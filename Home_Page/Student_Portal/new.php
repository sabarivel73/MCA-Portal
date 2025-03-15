<?php
 include"database.php";
?>
<!DOCTYPE HTML>
<html>
    <head>
      <title>MCA Portal</title>
      <style>
        *
        {
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'poppins',sans-serif;
            cursor:pointer;
        }
      </style>
    </head>
    <body>
        <div class="container">
                <div class="center">
                    <?php
                       if(isset($_POST["submit"]))
                       {
                            $sql="insert into user (UNAME,UPASS,MAIL,STATE) values ('{$_POST["name"]}','{$_POST["pass"]}','{$_POST["mail"]}','{$_POST["state"]}')";
                            $db->query($sql);
                            echo"<p class='success'> Successfully Registered</p>";
                       }   
                    ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" >
                        <h3 class="heading">New User</h3>
                        <label>Name : </label>
                        <input type="text" name="name" required>
                        <label>Password : </label>
                        <input type="password" name="pass" required>
                        <label>Email : </label>
                        <input type="email" name="mail" required>
                        <label>State : </label>
                        <select name="state" required>
                            <option vaalue="">Select</option>
                            <option vaalue="1">Tamil Nadu</option>
                            <option vaalue="2">Mumbai</option>
                            <option vaalue="3">Kerala</option>
                            <option vaalue="4">Karnataka</option>
                            <option vaalue="5">Andhra Pradesh</option>
                            <option vaalue="Others">Others</option>
                        </select>
                        <button type="submit" name="submit">Register</button>
                        <a href="ulogin.php">Login Now</a>
                        <a href="new.php">Refresh</a>
                        <a href="../index.php">Home</a>
                    </form>
                </div>        
                <div class="footer">
                   <p>Copyright &copy; MCA Portal 2025</p>
                </div>
        </div>
    </body>
</html>