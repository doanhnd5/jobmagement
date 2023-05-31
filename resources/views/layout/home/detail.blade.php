@extends('layout.base')

@section('content')
<div class="job-work-detail">
    <section class="fv relative -mt-[50px] md:mt-0 hidden md:block">
        <div class="fv-slider relative h-[260px]">
          <img src="{{ asset('image/jobsempai_layer.jpg') }}" class="w-full h-full object-cover">
        </div>
    </section>
    <div class="max-w-[820px] m-auto">
        <div class="job-work-detail-header">
            <h2 class="job-title my-5 font-bold text-sm text-center">{{ $jobWork['job_name'] ?? "" }}</h2>
            <div class="p-3 md:p-5 mb-6 bg-third-blue">
                <div class="job-infor">
                    <div class="flex justify-center items-center mr-[3px]">
                        <i class="icon-group-fill-blue w-4 h-4"></i>
                    </div>
                    <div class="font-bold text-xs leading-[18px] tracking-wider text-[#666]">Hình thức</div>
                    <div class="font-medium text-xs leading-[18px] tracking-[0.01em] text-[#666]">
                        {{ ScreenConst::JOB_TYPE_NAME[$jobWork['employment_type_id']] }}
                    </div>
                    <div class="flex justify-center items-center mr-[3px]">
                        <i class="icon-currency-yen-blue w-4 h-4"></i>
                    </div>
                    <div class="font-bold text-xs leading-[18px] tracking-wider text-[#666]">Mức lương</div>
                    <div class="font-medium text-xs leading-[18px] tracking-[0.01em] text-[#666]">
                        {{ $jobWork['salary'] . '円' }}
                    </div>
                </div>
                <div class="list_tag flex flex-wrap gap-[8px] mt-[8px]">
                    <div class="flex flex-wrap gap-2">
                        @foreach ($tagList as $tagName )
                            <span class="p-1 border border-main-blue rounded font-medium text-[10px] leading-4 text-main-blue ">
                                {{ $tagName }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="job-work-detail-body text-555">
            <div class="m-auto">
                <div class="bg-white p-3 md:p-5 mb-5">
                    <div class="grid mb-4 text-center">
                        <p class="text-base">
                            <i class="fal fa-file-alt text-main-blue"></i>
                        </p>
                        <p class="font-bold text-lg">Nội dung công việc</p>
                    </div>
                    <div class="font-light text-sm tracking-[.04em] text-5">
                        {!! nl2br($jobWork['description']) ?? null !!}
                    </div>
                </div>
            </div>
            <div class="m-auto">
                <div class="bg-white p-3 md:p-5 mb-5">
                    <div class="grid mb-4 text-center">
                        <p class="text-base">
                            <i class="fal fa-tag text-main-blue"></i>
                        </p>
                        <p class="font-bold text-lg text-center">Thông tin chi tiết</p>
                    </div>
                    <div class="detail-information-table">
                        <div class="font-bold text-sm leading-[21px] tracking-[.04em] text-5 line-left mb-1 md:mb-2.5">Công ty đăng tuyển</div>
                        <div class="font-light text-sm leading-[21px] tracking-[.04em text-5] pl-2 mb-[10px]">
                            {{$jobWork['company_name'] ?? ''}}
                        </div>
                        <div class="font-bold text-sm leading-[21px] tracking-[.04em] text-5 line-left mb-1">Hình thức tuyển dụng</div>
                        <div class="font-light text-sm leading-[21px] tracking-[.04em text-5] pl-2 mb-[10px]">
                            {{ ScreenConst::JOB_TYPE_NAME[$jobWork['employment_type_id']] }}
                        </div>
                        <div class="font-bold text-sm leading-[21px] tracking-[.04em] text-5 line-left mb-1">Lương cơ bản</div>
                        <div class="font-light text-sm leading-[21px] tracking-[.04em text-5] pl-2 mb-[10px]">
                            {{ $jobWork['salary'] . '円' }}
                        </div>
                        @php
                            $workTimeFrom = App\Libs\SystemUtil::getWorkTime($jobWork['work_time_from']);
                            $workTimeTo   = App\Libs\SystemUtil::getWorkTime($jobWork['work_time_to']);
                            $workTime     = $workTimeFrom . ' ～ ' . $workTimeTo;
                        @endphp
                        <div class="font-bold text-sm leading-[21px] tracking-[.04em] text-5 line-left mb-1">Thời gian làm việc</div>
                        <div class="font-light text-sm leading-[21px] tracking-[.04em text-5] pl-2 mb-[10px]">
                            {{ $workTime }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="job-work-detail-button mb-4 flex items-center justify-center gap-4 text-[8px] leading-[12px] md:text-sm text-white text-center">
                <a href="{{ route('get_job_list') }}" class="inline-block bg-main-blue w-[120px] md:w-[200px] py-3 md:py-2 bg-[#F5CE0A] rounded">Quay lại</a>
                <a href="{{ route('apply', ['id' => $jobWork['id']]) }}" class="inline-block bg-main-blue w-[120px] md:w-[200px] py-3 md:py-2 rounded">Ứng tuyển</a>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@stop


@section('js')
    <script src="{{ asset('js/home.js') }}"></script>
@stop
