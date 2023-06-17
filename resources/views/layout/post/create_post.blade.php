@php
    $displayTime = \Carbon\Carbon::now();
@endphp

@extends('layout.base')

@section('content')
    <section class="page-user container px-2 mb-5 selectionTableList">
        <br>
        <h2 class="font-bold text-base md:text-3xl text-center text-40381F mb-7">Thông tin bài đăng</h2>
        <form method="post" enctype="multipart/form-data" id="form">
            <div class="user-information bg-white p-4 py-5" id="formBox">
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Tiêu đề
                        </div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <input type="text" name="txtPostTitle" id="txtPostTitle" value="{{ $postData['post_title'] ?? null }}"
                        class="bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a w-full border border-gray-c"
                        >
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Nội dung</div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <textarea id="txtPostContent" rows="8"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @if (isset($postData['post_content']))
                            {{ $postData->post_content }}
                        @endif
                    </textarea>
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5 mr-2">Ảnh đại diện bài đăng</div>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="shrink-0">
                            @php
                                $isSetImage = isset($postData['image_name']);
                            @endphp
                          <img id='preview_img' class="
                                @if (!$isSetImage)
                                hidden
                                @endif  h-16 w-16 object-cover" src="{{ $isSetImage ? asset('image/post/' . $postData['image_name']) : "" }}" />
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
                <button type="button" id="btnBack" data-url="{{ route('post_list') }}" class="mr-2 flex justify-center items-center h-[50px] w-[187px] rounded bg-[#F5CE0A]">
                    <span class="text-white text-[14px]">Quay lại</span>
                </button>
                <button type="button" id="btnRegist"
                data-url="{{ route('post.regist') }}"
                class="flex justify-center items-center h-[50px] w-[187px] rounded bg-[#FF7A00]"
                data-cfm-msg="{{ __('messages.I0001', ['attribute1' => 'tạo', 'attribute2' => 'bài đăng']) }}">
                    <span class="text-white text-[14px]">Create Post</span>
                </button>
            </div>
        </form>
    </section>
    <input type="text" id="txtDatetimeDisplay" hidden value="{{ $displayTime }}">
    <input type="text" id="txtPostId" hidden value="{{ $postId }}">
@endsection

@section('js')
    <script src="{{ asset('js/createPost.js') }}"></script>
@endsection

