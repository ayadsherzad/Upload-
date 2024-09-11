<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login dashborad</title>
    <meta name="language" content="English">    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>
  <body>
<style>
*{color:#fff;}
body {background:#111;}
.form { 

padding-top:40px;
width:95%;
height:300px;
background:#222;
display:flex;
margin-top:50px;
border:#fff solid 2px;
border-radius : 20px;
}
input {


direction: ltr;
outline:none;
color:#fff;
height:50px;
width:90%;
border:#999 solid 1px;
background:#222;
border-radius:10px;
margin:10px;
}

button[type="submit"] {

background:#302E35;
outline:none;
color:#fff;
height:50px;
width:90%;
border:#999 solid 1px;
background:#222;
border-radius:10px;
margin:10px;
}


</style>
<center>
 <form  id="login-form"> <input  placeholder="user" name="user" size="30" type="text" value="" /> <input  placeholder="password"  name="pass" size="30" type="password" value="" />           <button type="submit" name="submit">LOGIN</button>
</form>
 
    <div id="response-message"></div>

 <script>
  // JavaScript code for handling the form submission via AJAX
  $(document).ready(function() {
    // Attach a submit event handler to the form
    $('#login-form').submit(function(event) {
      // Prevent the form from submitting in the traditional way
      event.preventDefault();

      // Serialize the form data
      var formData = $(this).serialize();

      // Send an AJAX POST request
      $.ajax({
        url: 'checklogin.php', // Specify the PHP script that will receive the form data
        type: 'POST', // Use the POST method
        data: formData, // Pass the serialized form data
        success: function(response) {
        var data = JSON.parse(response);
  
  if (data.success) {
    // Redirect to the specified URL
    window.location.href = data.redirect;
  } else {
    // Handle unsuccessful login
    $('#response-message').text(data.message);
  }
        },
        error: function(xhr, status, error) {
          // Handle errors
          console.log(error);
          // Add your own code to handle errors
          $('#response-message').text('An error occurred. Please try again later.');
        }
      });
    });
    
    
  });
</script>
</body>
</html>