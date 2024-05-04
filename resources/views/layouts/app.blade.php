@include('partials.header')
    <body class="">
        <!-- Wrapper Start -->
        <div class="wrapper">
            <!-- Sidebar -->
            @include("partials.sidebar")
            <!-- Navbar -->
            @include("partials.navbar")
            <div class="content-page">
                @yield('content')
            </div>
        </div>
        <!-- Wrapper End-->
        <footer class="iq-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 text-right">
                        <span class="mr-1">
                            {{ date('Y') }}©
                        </span> 
                        <span class="text-primary">{{ config('app.name') }}</span>.
                    </div>
                </div>
            </div>
        </footer>
        @include('partials.footer')
        @stack('scripts')

        @include('sweetalert::alert')
    </body>
</html>
