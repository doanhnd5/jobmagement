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
    const TAG_DEFAULT = "";

    public function __construct(Request $request)
    {
        parent::__construct();
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
        $jobInformation = [
            'job_name'             => $request->job_name,
            'employment_type_id'   => $request->employment_type_id,
            'tag'                  => $request->tag,
            'workplace_city'       => $request->workplace_city,
            'workplace_prefecture' => $request->workplace_prefecture,
            'work_time_from'       => $request->work_time_from,
            'work_time_to'         => $request->work_time_to,
            'salary'               => $request->salary,
            'description'          => $request->description,
            'company_name'         => $request->company_name,
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
            $jobId     = $request->id;
            // Begin transaction
            DB::beginTransaction();
            if (isset($jobId)) {
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
                $paramUpdate       = $this->getJobParamList($request);
                $paramUpdate['id'] = $jobId;
                $this->setParamUpdateInfoCommon($paramUpdate);
                JobWork::where('id', '=', $jobId)->update($paramUpdate);
                $isSuccess = true;
            } else {
                $paramRegist = $this->getJobParamList($request);
                $this->setParamCreateInfoCommon($paramRegist);
                $jobId = JobWork::insertGetId($paramRegist);
                $isSuccess = true;
            }

            if ($isSuccess) {
                // Resgist Tag
                $isExist = JobTag::where('job_id', '=', $jobId)->exists();
                if ($isExist) {
                    JobTag::where('job_id', '=', $jobId)->delete();
                }
                $tagIdList = $request->tag;
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

    private function getJobParamList($request)
    {
        $paramList = [];
        $paramList['job_name']             = $request->job_name;
        $paramList['employment_type_id']   = $request->employment_type_id;
        $paramList['workplace_prefecture'] = $request->workplace_prefecture;
        $paramList['workplace_city'] = $request->workplace_city;
        $paramList['work_time_from'] = $request->work_time_from;
        $paramList['work_time_to']   = $request->work_time_to;
        $paramList['company_name']   = $request->company_name;
        $paramList['salary']         = $request->salary;
        $paramList['description']    = $request->description;
        return $paramList;
    }
}
