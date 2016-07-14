<?php
  //include("loginfile.php");
session_start();
if (isset($_SESSION['u_id'])) header("Location: index.php") ;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nomi in the House~</title>
	<?php include('_headCommon.php');?>
	<style type="text/css">
	.forsignup{
		display: none;
	}
	</style>

</head>
<body>
	<div class="container-fluid Homepic"  align="center">

		<h1>Nomi in the House</h1>
		<div class = "createform">
			    <input type="text" class="form-control" name="userid" id = "userid"placeholder="ID">
			    <span class="error"><?php echo $useridErr;?></span>

			    <input type="password" class="form-control" name="pwd"id = "pwd" placeholder="Password">
			    <span class="error"><?php echo $pwdErr;?></span>

			    <input type="password" class="form-control forsignup" name="vrf" id = "vrf" placeholder="Verify password">
			    <span class="error forsignup"><?php echo $vrfErr;?></span>

			    <input type="text" class="form-control forsignup" name="usern" id="usern" placeholder="Name">
			    <span class="error forsignup"><?php echo $usernErr;?></span>

			    <input type="email" class="form-control forsignup" name="email" id="email"placeholder="Email">
			    <span class="error forsignup"><?php echo $emailErr;?></span>

				<button type="submit" class="btn btn-warning forsignin" id = "signin">Sign In</button>
				<button type="submit" class="btn btn-warning forsignup" id = "signup">Sign Up</button>

				<div class="row">
					<div class="col-sm-6" text-align="center">
						<a href="#guest" role="button">Visit as a guest</a>
					</div>
					<div class="col-sm-6" text-align="center">
						<a href="#createAccount" class="forsignin" role="button">Create account</a>
						<a href="#signIn" class="forsignup" role="button">Already have account</a>
					</div>
				</div>
			<!--/form-->

		</div>


	</div>

	<?php include('_footer.php');?>
	<?php include('_scripts.php');?>

	<script type="text/javascript">
	$(function(){


		//home pic size
		var $w = $( document ).width();
		var $r = $w/1275;
		var $h = $r*700;
		var $h2 = $( document ).height()-30;
		$('.Homepic').css({height:$h2+'px'});


	});

	</script>

</body>
</html>