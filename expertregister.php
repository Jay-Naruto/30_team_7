<!DOCTYPE html>
<html lang="en">
<head>
	<title>Expert Login</title>
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
	<center>
		<h1>Expert Login</h1>
		<form action="expertregister.php" method="post">
			
<p>
			<label for="linkedinid">LinkedinID:</label>
			<input type="text" name="linkedinid" id="linkedinid">
			</p>

			
<p>
			<label for="password">Password:</label>
			<input type="password" name="password" id="password">
			</p>

			
<p>
			<label for="confirm_password">Confirm Password:</label>
			<input type="password" name="confirm_password" id="confirm_password">
			</p>

			
<p>
			<label for="domain">Domain:</label>
			<input type="text" name="domain" id="domain">
			</p>

			
<p>
			<label for="designation">Designation:</label>
			<input type="text" name="designation" id="designation">
			</p>
            <p>
			<label for="num">Number:</label>
			<input type="text" name="num" id="num">
			</p>
			<input type="submit" value="Submit">
            <input type=hidden name=s value=1> 
		</form>
        <a href="expertlogin.php">
          Want to sign in?
        </a>
	</center>


    <?php
    if(isset($_POST["s"]))
    {
    
      $linkedinid=$_POST["linkedinid"];
      $password=$_POST["password"];
     // $password=$_POST["password"];
      $domain=$_POST["domain"];
      $designation=$_POST["designation"];
      $num=$_POST["num"];
      $conn1 = new mysqli("localhost", "root","", "my_db");
      if ($conn1->connect_error)
                 die("Connection failed: " . $conn1->connect_error);
             else
                 {
                //    $salted="aszdhs2134fvbmjkoiup".$password."dierbmdswked545ocyyiu";
                //    $hashed=hash('sha512',$salted);
                //    $password2="rahil";
                //    $salted2="aszdhs2134fvbmjkoiup".$password2."dierbmdswked545ocyyiu";
                //    $hashed2=hash('sha512',$salted2);
                   $sql1="insert into expert(linkedinid,password, domain, designation, num) values('".$linkedinid."','".$password."','".$domain."','".$designation."','".$num."')";
                   $r1=mysqli_query($conn1,$sql1);
                   if($r1==1)
                    {
   
           #echo"<table align=center><tr><td colspan=2 align=center><strong>Registeration added successfully</strong>";
           ?>
           <!-- <script>
             window.alert("Registered Successfully");
             window.location.href="login.php";
           </script> -->
           <?php
         }
         else
           echo"<table align=center><tr><td ><strong>Registeration cannot be added</strong>";
                   mysqli_close($conn1);
   
   
   }
}
    ?>
</body>
</html>
