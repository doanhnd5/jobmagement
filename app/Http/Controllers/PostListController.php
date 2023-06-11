<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Consts\ScreenConst;
use Illuminate\Support\Facades\DB;

class PostListController extends Controller
{
    private ?array $srchList;

    public function __construct(Request $request)
    {
        parent::__construct();

        $this->srchList = [];
    }

    public function index(Request $request)
    {
        try {
            $this->setSrchList($request);
            $param['htmlSearchArea'] = $this->getHtmlSearchArea();
            $param['htmlTableArea']  = $this->getHtmlTableArea();
            return view('layout.post.post_list', $param);
        } catch (\Exeption $ex) {
            return view('errors.index');
        }
    }

    public function getPostList(Request $request)
    {
        try {
            $postList = Posts::all()->paginate(ScreenConst::MAX_PER_PAGE_HOME_LIST);
            $param = [];
            $param['postList'] = $postList;
            return view('layout.post.public_post', $param);
        } catch (\Exeption $ex) {
            return view('errors.index');
        }
    }

    public function getPostDetail(Request $request)
    {
        try {
            $postData = Posts::where('id', '=', $request->id)->first();
            if (is_null($postData)) {
                return view('errors.index');
            }
            $param = [];
            $param['postData'] = $postData;
            return view('layout.post.post_detail', $param);
        } catch (\Exeption $ex) {
            return view('errors.index');
        }
    }



    public function search(Request $request)
    {
        try {
            $this->setSrchList($request);
            $htmlTableArea = $this->getHtmlTableArea();
            $data = [
                'status'        => ScreenConst::PROCESS_STATUS_SUCCESS,
                'htmlTableArea' => $htmlTableArea,
            ];
            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'url'      => route('job_list'),
                'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                'alertMsg' => __('messages.E0001', ['attribute' => 'Tìm kiếm job']),
            ];
            return response()->json($data);
        }
    }

    public function delete(Request $request)
    {
        try {
            $postId = $request->id;
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
            // Begin Transaction
            DB::beginTransaction();
            // Delete Job
            $postData->delete();
            // Commit
            DB::commit();
            // Delete Success
            $data = [
                'url'      => route('post_list'),
                'status'   => ScreenConst::PROCESS_STATUS_SUCCESS,
                'alertMsg' => __('messages.I0002', ['attribute1' => 'Xóa', 'attribute2' => 'bài đăng'])
            ];
            return response()->json($data);
        } catch (\Exeption $ex) {
            DB::rollBack();
            $data = [
                'status'   => ScreenConst::PROCESS_STATUS_SYSTEM_ERROR,
                'alertMsg' => __('messages.E0001', ['attribute' => 'Xóa bài đăng']),
            ];
            return response()->json($data);
        }
    }

    public function publish(Request $request)
    {
        try {
            $postId = $request->id;
            // Get data
            $postData = Posts::where('id', '=', $postId);
            // Check data exists
            if (!$postData->exists()) {
                $data = [
                    'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                    'alertMsg' => __('messages.EM004', ['attribute' => 'Bài đăng'])
                ];
                return $data;
            }

            // Check newest data
            if ($this->isAlreadyUpdated($request, $postData->first())) {
                $data = [
                    'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                    'alertMsg' => __('messages.EM003', ['attribute' => 'Bài đăng'])
                ];
                return $data;
            }
            $paramUpdate = [];
            $paramUpdate['is_publish'] = true;
            $this->setParamUpdateInfoCommon($paramUpdate);
            // Begin transaction
            DB::beginTransaction();
            Posts::where('id', '=', $postId)->update($paramUpdate);
            // Commit
            DB::commit();
            // Search Newest Candidates Data
            $this->setSrchList($request);
            // Regist Success
            $data = [
                'htmlTableArea' => $this->getHtmlTableArea(),
                'status'   => ScreenConst::PROCESS_STATUS_SUCCESS,
                'alertMsg' => __('messages.I0002', ['attribute1' => 'Bài đăng được', 'attribute2' => 'xuất bản'])
            ];
            return response()->json($data);
        } catch (\Exeption $ex) {
            DB::rollBack();
            $data = [
                'status'   => ScreenConst::PROCESS_STATUS_SYSTEM_ERROR,
                'alertMsg' => __('messages.E0001', ['attribute' => 'Xuất bản bài đăng']),
            ];
            return response()->json($data);
        }
    }

    private function getHtmlTableArea()
    {
        $post     = new Posts();
        $postList = $post->getPostList($this->srchList);
        $param = [
            'postList' => $postList->paginate(ScreenConst::MAX_PER_PAGE),
        ];
        return view('layout.post.table_post', $param)->render();
    }

    private function getHtmlSearchArea()
    {
        $param   = [];
        $param['srchList'] = $this->srchList;
        return view('layout.post.search_post', $param)->render();
    }

    private function setSrchList(Request $request)
    {
        $this->srchList['srchPostTitle'] = $request->srchPostTitle ?? null;
    }

}
