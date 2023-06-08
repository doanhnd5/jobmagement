<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobWork;
use App\Models\Tag;
use App\Consts\ScreenConst;
use App\Libs\SessionManager;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private ?array $srchList;

    public function __construct(Request $request)
    {
        parent::__construct();

        $this->srchList = [];
    }

    public function index(Request $request)
    {
        $this->setSrchList($request);
        $param   = [];
        $param['tagList']              = Tag::all()->pluck('name', 'id');
        $param['jobWorkHotList']       = $this->getHtmlHotJobList();
        $param['htmlJobWorkBasicArea'] = $this->getJobWorkBasicHtmlArea();
        $param['htmlRecentJobListHtmlArea']    =$this->getHtmlRecentJobListHtmlArea();
        $param['htmlTopJobsWithMostCandidatesHtmlArea']    =$this->getHtmlTopJobsWithMostCandidatesHtmlArea();

        $param = array_merge($this->srchList, $param);
        return view('layout.home.index', $param);
    }

    public function getDetailJob(Request $request)
    {
        try {
            $jobData = JobWork::where('id', $request->id)->first();
            $param['jobWork'] = $jobData;
            $param['jobId']   = $request->id ;
            $param['tagList'] = $this->getTagList($request->id);
            return view('layout.home.detail', $param);
        } catch (\Exeption $ex) {
            return view('errors.index');
        }
    }

    public function getJobList(Request $request)
    {
        try {
            $this->setSrchList($request);
            $jobWork        = new JobWork();
            $jobWorkList    = $jobWork->getJobWorkList($this->srchList, true)->paginate(ScreenConst::MAX_PER_PAGE_HOME_LIST);
            $hotJobWorkList = $jobWork->getHotJobList();
            $param = [];
            $param['jobWorkHotList'] = $hotJobWorkList;
            $param['jobBasicList']   = $jobWorkList;
            return view('layout.home.list', $param);
        } catch (\Exeption $ex) {
            return view('errors.index');
        }
    }

    private function getHtmlHotJobList()
    {
        $jobWork        = new JobWork();
        $hotJobWorkList = $jobWork->getHotJobList();
        return $hotJobWorkList;
    }

    private function getHtmlRecentJobList()
    {
        $jobWork          = new JobWork();
        $recentJobWorkList = $jobWork->getRecentJobList(9); // Lấy 9 công việc mới nhất
        return $recentJobWorkList;
    }

    private function getHtmlTopJobsWithMostCandidates()
    {
        $jobWork          = new JobWork();
        $topJobsWithMostCandidates = $jobWork->getTopJobsWithMostCandidates(9); // Lấy 9 công việc mới nhất
        return $topJobsWithMostCandidates;
    }

    
    private function getJobWorkBasicList()
    {
        $jobWork     = new JobWork();
        $jobWorkList = $jobWork->getJobWorkList($this->srchList, true);
        return $jobWorkList;
    }

    private function setSrchList(Request $request)
    {
        $this->srchList['srchArea']    = $request->srchArea ?? null;
        $this->srchList['srchJobType'] = $request->srchJobType ?? null;
        $this->srchList['srchKeyAny']  = $request->srchKeyAny ?? null;
        $this->srchList['srchTag']     = $request->srchTag ?? null;
    }

    public function search(Request $request)
    {
        try {
            $this->setSrchList($request);
            $htmlJobWorkBasicArea = $this->getJobWorkBasicHtmlArea();
            $data = [
                'status'               => ScreenConst::PROCESS_STATUS_SUCCESS,
                'htmlJobWorkBasicArea' => $htmlJobWorkBasicArea,
            ];
            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'url'      => route('home'),
                'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                'alertMsg' => __('messages.E0001', ['attribute' => 'Tìm kiếm job']),
            ];
            return response()->json($data);
        }
    }

    private function getJobWorkBasicHtmlArea()
    {
        $jobWorkBasicList     = $this->getJobWorkBasicList()->take(12);
        $htmlJobWorkBasicArea = view('layout.home.basic_job', ['jobWorkBasicList' =>  $jobWorkBasicList])->render();
        return $htmlJobWorkBasicArea;
    }

    private function getHtmlRecentJobListHtmlArea()
    {
        $recentJobList     = $this->getHtmlRecentJobList()->take(12);
        $htmlRecentJobListHtmlArea = view('layout.home.recent_job', ['recentJobList' =>  $recentJobList])->render();
        return $htmlRecentJobListHtmlArea;
    }

    private function getHtmlTopJobsWithMostCandidatesHtmlArea()
    {
        $topJobsWithMostCandidates = $this->getHtmlTopJobsWithMostCandidates();
        $htmlTopJobsWithMostCandidatesHtmlArea = view('layout.home.top_jobs', ['topJobsWithMostCandidates' => $topJobsWithMostCandidates])->render();
        return $htmlTopJobsWithMostCandidatesHtmlArea;
    }
    
    private function getTagList($jobId)
    {
        $tagList = DB::table('job_tag')->join('tags', 'tags.id', '=', 'job_tag.tag_id')
            ->where('job_tag.job_id', '=', $jobId)
            ->select(
                'tags.id',
                'tags.name'
            )
            ->orderBy('tags.id')
            ->get();

        if ($tagList->count() != 0) {
            $tagList = $tagList->pluck('name', 'id')->toArray();
        }
        return $tagList;
    }
}
