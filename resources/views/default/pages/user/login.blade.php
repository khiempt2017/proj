<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<title>My Login Page &mdash; Bootstrap 4 Login Page Snippet</title>
	<link rel="stylesheet" type="text/css" href="{{asset("user/bootstrap/css/bootstrap.min.css")}}">
	<link rel="stylesheet" type="text/css" href="{{asset("user/css/my-login.css")}}">
</head>
<body class="my-login-page">
    
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						
					</div>
					<div class="card fat">
						<div class="card-body">
                            @include('admin.templates.notify')
                            <h4 class="card-title">Login</h4>
                            @php
                                $linkSubmit = route("user/login");
                            @endphp
                            <form method="POST" action="{{ $linkSubmit }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                {{ csrf_field() }}
								<div class="form-group">
									<label for="email">E-Mail Address</label>

									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
								</div>

								<div class="form-group">
									<label for="password">Password
										<a href="#" class="float-right">
											Forgot Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								</div>

								<div class="form-group">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>

								<div class="form-group no-margin">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
								<div class="margin-top20 text-center">
									Don't have an account? <a href="#">Create One</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; Your Company 2017
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset("user/js/jquery.min.js")}}"></script>
	<script src="{{asset("user/bootstrap/js/bootstrap.min.js")}}"></script>
	<script src="{{asset("user/js/my-login.js")}}"></script>
</body>
</html>