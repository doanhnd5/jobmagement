<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:og="http://ogp.me/ns#">

<head>
    {{-- Meta Tag --}}
    @include('includes.element.meta')

    <title>Job-visa</title>
    <meta name="description"
        content="Công ty cổ phần SEIKOU T&T, cup cấp dịch vụ hỗ trợ, phục vụ người Việt và nước ngoài tại Nhật.">
    @yield('ogp-meta')
    <meta name="keywords" content="THANH GIANG SEIKOU - 人材サポート, SEIKOU - ビザサポート,
    , グローバルサポート, 外国人サポート, 外国人仕事紹介, visa, japan visa
    keyword3">
    <link rel="icon" href="{{ url('image/logo2.png') }}">
    <meta name="description" content="HANH GIANG SEIKOU - 人材サポート 技能実習生の紹介 特定技能ビザ取得者の紹介 べトナム現地日本語教育運営 留学ビジネス ビザ取得代行サービス 留学生の生活サポート（インターネット、不動産紹介、行政手続き、金融機関手続き など）">

    {{-- CSS --}}
    @include('includes.element.link')
    {{-- CSS For Screen --}}
    @yield('css')
    <style>
    /*<![CDATA[*/
    #google_translate_element {
        margin-right: 10px;
        position: static;
        right: 42px;
        transform: scale(3);
    }
    .goog-te-banner-frame.skiptranslate,
    .goog-te-gadget-simple img,
    img.goog-te-gadget-icon,
    .goog-te-menu-value span {
        display: none !important;
    }

    .goog-te-menu-frame {
        box-shadow: none !important;
    }

    .goog-te-gadget-simple {
        background-color: transparent !important;
        display: inline-block;
        content: "Translate";
        background: url("https://www.argotrans.com/hubfs/Imported_Blog_Media/google_translate_logo.jpg") center / 20px 20px no-repeat;
        -webkit-transition: all .2s ease;
        transition: all .2s ease;
        background-size: 20px 20px;
        display: inline-block;
        font-weight: 400;
        line-height: 1.8;
        padding: 0 6px;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border-left: none !important;
        border-top: none !important;
        border-bottom: none !important;
        border-right: none !important;
        border-radius: 4px;
    }

    /*]]>*/
    </style>


    <style type="text/tailwindcss">
        @media (min-width: 300px) {
                .pt-home {
                    padding-top: 3rem;
                }
            }
            @media (min-width: 475px) {
                .pt-home {
                    padding-top: 3rem;
                }
            }
            @media (min-width: 568px) {
                .pt-home {
                    padding-top: 3rem;
                }
            }
            @media (min-width: 640px) {
                .pt-home {
                    padding-top: 3rem;
                }
            }

            @media (min-width: 768px) {
                .pt-home {
                    padding-top: 5rem;
                }
            }

            @media (min-width: 1024px) {
                .pt-home {
                    padding-top: 9rem;
                }
            }

            @media (min-width: 1240px) {
                .pt-home {
                    padding-top: 9rem;
                }
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    {{-- Header --}}
    @include('includes.header')
    {{-- Main --}}
    <main class="wrapper" id="main">
        <div id="spinerLoading"
            class="hidden flex justify-center items-center h-screen fixed top-0 left-0 right-0 bottom-0 w-full overflow-hidden bg-gray-700 opacity-75">
            <div
                class="border-t-transparent border-solid animate-spin  rounded-full border-blue-400 border-8 h-64 w-64">
            </div>
        </div>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('includes.footer')

    @include('includes.element.script')
    @yield('js')

    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
        function removeGoogleTranslateLabel() {
    const googleTranslateLabel = document.querySelector('.VIpgJd-ZVi9od-xl07Ob-lTBxed');
    if (googleTranslateLabel) {
        googleTranslateLabel.textContent = ''; // Xóa nội dung của phần tử
    }
    }
        function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'vi',
            includedLanguages: 'en,id,vi,my,ja', // Ngôn ngữ được hiển thị
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE, // Chế độ giao diện
            autoDisplay: false, // Tắt hiển thị tự động
            gaTrack: true, // Bật tích hợp Google Analytics (nếu có)
            gaId: 'UA-12345678-9', // ID Google Analytics (nếu có)
            multilanguagePage: true // Tự động phát hiện và dịch nhiều ngôn ngữ
        }, 'google_translate_element');
        removeGoogleTranslateLabel();
        }
    </script>
</body>
</html>
