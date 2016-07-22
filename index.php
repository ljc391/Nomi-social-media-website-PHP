<?php
    include("mysql_connect.php");
    session_start();
    if (!isset($_SESSION['u_id'])) header("Location: login.php") ;

    $u_id = $_SESSION['u_id'];
    $u_name = $_SESSION['u_name'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Nomi in the House~</title>
    <?php include('_headCommon.php');?>

</head>
<body>



    <?php include('_navbar.php');?>

    <div class = "container content" align = "center">

		<?php
		if ($_SESSION['u_id']=='ljc391'){
		?>
        <div class = "postform" align = "center">
                <input id = "title"type="text" class="form-control"  name = "title" placeholder="Title">
                <span class="error"><?php echo $titleErr;?></span>
                <textarea class="form-control" id = "content" name = "text" rows="3" placeholder="Content"></textarea>
                <div align = "center">
                <input type="file" id = "inputbox" name ="image">
                <button type="submit" class="btn btn-warning" name = "postform" id = "postform" value = "pf" align = "right">Post</button>
                </div>

        </div>
        <?php
    	}else{
      echo "</br></br>";

      }
        ?>


        <?php
            include("showdetail.php");
        ?>




       <?php include('_postCommentModal.php');?>



    </div>




   	<?php include('_footer.php');?>
   	<?php include('_scripts.php');?>

    <script type="text/javascript">

        $(function(){




        });
     </script>

</body>
</html>