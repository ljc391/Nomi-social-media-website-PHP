
<!DOCTYPE html>
<html>
<head>
    <title>Nomi in the House~</title> 
    <?php include('_headCommon.php');?>
</head> 
<body>

<a href="#doSomething">DO</a>
    
    <?php include('_scripts.php');?>

    <script type="text/javascript">
        
        $(function(){
           
           $('a[href="#doSomething"]').on('click', function(e){
           	console.log('here')
           	e.preventDefault();
           	$.ajax({
           		url:'./api/2/User/123',
           		method:'DELETE',
           		data:{

           		},
           		dataType:'json',
           		success:function(data){
           			alert(JSON.stringify(data));
           		},
           		error:function(){

           		}
           	})
           });
 

        });
     </script>
 
</body>
</html>