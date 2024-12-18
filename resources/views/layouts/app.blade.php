<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="img/favicon.png">

    <title>@yield('title')</title>

    @include('layouts/partials/css')
    @yield('css')

    <style>
        .confirmdanger {
            background-color: #0c97e2;
        }
    </style>
    <!-- Scripts -->
    <script src="{{ asset('asset/js/app.js') }}" defer></script>

</head>

<body>
    <div id="app">
        <div class="d-grid  active" id="wrapper">
            @include('layouts/partials/sidebar')
            <div id="page-content-wrapper" class="w-100">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg bg-primary-head border-0 pt-2 pb-2">
                    <div class="container-fluid justify-content-between ps-5 pe-5  nav-div">

                        <!-- <button class="btn btn-light text-primary shadow-lg bg-primary text-white" id="sidebarToggle"><i class="fa fa-bars "></i></button> -->
                        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-user"></i></button> -->

                        <div class="d-flex  align-items-center ">
                            <img src="https://appacmedia.com/images/favicon.png" width="30 " class="mbl_fav " alt="">
                            <div class="hamburger ms-3" onclick="toggleMenu()">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                            </div>

                        </div>
                        <div class="d-flex align-items-center gap-4">
                            <div class="bell"></div>
                            <a
                                class="nav-link dropdown-fullscreen arrow-none waves-effect waves-light pl-3"
                                href="#"
                                onclick="toggleFullScreen()">
                                <span id="fullscreen-icon">
                                    <!-- Fullscreen icon SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <path fill="none" stroke="#999999" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M2.75 15.469v3.469a2.313 2.313 0 0 0 2.313 2.312H8.53m12.72-5.781v3.469a2.31 2.31 0 0 1-2.312 2.312h-3.47M2.75 8.531V5.062A2.31 2.31 0 0 1 5.063 2.75H8.53m6.939 0h3.469a2.313 2.313 0 0 1 2.312 2.313V8.53" />
                                    </svg>
                                </span>
                            </a>
                            <nav class="navbar navbar-expand-md navbar-light">
                                <div class="container ">
                                    <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                        <span class="navbar-toggler-icon"></span>
                                    </button> -->

                                    <div class=" navbar-collapse">
                                        <!-- Left Side Of Navbar
                                        <ul class="navbar-nav me-auto"></ul> comment by vasanth-->

                                        <!-- Right Side Of Navbar -->
                                        <!-- <ul class="list-unstyled ms-auto mb-0">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link pri-text-color mt-0" onclick="logout()" href="#">
                                                    Logout
                                                </a>
                                            </li>

                                        </ul> comment by vasanth-->
                                        <div class="no-border">
                                            <div><button class="pro-d">

                                                    <img class="w-100" src="{{ request()->session()->has('profilephoto') && request()->session()->get('profilephoto') ? asset('uploadphoto/' . request()->session()->get('profilephoto'))  : asset('asset/image/avatar/' . request()->session()->get('avatarphoto').'.png') }}" alt="Employee profile">
                                                </button></div>
                                            <div class="pro-div">
                                                <div class="side-menu-hed h-auto">
                                                    <div class="menu-list-group pt-3 p-2 menu-list-group-flush gap-2  menus">
                                                        <div class=" menus">
                                                            <!-- <span id="m11">
    <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3">
        <img src="{{ asset('asset/image/settings.png') }}" width="22" alt="">
        <p class="mb-0">Settings</p>
    </div>
</span> -->
                                                            <span id="m8">
                                                                <a class=" menu-list-group-item menu-list-group-item-action menu-list-group-item-dark anchor border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3" href="/profile">
                                                                    <img src="{{ asset('asset/image/carbon-user-profile.png') }}" width="22" alt="">
                                                                    <p class="pro-p">View Profile</p>
                                                                </a>
                                                            </span>
                                                            <span id="m8">
                                                                <a class=" menu-list-group-item menu-list-group-item-action menu-list-group-item-dark anchor border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3" onclick="logout()" href="#">
                                                                    <img src="{{ asset('asset/image/login.png') }}" width="22" alt="">
                                                                    <p class="pro-p">Logout</p>
                                                                </a>
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </nav>
                        </div>
                    </div>
                </nav>

                <div class="lgrey-bg  w-100  ">
                    <div class="container px-4 ">

                        <main class="py-2">
                            @yield('content')
                        </main>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

@include('layouts/partials/js')
@yield('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
    function logout() {
		sessionStorage.setItem('sessionvariable', 'false');
        sessionStorage.clear();
        swal({
            title: "Alert",
            text: "Do you want to logout?",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "Okay",
                    value: true,
                    visible: true,
                    className: "confirmdanger", // Change this class to change the button color
                    closeModal: true
                }
            },
            closeOnClickOutside: false
        }).then((value) => {
            if (value) {
                $.ajax({
                    url: '{{ url("/logout") }}',
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Redirect to the logout URL upon successful logout
						
                        window.location.href = '{{ url("/") }}';
                    },
                    error: function(error) {
                        // Handle errors if necessary
                    }
                });
            }
        });
    }
</script>
<script>
    document.addEventListener('click', function(event) {
        const proD = document.querySelector('.pro-d');
        const proDiv = document.querySelector('.pro-div');

        // Check if the click is outside both `.pro-d` and `.pro-div`
        if (!proD.contains(event.target) && !proDiv.contains(event.target)) {
            proDiv.classList.remove('active');
        }
    });

    document.querySelector('.pro-d').addEventListener('click', function(event) {
        const proDiv = document.querySelector('.pro-div');
        proDiv.classList.toggle('active'); // Toggles the 'active' class
        event.stopPropagation(); // Prevent event bubbling to the document click listener
    });
</script>
<script>
    function toggleFullScreen() {
        const fullscreenIcon = document.getElementById("fullscreen-icon");

        if (!document.fullscreenElement) {
            // Enter fullscreen
            document.documentElement.requestFullscreen().catch((err) => {
                console.error(`Error attempting to enable fullscreen mode: ${err.message} (${err.name})`);
            });

            // Change to "Exit fullscreen" icon
            fullscreenIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                <path fill="none" stroke="#999999" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" 
                    d="M8.531 21.25v-3.469A2.31 2.31 0 0 0 6.22 15.47H2.75m12.719 5.78v-3.469a2.31 2.31 0 0 1 2.312-2.312h3.469M8.531 2.75v3.469A2.31 2.31 0 0 1 6.22 8.53H2.75m18.5.001h-3.469A2.31 2.31 0 0 1 15.47 6.22V2.75" />
            </svg>
        `;
        } else {
            // Exit fullscreen
            document.exitFullscreen();

            // Change back to "Enter fullscreen" icon
            fullscreenIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                <path fill="none" stroke="#999999" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                    d="M2.75 15.469v3.469a2.313 2.313 0 0 0 2.313 2.312H8.53m12.72-5.781v3.469a2.31 2.31 0 0 1-2.312 2.312h-3.47M2.75 8.531V5.062A2.31 2.31 0 0 1 5.063 2.75H8.53m6.939 0h3.469a2.313 2.313 0 0 1 2.312 2.313V8.53" />
            </svg>
        `;
        }
    }
</script>

</html>