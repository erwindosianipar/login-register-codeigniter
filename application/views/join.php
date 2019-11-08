<?php
if ($this->session->flashdata('info')) echo $this->session->flashdata('info');
?>
<div class="my-5">
	<div class="container">
		<div class="d-flex justify-content-center form-row">
			<div class="col-lg-4 post-outer">
				<div class="mb-5 text-center h5">
					Join Us
				</div>
				<div class="card brad-20">
					<div class="card-body brad-20 shadow">
						<div class="my-3">
							<?= form_open('join'); ?>
								<?php echo validation_errors('<script>swal({title: "Warning", text: "', '", timer: 10000, icon: "warning", button: false});</script>'); ?>
								<input type="text" name="email" value="<?= set_value('email'); ?>" placeholder="Email address" class="form-control mb-4 brad-20">
								<input type="password" name="password" value="<?= set_value('password'); ?>" placeholder="Password" class="form-control mb-4 brad-20">
								<input type="password" name="password_confirm" value="<?= set_value('password_confirm'); ?>" placeholder="Confirm Password" class="form-control mb-4 brad-20">
								<button type="submit" name="submit" class="btn btn-primary btn-block brad-20 mb-4">Join &rarr;</button>
							<?= form_close(); ?>
							
							<div class="text-center text-dark">
								Have an account? 
								<a href="<?= base_url(); ?>" title="Login" class="card-link">
									Login
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
