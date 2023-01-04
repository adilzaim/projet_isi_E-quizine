


	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">User access</li>
		</ol>
		
		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Sign in</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Sign in to your account</h3>
							<p class="text-center text-muted">Lorem ipsum dolor sit amet, <!--<a href="<?= base_url();?>index.php/signup.php">Register</a>--> adipisicing elit. Quo nulla quibusdam cum doloremque incidunt nemo sunt a tenetur omnis odio. </p>
							<hr>
							
							<?php  if(validation_errors() != null): ?>
           						 <div class="alert alert-warning  text-center pb-0 pt-0" role="alert">
               					 <p><strong><?= validation_errors();?> </strong></p>
            					</div>
							<?php endif; ?>
							<?php  if(isset($erreur_identifiant)): ?>
           						 <div class="alert alert-warning text-center pb-0 pt-0" role="alert">
               					 <p><strong><?= $erreur_identifiant?> </strong></p>
            					</div>
							<?php endif; ?>
							
							<?php echo form_open('compte/connecter'); ?>
								<div class="top-margin">
									<label>Username <span class="text-danger">*</span></label>
									<input type="text" name="pseudo" class="form-control">
								</div>
								<div class="top-margin">
									<label>Password <span class="text-danger">*</span></label>
									<input type="password" name="mdp" class="form-control">
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<b><a href="">Forgot password?</a></b>
									</div>
									<div class="col-lg-4 text-right">
										<button class="btn btn-action" type="submit">Sign in</button>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				
			</article>
			<!-- /Article -->

		</div>
	</div>	<!-- /container -->
	
