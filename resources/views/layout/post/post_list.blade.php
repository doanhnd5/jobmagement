
@php
    $displayTime = \Carbon\Carbon::now();
@endphp

@extends('layout.base')

@section('content')
    <section class="container px-2 mb-5 selectionTableList">
        <br>
        <h2 class="font-bold text-base md:text-3xl text-center text-40381F mb-7">ビザ情報</h2>
        <form class="w-full">
            {!! $htmlSearchArea !!}
        </form>
        <div class="flex flex-col mt-8">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div id="divTableList"
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    {!! $htmlTableArea !!}
                </div>
            </div>
        </div>
    </section>

    <input type="text" hidden id="txtDateDisplay" value="{{ $displayTime }}">
@endsection

@section('js')
    <script src="{{ asset('js/post.js') }}"></script>
@endsection
