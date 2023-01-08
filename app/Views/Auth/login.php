<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="app-container">
	<div class="h-100 bg-plum-plate bg-animation">
		<div class="d-flex h-100 justify-content-center align-items-center">
			<div class="mx-auto app-login-box col-md-8">
				<div class="app-logo-inverse mx-auto mb-3"></div>
				<div class="modal-dialog w-100 mx-auto">
					<div class="modal-content">
						<form action="<?= url_to('login') ?>" method="post">
							<?= csrf_field() ?>
							<div class="modal-body">
								<div class="h5 modal-title text-center">
									<h4 class="mt-2">
										<div>Welcome back,</div>
										<span>Please sign in to your account below.</span>
									</h4>
								</div>
								<?= view('App\Views\Auth\_message_block') ?>

								<div class="form-row">
									<?php if ($config->validFields === ['email']) : ?>
										<div class="col-md-12">
											<div class="position-relative form-group">
												<input type="email" name="login" placeholder="<?= lang('Auth.email') ?>" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" value="<?= old('login') ?>" />
												<div class="invalid-feedback">
													<?= session('errors.login') ?>
												</div>
											</div>
										</div>
									<?php else : ?>
										<div class="col-md-12">
											<div class="position-relative form-group">
												<input type="text" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" value="<?= old('login') ?>" />
												<div class="invalid-feedback">
													<?= session('errors.login') ?>
												</div>
											</div>
										</div>
									<?php endif; ?>
									<div class="col-md-12">
										<div class="position-relative form-group">
											<input type="password" name="password" placeholder="<?= lang('Auth.password') ?>" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" />
											<div class="invalid-feedback">
												<?= session('errors.password') ?>
											</div>
										</div>
									</div>
								</div>

								<?php if ($config->allowRemembering) : ?>
									<div class="position-relative form-check">
										<input type="checkbox" name="remember" id="rememberCheck" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?> />
										<label for="rememberCheck" class="form-check-label"><?= lang('Auth.rememberMe') ?></label>
									</div>
								<?php endif; ?>
								<?php if ($config->allowRegistration) : ?>
									<div class="divider"></div>
									<h6 class="mb-0">
										No account?
										<a href="<?= url_to('register') ?>" class="text-primary">Sign up now</a>
									</h6>
								<?php endif; ?>
							</div>

							<div class="modal-footer clearfix">
								<?php if ($config->activeResetter) : ?>
									<div class="float-left">
										<a href="<?= url_to('forgot') ?>" class="btn-lg btn btn-link">Recover Password</a>
									</div>
								<?php endif; ?>
								<div class="float-right">
									<button type="submit" class="btn btn-primary btn-lg">
										<?= lang('Auth.loginAction') ?>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="text-center text-white opacity-8 mt-3">
					Copyright © SPBU Pro <?= date('Y') ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>