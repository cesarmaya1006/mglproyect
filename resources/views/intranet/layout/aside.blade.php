<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark" style="background-image: url('{{ asset("imagenes/sistema/aside2.jpg") }}');">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('imagenes/sistema/mgl_tech_logo.png') }}" alt="AdminLTE Logo" class="brand-image rounded-circle opacity-75 shadow bg-white" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light" style="font-size:0.9em;">Mayo - Sistems</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper" style="background-color: rgba(0,0,0,0.7); font-size:0.8em;">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                @foreach ($menusComposer as $key => $item)
                    @if ($item['menu_id'] != 0)
                        @break
                    @endif
                    @include("intranet.layout.menu-item", ["item" => $item])
                @endforeach
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
