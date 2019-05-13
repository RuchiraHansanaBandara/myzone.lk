<?php  include 'includes/mainheader/header.php'?>

<div class="row justify-content-center" >
				<div class="col-md-5 col-md-offset-3 col-md-6 col-md-offset-3">
					<div class="alert-placeholder">
                        <?php display_message(); ?>
	                    <?php recover_password(); ?>
					</div>
                    <div id="loginPanel">
					<div class="card card-recover" >
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="text-center recover_head"><h5><b>Recover Password</b></h5></div>
									<form id="register-form"  method="post" role="form" autocomplete="off">
										<div class="form-group">

											<label for="email" style="font-weight: bold; font-size: 18px;">Email Address</label>
											<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" autocomplete="off" />
										</div>
										<div class="form-group">
											<div class="row">

												<div class="col-lg-6 col-sm-6 col-sm-6">
													<input type="submit" name="cancel_submit" id="cancel_submit" tabindex="2" class="form-control btn btn-danger" value="Cancel" />
												</div>
												<div class="col-lg-6 col-sm-6 col-xs-6">
													<input type="submit" name="recover-submit" id="recover-submit" tabindex="2" class="form-control btn btn-success" value="Send Password Reset Link" />
												</div>

												
											</div>
										</div>
										<input type="hidden" class="hide" name="token" id="token" value="<?php echo token_generator();?>">
									</form>
								</div>
							</div>
						</div>
					</div>
                    </div>
				</div>
			</div>
    <?php  include 'includes/mainheader/footer.php'?>
