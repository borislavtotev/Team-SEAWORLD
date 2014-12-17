<?php 
include_once( 'views/partials/header.php'); 
include_once( 'system/send-email.php' ); 
?>
<!--About us info-->
    <div class="container">
        <header class="row">
            <div class="col-md-12">
                <div class="jumbotron animated fadeInDownBig">
                    <hgroup>
                        <h1 class="text-center">Programators! About us</h1>
                        <h2 class="text-center">Weird programmers. One place.</h2>
                        <h4 class="text-center">
                            <div>
                                The best place for all the programmers to share what they find funny and interesting to others.
                            </div>
                                <ul id="about-info">
                                    <li>Upload/Rate/Comment photos</li>
                                    <li>Make your own albums with photos</li>
                                    <li>Be weird - have real Programator fun!</li>
                                </ul>
                        </h4>
                        <img src="img/about-us-guy.jpg" alt="" id="baner" class="img-responsive" alt="Responsive image"/>
                        <div id="about-info">Project created by team Seaworld.</div>
                    </hgroup>
                    <div class="formContainer">
						<div class="row">
						  <form role="form" method="post" >
						    <div class="col-lg-6 innerContactForm">			      
						      <div class="form-group">
						        <label for="InputName">Your Name</label>
						        <div class="input-group">
						          <input type="text" class="form-control" name="InputName" id="InputName" placeholder="Enter Name" required>
						          <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
						      </div>
						      <div class="form-group">
						        <label for="InputEmail">Your Email</label>
						        <div class="input-group">
						          <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="Enter Email" required  >
						          <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
						      </div>
						      <div class="form-group">
						        <label for="InputMessage">Message</label>
						        <div class="input-group">
						          <textarea name="InputMessage" id="InputMessage" class="form-control" rows="5" required></textarea>
						          <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
						      </div>
						      <div class="form-group">
						        <label for="InputReal">What is 4+3? (Simple Spam Checker)</label>
						        <div class="input-group">
						          <input type="text" class="form-control" name="InputReal" id="InputReal" required>
						          <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
						      </div>
						      <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
						    </div>
						  </form>
						  <hr class="featurette-divider hidden-lg">			  
					</div>
                </div>
        </header>
        

    </div>
<?php include_once( 'views/partials/footer.php' );