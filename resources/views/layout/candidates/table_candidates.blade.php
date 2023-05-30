<table id="tblList" class="min-w-full">
    <colgroup>
        <col style="width: 120px">
        <col style="width: 80px">
        <col style="width: 120px">
        <col style="width: 100px">
        <col style="width: 150px">
        <col style="width: 120px">
        <col style="width: 120px">
        <col style="width: 100px">
        <col style="width: 100px">
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
                Job ứng tuyển</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider  uppercase border-b border-gray-200">
                Ngày ứng tuyển</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider  uppercase border-b border-gray-200">
                Trạng thái</th>
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
                <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                    @if (!$candidatesData['is_contacted'])
                    <button class="btn-confirm-contact bg-blue-500 hover:bg-blue-700 text-white font-bold border border-blue-700 rounded"
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
<div class="inline-block min-w-full pagination">
    {{ $candidatesList->appends(request()->input())->links() }}
</div>

