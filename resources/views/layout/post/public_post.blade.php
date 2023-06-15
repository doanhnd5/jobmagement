@extends('layout.base')

@section('content')
    <section class="fv relative -mt-[50px] md:mt-0">
        <div class="fv-slider relative h-[260px]">
        <img src="{{ asset('image/banner.png') }}" class="w-full h-full object-cover">
        </div>
        <div class="fv-title bg-white">
            <h1 class="font-bold text-base leading-[46px] text-40381F text-center pt-5 pb-2.5">Danh sách bài đăng</h1>
        </div>
    </section>
    <section class="popular pt-7.5 mx-2 md:mx-auto mb-9.5 md:mb-11 md:max-w-[1240px]">
        <div class="main-wid p-[9px] md:p-0 container md:mx-auto lg:flow-root">
            <div class="main-col-recDetail">
                <div class="recList">
                    <ul id="list_post" class="font-serif grid md:grid-cols-2 lg:grid-cols-3 md:gap-x-[2%] xl:gap-x-[5%]">
                        @if($postList && !$postList->isEmpty())
                            @foreach ($postList as $post)
                                <li class="relative bg-white py-4 px-2 border-t-4 border-solid border-main-blue mb-6">
                                    <h3 class="company-name text-main-blown p-0 mb-4 text-sm lg:text-base font-bold">
                                        {{ $post->post_title ?? '' }}
                                    </h3>
                                    <a class="recDetail mb-2">
                                        <div class="flex justify-between items-center mb-4">
                                            <figure class="w-1/3 aspect-[53/40]" data-url="{{ route('post.detail', ['id' => $post['id']]) }}">
                                                <img src="{{ $post->image_name ? asset('image/post/' . $post->image_name) : asset('image/post/default.jpg') }}" width="282" height="212" alt="" class="w-full h-full object-cover">
                                            </figure>
                                            <p class="job-name text-sm tracking-[0.01em] w-2/3 ml-2 line-clamp-2">
                                                {{ $post->post_content }}
                                            </p>
                                        </div>
                                    </a>
                                    <div class="btns h-9 text-center">
                                        <a href="{{ route('post.detail', ['id' => $post['id']]) }}" class="detailBtn w-[152px] h-9 inline-flex items-center justify-center bg-FF7A00 rounded absolute bottom-4 left-1/2 -translate-x-1/2">
                                            <span class="text-[11px] leading-3 font-bold text-white">Đọc thêm</span>
                                            <i class="icon-chevron-right-white w-4.5 h-4.5"></i>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="">Không có bài đăng</li>
                        @endif
                    </ul>
                </div>
                <div class="page-custom">
                    @if ($postList->isNotEmpty())
                    {{ $postList->links('includes.pagination') }}
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script src="{{ asset('js/publicPost.js') }}"></script>
@stop
