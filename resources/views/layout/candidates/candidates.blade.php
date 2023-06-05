@php
    $displayTime = \Carbon\Carbon::now();
@endphp

@extends('layout.base')

@section('content')
    <section class="container px-2 mb-5 selectionTableList">
        <br>
        <h2 class="font-bold text-base md:text-3xl text-center text-40381F mb-7">応募履歴</h2>
        <form class="w-full">
            <div class="flex flex-wrap mb-2">
                <div class="px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                        Họ & tên
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="txtName" type="text">
                </div>
                <div class="px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                        Số điện thoại
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="txtPhoneNumber" type="text">
                </div>
                <div class="px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="txtEmail" type="text">
                </div>
                <div class="px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                        Tên Job
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="txtJobName" type="text">
                </div>
                <div class="px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Trạng thái
                    </label>
                    <div class="relative">
                        <select id="ddlContactStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            data-url="{{ route('change_contact_status') }}">
                            @foreach(ScreenConst::CONTACT_STATUS as $contactKey => $contactStatus)
                                <option value="{{ $contactKey }}">{{ $contactStatus }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="px-3 mb-3" style="margin-top: 25px">
                    <button type="button" id="btnSearch" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    data-url="{{ route('candidates.search') }}">
                        Tìm kiếm
                    </button>
                </div>
            </div>
        </form>
        <div class="flex flex-col mt-8">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div id="divTableList"
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    {!! $htmCandidatesArea !!}
                </div>
            </div>
        </div>
    </section>

    <input type="text" hidden id="txtDateDisplay" value="{{ $displayTime }}">
@endsection

@section('js')
    <script src="{{ asset('js/candidates.js') }}"></script>
@endsection


