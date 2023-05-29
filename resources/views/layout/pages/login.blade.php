@extends('layout.base')

@section('content')
    <div class="page-login">
        <div class="max-w-[768px] m-auto">
            <div class="px-2 mt-4">
                <h1 class="font-serif font-bold text-2xl text-center text-main-blue">
                    <a href="#">
                        <img src="{{ asset('image/jobsempai_logo.png')}}" width="470" height="190" alt="jobsempai.com" class="m-auto">
                    </a>
                </h1>
                <div class="px-7 mb-2">
                    <form action="{{ route('login.login') }}" method="post" class="mb-11">
                        <h2 class="text-xl text-center text-333 mt-3 mb-3">Đăng nhập</h2>
                        @csrf
                        <div class="mb-3">
                            <input type="text" placeholder="Email" name="email"
                                class="text-sm-base py-2 px-6 border border-solid border-second-blue rounded-full w-full">
                                @error('email')
                                    <span class="block font-medium text-xs text-[#ff5b5b] bg-[#ffebeb] py-2 px-6 mt-1.5">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="mb-1.5">
                            <div class="relative">
                                <input type="password" name="password" placeholder="Mật khẩu"
                                    class="text-sm-base py-2 px-6 border border-solid border-second-blue rounded-full w-full"
                                    id="password">
                                <img src="{{ asset('assets/icon/eye.svg') }}" alt=""
                                    class="eye absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer" id="eye">
                            </div>
                            @error('password')
                                <span class="block font-medium text-xs text-[#ff5b5b] bg-[#ffebeb] py-2 px-6 mt-1.5">{{ $message }}</span>
                            @enderror
                        </div>
                        @error('login_fail')
                            <span class="block font-medium text-xs text-[#ff5b5b] bg-[#ffebeb] py-2 px-6 mt-1.5 mb-1">{{ $message }}</span>
                        @enderror
                        <div class="text-center">
                            <button type="submit"
                                class="btn-login bg-main-blue rounded-[19px] w-[180px] py-2 text-sm-base text-white">Đăng
                                nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        header,
        footer {
            display: none;
        }

        .btn-login:hover {
            opacity: 0.8;
        }

        .btn-login:active {
            opacity: 0.7;
        }
    </style>
@stop
