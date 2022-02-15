<?php $this->view("header", $data); ?>
<center>
	<section id="form"><!--form-->
		<div class="container" style="margin-top: 5px;">
			<div class="row" style="text-align: center;">

			<span style="font-size: 20px; color:red;">
				<?php check_error() ?>
				</span>
				<div class="col-sm-4 col-sm-offset-1" style="float:none; display:inline-block;">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form method="post">
							<input type="email"  name="email" placeholder="email" />
							<input type="password" name="password" placeholder="Enter your password!" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
								
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>

						<br>

						<a href="<?= ROOT ?>signup">                                Don't have an account? Signup here
</a>
					</div><!--/login form-->
				</div>
			
				
			</div>
		</div>
	</section><!--/form-->
	</center>
<?php $this->view("footer", $data); ?>
