<div class="flex flex-wrap mb-2">
    <div class="px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
            Tiêu đề
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="txtPostTitle" value="{{ $srchList['srchPostTitle'] ?? '' }}" type="text">
    </div>
    <div class="px-3 mb-3" style="margin-top: 25px">
        <button type="button" id="btnSearch" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        data-url="{{ route('post.search') }}">
            Tìm kiếm
        </button>
    </div>
    <div class="px-3 mb-3" style="margin-top: 25px;">
        <button id="btnCreatePost" type="button" data-url="{{ route('post.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Thêm bài đăng
        </button>
    </div>
</div>
