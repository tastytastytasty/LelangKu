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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

	<title>Register | LelangKu</title>

	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						@if (session('success'))
							<div id="alertBox" class="alert alert-success text-success"
								style="padding:10px; margin-bottom:10px; background:#d4edda; position:relative;">
								{{ session('success') }}
								<button id="closeAlert" class="text-success"
									style="position:absolute; top:5px; right:10px; background:none; border:none; font-size:20px; line-height:20px; cursor:pointer;">
									&times;
								</button>
							</div>
						@endif
						<div class="text-center mt-4">
							<h1 class="h2">Ayo Mulai</h1>
							<p class="lead">
								Buat pengalaman lelang terbaik untuk Anda.
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="{{asset('assets/img/icons/log.png')}}" alt="LelangKu"
											class="img-fluid" width="200"/>
									</div>
									<form action="{{ route('register') }}" method="post">
										@csrf
										<div class="mb-3 mt-3">
											<label class="form-label">Nama Lengkap</label>
											<input class="form-control form-control-lg" type="text" name="nama_lengkap"
												placeholder="Masukkan Nama Anda" />
										</div>
										<div class="mb-3">
											<label class="form-label">NIK</label>
											<input class="form-control form-control-lg" type="text" minlength="16" maxlength="16" name="username"
												placeholder="Masukkan NIK Anda" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" minlength="6" name="password"
												placeholder="Masukkan password Anda" />
										</div>
										<div class="mb-3">
											<label class="form-label">Nomor Telpon</label>
											<input class="form-control form-control-lg" type="text" name="telp"
												placeholder="Masukkan no.telp Anda" />
										</div>
											<label class="form-label">Alamat</label>
											<input class="form-control form-control-lg" type="text" name="alamat"
												placeholder="Masukkan alamat Anda" />
										</div>
										<div class="text-center mt-4">
											<button type="submit" class="btn btn-lg btn-primary"
												style="padding-left:200px; padding-right:200px;">Register</button>
										</div>
										<div class="text-center mt-3">
											<span>Sudah punya akun?
												<a href="/login" class="text-primary">Log in.</a>
											</span>
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

	<script src="{{asset('assets/js/app.js')}}"></script>

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