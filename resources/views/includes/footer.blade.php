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
                    <li><a target="_blank" href="https://www.facebook.com/thanhgiangseikou">
                            Facebook</a></li>
                    <li>Email : thanhgiangseikou@gmail.com</li>
                    <li>Tel : 03-5937-1685</li>
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
                        <a target="_blank" href="https://m.me/thanhgiangseikou">Liên hệ</a>
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
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6480.0005455499895!2d139.68848697770994!3d35.701610900000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188db424557b7b%3A0xff98c5533ea4478c!2sThanh%20Giang%20Seikou%20-%20Nh%C3%A0%20m%E1%BA%A1ng%20Sim%20V%C3%A0ng!5e0!3m2!1sja!2sjp!4v1686023218398!5m2!1sja!2sjp"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    @include('includes.modal.change_password')
</footer>
