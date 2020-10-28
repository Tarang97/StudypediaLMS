// JavaScript Validation For Registration Page

$('document').ready(function()
{
		 
		 // valid email pattern
		 var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		 
		 $.validator.addMethod("validemail", function( value, element ) {
		     return this.optional( element ) || eregex.test( value );
		 });

		 
		 $("#register-form").validate({
					
		  rules:
		  {
				first_name: {
					required: true,
					minlength: 3,
					maxlength: 20
				},
				last_name: {
					required: true,
					minlength: 3,
					maxlength: 20
				},
				username: {
					required: true,
					minlength: 3,
					maxlength: 20
				},
				email: {
					required: true,
					validemail: true
				},
				password: {
					required: true,
					minlength: 8,
					maxlength: 15
				},
				confirm_password: {
					required: true,
					equalTo: '#password'
				},
		   },
		   messages:
		   {
				first_name:{
					required: "Please Enter First Name",
					minlength: "First Name at least have 3 characters"
					},
				last_name:{
					required: "Please Enter Last Name",
					minlength: "Last Name at least have 3 characters"
					},
				username:{
					required: "Please Enter User Name",
					minlength: "User Name at least have 3 characters"
					},
			    email: {
					  required: "Please Enter Email Address",
					  validemail: "Enter Valid Email Address"
					   },
				password:{
					required: "Please Enter Password",
					minlength: "Password at least have 8 characters"
					},
				confirm_password:{
					required: "Please Retype your Password",
					equalTo: "Password Did not Match !"
					}
		   },
		   errorPlacement : function(error, element) {
			  $(element).closest('.form-group').find('.help-block').html(error.html());
		   },
		   highlight : function(element) {
			  $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		   },
		   unhighlight: function(element, errorClass, validClass) {
			  $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			  $(element).closest('.form-group').find('.help-block').html('');
		   },
		   
		   		/*submitHandler: function(form){
					
					alert('submitted');
					form.submit();
					//var url = $('#register-form').attr('action');
					//location.href=url;
					
				}*/
				
				submitHandler: function() 
							   { 
							   console.log("Hi");
							   var name = $(this).val(); 
  
								if(name.length > 2)
								{  
								$("#result").html('checking...');
   
								/*$.post("username-check.php", $("#reg-form").serialize())
								.done(function(data){
								$("#result").html(data);
								});*/
   
								$.ajax({
    
								type : 'POST',
								url  : 'username-check.php',
								data : $(this).serialize(),
								success : function(data)
								{
								$("#result").html(data);
								}
								});
    return false;
   
  }
  else
  {
   $("#result").html('');
  }
 }
				//			   		alert("Submitted!");
									//$("#register-form").resetForm(); 
							  // }
		   
		   }); 
		   
		   
		   /*function submitForm(){
			 
			   
			   /*$('#message').slideDown(200, function(){
				   
				   $('#message').delay(3000).slideUp(100);
				   $("#register-form")[0].reset();
				   $(element).closest('.form-group').find("error").removeClass("has-success");
				    
			   });
			   
			   alert('form submitted...');
			   $("#register-form").resetForm();
			      
		   }*/
});