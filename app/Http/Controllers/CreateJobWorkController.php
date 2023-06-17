<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\JobWork;
use App\Models\JobTag;
use Illuminate\Support\Facades\Validator;
use App\Consts\ScreenConst;
use Illuminate\Support\Facades\DB;

class CreateJobWorkController extends Controller
{
    private ?string $tmpPath;
    private ?string $imageName;

    const TAG_DEFAULT = "";

    public function __construct(Request $request)
    {
        parent::__construct();
        // Init Variable
        $this->tmpPath   = "";
        $this->imageName = "";
    }

    public function index(Request $request)
    {
        try {
            $param                    = [];
            $jobData                  = JobWork::where('id', $request->id)->first();
            $selectedTagList          = $this->getSelectedTagList($request->id);
            $param['jobData']         = $jobData;
            $param['tagList']         = Tag::all()->pluck('name', 'id');
            $param['selectedTagList'] = $selectedTagList->toArray();
            $param['jobId']   = $request->id;
            return view('layout.job.create_job', $param);
        } catch (\Exeption $ex) {
            return view('errors.index');
        }
    }

    public function regist(Request $request)
    {
        try {
            // Uploaed Image
            $this->setUploadedImageInfor($request);
            // Regist Param
            $registParam = json_decode($request->paramRegist);
            // Validate
            $jobInformation = [
                'job_name'             => $registParam->job_name,
                'employment_type_id'   => $registParam->employment_type_id,
                'tag'                  => $registParam->tag,
                'workplace_city'       => $registParam->workplace_city,
                'workplace_prefecture' => $registParam->workplace_prefecture,
                'work_time_from'       => $registParam->work_time_from,
                'work_time_to'         => $registParam->work_time_to,
                'salary'               => $registParam->salary,
                'description'          => $registParam->description,
                'company_name'         => $registParam->company_name,
            ];

            $validationRules = [
                'job_name'             => ['bail', 'required', 'max_utf8:255'],
                'employment_type_id'   => ['bail', 'required', 'max_utf8:255'],
                'tag'                  => ['bail', 'array_length:1'],
                'workplace_city'       => ['bail', 'required', 'max_utf8:255'],
                'workplace_prefecture' => ['bail', 'required', 'max_utf8:255'],
                'work_time_from'       => ['bail', 'required', 'max_utf8:4', ],
                'work_time_to'         => ['bail', 'required', 'max_utf8:4'],
                'salary'               => ['bail', 'required'],
                'company_name'         => ['bail', 'required'],
            ];

            $validator = Validator::make($jobInformation, $validationRules);
            if ($validator->fails()) {
                $errors = [
                    'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                    'alertMsg' => __('messages.E0002'),
                    'errorMsg' => json_decode($validator->messages()),
                ];
                return response()->json($errors);
            }
            try {
                $isSuccess = false;
                $jobId     = $registParam->id;
                $paramListRegistList = $this->getJobParamList($request, $registParam);
                // Begin transaction
                DB::beginTransaction();
                if (!empty($jobId)) {
                    // Get data
                    $jobData = JobWork::where('id', '=', $jobId);
                    // Check data exists
                    if (!$jobData->exists()) {
                        $data = [
                            'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                            'alertMsg' => __('messages.EM004', ['attribute' => 'job'])
                        ];
                        return $data;
                    }

                    // Check newest data
                    if ($this->isAlreadyUpdated($request, $jobData->first())) {
                        $data = [
                            'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                            'alertMsg' => __('messages.EM003', ['attribute' => 'job'])
                        ];
                        return $data;
                    }
                    $paramListRegistList['id'] = $jobId;
                    $this->setParamUpdateInfoCommon($paramListRegistList);
                    JobWork::where('id', '=', $jobId)->update($paramListRegistList);
                    $isSuccess = true;
                } else {
                    $this->setParamCreateInfoCommon($paramListRegistList);
                    $jobId = JobWork::insertGetId($paramListRegistList);
                    $isSuccess = true;
                }

                if ($isSuccess) {
                    // Resgist Tag
                    $isExist = JobTag::where('job_id', '=', $jobId)->exists();
                    if ($isExist) {
                        JobTag::where('job_id', '=', $jobId)->delete();
                    }
                    $tagIdList = $registParam->tag;
                    $paramList   = [];
                    $paramCommon = [];
                    $this->setParamCreateInfoCommon($paramCommon, false);
                    foreach ($tagIdList as $key => $tagId) {
                        $param = [];
                        $param['job_id'] = $jobId;
                        $param['tag_id'] = $tagId;
                        $param = array_merge($paramCommon, $param);
                        array_push($paramList, $param);
                    }
                    JobTag::insert($paramList);
                }

                // Move uploaded image
                if (!empty($this->imageName)) {
                    $desPath = public_path('image/uploaded/' . $this->imageName);
                    move_uploaded_file($this->tmpPath, $desPath);
                }
                // Commit
                DB::commit();
                // Regist Success
                $data = [
                    'url'      => route('job_list'),
                    'status'   => ScreenConst::PROCESS_STATUS_SUCCESS,
                    'alertMsg' => __('messages.I0002', ['attribute1' => 'Thêm', 'attribute2' => 'job'])
                ];
                return response()->json($data);
            } catch (\Exeption $ex) {
                DB::rollBack();
                $data = [
                    'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                    'alertMsg' => __('messages.E0001', ['attribute' => 'Tạo job']),
                ];
                return response()->json($data);
            }
        } catch (\Exeption $ex) {
            DB::rollBack();
            $data = [
                'status'   => ScreenConst::PROCESS_STATUS_SYSTEM_ERROR,
                'alertMsg' => __('messages.E0001', ['attribute' => 'Tạo job']),
            ];
            return response()->json($data);
        }
    }

    private function getSelectedTagList($jobId)
    {
        $tagList = DB::table('job_tag')
            ->join('tags', 'tags.id', '=', 'job_tag.tag_id')
            ->select('tags.id')
            ->where('job_tag.job_id', '=', $jobId)
            ->get();

        $tagIdList = $tagList->pluck('id');
        return $tagIdList;
    }

    private function getJobParamList($request, $paramRegist)
    {
        $paramList = [];
        $paramList['job_name']             = $paramRegist->job_name;
        $paramList['employment_type_id']   = $paramRegist->employment_type_id;
        $paramList['workplace_prefecture'] = $paramRegist->workplace_prefecture;
        $paramList['workplace_city'] = $paramRegist->workplace_city;
        $paramList['work_time_from'] = $paramRegist->work_time_from;
        $paramList['work_time_to']   = $paramRegist->work_time_to;
        $paramList['company_name']   = $paramRegist->company_name;
        $paramList['salary']         = $paramRegist->salary;
        $paramList['description']    = $paramRegist->description;
        $paramList['is_important']   = $paramRegist->is_important;
        if (!empty($this->imageName)) {
            $paramList['image_name'] = $this->imageName;
        }
        return $paramList;
    }

    private function setUploadedImageInfor($request)
    {
        if (isset($_FILES['image'])) {
            $this->tmpPath   = $_FILES['image']['tmp_name'];
            $this->imageName = $_FILES['image']['name'];
        }
    }
}
