<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Posts;
use App\Models\JobTag;
use Illuminate\Support\Facades\Validator;
use App\Consts\ScreenConst;
use Illuminate\Support\Facades\DB;

class CreatePostController extends Controller
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
            $param             = [];
            $postData          = Posts::where('id', $request->id)->first();
            $param['postData'] = $postData;
            $param['postId']   = $request->id;
            return view('layout.post.create_post', $param);
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
                'post_title'   => $registParam->post_title,
                'post_content' => $registParam->post_content
            ];

            $validationRules = [
                'post_title'   => ['bail', 'required', 'max_utf8:255'],
                'post_content' => ['bail', 'required'],
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
                $postId    = $registParam->id;
                $paramListRegistList = $this->getPostParamList($request, $registParam);
                // Begin transaction
                DB::beginTransaction();
                if (!empty($postId)) {
                    // Get data
                    $postData = Posts::where('id', '=', $postId);
                    // Check data exists
                    if (!$postData->exists()) {
                        $data = [
                            'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                            'alertMsg' => __('messages.EM004', ['attribute' => 'bài đăng'])
                        ];
                        return $data;
                    }

                    // Check newest data
                    if ($this->isAlreadyUpdated($request, $postData->first())) {
                        $data = [
                            'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                            'alertMsg' => __('messages.EM003', ['attribute' => 'bài đăng'])
                        ];
                        return $data;
                    }
                    $this->setParamUpdateInfoCommon($paramListRegistList);
                    Posts::where('id', '=', $postId)->update($paramListRegistList);
                } else {
                    $this->setParamCreateInfoCommon($paramListRegistList);
                    $paramListRegistList['is_publish'] = false;
                    Posts::insert($paramListRegistList);
                }

                // Move uploaded image
                if (!empty($this->imageName)) {
                    $desPath = public_path('image/post/' . $this->imageName);
                    move_uploaded_file($this->tmpPath, $desPath);
                }
                // Commit
                DB::commit();
                // Regist Success
                $data = [
                    'url'      => route('post_list'),
                    'status'   => ScreenConst::PROCESS_STATUS_SUCCESS,
                    'alertMsg' => __('messages.I0002', ['attribute1' => 'Tạo', 'attribute2' => 'bài đăng'])
                ];
                return response()->json($data);
            } catch (\Exeption $ex) {
                DB::rollBack();
                $data = [
                    'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                    'alertMsg' => __('messages.E0001', ['attribute' => 'Tạo bài đăng']),
                ];
                return response()->json($data);
            }
        } catch (\Exeption $ex) {
            DB::rollBack();
            $data = [
                'status'   => ScreenConst::PROCESS_STATUS_SYSTEM_ERROR,
                'alertMsg' => __('messages.E0001', ['attribute' => 'Tạo bài đăng']),
            ];
            return response()->json($data);
        }
    }

    private function getPostParamList($request, $paramRegist)
    {
        $paramList = [];
        $paramList['post_title']   = $paramRegist->post_title;
        $paramList['post_content'] = $paramRegist->post_content;
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
