@php
    $isLogin = App\Libs\SessionManager::isLogin();
@endphp
<footer id="footer">
    <!-- FOOTER START -->
    <div class="footer">
        <div class="contain">
            <div class="col logo">
                <ul>
                    <div class="footer-logo">
                        <img src="{{asset('image/logo2.png/')}}" alt="Logo" />
                    </div>
                </ul>
            </div>
            <div class="col adress">
            <ul>
                <p>
                〒169-0073
                    Tòa nhà Narita 401, 1-17-6 Hyakuncho, Shinjuku-ku, Tokyo
                </p>
                <p>
                TEL: 03-6313-4267  Hotline: 080-1175-5868 <br/>Email: thanhgiangseikou@gmail.com
                </p>
                </ul>
            </div>
                <div class="col sns">
                    <div class="sns-icon">
                    <div class="contact">
                      <a href="https://www.facebook.com/thanhgiangseikou">
                        <img src="{{asset('image/facebook.svg')}}">
                      </a>
                      <a href="https://www.messenger.com/t/383063642069568">
                        <img src="{{asset('image/messenge.svg')}}">
                      </a>
                    </div>
                    </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v17.0" nonce="wwjPYoxd"></script>
<hr>
<div class="footer">
        <div class="contain">
            <div class="col contact">
                <ul>
                <li><a target="_blank" href="/about">
                            Về chúng tôi</a></li>
                            <li>
                        <a target="_blank" href="/contact">Liên hệ</a>
                    </li>
                </ul>
            </div>
            <div class="col page">
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
            <div class="col facebook">
                <ul>
                <div class="fb-page" data-href="https://www.facebook.com/thanhgiangseikou" data-tabs="timeline" data-width="500" data-small-header="false" data-adapt-container-width="true" data-height="150" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/thanhgiangseikou" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/thanhgiangseikou">Visa &amp; Jobs Thanh Giang Seikou</a></blockquote></div>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    @include('includes.modal.change_password')
    <div id="fb-root"></div>
    <p class="copyright">&copy; 2023. Công ty cổ phần <span class="notranslate">Thanh Giang Seikou</span></p>
</footer>
