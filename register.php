<?php

$title = "Register";
include 'includes/mainheader/header.php'?>

<?php if (logged_in()){
    redirect("index.php");
}?>
<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
            <?php validate_user_registration(); ?>
								
		</div>



	</div>
    	<div class="row justify-content-center" id="loginPanel">
			<div class="col-md-4 col-md-offset-3">
				<div class="card panel-login">
					<div class="card-header">
						<div class="row">
							<div class="col-sm-6">
								<a href="login.php">Login</a>
							</div>
							<div class="col-sm-6">
								<a href="register.php" class="active" id="">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="register-form" method="post" role="form" >
                                    <div class="form-group">
                                        <input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="First Name" value="" required >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" tabindex="1" class="form-control" placeholder="Last Name" value="" required >
                                    </div>
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" required >
									</div>
									<div class="form-group">
										<input type="email" name="email" id="register_email" tabindex="1" class="form-control" placeholder="Email Address" value="" required >
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group">
										<input type="password" name="confirm_password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" required>
									</div>
									<div class="form-group">
										<div class="row justify-content-center">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
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
<?php  include 'includes/mainheader/footer.php'?>
