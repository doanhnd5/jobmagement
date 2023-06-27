@extends('layout.base')

@section('ogp-meta')
    <meta property="og:title" content="{{ $postData['post_title'] ?? "" }}">
    <meta property="og:image" content="{{ !empty($postData['image_name']) ? asset('image/post/' . $postData['image_name']) : asset('image/post/default.jpg') }}">
    <meta property="og:url" content="{{ route('post.detail', ['id' => $postData['id']]) }}">
@endsection

@section('content')
<div class="job-work-detail">
    <section class="fv relative -mt-[50px] md:mt-0 hidden md:block">
        <div class="fv-slider relative h-[260px]">
          <img src="{{ asset('image/banner.png') }}" class="w-full h-full object-cover"
          srcset="{{ asset('image/banner.jpg') }} 87w, {{ asset('image/banner.jpg') }} 155w">
        </div>
    </section>
    <div class="max-w-[820px] m-auto">
        <div class="job-work-detail-body text-555">
            <figure class="job-detail-slick border aspect-[45/23] mb-4 my-5">
                <img src="{{ !empty($postData['image_name']) ? asset('image/post/' . $postData['image_name']) : asset('image/post/default.jpg') }}" alt="{{ $postData['image_name'] ?? "default.jpg" }}" class="w-full h-full object-cover">
            </figure>
            <div class="m-auto">
                <div class="bg-white p-3 md:p-5 mb-5" style="min-height: 305px">
                    <div class="grid mb-4 text-center">
                        <p class="text-base">
                            <i class="fal fa-file-alt text-main-blue"></i>
                        </p>
                        <p class="font-bold text-lg">{{ $postData->post_title }}</p>
                    </div>
                    <div class="font-light text-sm tracking-[.04em] text-5 ck-content">
                        {!! $postData->post_content !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="job-work-detail-button mb-4 flex items-center justify-center gap-4 text-[8px] leading-[12px] md:text-sm text-white text-center">
            <a href="{{ $previousUrl }}" class="inline-block bg-main-blue w-[120px] md:w-[200px] py-3 md:py-2 bg-[#F5CE0A] rounded">Quay lại</a>
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
