<?php
$conn=new mysqli("localhost","root","", "my_db");
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
else
  {
    
    $sql = "select * from expert ";
    $r   = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($r))
      {
        $dbuname    = $row["linkedinid"];
        $dbpassword = $row["password"];
      }
    mysqli_close($conn);
  }
?>




<?php
if (isset($_POST['s']))
  {
    $linkedinid = $_POST["linkedinid"];
    $password = $_POST["password"];
    $success  = 1;
    if ($success == 1)
      {
        // echo "<form action='success.php'>";
        if ($linkedinid == $dbuname && $password == $dbpassword)
          {
            echo "Success in login";
            echo "<form id='auth' action='experthome.php' method='POST' >
    <input type='hidden' name='logincheck' value=1>
    <input type=hidden name='username' value='$username'>

</form>

<script>
document.getElementById('auth').submit();
</script>

";
          }
       /* else
          {
            
            // echo "<input type='hidden' name=logincheck value=0>"; 
            // echo " <input type='submit'>";
            // echo "<h1>login failed</h1>";}
            // echo "</form>";
           
            
            echo "<script> location.href='adminlogin.php';</script>";
          }
          */
      }
  }
?>