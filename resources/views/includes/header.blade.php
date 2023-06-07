@php
    $isLogin = App\Libs\SessionManager::isLogin();
@endphp

<header id="header">
    <nav class="flex items-center justify-between" >
        <div class="header__logo self-center">
                <h1 class="ml-2">
                    <a href="{{ route('home') }}">
                        <div class="text-black font-bold">
                            <img src="{{asset('image/logo2.png')}}" width="122" height="49" alt="jobsempai.com"/>
                        </div>
                    </a>
                </h1>
            </div>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <ul>
            <li><button" class="close-btn" id="close-btn">&times;</button></li>
            <li><a href="/" class="block mt-4 lg:inline-block nav-tab">Trang chủ</a></li>
            <li><a href="{{ route('get_job_list') }}" class="block mt-4 lg:inline-block nav-tab">Tuyển dụng</a></li>
            <!--
            <li><a href="/" class="block mt-4 lg:inline-block nav-tab">Visa</a></li>
-->
            <li><a href="/about" class="block mt-4 lg:inline-block nav-tab">Giới thiệu</a></li>
            <li>
            </li>
            @if ($isLogin)
                <li>
                <a href="{{ route('candidates') }}" class="block mt-4 lg:inline-block nav-tab">
                    応募履歴
                </a>
                </li>
                <li><a href="{{ route('job_list') }}" class="block mt-4 lg:inline-block nav-tab">
                    求人情報一覧
                </a></li>
                <li><a href="{{ route('post_list') }}" class="block mt-4 lg:inline-block nav-tab">
                    ビザ情報
                </a></li>
            @endif
        </ul>
        <div id='google_translate_element'></div>
    </nav>
</header>
<script>
    document.getElementById('close-btn').addEventListener('click', function(){
    document.getElementById('check').checked = false;
});

</script>
