@if ($postList->count() != 0)
    <div class="text-center">
        <h2 class="font-serif font-medium text-base md:text-xl text-center text-FFA500 my-2.5">
            <span class="relative inline-block pt-6 pl-[12.5px] lg:pl-[26.18px]">Danh sách bài đăng gần đây</span>
        </h2>
    </div>
    <div class="post_container">
        @foreach ($postList as $post)
        <div class="post_item">
            <div class="post_item_left">
                <div class="hot_job_img">
                    <figure>
                        <img src="{{ $post->image_name ? asset('image/post/' . $post->image_name) : asset('image/post/default.jpg') }}"
                            class="alpha wp-post-image"
                            alt="{{ $post->image_name ? asset('image/post/' . $post->image_name) : asset('image/post/default.jpg') }}"
                            loading="lazy"
                            srcset="{{ $post->image_name ? asset('image/post/' . $post->image_name) : asset('image/post/default.jpg') }} 87w, {{ $post->image_name ? asset('image/post/' . $post->image_name) : asset('image/post/default.jpg') }} 140w,
                                {{ $post->image_name ? asset('image/post/' . $post->image_name) : asset('image/post/default.jpg') }} 155w"
                            sizes="(max-width: 87px) 100vw, 87px">
                        <div class="rating_mark"></div>
                    </figure>
                </div>
            </div>
            <div class="post_item_right">
                <div class="text_excerpt line-clamp-2 ck-content">
                    <a href="{{ route('post.detail', ['id' => $post['id']]) }}">
                       <h3>
                            <strong>{!! $post['post_title'] !!}</strong>
                        </h3>
                        {!! $post['post_content'] !!}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if ($postList->count() >= ScreenConst::MAX_PER_PAGE_JOB_HOME_PAGE)
        <div id="slick-slider-dots" class="slick-slider-dots mb-4 md:mb-7.5"></div>
        <div class="popular-see-more text-center md:mb-4">
            <a href="{{ route('get_job_list') }}" class="see-more-btn inline-flex items-center">
                <span class="font-bold text-sm leading-[26px] tracking-wider text-main-blue">Xem thêm</span>
                <i class="icon-chevron-right-blue w-6 h-6"></i>
            </a>
        </div>
        <div class="container text-center">
    @endif
@endif
