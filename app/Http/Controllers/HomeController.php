<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobWork;
use App\Models\Tag;
use App\Models\Posts;
use App\Consts\ScreenConst;
use App\Libs\SessionManager;
use Illuminate\Support\Facades\DB;
use Session;

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
        $param['htmlRecentJobListHtmlArea'] = $this->getHtmlRecentJobListHtmlArea();
        $param['htmlTopJobsWithMostCandidatesHtmlArea'] = $this->getHtmlTopJobsWithMostCandidatesHtmlArea();
        $param['htmlPostList'] = $this->getPostList();

        $param = array_merge($this->srchList, $param);
        return view('layout.home.index', $param);
    }

    public function getDetailJob(Request $request)
    {
        try {
            $previousUrl = url()->previous();
            if ($previousUrl == url()->current()) {
                $previousUrl = Session::get('fromPage');
            } else {
                $previousUrl = url()->previous();
                Session::put('fromPage', $previousUrl);
            }
            $jobData = JobWork::where('id', $request->id)->first();
            $param['jobWork'] = $jobData;
            $param['jobId']   = $request->id ;
            $param['tagList'] = $this->getTagList($request->id);
            $param['previousUrl'] = $previousUrl;
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
        $recentJobWorkList = $jobWork->getJobWorkList($this->srchList, true)->take(9); // Lấy 9 công việc mới nhất
        return $recentJobWorkList;
    }

    private function getHtmlTopJobsWithMostCandidates()
    {
        $jobWork          = new JobWork();
        $topJobsWithMostCandidates = $jobWork->getTopJobsWithMostCandidates($this->srchList)->take(9); // Lấy 9 công việc mới nhất
        return $topJobsWithMostCandidates;
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
            $htmlRecentJobListHtmlArea = $this->getHtmlRecentJobListHtmlArea();
            $htmlTopJobsWithMostCandidatesHtmlArea = $this->getHtmlTopJobsWithMostCandidatesHtmlArea();
            $data = [
                'status'               => ScreenConst::PROCESS_STATUS_SUCCESS,
                'htmlRecentJobListHtmlArea' => $htmlRecentJobListHtmlArea,
                'htmlTopJobsWithMostCandidatesHtmlArea' => $htmlTopJobsWithMostCandidatesHtmlArea,
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

    private function getHtmlRecentJobListHtmlArea()
    {
        $recentJobList     = $this->getHtmlRecentJobList()->take(9);
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

    private function getPostList()
    {
        $postList = Posts::where('is_publish', true)->orderBy('id', 'desc')->get();
        $param = [];
        $param['postList'] = $postList;
        return view('layout.home.post_list', $param);
    }
}
