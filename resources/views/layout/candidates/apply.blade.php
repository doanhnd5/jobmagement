@extends('layout.base')

@section('content')
    <section class="fv relative -mt-[50px] md:mt-0 mb-7.5">
        <div class="fv-slider relative h-[520px]">
            <img src="{{ asset('image/banner_mypage.jpg') }}" class="w-full h-full object-cover">
        </div>
        <div class="fvInner w-full text-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            <h1 class="font-serif font-semibold text-xl lg:text-[40px] lg:leading-[57px] tracking-widest text-white"
                style="text-shadow: 0px 0px 20px #000000;">Giới thiệu việc làm miễn phí,<br class="lg:hidden">hỗ trợ tận tâm
            </h1>
        </div>
    </section>
    <section class="page-user container px-2 mb-5">
        <br>
        <h2 class="font-bold text-base md:text-3xl text-center text-40381F mb-7">Thông tin cơ bản</h2>
        <div class="group_title pl-2 border-l-[3px] border-l-main-blue border-solid mb-4">
            <p class="text-[14px] font-yugothic text-333 font-medium">Vui lòng cài đặt thông tin cơ bản cần thiết</p>
        </div>
        <form method="post" enctype="multipart/form-data" id="form">
            <div class="user-information bg-white p-4 py-5" id="formBox">
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Họ tên
                        </div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex items-center">
                            <label class="text-[14px] text-333 mr-2" for="txtFirstName">Họ</label>
                            <input type="text" placeholder="xxxx" name="txtFirstName" id="txtFirstName"
                                class="bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a w-full border border-gray-c"
                                >
                        </div>
                        <div class="flex items-center">
                            <label class="text-[14px] text-333 mr-2" for="txtLastName">Tên</label>
                            <input type="text" placeholder="xxxx" name="txtLastName" id="txtLastName"
                                class="bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a w-full border border-gray-c"
                                >
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Ngày tháng
                            năm sinh</div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <select name="birth_day" id="ddlBirthDay" class="w-16 font-normal text-555 border-[1px] rounded border-solid border-[#cccccc] p-2">
                          @for($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                          @endfor
                        </select>
                        <select name="birth_month" id="ddlBirthMonth" class="w-16 font-normal text-555 border-[1px] rounded border-solid border-[#cccccc] p-2">
                          @for($i = 1; $i <= 12; $i++)
                            <option  value="{{ $i }}">{{ $i }}</option>
                          @endfor
                        </select>
                        <select name="birth_year" id="ddlBirthYear" class="w-20 font-normal text-555 border-[1px] rounded border-solid border-[#cccccc] p-2">
                          @for($i = date("Y"); $i >= 1990; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                          @endfor
                        </select>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Email
                        </div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <input type="email" placeholder="xxxxx@gmail.com" name="txtEmail" id="txtEmail"
                        class="bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a w-full border border-gray-c"
                        >
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Số điện
                            thoại</div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <input type="text" name="txtPhoneNumber" id="txtPhoneNumber"
                        class="bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a w-full border border-gray-c"
                        >
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Tư cách lưu trú</div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <input type="text" name="txtResidence" id="txtResidence"
                        class="bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a w-full border border-gray-c"
                        >
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-[10px]">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Giới tính
                        </div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <div class="flex group-gender">
                        <div class="flex items-center mr-4">
                            <input type="radio" name="rdoGender" id="male" class="mr-1" value="0">
                            <label for="male"
                                class="font-regular text-sm leading-[21px] tracking-[.04em] text-555">Nam</label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input type="radio" name="rdoGender" id="female" class="mr-1" value="1">
                            <label for="female"
                                class="font-regular text-sm leading-[21px] tracking-[.04em] text-555">Nữ</label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input type="radio" name="rdoGender" id="other" class="mr-1" value="2">
                            <label for="other"
                                class="font-regular text-sm leading-[21px] tracking-[.04em] text-555">Khác</label>
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Trình độ
                            tiếng Nhật</div>
                    </div>
                    <select name="txtJapaneseSkill" id="txtJapaneseSkill"
                        class="font-normal text-555 border rounded border-solid border-gray-c p-2 mr-[2px] w-[145px]" style="width: 215px">
                        @foreach (ScreenConst::JAPANESE_LEVEL_NAME as $janpaneseLevelKey => $janpaneseLevelName)
                            <option value="{{ $janpaneseLevelKey }}" @if ($janpaneseLevelKey == ScreenConst::JAPANESE_LEVEL_N1)
                                selected
                            @endif>
                                {{ $janpaneseLevelName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Địa chỉ
                        </div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <input type="text" name="txtAddress" id="txtAddress"
                        class="bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a w-full border border-gray-c"
                        >
                </div>
                <div class="mb-0">
                    <div class="flex items-center mb-1.5">
                        <div class="font-medium text-[12px] text-base leading-6 text-555 tracking-[.04em] text-5">Facebook
                        </div>
                        <span class="font-medium text-[13px] leading-5 tracking-[.04em] text-red-1000">※Bắt buộc</span>
                    </div>
                    <input type="url" placeholder="" name="txtFacebookUrl" id="txtFacebookUrl"
                        class="bg-opacity-10 rounded px-[10px] h-10 font-medium text-sm leading-[21px] tracking-[.04em] text-a w-full border border-gray-c"
                        >
                </div>
            </div>
            <div class="flex items-center justify-center mt-4 mb-10">
                <button type="button" id="btnCancel" class="mr-2 flex justify-center items-center h-[50px] w-[187px] rounded bg-[#F5CE0A]"
                    data-cfm-msg="{{ __('messages.I0001', ['attribute1' => 'hủy ứng tuyển', 'attribute2' => 'job']) }}"
                    data-url="{{ route('get_job_list') }}">
                    <span class="text-white text-[14px]">Hủy</span>
                </button>
                <button type="button" id="btnApply" class="flex justify-center items-center h-[50px] w-[187px] rounded bg-[#FF7A00]"
                    data-cfm-msg="{{ __('messages.I0001', ['attribute1' => 'ứng tuyển', 'attribute2' => 'job']) }}"
                    data-url="{{ route('apply.create') }}">
                    <span class="text-white text-[14px]">Ứng tuyển</span>
                </button>
            </div>
        </form>
    </section>
    <input type="text" id="txtJobId" hidden value="{{ $id }}">
@endsection

@section('js')
    <script src="{{ asset('js/apply.js') }}"></script>
@endsection


