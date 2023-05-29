<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidates;
use Illuminate\Support\Facades\Validator;
use App\Consts\ScreenConst;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApplyController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $jobId = $request->id;
        return view('layout.candidates.apply', ['id' => $jobId]);
    }

    public function apply(Request $request)
    {
        $candidatesInfo = [
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'email'             => $request->email,
            'phone_number'      => $request->phone_number,
            'residence'         => $request->residence,
            'japanese_skill_id' => $request->japanese_skill_id,
            'facebook_url'      => $request->facebook_url,
            'address'           => $request->address,
            'gender'            => $request->gender,
            'date_of_birth'     => $request->date_of_birth,
        ];

        $validationRules = [
            'first_name'         => ['bail', 'required', 'max_utf8:255'],
            'last_name'          => ['bail', 'required', 'max_utf8:255'],
            'email'              => ['bail', 'required', 'max_utf8:255'],
            'gender'             => ['bail', 'required', 'max_utf8:255'],
            'phone_number'       => ['bail', 'required', 'max_utf8:255'],
            'residence'          => ['bail', 'required', 'max_utf8:255'],
            'japanese_skill_id'  => ['bail', 'required', 'max_utf8:255'],
            'facebook_url'       => ['bail', 'required', 'max_utf8:255'],
            'address'            => ['bail', 'required', 'max_utf8:255'],
            'date_of_birth'      => ['bail', 'required' , 'max_utf8:20'],
        ];

        $validator = Validator::make($candidatesInfo, $validationRules);
        if ($validator->fails()) {
            $errors = [
                'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                'alertMsg' => __('messages.E0002'),
                'errorMsg' => json_decode($validator->messages()),
            ];
            return response()->json($errors);
        }
        try {
            $jobId = $request->id;
            // Get data
            $candidatesData = Candidates::where('job_id', '=', $jobId)
                ->where('phone_number', '=', $request->phone_number);
            // Check data exists
            if ($candidatesData->exists()) {
                $data = [
                    'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                    'alertMsg' => __('messages.EM005')
                ];
                return response()->json($data);
            }

            $paramRegist = $this->getCandidatesParamList($request);
            // Begin transaction
            DB::beginTransaction();
            Candidates::insert($paramRegist);
            // Commit
            DB::commit();
            // Regist Success
            $data = [
                'url'      => route('home'),
                'status'   => ScreenConst::PROCESS_STATUS_SUCCESS,
                'alertMsg' => __('messages.I0002', ['attribute1' => 'ứng tuyển', 'attribute2' => 'job'])
            ];
            return response()->json($data);
        } catch (\Exeption $ex) {
            DB::rollBack();
            $data = [
                'status'   => ScreenConst::PROCESS_STATUS_SYSTEM_ERROR,
                'alertMsg' => __('messages.E0001', ['attribute' => 'Ứng tuyển']),
            ];
            return response()->json($data);
        }
    }

    private function getCandidatesParamList($request)
    {
        $paramList = [];
        $paramList['job_id']            = $request->id;
        $paramList['first_name']        = $request->first_name;
        $paramList['last_name']         = $request->last_name;
        $paramList['email']             = $request->email;
        $paramList['phone_number']      = $request->phone_number;
        $paramList['residence']         = $request->residence;
        $paramList['japanese_skill_id'] = $request->japanese_skill_id;
        $paramList['facebook_url']      = $request->facebook_url;
        $paramList['address']           = $request->address;
        $paramList['gender']            = $request->gender;
        $paramList['date_of_birth']     = $request->date_of_birth;
        $paramList['is_contacted']      = false;
        $paramList['apply_date']        = Carbon::now();
        $this->setParamUpdateInfoCommon($paramList);
        return $paramList;
    }

    private function getCandidatesList()
    {
        $candidatesList = Candidates::factory()->count(60)->create();
        return $candidatesList;
    }
}
