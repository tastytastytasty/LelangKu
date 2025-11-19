<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{asset('assets/img/icons/leg.png')}}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

    <title>Log In | LelangKu</title>

    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        @if (session('error'))
                            <div id="alertBox" class="alert alert-danger text-danger"
                                style="padding:10px; margin-bottom:10px; background:#f8d7da; position:relative;">
                                {{ session('error') }}
                                <button id="closeAlert" class="text-danger"
                                    style="position:absolute; top:5px; right:10px; background:none; border:none; font-size:20px; line-height:20px; cursor:pointer;">
                                    &times;
                                </button>
                            </div>
                        @endif
                        <div class="text-center mt-4">
                            <h1 class="h2">Selamat datang</h1>
                            <p class="lead">
                                Masukkan akun Anda untuk melanjutkan
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-2">
                                    <div class="text-center">
                                        <img src="{{asset('assets/img/icons/log.png')}}" alt="LelangKu"
											class="img-fluid" width="200"/>
                                    </div>
                                    <form action="{{ route('login.masyarakat') }}" method="post">
                                        @csrf
                                        <div class="mb-3 mt-5">
                                            <label class="form-label">NIK</label>
                                            <input class="form-control form-control-lg" type="text" minlength="16" maxlength="16" name="username"
                                                placeholder="Masukkan NIK Anda" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required/>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" minlength="6" name="password"
                                                placeholder="Masukkan password Anda" />
                                            <!-- <div class="d-flex justify-content-between mt-3 gap-2">
                                                <span>
                                                    <a href="" class="text-primary">Lupa Password?</a>
                                                </span>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="remember-me"
                                                        name="remember-me" checked>
                                                    <span class="form-check-label">
                                                        Ingatkan password
                                                    </span>
                                                </label>
                                            </div> -->
                                        </div>
                                        <div class="text-center mt-5">
                                            <button type="submit" class="btn btn-lg btn-primary"
                                                style="padding-left:235px; padding-right:235px;">Log in</button>
                                        </div>
                                        <div class="d-flex justify-content-between mt-3 gap-2">
                                            <div class="text-center mt-3">
                                                <span>Buat akun baru?
                                                    <a href="/register" class="text-primary">Register.</a>
                                                </span>
                                            </div>
                                            <div class="text-center mt-3">
                                                <span>Login sebagai
                                                    <a href="/" class="text-primary">Petugas.</a>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{assert('assets/js/app.js')}}"></script>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var closeBtn = document.getElementById("closeAlert");
        var alertBox = document.getElementById("alertBox");

        if (closeBtn) {
            closeBtn.addEventListener("click", function () {
                alertBox.style.display = "none";
            });
        }
    });
</script>

</html>