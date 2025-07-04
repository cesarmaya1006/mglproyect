<!doctype html>
<html lang="es">
<!--begin::Head-->
<head>
    @include('intranet.layout.head')
    @yield('cssPagina')
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    @yield('phpPagina')
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        @include('intranet.layout.menusup')
        <!--end::Header-->
        <!--begin::Sidebar-->
        @include('intranet.layout.aside')

        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            @yield('tituloPagina')
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            @yield('botones_card')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            @include('includes.mensaje')
                            @include('includes.error-form')
                        </div>
                    </div>
                    @yield('cuerpoPagina')
                    <!-- /.row (main row) -->
                    @yield('footer_card')
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        @include('intranet.layout.footer')
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    @yield('modales')
    @include('intranet.layout.script')
    @yield('scriptPagina')
    <!--end::Script-->
</body>
<!--end::Body-->

</html>
