<div class="flex flex-wrap mb-2">
    <div class="px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
        Khu vực
      </label>
      <select id="srchJobArea" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Chọn vùng</option>
            @foreach (ScreenConst::JOB_AREA_NAME as $areaKey => $areaName)
                @if (isset($srchList['srchArea']) && $srchList['srchArea'] == $areaKey)
                    <option value="{{ $areaKey }}" selected>{{ $areaName }}</option>
                @else
                    <option value="{{ $areaKey }}">{{ $areaName }}</option>
                @endif
           @endforeach
      </select>
    </div>
    <div class="px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
        Hình thức tuyển dụng
      </label>
      <div class="relative">
          <select id="srchEmploymentType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Chọn hình thức tuyển dụng</option>
            @foreach(ScreenConst::WORK_STATUS_EMPLOYEE_NAME as $employmentKey => $employmentName)
                @if (isset($srchList['srchJobType']) && $srchList['srchJobType'] == $employmentKey)
                    <option value="{{ $employmentKey }}" selected>{{ $employmentName }}</option>
                @else
                    <option value="{{ $employmentKey }}">{{ $employmentName }}</option>
                @endif
              @endforeach
          </select>
      </div>
    </div>
    <div class="px-3 mb-3" style="margin-top: 25px">
      <button type="button" id="btnSearch" data-url="{{ route('search') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Tìm kiếm
      </button>
    </div>
    <div class="px-3 mb-3" style="margin-top: 25px;">
      <button id="btnCreateJob" type="button" data-url="{{ route('create.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Thêm Job Mới
      </button>
    </div>
  </div>
