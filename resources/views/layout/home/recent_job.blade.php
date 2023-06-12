<div class="popularCardlist pb-2 slick-initialized slick-slider slick-dotted">
    <ul class="hot_job">
        @foreach ($recentJobList as $job)
        <li id="job-{{ $job['id'] }}"
            class="post-1119062 item type-item status-publish has-post-thumbnail hentry employ-haken picky-shufu-kangei picky-tomodachiobo picky-wwork-ok picky-freeter-kangei picky-mikeikensha picky-kotsuhi picky-shakaihoken picky-kenshuseido picky-shift-sei picky-senior-kangei picky-rirekisyofuyou picky-532 genre-souzai-sushi area-606 area-kyouto-fu rating-97 rating-98 rating-99 is-recommend rate-rating-gold">
            <a  href="{{ route('detail', ['id' => $job['id']]) }}">
                <div class="hot_job_img">
                    <figure>
                        <img
                            src="{{ $job->image_name ? asset('image/uploaded/' . $job->image_name) : asset('image/uploaded/job_1.jpg') }}"
                            class="alpha wp-post-image" alt="{{ $job->image_name ? asset('image/uploaded/' . $job->image_name) : asset('image/uploaded/job_1.jpg') }}" loading="lazy"
                            srcset="{{ $job->image_name ? asset('image/uploaded/' . $job->image_name) : asset('image/uploaded/job_1.jpg') }} 87w, {{ $job->image_name ? asset('image/uploaded/' . $job->image_name) : asset('image/uploaded/job_1.jpg') }} 140w, {{ $job->image_name ? asset('image/uploaded/' . $job->image_name) : asset('image/uploaded/job_1.jpg') }} 155w"
                            sizes="(max-width: 87px) 100vw, 87px">
                        <div class="rating_mark"></div>
                    </figure>
                </div>
                <div class="job_detail">
                    <h3 class="job-name-detail">{{ $job['job_name'] }}</h3>
                    <h2>
                        <span class="text_excerpt">
                            <i class="icon-business-center-blue w-3.5 h-3.5"></i>
                            {{ ScreenConst::JOB_TYPE_NAME[$job['employment_type_id']] }}
                        </span>
                    </h2>
                    <h2>
                        <span class="text_excerpt">
                            <i class="icon-location-on-fill-blue w-3.5 h-3.5"></i>
                            {{ $job['workplace_city'] }}
                        </span>
                    </h2>
                    <h2>
                        <span class="text_excerpt">
                            <i class="icon-currency-yen-blue w-3.5 h-3.5"></i>
                            {{ App\Libs\SystemUtil::formatNumber($job['salary']) }}
                        </span>
                    </h2>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>



@if ($recentJobList->count() != 0)
    @if ($recentJobList->count() >= ScreenConst::MAX_PER_PAGE_JOB_HOME_PAGE)
        <div id="slick-slider-dots" class="slick-slider-dots mb-4 md:mb-7.5"></div>
        <div class="popular-see-more text-center md:mb-4">
            <a href="{{ route('get_job_list') }}" class="see-more-btn inline-flex items-center">
                <span class="font-bold text-sm leading-[26px] tracking-wider text-main-blue">Xem thêm</span>
                <i class="icon-chevron-right-blue w-6 h-6"></i>
            </a>
        </div>
        <div class="container text-center">
    @endif
@else
    <div id="slick-slider-dots" class="slick-slider-dots mb-4 md:mb-7.5"></div>
    <div class="popular-see-more text-center md:mb-4">
        Không có thông tin tuyển dụng!
    </div>
@endif

