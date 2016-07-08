$(function(){  

 	
    	$('a[href="#createAccount"]').on('click', function(e){
    		e.preventDefault();
    		$('.forsignup').show().prop('disabled', false);
    		$('.forsignin').hide();
    	})

    	$('a[href="#signIn"]').on('click', function(e){
    		e.preventDefault();
    		$('.forsignup').hide();
    		$('.forsignin').show().prop('disabled', false);;
    	})

    	$('a[href="#guest"]').on('click', function(e){
    		e.preventDefault();
    		$('.forsignup').hide();
    		$('.forsignin').hide();
    		var guest = 'guest'.split('');
    		var guestPassword = 'guest'.split('');

    		console.log(guest);
    		$('#userid').val('');
    		$('#pwd').val('');
    		
    		var first = true;
    		function aPwd(){
    			if (guestPassword.length==2 && first){
    				$('#pwd').val('');
    				guestPassword = 'guest'.split('');
    				first=false;
    			}
    			if (guestPassword.length>0){
	    			var c = guestPassword.shift();
	    			var current = $('#pwd').val();
	    			$('#pwd').val(current+c);
	    			setTimeout(aPwd,200);
	    		}else{
	    			setTimeout(function(){
	    				attemptSignIn();
	    			},1000)
	    		}
    		}

    		function aUser(){
    			if (guest.length>0){
	    			var c = guest.shift();
	    			var current = $('#userid').val();
	    			$('#userid').val(current+c);
	    			setTimeout(aUser,200);
	    		}else{
	    			setTimeout(aPwd,1000)
	    		}
    		}
    		aUser();
    	})

		$('#signin').on('click', function(e){
    		e.preventDefault();
    		attemptSignIn();
    	})

		function attemptSignIn(){
			$.ajax({
				url:'./postapi.php',
				method:'POST',
				data:{
					action:'signin',
					userid:$('#userid').val(),
					pwd:$('#pwd').val()
				},
				dataType:'json',
				success: function(response){
					if (response.success){
						//alert(JSON.stringify(response.data));
						location.reload();
						//$('h1').html(response.data.email);
					}else{
						alert(response.message)
					}
				},
				error: function(){

				}

			});
		}

		$('#signup').on('click', function(e){
    		e.preventDefault();
    		attemptSignUp();
    	})

		function attemptSignUp(){
			$.ajax({
				url:'./postapi.php',
				method:'POST',
				data:{
					action:'signup',
					userid:$('#userid').val(),
					pwd:$('#pwd').val(),
					vrf:$('#vrf').val(),
					usern:$('#usern').val(),
					email:$('#email').val()
				},
				dataType:'json',
				success: function(response){
					if (response.success){
						//alert(JSON.stringify(response.data));
						location.reload();
						//$('h1').html(response.data.email);
					}else{
						alert(response.message)
					}
				},
				error: function(){

				}

			});
		}

    



  }); 