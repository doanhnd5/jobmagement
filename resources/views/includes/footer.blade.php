@php
    $isLogin = App\Libs\SessionManager::isLogin();
@endphp
<footer id="footer">
    <!-- FOOTER START -->
    <div class="footer">
        <div class="contain">
            <div class="col">
                <ul>
                    <div class="footer-logo">
                        <img src="{{asset('image/logo2.png/')}}" alt="Logo" />
                    </div>
                </ul>
            </div>
            <div class="col">
                <h1 style="color:white">Liên hệ</h1>
                <ul>
                <li><a target="_blank" href="/about">
                            Về chúng tôi</a></li>
                            <li>
                        <a target="_blank" href="/contact">Liên hệ</a>
                    </li>
                </ul>
            </div>
            <div class="col"></div>
            <div class="col">
                <h1 style="color:white">Tuyển dụng</h1>
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li>
                        <a href="{{ route('get_job_list') }}">Công việc</a>
                    </li>
                    <li>
                        <a target="_blank" href="{{ route('post.list') }}">Visa</a>
                    </li>
                    @if ($isLogin)
                        <li>
                            <a href="#" id="btnShowModalChangePassword">Thay đổi mật khẩu</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col map-col">
                <ul>
                <div class="fb-page" data-href="https://www.facebook.com/thanhgiangseikou" data-tabs="timeline" data-width="" data-small-header="false" data-adapt-container-width="true" data-height="100" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/thanhgiangseikou" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/thanhgiangseikou">Visa &amp; Jobs Thanh Giang Seikou</a></blockquote></div>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    @include('includes.modal.change_password')
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v17.0" nonce="wwjPYoxd"></script>

</footer>
