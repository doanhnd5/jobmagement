<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobWork;
use App\Models\Tag;
use App\Consts\ScreenConst;
use Illuminate\Support\Facades\DB;

class JobListController extends Controller
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
            return view('layout.job.job_list', $param);
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
            $jobId = $request->id;
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
            // Begin Transaction
            DB::beginTransaction();
            // Delete Job
            $jobData->delete();
            // Commit
            DB::commit();
            // Delete Success
            $data = [
                'url'      => route('job_list'),
                'status'   => ScreenConst::PROCESS_STATUS_SUCCESS,
                'alertMsg' => __('messages.I0002', ['attribute1' => 'Xóa', 'attribute2' => 'job'])
            ];
            return response()->json($data);
        } catch (\Exeption $ex) {
            DB::rollBack();
            $data = [
                'status'   => ScreenConst::PROCESS_STATUS_SYSTEM_ERROR,
                'alertMsg' => __('messages.E0001', ['attribute' => 'Xóa job']),
            ];
            return response()->json($data);
        }
    }

    private function getHtmlTableArea()
    {
        $jobWork     = new JobWork();
        $jobWorkList = $jobWork->getJobWorkList($this->srchList);
        $param = [
            'jobWorkList' => $jobWorkList->paginate(ScreenConst::MAX_PER_PAGE),
        ];
        return view('layout.job.table_job', $param)->render();
    }

    private function getHtmlSearchArea()
    {
        $param   = [];
        $tagList = Tag::all()->pluck('name', 'id');
        $param['srchList'] = $this->srchList;
        $param['tagList']  = $this->setDdlEmptyDataNullable($tagList, "");
        return view('layout.job.search_job', $param)->render();
    }

    private function getJobWorkList()
    {
        $jobWorkList = JobWork::all();
        return $jobWorkList;
    }

    private function setSrchList(Request $request)
    {
        $this->srchList['srchArea']    = $request->srchJobArea ?? null;
        $this->srchList['srchJobType'] = $request->srchEmploymentType ?? null;
    }
}
