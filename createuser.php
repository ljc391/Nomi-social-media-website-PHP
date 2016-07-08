<?php
  include("createuserfile.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nomi in the House~</title> 
	<link rel="stylesheet" href="main_nomi.css" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Raleway" />
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<link rel="stylesheet"href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head> 
<body>
	<div class="container-fluid Homepic"  align="center">   
		</br></br></br></br>
		<h1>Nomi in the House</h1> 
		<div class = "createform">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-horizontal" role="form"> 
			    <input type="text" class="form-control" name="userid" placeholder="ID">
			    <span class="error"><?php echo $useridErr;?></span>
			    <input type="password" class="form-control" name="pwd" placeholder="Password">
			    <span class="error"><?php echo $pwdErr;?></span>
			    <input type="text" class="form-control" name="usern" placeholder="Name">
			    <span class="error"><?php echo $usernErr;?></span>
			    <input type="email" class="form-control" name="email" placeholder="Email">
			    <span class="error"><?php echo $emailErr;?></span>
			   
				<div class="checkbox">
					<label>
					  <input type="checkbox" > Check me out
					</label>
				</div> 
				<button type="submit" class="btn btn-warning">Sign Up</button> 
					<br/>
				<a class="btn btn-info" href="login.php" role="button">Sign In</a> 
			</form>
			
		</div>

	 
	</div>
 
 
	<div class="container-fluid footer"> 
		<p>&copy; 2016 Nomi. All rights reserved.</p>
	</div>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   

	<script type="text/javascript">
	$(function(){ 

 	
		//home pic size
		var $w = $( document ).width();
		var $r = $w/1275;
		var $h = $r*700;
		$('.Homepic').css({height:$h+'px'});
    			 
	 
    



  });</script>
 
</body>
</html>