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
<header>
  <h1 id="mfa">Expert Login</h1>


</header>

<p>
      <h2 align=center> Login Page </h2>
</p>

    <br>

    <div class="panel" align=center>
        <form action="expertauth.php" method="POST">
            <table cellpadding=5>
                <tr> <td> LinkedinID :
              <td><input class="contact-form-text" type="text" name="linkedinid" > 
            <tr> <td> Password :
              <td><input  class="contact-form-text" type="password" name="password" >
                <tr><td>
            <tr><td colspan=2 align=center>

            <input class="contact-form-btn" type=submit name="Login">
        </table>
            <input type="hidden" name=s value=1>
        </form> 
        <a href="expertregister.php">
          Want to sign up?
        </a>
    </div>

</body>
</html>