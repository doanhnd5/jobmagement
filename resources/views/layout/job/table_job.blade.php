<table id="tblList" class="min-w-full">
    <thead>
        <tr>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Tên Job</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Hình thức nhân viên</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Mức lương</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Thời gian làm việc</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Khu vực</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Thành phố</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Edit</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Delete</th>
        </tr>
    </thead>
    <tbody class="bg-white">
        @foreach ($jobWorkList as $jobWork)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                    <div class="ml-4">
                        <div class="text-sm font-medium leading-5 text-gray-900">
                            {{  $jobWork['job_name'] }}
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                    <div class="text-sm leading-5">{{ ScreenConst::JOB_TYPE_NAME[$jobWork['employment_type_id']] }}</div>
                </td>
                <td class="px-6 py-4 text-sm leading-5  whitespace-no-wrap border-b border-gray-200 text-center">
                    <div class="text-sm leading-5">{{  $jobWork['salary'] . '万' }}</div>
                </td>
                @php
                    $workTimeFrom = App\Libs\SystemUtil::getWorkTime($jobWork['work_time_from']);
                    $workTimeTo   = App\Libs\SystemUtil::getWorkTime($jobWork['work_time_to']);
                    $workTime     = $workTimeFrom . ' ～ ' . $workTimeTo;
                @endphp
                <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 ">{{  $workTime }}</div>
                </td>
                <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-200 text-center">
                    <div class="text-sm leading-5">{{ ScreenConst::JOB_AREA_NAME[$jobWork['workplace_prefecture']] }}</div>
                </td>
                <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 ">{{  $jobWork['workplace_city'] }}</div>
                </td>
                <td class="px-6 py-4 border-b border-gray-200">
                    <a class="detail" href="{{ route('create.index', ['id' => $jobWork['id'] ]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                </td>
                <td class="px-6 py-4 border-b border-gray-200">
                    <a class="btn-delete" href="{{ route('delete') }}" data-id="{{ $jobWork['id'] }}"
                        data-cfm-msg="{{ __('messages.I0001', ['attribute1' => 'xóa', 'attribute2' => 'job']) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="inline-block min-w-full pagination">
    {{ $jobWorkList->appends(request()->input())->links() }}
</div>
