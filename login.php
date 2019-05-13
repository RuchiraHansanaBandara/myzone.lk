<?php
$title = "Login";
include 'includes/mainheader/header.php'?>

<?php if(logged_in()){
    redirect('index.php');
}?>



<div class="row">
		<div class="col-lg-6 col-lg-offset-3">

	        <?php display_message(); ?>
            <?php validate_user_login(); ?>
								
		</div>
	</div>
    	<div class="row justify-content-md-center" id="loginPanel">

			<div class="col-md-4">
				<div class="card panel-login">
					<div class="card-header">
						<div class="row">
							<div class="col-sm-6">
								<a href="login.php" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-sm-6">
								<a href="register.php" id="">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form"  method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="login-
										password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember" id="remember_me"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row  justify-content-md-center">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="recover.php" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
<?php  require_once 'includes/mainheader/footer.php'; ?>
