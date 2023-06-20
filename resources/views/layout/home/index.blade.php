@extends('layout.base')

@section('content')
    <section class="fv relative -mt-[50px] md:mt-0 mb-[50px] md:mb-25">
        <div class="relative h-[520px]">
            <img src="{{ asset('image/banner.png') }}" class="w-full h-full object-cover">
            <div class="fvInner w-[96%] lg:w-full text-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-9">
                <p class="font-serif font-semibold text-xl lg:text-[40px] lg:leading-[57px] tracking-widest text-white mb-9"
                    style="text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                    <span class="notranslate">Job - Visa</span>
                </p>
                <p class="font-serif font-semibold text-xl lg:text-[40px] lg:leading-[57px] tracking-widest text-white mb-9"
                    style="text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                    <span class="notranslate">Japan</span>
                </p>
            </div>
        </div>
    </section>

    <section class="fv relative -mt-[50px] md:mt-0 mb-[50px] md:mb-25">
        <div class="relative h-[0px]">
            <div class="fvInner w-[96%] lg:w-full text-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-9">
                <div class="searchBox w-full max-w-[972px] h-auto p-2.5 rounded-lg lg:p-8 mx-auto">
                    <form method="get" id="searchform" action="#" class="flex gap-2 flex-wrap">
                        <input type="hidden" name="size" value="200">
                        <div class="searchBoxInr grid grid-cols-3 gap-x-2 w-full">
                            <div
                                class="btnSearchItems w-full h-auto border border-solid border-gray-c rounded overflow-hidden bg-none">
                                <div class="btnBottom static bg-white h-auto">
                                    <p class="btnBottomTxt w-full relative">
                                        <i
                                            class="icon-location-on-fill-blue w-4.5 h-4.5 absolute top-1/2 -translate-y-1/2 left-0.5 md:left-2"></i>
                                        <select name="ddlArea" id="ddlArea"
                                            class="w-full h-[46px] px-5.5 md:px-[28px] font-body">
                                            <option value="">Khu vực</option>
                                            @foreach (ScreenConst::JOB_AREA_NAME as $areaKey => $areaName)
                                                @if ($areaKey == $srchArea)
                                                    <option value="{{ $areaKey }}" selected>{{ $areaName }}
                                                    </option>
                                                @else
                                                    <option value="{{ $areaKey }}">{{ $areaName }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <i
                                            class="icon-chevron-right-blue w-4.5 h-4.5 absolute top-1/2 -translate-y-1/2 right-0.5 md:right-2"></i>
                                    </p>
                                </div>
                            </div>
                            <div
                                class="btnSearchItems w-full h-auto border border-solid border-gray-c rounded overflow-hidden bg-none ">
                                <div class="btnBottom static bg-white h-auto">
                                    <p class="btnBottomTxt w-full relative">
                                        <i
                                            class="icon-business-center-blue w-4.5 h-4.5 absolute top-1/2 -translate-y-1/2 left-0.5 md:left-2"></i>
                                        <select name="categories[]" id="ddlJobType"
                                            class="w-full h-[46px] px-5.5 md:px-[28px] font-body">
                                            <option value="">Hình thức tuyển dụng</option>
                                            @foreach (ScreenConst::JOB_TYPE_NAME as $jobTypeKey => $jobTypeName)
                                                @if ($jobTypeKey == $srchJobType)
                                                    <option value="{{ $jobTypeKey }}" selected>{{ $jobTypeName }}
                                                    </option>
                                                @else
                                                    <option value="{{ $jobTypeKey }}">{{ $jobTypeName }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <i
                                            class="icon-chevron-right-blue w-4.5 h-4.5 absolute top-1/2 -translate-y-1/2 right-0.5 md:right-2"></i>
                                    </p>
                                </div>
                            </div>
                            <div
                                class="btnSearchItems w-full h-auto border border-solid border-gray-c rounded overflow-hidden bg-none ">
                                <div class="btnBottom static bg-white h-auto">
                                    <p class="btnBottomTxt w-full relative">
                                        <i
                                            class="icon-temp-preferences-custom-fill-blue w-4.5 h-4.5 absolute top-1/2 -translate-y-1/2 left-0.5 md:left-2"></i>
                                        <select name="tags[]" id="ddlTag"
                                            class="w-full h-[46px] px-5.5 md:px-[28px] font-body">
                                            <option value="" class="notranslate">Tag</option>
                                            @foreach ($tagList as $tagKey => $tagName)
                                                @if ($tagKey == $srchTag)
                                                    <option value="{{ $tagKey }}" selected>{{ $tagName }}
                                                    </option>
                                                @else
                                                    <option value="{{ $tagKey }}">{{ $tagName }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <i
                                            class="icon-chevron-right-blue w-4.5 h-4.5 absolute top-1/2 -translate-y-1/2 right-0.5 md:right-2"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="text-search w-full flex-1 flex items-center justify-between">
                            <input type="text" id="txtKeyAny" value="{{ $srchKeyAny }}"
                                data-url="{{ route('home.search') }}" placeholder="Từ khoá (Thành phố, nội dung công việc, lương)"
                                class="w-[calc(100%-46px)] rounded-l">
                            <button type="button" id="btnSearch" data-url="{{ route('home.search') }}"
                                class="searchBoxSubmit bg-main-blue inline-flex items-center justify-center rounded-r">
                                <i class="searchBoxSubmit-icon inline-block w-6 h-6"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <section class="popular pt-home mx-2 md:mx-auto mb-9.5 md:mb-11 md:max-w-[1240px] xs:pt-home">
        <div class="popularInner bg-CBE3FF py-4 px-1 md:px-8">
            <div class="sectionTitle text-center">
                <h2 class="font-serif font-medium text-base md:text-xl text-center text-0011ff text-4E4A40 my-2.5">
                    <span class="relative inline-block pt-6 pl-[12.5px] lg:pl-[26.18px]">
                        Thông tin tuyển dụng được nhiều người quan tâm
                    </span>
                </h2>
            </div>
            <wee-slider data-loop="true" data-align="center" data-buttons-on-hover="true">
                <div class="wee-slider">
                    <ul class="wee-slider__slides">
                        @foreach ($jobWorkHotList as $job)
                            <li class="wee-slider__slide">
                                <div class="slide-content">
                                    <a href="{{ route('detail', ['id' => $job['id']]) }}"
                                        class="popularCard block slick-slide slick-current slick-active">
                                        <div class="popularCard_inner flex-col p-0 lg:bg-white">
                                            <div class="popularCard_inner_photo w-full mb-2 lg:mb-0">
                                                <figure class="aspect-[143/100] mb-2">
                                                    <img class="h-full object-cover"
                                                        src="{{ $job->image_name ? asset('image/uploaded/' . $job->image_name) : asset('image/uploaded/job_1.jpg') }}"
                                                        width="100%" alt="">
                                                </figure>
                                                <p
                                                    class="company-tit text-[11px] leading-4 text-888 mb-1 truncate lg:px-2 px-1">
                                                    {{ $job->company_name ?? '' }}</p>
                                                <h3 class="title font-bold text-xs text-40381F lg:px-2 truncate px-1 job-name"
                                                    title="{{ $job->job_name ?? '' }}">
                                                    {{ $job->job_name ?? 'Tuyển dụng nhân viên' }}</h3>
                                            </div>
                                            <div
                                                class="popularCard_inner_info w-full font-light text-[11px] leading-5 text-333 lg:p-2 px-1">
                                                <ul class="popularCard_inner_place flex">
                                                    <li class="item w-3.5 flex items-center">
                                                        <i class="icon-location-on-fill-blue w-3.5 h-3.5"></i>
                                                    </li>
                                                    <li class="item-text pl-1 self-center truncate">
                                                        <span class="block">{{ $job->workplace_city }}</span>
                                                    </li>
                                                </ul>
                                                <ul class="recommendCard_inner_occupation flex">
                                                    <li class="item w-3.5 flex items-center">
                                                        <i class="icon-business-center-blue w-3.5 h-3.5"></i>
                                                    </li>
                                                    <li class="item-text pl-1 self-center truncate">
                                                        {{ ScreenConst::JOB_TYPE_NAME[$job['employment_type_id']] }}</li>
                                                </ul>
                                                <ul class="popularCard_inner_salary flex items-start">
                                                    <li class="item w-3.5 flex items-center mt-[3px]">
                                                        <i class="icon-currency-yen-blue w-3.5 h-3.5"></i>
                                                    </li>
                                                    <li class="item-text pl-1 self-center truncate">
                                                        <span
                                                            class="inline-block">{{ App\Libs\SystemUtil::formatNumber($job['salary']) }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <ul class="wee-slider__navdots">
                    <li class="wee-slider__navdot"></li>
                    <li class="wee-slider__navdot"></li>
                    <li class="wee-slider__navdot"></li>
                    <li class="wee-slider__navdot"></li>
                    <li class="wee-slider__navdot"></li>
                    <li class="wee-slider__navdot"></li>
                    <li class="wee-slider__navdot"></li>
                </ul>
            </wee-slider>
        </div>
    </section>

    <section class="popular mx-2 md:mx-auto mb-9.5 md:mb-11 md:max-w-[1240px]" id="divRencentJob">
        {!! $htmlRecentJobListHtmlArea !!}
    </section>

    <section class="popular mx-2 md:mx-auto mb-9.5 md:mb-11 md:max-w-[1240px]" id="divTopApplyJob">
        {!! $htmlTopJobsWithMostCandidatesHtmlArea !!}
    </section>

    <section class="popularPost mx-2 md:mx-auto mb-9.5 md:mb-11 md:max-w-[1240px]">
        {!! $htmlPostList !!}
    </section>


@stop

@section('js')
    <script src="{{ asset('js/home.js') }}"></script>
@endsection
