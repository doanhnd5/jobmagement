@php
    $displayTime = \Carbon\Carbon::now();
@endphp

@extends('layout.base')

@section('content')
    <section class="page-user container px-2 mb-5 selectionTableList">
        <br>
        <h2 class="font-bold text-base md:text-3xl text-center text-40381F mb-7">Thông tin về job</h2>
        <form method="post" enctype="multipart/form-data" id="form">
            <div class="user-information bg-white p-4 py-5" id="formBox">
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Tên công việc
                        </div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <input type="text" name="txtJobName" id="txtJobName" value="{{ $jobData['job_name'] ?? null }}"
                        class="bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a w-full border border-gray-c"
                        >
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Hình thức tuyển dụng
                        </div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <select name="ddlEmployeeType" id="ddlEmployeeType"
                        class="font-normal w-full text-555 border rounded border-solid border-gray-c py-2 pl-2 pr-6">
                        @foreach (ScreenConst::JOB_TYPE_NAME as $jobTypeKey => $jobTypeName)
                            @if (isset($jobData['employment_type_id']) && $jobTypeKey == $jobData['employment_type_id'])
                                <option value="{{ $jobTypeKey }}" selected>{{ $jobTypeName }}</option>
                            @else
                                <option value="{{ $jobTypeKey }}">{{ $jobTypeName }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Khu vực
                        </div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <select name="ddlJobArea" id="ddlJobArea"
                        class="font-normal w-full text-555 border rounded border-solid border-gray-c py-2 pl-2 pr-6">
                        @foreach (ScreenConst::JOB_AREA_NAME as $areaKey => $areaName)
                            @if (isset($jobData['workplace_prefecture']) && $areaKey == $jobData['workplace_prefecture'])
                                <option value="{{ $areaKey }}" selected>{{ $areaName }}</option>
                            @else
                                <option value="{{ $areaKey }}">{{ $areaName }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Tag
                        </div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach ($tagList as $tagKey => $tagType)
                            <div class="flex items-center">
                                @if (in_array($tagKey, $selectedTagList))
                                    <input id="tag_{{ $tagKey }}" name="chkTag" type="checkbox" checked value="{{ $tagKey }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="tag_{{ $tagKey }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tagType }}</label>
                                @else
                                    <input id="tag_{{ $tagKey }}" name="chkTag" type="checkbox" value="{{ $tagKey }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="tag_{{ $tagKey }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tagType }}</label>
                                @endif
                            </div>
                        @endforeach
                      </div>
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Thành phố
                        </div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <input type="text" name="txtWorkPlaceCity" id="txtWorkPlaceCity" value="{{ $jobData['workplace_city'] ?? null }}"
                        class="bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a w-full border border-gray-c"
                        >
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Tên công ty
                        </div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <input type="text" name="txtCompany" id="txtCompany" value="{{ $jobData['company_name'] ?? null }}"
                        class="bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a w-full border border-gray-c"
                        >
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Nội dung công việc</div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <textarea id="txtDescription" rows="4" value="{{ $jobData['description'] ?? null }}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $jobData['description'] ?? "" }}</textarea>
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Thời gian
                            làm việc</div>
                            <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <div class="gap-3">
                        @php
                            $workTimeFrom = App\Libs\SystemUtil::getWorkTime($jobData['work_time_from'] ?? "");
                            $workTimeTo   = App\Libs\SystemUtil::getWorkTime($jobData['work_time_to'] ?? "");
                        @endphp
                        <div class="flex items-center">
                            <input type="text" placeholder="HH:MM"  value="{{ $workTimeFrom }}" maxlength="4" name="txtWorkTimeFrom" id="txtWorkTimeFrom"
                                class="form-input-time mr-2 bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a border border-gray-c"
                                >
                            <span class="mr-2">～</span>
                            <div class="flex items-center">
                                <input type="text" maxlength="4" value="{{ $workTimeTo }}" placeholder="HH:MM" name="txtWorkTimeTo" id="txtWorkTimeTo"
                                    class="form-input-time bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a border border-gray-c"
                                    >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Mức lương cơ bản
                           </div>
                           <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <input type="text" name="txtSalary" id="txtSalary" value="{{ $jobData['salary'] ?? null }}"
                    class="bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a w-full border border-gray-c"
                    >
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5 mr-2">Ưu tiên</div>
                    </div>
                    <div class="flex">
                        <div class="mb-[0.125rem] mr-4 inline-block min-h-[1.5rem] pl-[1.5rem]">
                            <input
                              class="relative float-left -ml-[1.5rem] mr-1 mt-0.5 h-5 w-5 rounded-full border-2 border-solid border-neutral-300 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:border-neutral-600 dark:checked:border-primary dark:checked:after:border-primary dark:checked:after:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:border-primary dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
                              type="radio"
                              name="rdoJobImportant"
                              id="rdoYes"
                              value="1" />
                            <label
                              class="mt-px inline-block pl-[0.15rem] hover:cursor-pointer"
                              for="rdoYes">Yes</label
                            >
                        </div>
                        <div class="mb-[0.125rem] mr-4 inline-block min-h-[1.5rem] pl-[1.5rem]">
                            <input class="relative float-left -ml-[1.5rem] mr-1 mt-0.5 h-5 w-5 rounded-full border-2 border-solid border-neutral-300 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:border-neutral-600 dark:checked:border-primary dark:checked:after:border-primary dark:checked:after:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:border-primary dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
                              type="radio"
                              name="rdoJobImportant"
                              id="rdoNo"
                              value="0" checked/>
                            <label
                              class="mt-px inline-block pl-[0.15rem] hover:cursor-pointer"
                              for="rdoNo">No</label>
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5 mr-2">Ảnh đại diện công việc</div>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="shrink-0">
                            @php
                                $isSetImage = isset($jobData['image_name']);
                            @endphp
                          <img id='preview_img' class="
                                @if (!$isSetImage)
                                    hidden
                                @endif h-16 w-16 object-cover" src="{{ $isSetImage ? asset('image/uploaded/' . $jobData['image_name']) : "" }}" />
                        </div>
                        <label class="block">
                          <span class="sr-only">Choose photo</span>
                          <input type="file" id="txtImage" onchange="loadFile(event)" class="block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-violet-50 file:text-violet-700
                            hover:file:bg-violet-100
                          "/>
                        </label>
                      </div>
                </div>
            </div>
            <div class="flex items-center justify-center mt-4 mb-10">
                <button type="button" id="btnBack" data-url="{{ route('job_list') }}" class="mr-2 flex justify-center items-center h-[50px] w-[187px] rounded bg-[#F5CE0A]">
                    <span class="text-white text-[14px]">Quay lại</span>
                </button>
                <button type="button" id="btnRegist"
                data-url="{{ route('regist') }}"
                class="flex justify-center items-center h-[50px] w-[187px] rounded bg-[#FF7A00]"
                data-cfm-msg="{{ __('messages.I0001', ['attribute1' => 'tạo', 'attribute2' => 'job']) }}">
                    <span class="text-white text-[14px]">Create Job</span>
                </button>
            </div>
        </form>
    </section>
    <input type="text" id="txtDatetimeDisplay" hidden value="{{ $displayTime }}">
    <input type="text" id="txtJobId" hidden value="{{ $jobId }}">
@endsection

@section('js')
    <script src="{{ asset(App\Libs\AssetHelper::cacheBusting('js/createJob.js')) }}"></script>
@endsection

