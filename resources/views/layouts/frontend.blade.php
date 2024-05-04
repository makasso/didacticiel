@include('partials.header')
@stack('styles')

<body class="">
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page">
            @yield('content')
        </div>
        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- Navbar -->
        {{-- @include("partials.navbar") --}}

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
    <script>
        $(document).ready(function() {
            $('.btn-module-disabled').click(function(e) {
                e.preventDefault();
                Toast.fire({
                    title: 'Vous ne pouvez pas accéder à ce module pour l\'instant',
                    icon: 'error',

                });
            });
        })
    </script>

    @include('sweetalert::alert')
</body>

</html>
