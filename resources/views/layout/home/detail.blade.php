@extends('layout.base')

@section('ogp-meta')
    {{-- <meta property="og:title" content="{{ $jobWork['job_name'] ?? "" }}"> --}}
    {{-- <meta property="og:description" content="Mô tả công việc"> --}}
    {{-- <meta property="og:image" content="{{ !empty($jobWork['image_name']) ? asset('image/uploaded/' . $jobWork['image_name']) : asset('image/uploaded/job_1.jpg') }}">
    <meta property="og:url" content="{{ route('detail', ['id' => $jobWork['id']]) }}"> --}}
    <meta property="og:url"                content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="When Great Minds Don’t Think Alike" />
<meta property="og:description"        content="How much does culture influence creative thinking?" />
<meta property="og:image"              content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />
@endsection

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
            <figure class="job-detail-slick border aspect-[45/23] mb-4">
                <img src="{{ !empty($jobWork['image_name']) ? asset('image/uploaded/' . $jobWork['image_name']) : asset('image/uploaded/job_1.jpg') }}" alt="{{ $jobWork['image_name'] ?? "job_1.jpg" }}" class="w-full h-full object-cover">
            </figure>
            <div class="p-3 md:p-5 mb-6 bg-third-blue">
                <div class="job-infor">
                    <div class="flex justify-center items-center mr-[3px]">
                        <i class="icon-group-fill-blue w-4 h-4"></i>
                    </div>
                    <div class="font-bold text-xs leading-[18px] tracking-wider text-[#ffff]">Hình thức</div>
                    <div class="font-medium text-xs leading-[18px] tracking-[0.01em] text-[#ffff]">
                        @if (isset($jobWork['employment_type_id']))
                            {{ ScreenConst::JOB_TYPE_NAME[$jobWork['employment_type_id']] }}
                        @endif
                    </div>
                    <div class="flex justify-center items-center mr-[3px]">
                        <i class="icon-currency-yen-blue w-4 h-4"></i>
                    </div>
                    <div class="font-bold text-xs leading-[18px] tracking-wider text-[#ffff]">Mức lương</div>
                    <div class="font-medium text-xs leading-[18px] tracking-[0.01em] text-[#ffff]">
                        {{ App\Libs\SystemUtil::formatNumber($jobWork?->salary)}}
                    </div>
                </div>
                <div class="list_tag flex flex-wrap gap-[8px] mt-[8px]">
                    <div class="flex flex-wrap gap-2">
                        @foreach ($tagList as $tagName )
                            <span class="p-1 border border-main-orange rounded font-medium text-[10px] leading-4 text-main-blue ">
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
                        @php
                            $descriptionList = [];
                            if (isset($jobWork['description'])) {
                                $descriptionList = explode("\n", $jobWork->description);
                            }
                        @endphp
                        <ol>
                            @foreach ($descriptionList as $description)
                                @if (!empty($description))
                                    <li class="description">{{ $description }}</li>
                                @endif
                            @endforeach
                        </ol>
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
                            {{ $jobWork['company_name'] ?? ''}}
                        </div>
                        <div class="font-bold text-sm leading-[21px] tracking-[.04em] text-5 line-left mb-1">Hình thức tuyển dụng</div>
                        <div class="font-light text-sm leading-[21px] tracking-[.04em text-5] pl-2 mb-[10px]">
                            @if (isset($jobWork['employment_type_id']))
                             {{ ScreenConst::JOB_TYPE_NAME[$jobWork['employment_type_id']] }}
                            @endif
                        </div>
                        <div class="font-bold text-sm leading-[21px] tracking-[.04em] text-5 line-left mb-1">Lương cơ bản</div>
                        <div class="font-light text-sm leading-[21px] tracking-[.04em text-5] pl-2 mb-[10px]">
                            @if (isset($jobWork['salary']))
                                {{ App\Libs\SystemUtil::formatNumber($jobWork?->salary)}}
                            @endif
                        </div>
                        @php
                            $workTimeFrom = App\Libs\SystemUtil::getWorkTime($jobWork?->work_time_from);
                            $workTimeTo   = App\Libs\SystemUtil::getWorkTime($jobWork?->work_time_to);
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
                <a href="{{ url()->previous() }}" class="inline-block bg-main-blue w-[120px] md:w-[200px] py-3 md:py-2 bg-[#F5CE0A] rounded">Quay lại</a>
                <a href="{{ route('apply', ['id' => $jobWork?->id]) }}" class="inline-block bg-main-blue w-[120px] md:w-[200px] py-3 md:py-2 rounded">Ứng tuyển</a>
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
