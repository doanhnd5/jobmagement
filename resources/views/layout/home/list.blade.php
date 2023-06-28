@extends('layout.base')

@section('content')
    <section class="fv relative -mt-[50px] md:mt-0">
        <div class="fv-slider relative img-banner-area">
            <img src="{{ asset('image/jobbanner.jpg') }}" class="w-full h-full object-cover banner"
            srcset="{{ asset('image/jobbanner.jpg') }} 87w, {{ asset('image/jobbanner.jpg') }} 155w">
            {{-- <img src="{{ asset('image/banner21.jpg') }}" class="w-full h-full object-cover md:hidden"> --}}
        </div>
    </section>
    <section class="popular pt-7.5 mx-2 md:mx-auto mb-9.5 md:mb-11 md:max-w-[1240px]">
        <div class="popularInner py-4 px-1 md:px-8" style="background-color: #FFFFFF">
            <div class="sectionTitle text-center">
                <h2 class="font-serif font-medium text-base md:text-xl text-center text-blue my-2.5">
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
                                            <div class="popularCard_inner_photo mb-2 lg:mb-0">
                                                <figure class="aspect-[143/100] mb-2">
                                                    <img class="h-full object-cover"
                                                        src="{{ $job->image_name ? asset('image/uploaded/' . $job->image_name) : asset('image/uploaded/job_1.jpg') }}"
                                                        width="100%" alt="">
                                                </figure>
                                                <p
                                                    class="company-tit text-[11px] leading-4 text-888 mb-1 truncate lg:px-2 px-1">
                                                    {{ $job->company_name ?? '' }}</p>
                                                <h3 class="title font-bold text-xs text-40381F lg:px-2 truncate px-1 job-name" title="{{ $job->job_name ?? '' }}">
                                                    {{ $job->job_name ?? 'Tuyển dụng nhân viên' }}</h3>
                                            </div>
                                            <div
                                                class="popularCard_inner_info font-light text-[11px] leading-5 text-333 lg:p-2 px-1">
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
    <div id='google_translate_element'></div>

    <section class="popular pt-7.5 mx-2 md:mx-auto mb-9.5 md:mb-11 md:max-w-[1240px]">
        <div class="main-wid p-[9px] md:p-0 container md:mx-auto lg:flow-root">
            <div class="main-col-recDetail">
                <div class="recList">
                    <ul id="list_job"
                        class="list-job font-serif grid md:grid-cols-2 lg:grid-cols-3 md:gap-x-[2%] xl:gap-x-[5%]">
                        @if ($jobBasicList && !$jobBasicList->isEmpty())
                            @foreach ($jobBasicList as $job)
                                <li class="relative bg-white py-4 px-2 border-t-4 border-solid border-main-blue mb-6">
                                    <h3 class="company-name text-main-blown p-0 mb-4 text-sm lg:text-base font-bold">
                                        {{ $job->company_name ?? '' }}
                                    </h3>
                                    <div class="post_item">
                                        <div class="post_item_left">
                                            <div class="hot_job_img">
                                                <figure>
                                                    <img src="{{ $job->image_name ? asset('image/uploaded/' . $job->image_name) : asset('image/uploaded/job_1.jpg') }}"
                                                        class="alpha wp-post-image"
                                                        loading="lazy"
                                                        sizes="(max-width: 87px) 100vw, 87px">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="post_item_right">
                                            <div class="">
                                                   <h3>
                                                        <strong> {{ $job->job_name ?? 'Tuyển dụng nhân viên' }}</strong>
                                                    </h3>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="txt mb-4 w-full ">
                                        <table style="border: none;">
                                            <tr style="border: none;">
                                                <td class="detail_text" scope="col" style="border: none; width: 30%;">
                                                    <i class="icon-location-on-fill-blue w-3.5 h-3.5"></i>Địa điểm
                                                </td>
                                                <td class="detail_text" style="border: none;">{{ $job->workplace_city }}</td>
                                            </tr>
                                            <tr>
                                                <td class="detail_text" scope="row" style="border: none;width: 30%;">
                                                   <i class="icon-currency-yen-blue w-3.5 h-3.5"></i> Mức lương
                                                </td>
                                                <td class="detail_text" style="border: none;">
                                                        {{ App\Libs\SystemUtil::formatNumber($job->salary) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="detail_text" scope="row" style="border: none;width: 30%;">
                                                <i class="icon-group-fill-blue w-3.5 h-3.5"></i>Trạng thái
                                                </td>
                                                <td class="detail_text" style="border: none;">
                                                    {{ ScreenConst::JOB_TYPE_NAME[$job['employment_type_id']] }}
                                                </td>
                                            </tr>
                                        </table>
                                        </div>
                                    <div class="btns h-9 text-center">
                                        <a href="{{ route('apply', ['id' => $job['id']]) }}"
                                            class="detailBtn w-[152px] h-9 inline-flex items-center justify-center bg-FF7A00 rounded absolute bottom-4 left-1/2 -translate-x-1/2">
                                            <span class="text-[11px] leading-3 font-bold text-white">Ứng tuyển</span>
                                            <i class="icon-chevron-right-white w-4.5 h-4.5"></i>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        @else
                        @endif
                    </ul>
                </div>
                <div class="page-custom">
                    @if ($jobBasicList->isNotEmpty())
                        {{ $jobBasicList->links('includes.pagination') }}
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script src="{{ asset('js/list.js') }}"></script>
@stop
