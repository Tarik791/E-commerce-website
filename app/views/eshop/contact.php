<?php $this->view("header", $data); ?>

	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
					<iframe id="gmap" class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d184011.21359289528!2d18.242907937050095!3d43.893637740498185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4758cbb1ed719bd1%3A0x562ecda6de87b33e!2sSarajevo!5e0!3m2!1shr!2sba!4v1633610531072!5m2!1shr!2sba" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>	
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>


						<?php if(is_array($errors) && count($errors)> 0): ?>
						<?php foreach ($errors as $error): ?>
	    				<div class="status alert alert-danger" ><?=$error?></div>
						<?php endforeach; ?>
						<?php endif; ?>
							
						<?php if(isset($_GET['success'])): ?>

						<div class="status alert alert-success" >Message sent successfully</div>

						<?php endif; ?>

						
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" placeholder="Name" value="<?=isset($POST['name']) ? $POST['name']:'' ?>"><!---<p>//$user_data->name</p>-->
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email" value="<?=isset($POST['email']) ? $POST['email']:'' ?>">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject" value="<?=isset($POST['subject']) ? $POST['subject']:'' ?>">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"><?=isset($POST['message']) ? $POST['message']:'' ?></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" class="btn btn-primary pull-right" value="Submit" >
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
							<?=nL2br(Settings::contact_info());?>
				
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a target="_new" href="<?=Settings::facebook_link()?>"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a target="_new" href="<?=Settings::twitter_link()?>"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a target="_new" href="<?=Settings::linkedin_link()?>"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a target="_new" href="<?=Settings::website_link()?>"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
							
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
	
	<?php $this->view("footer", $data); ?>