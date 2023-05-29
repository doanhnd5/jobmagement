<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- Meta Tag --}}
        @include('includes.element.meta')

        <title>Jobsempai.com</title>

        {{-- CSS --}}
        @include('includes.element.link')
        {{-- CSS For Screen --}}
        @yield('css')
    </head>
    <body>
        {{-- Header --}}
        @include('includes.header')
        {{-- Main --}}
        <main id="main">
            <div id="spinerLoading" class="hidden flex justify-center items-center h-screen fixed top-0 left-0 right-0 bottom-0 w-full z-50 overflow-hidden bg-gray-700 opacity-75">
                <div class="border-t-transparent border-solid animate-spin  rounded-full border-blue-400 border-8 h-64 w-64"></div>
            </div>
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('includes.footer')

        @include('includes.element.script')
        @yield('js')
    </body>
</html>
