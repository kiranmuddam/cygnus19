/*
Author: Pradeep Khodke
URL: http://www.codingcage.com/
*/

$('document').ready(function()
{ 
     /* validation */
	 $("#login-form").validate({
      rules:
	  {
			password: {
			required: true,
			},
			user_idno: {
            required: true
            },
	   },
       messages:
	   {
            password:{
                      required: "Enter your Password"
                     },
            user_idno: "Enter Username",
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#login-form").serialize();
				
			$.ajax({
				
			type : 'POST',
			url  : 'login_process.php',
			data : data,
			beforeSend: function()
			{					
				$("#btn-login").html(' Sending ...');
			},
			success :  function(output)
			   {									   	
					if(output=="3"){									
						$("#btn-login").html('Signing In ...');
						$.toast({
            heading: 'Login Success',
            text: 'Succesfully Login.',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3500

        });
						setTimeout(' window.location.href = "index.php"; ',2000);						
					}else if(output=="1"){					
						$.toast({
            heading: 'Account Inactive',
            text: 'Your Account is in Inactive State.Please Contact Admin',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'warning',
            hideAfter: 3500

        });
						$("#btn-login").html('Login');
					}else if(output=="2"){
						$.toast({
            heading: 'Account Blocked',
            text: 'Your Account Blocked by Admin.Please Contact Admin',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500
			});
						$("#btn-login").html('Login');
					}else if(output=="4"){
							$.toast({
            heading: 'Invalid Credintials',
            text: 'Please Check Username and Password.',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });
						$("#btn-login").html('Login');
					}else if(output=="5"){
							$.toast({
            heading: 'Account Not Exists',
            text: 'Account is not found in database.',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });
						$("#btn-login").html('Login');
					}else{						
							$.toast({
            heading: 'Server Error',
            text: 'Some Error Occured in Backend.',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });
						$("#btn-login").html('Login');

					}
			  }
			});
				return false;
		}
	   /* login submit */
});
