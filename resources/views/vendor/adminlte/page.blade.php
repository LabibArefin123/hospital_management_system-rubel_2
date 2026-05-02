@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')

<link rel="icon" type="image/png" href="{{ asset('uploads/images/icon.png') }}">
<link rel="stylesheet" href="{{ asset('css/custom_backend.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">
        <!-- start of modal animation -->
        <div class="modal fade" id="backConfirmModal" tabindex="-1" role="dialog" aria-labelledby="backConfirmLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content text-center p-4">
                    <!-- Animated Circle Icon -->
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-bounce" width="50" height="50"
                            fill="#FFC107" viewBox="0 0 16 16">
                            <path
                                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0-12a.905.905 0 0 1 .9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 3.995A.905.905 0 0 1 8 3zm.002 6a1 1 0 1 1-2.002 0 1 1 0 0 1 2.002 0z" />
                        </svg>
                    </div>

                    <!-- Modal Message -->
                    <div class="modal-body mb-3">
                        Please fill up the required fields before leaving the page. Do you want to leave?
                    </div>

                    <!-- Footer Buttons -->
                    <div class="modal-footer d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Stay</button>
                        <a href="#" class="btn btn-danger leave-page">Leave</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of modal animation -->

    
        {{-- Preloader --}}
        @if ($preloaderHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- Top Navbar --}}
        @if ($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Sidebar --}}
        @unless ($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endunless

        {{-- Content --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @include('frontend.layouts.footer')
        @hasSection('footer')
            @yield('footer')
        @endif

        {{-- Right Sidebar --}}
        @if ($layoutHelper->isRightSidebarEnabled())
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif
    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
   
    <!-- Start of Login / Logout -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // ✅ 1️⃣ Logout Confirmation
            const logoutButton = document.querySelector('a[href="#"][onclick*="logout-form"]');
            const logoutForm = document.getElementById('logout-form');

            if (logoutButton && logoutForm) {
                logoutButton.removeAttribute('onclick');
                logoutButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure you want to log out?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, log out',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Slight delay to ensure session flash persists properly
                            setTimeout(() => logoutForm.submit(), 200);
                        }
                    });
                });
            }

            // ✅ 2️⃣ Show alerts based on session (AFTER page reload)
            @if (session()->has('login_success'))
                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Welcome back!',
                        text: '{{ session('login_success') }}',
                        timer: 2500,
                        showConfirmButton: false
                    });
                }, 300);
            @endif
        });
    </script>

    {{-- start of manual search --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const globalSearchUrl = "{{ route('global.search') }}";

            const navbarForms = document.querySelectorAll(".navbar-search-block form");

            navbarForms.forEach(form => {
                const input = form.querySelector('input[name="term"]');
                if (!input) return;

                // Create result box
                const resultBox = document.createElement("div");
                resultBox.style.position = "absolute";
                resultBox.style.top = "40px";
                resultBox.style.left = "0";
                resultBox.style.width = "100%";
                resultBox.style.maxHeight = "250px";
                resultBox.style.overflowY = "auto";
                resultBox.style.background = "#ffffff";
                resultBox.style.border = "1px solid #ddd";
                resultBox.style.borderRadius = "6px";
                resultBox.style.boxShadow = "0 4px 8px rgba(0,0,0,0.08)";
                resultBox.style.zIndex = "99999";
                resultBox.style.display = "none";
                resultBox.style.color = "#000";

                const parentGroup = input.closest(".input-group");
                parentGroup.style.position = "relative";
                parentGroup.appendChild(resultBox);

                let timer = null;

                // Prevent full-page reload
                form.addEventListener("submit", e => e.preventDefault());

                input.addEventListener("input", function() {
                    const query = this.value.trim();
                    clearTimeout(timer);

                    if (query.length < 2) {
                        resultBox.style.display = "none";
                        return;
                    }

                    timer = setTimeout(() => {
                        fetch(`${globalSearchUrl}?term=${encodeURIComponent(query)}`)
                            .then(res => res.json())
                            .then(data => {
                                if (!Array.isArray(data) || data.length === 0) {
                                    resultBox.innerHTML = `
                                    <div class="p-2 text-muted" style="color:#555;">No results found</div>`;
                                } else {
                                    resultBox.innerHTML = data.map(item => `
                                    <div class="search-item"
                                        style="
                                            padding:8px 12px;
                                            cursor:pointer;
                                            display:flex;
                                            justify-content:space-between;
                                            align-items:center;
                                            border-bottom:1px solid #f1f1f1;
                                            color:#000;
                                        "
                                        onmouseover="this.style.background='#f7f7f7'"
                                        onmouseout="this.style.background='#fff'"
                                        onclick="window.location='${item.url}'">
                                        
                                        <span style="font-size:14px; font-weight:500;">
                                            ${item.label}
                                        </span>

                                        <span style="
                                            font-size:11px;
                                            background:#e6f0ff;
                                            color:#000;
                                            padding:2px 6px;
                                            border-radius:4px;
                                        ">
                                            ${item.type ? item.type.toUpperCase() : ''}
                                        </span>
                                    </div>
                                `).join("");
                                }
                                resultBox.style.display = "block";
                            })
                            .catch(() => {
                                resultBox.innerHTML = `
                                <div class="p-2 text-danger">Error loading results</div>`;
                                resultBox.style.display = "block";
                            });
                    }, 300);
                });

                // Close when clicking outside
                document.addEventListener("click", function(e) {
                    if (!resultBox.contains(e.target) && e.target !== input) {
                        resultBox.style.display = "none";
                    }
                });
            });
        });
    </script>
    {{-- end of manual search --}}

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                timer: 2500,
                showConfirmButton: false
            });
        @endif

        @if (session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: "{{ session('warning') }}",
                timer: 2500,
                showConfirmButton: false
            });
        @endif

        @if (session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: "{{ session('info') }}",
                timer: 2500,
                showConfirmButton: false
            });
        @endif
    </script>
    <!-- end of notification toaster notification -->
    <!-- start of data table format table -->
    <script>
        $(document).ready(function() {
            $('#dataTables').DataTable();
        });
    </script>
    <!-- end of data table format table -->

    <!-- start of jquery and bootstrap table -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- end of jquery and bootstrap table -->
@section('plugins.Datatables', true)
@stop
