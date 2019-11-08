<?php
if(!$this->session->has_userdata('user_id')) redirect(base_url(),'refresh');
if ($this->session->flashdata('info')) echo $this->session->flashdata('info');
?>
<div class="my-3">
	<div class="container">
		<div class="d-flex justify-content-center form-row">
			<div class="col-lg-4 post-outer">
				<div class="card bg-primary brad-20 text-white mb-3">
					<div class="card-body brad-20 shadow">
						<div class="my-0">
							<p>Welcome!</p>
							<div class="float-left">
								<p class="h5 font-weight-bold"><?= $this->session->userdata('email'); ?></p>
							</div>
							<div class="float-right">
								<p>User ID: <?= $this->session->userdata('user_id'); ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="fixed-bottom mb-3">
	<div class="container">
		<div class="d-flex justify-content-center form-row">
			<div class="col-lg-4 post-outer">
				<div class="card brad-20">
					<div class="card-body shadow p-3 brad-20">
						<div class="my-0 text-center">
							<div class="form-row h4">
								<div class="col">
									<i class="fa fa-tag"></i>
								</div>
								<div class="col">
									<i class="fa fa-shopping-basket"></i>
								</div>
								<div class="col">
									<i class="fa fa-plus-circle"></i>
								</div>
								<div class="col">
									<i class="fa fa-user-circle"></i>
								</div>
								<div class="col">
									<a href="<?= base_url('login/logout'); ?>" title="Logout">
										<i class="fa fa-sign-out-alt"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
