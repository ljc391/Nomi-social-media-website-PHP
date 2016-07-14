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


    <nav class="navbar navbar-fixed-top">
            <div class="nav navbar-nav navbar-left nomiimg">
                <img src="image/nomi_icon.png" width = "50px">
                <a href="index.php">NOMI</a>
            </div>



                <form class="navbar-form navbar-right nomisear " role="search">
                  <div class=" form-group">
                    <input type="text" id = "inputbox" class="form-control" placeholder="Search">
                    <ul class="list-group" id="searchresult" style="z-index:1000; position:absolute;">

                    </ul>
                  </div>
                </form>
                <ul class="nav navbar-nav navbar-right nomibtn">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"   ><img src="image/edit.png" width = "50px"></a>
                  <ul class="dropdown-menu">
                    <li><a  class ="glyphicon glyphicon-log-out" href="#logout"> Logout</a></li>
                    <li><a class = "glyphicon glyphicon-pencil"href="edit.php"> Edit </a></li>
                    <li><a class = "glyphicon glyphicon-envelope"href="message.php" id = "message"> Chat Room </a></li>
                  </ul>
                </li>

            </ul>

        </div>
    </nav>

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