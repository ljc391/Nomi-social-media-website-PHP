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

    <?php include('_nav.php');?>



    <div class = "container content" align = "center">





    </div>




    <?php include('_footer.php');?>
    <?php include('_scripts.php');?>

    <script type="text/javascript">

        $(function(){




        });
     </script>

</body>
</html>