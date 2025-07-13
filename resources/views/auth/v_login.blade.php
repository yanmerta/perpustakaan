<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title>Login - Sistem Informasi Perpustakaan</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('dist/assets/template_admin/demo1/dist/assets/media/logo.jpeg') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('dist/assets/template_admin/demo1/dist/assets/plugins/global/plugins.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/assets/template_admin/demo1/dist/assets/css/style.bundle.css') }}" rel="stylesheet"
        type="text/css" />
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="bg-body">

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">

            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px" style="background-color: #F2C98A">
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                        <a href="/" class="py-9 mb-5">
                            <img alt="Logo"
                                src="{{ asset('dist/assets/template_admin/demo1/dist/assets/media/logo.png') }}"
                                class="h-120px" />
                        </a>
                        <h1 class="fw-bolder fs-2qx pb-5" style="color: #986923;">Sistem Informasi Perpustakaan</h1>
                        <p class="fw-bold fs-2" style="color: #986923;">Solusi Digital untuk Manajemen Koleksi dan
                            Layanan Pustaka</p>

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
                    <div class="w-lg-500px p-10 p-lg-15 mx-auto">

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
                                <h1 class="text-dark mb-3">Masuk ke Halaman Admin</h1>
                            </div>

                            <div class="fv-row mb-10">
                                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                <input class="form-control form-control-lg form-control-solid" type="email"
                                    name="email" value="{{ old('email') }}" required autofocus />
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="fv-row mb-10">
                                <div class="d-flex flex-stack mb-2">
                                    <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                </div>
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    name="password" required />
                                @error('password')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">Masuk</span>
                                    <span class="indicator-progress">Mohon tunggu...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                        <!--end::Form-->

                    </div>
                </div>
                <!--begin::Footer-->

                <!--end::Footer-->
            </div>
            <!--end::Body-->

        </div>
    </div>

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
