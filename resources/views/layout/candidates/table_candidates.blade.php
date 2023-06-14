<table id="tblList" class="min-w-full">
    <colgroup>
        <col style="width: 300px">
        <col style="width: 80px">
        <col style="width: 100px">
        <col style="width: 80px">
        <col style="width: 150px">
        <col style="width: 120px">
        <col style="width: 120px">
        <col style="width: 100px">
        <col style="width: 400px">
        <col style="width: calc(100% -20px)">
    </colgroup>
    <thead>
        <tr>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Họ và tên</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Giới tính</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider  uppercase border-b border-gray-200">
                Email</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Số điện thoại</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider  uppercase border-b border-gray-200">
                Địa chỉ</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider  uppercase border-b border-gray-200">
                Tên job</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider  uppercase border-b border-gray-200">
                Ngày ứng tuyển</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider  uppercase border-b border-gray-200">
                Trạng thái</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Ghi chú</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Xác nhận</th>
        </tr>
    </thead>
    <tbody class="bg-white">
        @foreach ($candidatesList as $candidatesData)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{  $candidatesData['first_name'] . ' ' . $candidatesData['last_name']  }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{  ScreenConst::GENDER_NAME[$candidatesData['gender']] }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{ $candidatesData['email'] }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{  $candidatesData['phone_number'] }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{  $candidatesData['address'] }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{  $candidatesData['job_name'] }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{  $candidatesData['apply_date'] }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-200 text-center">
                    @if ($candidatesData['is_contacted'])
                        Đã liên hệ
                    @else
                        Chưa liên hệ
                    @endif
                </td>
                <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-200 text-center">
                    <input class="remark shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      type="text" value="{{ $candidatesData['remark'] }}" data-cfm-msg="{{ __('messages.I0005') }}"
                        data-url="{{ route('remark') }}"
                        data-id="{{ $candidatesData['id'] }}"
                        title="{{ $candidatesData['remark'] }}">
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                    @if (!$candidatesData['is_contacted'])
                    <button class="btn-confirm-contact bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        data-cfm-msg="{{ __('messages.I0003') }}"
                        data-url="{{ route('confirm') }}"
                        data-id="{{ $candidatesData['id'] }}">
                        Xác nhận
                    </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="inline-block pagination">
    {{ $candidatesList->appends(request()->input())->links() }}
</div>

