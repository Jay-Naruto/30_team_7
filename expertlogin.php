<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/s.css"/>
    <style>
        body{ font: 14px sans-serif;
        margin:auto; 
        margin-top: 120px;
        width:500px; 
        background-color: rgb(172,203,225);
        color: black;
        
        
        }
        .wrapper{  border-style: solid;
        border-color: blue;
        border-radius: 30px;
        padding: 20px;  background-color: white;}
    </style>
  </head>
  
<body>
   <!--Header-->
   <header id="header" class="transparent-nav" style="position: fixed;background-color: rgb(124,152,179); top: 0;">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a class="logo" href="main.php" style="padding-bottom: 10px;">Career Space</a>
					</div>
					<!-- /Logo -->

				</div>
			</div>
		</header>
        
		<!-- /Header -->

  <h1 id="mfa"></h1>


</header>

<p>
      <h2 align=center> Login Page </h2>
</p>

    <br>

    <div class="wrapper" align=center>
        <form action="expertauth.php" method="POST">
            <table cellpadding=5>
                <tr> <td> <b>Username :</b>
              <td><input class="contact-form-text" type="text" name="linkedinid" > 
              <tr><td>
            <tr> <td> <b>Password :</b>
              <td><input  class="contact-form-text" type="password" name="password" >
                <tr><td>
            <tr><td colspan=2 align=center>

            <!-- <input class="contact-form-btn" type=submit name="Login"> -->
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </table>
            <input type="hidden" name=s value=1>
            <p style="font-size: 16px;">Don't have an account? <a href="expertregister.php" style="color:blue;">Sign up now</a>.</p>
            <!-- <p style="font-size: 16px;">Forgot Password? <a href=".php" style="color:blue;">click here</a>.</p> -->

        </form> 
    </div>

</body>
</html>