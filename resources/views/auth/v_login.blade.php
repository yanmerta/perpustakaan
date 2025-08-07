<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title>Login - Sistem Informasi Perpustakaan</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('dist/assets/template_admin/demo1/dist/assets/media/SD.png') }}" />

    <!-- Font: Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS Bundle -->
    <link href="{{ asset('dist/assets/template_admin/demo1/dist/assets/plugins/global/plugins.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/assets/template_admin/demo1/dist/assets/css/style.bundle.css') }}" rel="stylesheet"
        type="text/css" />
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="bg-body" style="font-family: 'Poppins', sans-serif;">

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">

            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px"
                style="background: linear-gradient(to bottom, #F5F5F5, #E8E8E8);">
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                        <a href="/" class="py-9 mb-5">
                            <img alt="Logo"
                                src="{{ asset('dist/assets/template_admin/demo1/dist/assets/media/SD.png') }}"
                                class="h-200px" />
                        </a>
                        <h1 class="fw-bold fs-1 pb-3"
                            style="color: #B8860B; letter-spacing: 1px; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">
                            Sistem Informasi Perpustakaan
                        </h1>
                        <p class="fw-semibold fs-4"
                            style="color: #555555; line-height: 1.6; text-shadow: 0.5px 0.5px 1px rgba(0,0,0,0.05);">
                            Solusi Digital untuk Manajemen Koleksi dan Layanan Pustaka
                        </p>

                    </div>
                    <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                        style="background-image: url('{{ asset('assets/media/illustrations/sketchy-1/13.png') }}')">
                    </div>
                </div>
            </div>
            <!--end::Aside-->

            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <div class="w-lg-500px p-10 p-lg-15 mx-auto"
                        style="background: #ffffff; border-radius: 16px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);">

                        <!--begin::Alert-->
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <!--end::Alert-->

                        <!--begin::Form-->
                        <form class="form w-100" method="POST" action="{{ route('login.process') }}">
                            @csrf

                            <div class="text-center mb-10">
                                <h1 class="text-dark mb-5">LOGIN SIMPERPUS</h1>
                            </div>

                            <!-- Email -->
                            <div class="fv-row mb-10">
                                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i
                                            class="bi bi-envelope-fill text-primary"></i></span>
                                    <input class="form-control form-control-lg form-control-solid" type="email"
                                        name="email" value="{{ old('email') }}" required autofocus />
                                </div>
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="fv-row mb-10">
                                <div class="d-flex flex-stack mb-2">
                                    <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i
                                            class="bi bi-lock-fill text-primary"></i></span>
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        name="password" required />
                                </div>
                                @error('password')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5"
                                    style="transition: background-color 0.3s ease;">
                                    <span class="indicator-label">Masuk</span>
                                    <span class="indicator-progress">Mohon tunggu...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    {{-- Footer --}}
                    <footer class="text-center mt-10">
                        <div class="text-muted small">
                            &copy; {{ date('Y') }}
                            <a href="#" class="fw-semibold text-primary text-decoration-none">
                                Sistem Informasi Perpustakaan
                            </a>. All rights reserved.
                        </div>
                    </footer>
                    {{-- End Footer --}}
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <style>
        html,
        body {
            height: 100%;
        }

        .d-flex.flex-column.flex-root {
            min-height: 100vh;
        }

        footer {
            margin-top: auto;
            padding: 1rem 0;
        }
    </style>

    <!-- Scripts -->
    <script>
        var hostUrl = "{{ asset('assets/') }}/";
    </script>
    <script src="{{ asset('dist/assets/template_admin/demo1/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('dist/assets/template_admin/demo1/dist/assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('dist/assets/template_admin/demo1/dist/assets/js/custom/authentication/sign-in/general.js') }}">
    </script>
</body>
<!--end::Body-->

</html>
