<table id="tblList" class="min-w-full">
    <colgroup>
        <col style="width: 200px">
        <col style="width: 100px">
        <col style="width: 80px">
        <col style="width: 80px">
        <col style="width: 80px">
    </colgroup>
    <thead>
        <tr>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Tiêu đề</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Ngày đăng</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Edit</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Delete</th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider uppercase border-b border-gray-200">
                Xuất bản</th>
        </tr>
    </thead>
    <tbody class="bg-white">
        @foreach ($postList as $index => $postData)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                    <div class="text-sm leading-5">{{ $postData['post_title'] }}</div>
                </td>
                <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-200 text-center">
                    <div class="text-sm leading-5">{{ $postData['create_datetime'] }}</div>
                </td>
                <td class="px-6 py-4 border-b border-gray-200 text-center">
                    <a class="detail" href="{{ route('post.create', ['id' => $postData['id'] ]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                </td>
                <td class="px-6 py-4 border-b border-gray-200  text-center">
                    <a class="btn-delete" href="{{ route('post.delete') }}" data-id="{{ $postData['id'] }}"
                        data-cfm-msg="{{ __('messages.I0001', ['attribute1' => 'xóa', 'attribute2' => 'bài đăng']) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </a>
                </td>
                <td class="px-6 py-4 border-b border-gray-200 text-center">
                    @if (!$postData['is_publish'])
                        <button class="btn-publish bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                            data-cfm-msg="{{ __('messages.I0004') }}"
                            data-url="{{ route('post.publish') }}"
                            data-id="{{ $postData['id'] }}">
                            Xuất bản
                        </button>
                    @endif
            </tr>
        @endforeach
    </tbody>
</table>
<div class="inline-block pagination">
    {{ $postList->appends(request()->input())->links() }}
</div>
