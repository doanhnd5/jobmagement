<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidates;
use App\Consts\ScreenConst;
use Illuminate\Support\Facades\DB;

class CadidatesController extends Controller
{

    private ?array $srchList;

    public function __construct(Request $request)
    {
        parent::__construct();

        $this->srchList = [];
    }

    public function index(Request $request)
    {
        $param = [];
        $param['htmCandidatesArea'] = $this->getCandidateHtmlArea();
        return view('layout.candidates.candidates', $param);
    }

    public function confirm(Request $request)
    {
        try {
            $candidatesId = $request->id;
            // Get data
            $candidatesData = Candidates::where('id', '=', $candidatesId);
            // Check data exists
            if (!$candidatesData->exists()) {
                $data = [
                    'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                    'alertMsg' => __('messages.EM004', ['attribute' => 'ứng viên'])
                ];
                return $data;
            }

            // Check newest data
            if ($this->isAlreadyUpdated($request, $candidatesData->first())) {
                $data = [
                    'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                    'alertMsg' => __('messages.EM003', ['attribute' => 'ứng viên'])
                ];
                return $data;
            }
            $paramUpdate = [];
            $paramUpdate['is_contacted'] = true;
            $paramUpdate['remark'] = $request->remark;
            $this->setParamUpdateInfoCommon($paramUpdate);
            // Begin transaction
            DB::beginTransaction();
            Candidates::where('id', '=', $candidatesId)->update($paramUpdate);
            // Commit
            DB::commit();
            // Search Newest Candidates Data
            $this->setSrchList($request);
            // Regist Success
            $data = [
                'htmCandidatesArea' => $this->getCandidateHtmlArea(),
                'status'   => ScreenConst::PROCESS_STATUS_SUCCESS,
                'alertMsg' => __('messages.I0002', ['attribute1' => 'Xác nhận đã liên hệ', 'attribute2' => 'ứng viên'])
            ];
            return response()->json($data);
        } catch (\Exeption $ex) {
            DB::rollBack();
            $data = [
                'status'   => ScreenConst::PROCESS_STATUS_SYSTEM_ERROR,
                'alertMsg' => __('messages.E0001', ['attribute' => 'Xác nhận liên hệ ứng viên']),
            ];
            return response()->json($data);
        }
    }

    public function changeContactStatus(Request $request)
    {
        return $this->searchCommon($request);
    }

    public function search(Request $request)
    {
        return $this->searchCommon($request);
    }

    private function searchCommon($request)
    {
        try {
            $this->setSrchList($request);
            // Regist Success
            $data = [
                'htmCandidatesArea' => $this->getCandidateHtmlArea(),
                'status' => ScreenConst::PROCESS_STATUS_SUCCESS
            ];
            return response()->json($data);
        } catch (\Exeption $ex) {
            $data = [
                'url'      => route('candidates'),
                'status'   => ScreenConst::PROCESS_STATUS_SYSTEM_ERROR,
                'alertMsg' => __('messages.E0001', ['attribute' => 'Tìm kiếm ứng viên']),
            ];
            return response()->json($data);
        }
    }

    private function getCandidatesList()
    {
        $candidates     = new Candidates();
        $candidatesList = $candidates->getCandidateList($this->srchList);
        return $candidatesList;
    }

    private function getCandidateHtmlArea()
    {
        $candidateList = $this->getCandidatesList();
        $param = [];
        $param['candidatesList'] = $candidateList->paginate(ScreenConst::MAX_PER_PAGE);
        return view('layout.candidates.table_candidates', $param)->render();
    }

    private function setSrchList(Request $request)
    {
        $this->srchList['name']           = $request->name;
        $this->srchList['phone_number']   = $request->phone_number;
        $this->srchList['email']          = $request->email;
        $this->srchList['job_name']       = $request->job_name;
        $this->srchList['contact_status'] = $request->contact_status;
    }
}
