<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
@include('main.head-css')

<body>
    <main class="main" id="top">
        <div class="container-fluid px-0" data-layout="container">

            @include('main.sidebar')
            @include('main.topbar')
            @include('main.head')
            <div class="content">
                @yield('content')
                @include('main.footer')
            </div>
        </div>
    </main>
    @include('main.vendor-scripts')
</body>
</html>

