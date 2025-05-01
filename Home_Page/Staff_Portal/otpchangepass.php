<?php
    session_start();
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
                        $csql = "select * from staff WHERE MAIL='{$_POST["email"]}'";
                        $cr = $db->query($csql);
                        if($cr->num_rows>0)
                        {
                            $sql="update staff set SPASS='{$_POST["npass"]}' WHERE MAIL='{$_POST["email"]}'";
                            if($db->query($sql))
                            {
                                echo"<p class='success'>Password Changed Successfully</p>";
                            }
                        }
                        else
                        {
                            echo "<p class='error'>Mail Not Found</p>";
                        }   
                    }   
                ?>
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                    <h3 class="heading">Change Password</h3>
                    <label>Enter Your Email : </label>
                    <input type="email" name="email" required>
                    <label>New Password : </label>
                    <input type="password" name="npass" required>
                    <button type="submit" name="submit">Update</button>
                    <a href="shome.php">Home</a>
                </form>
            </div>        
            <div class="footer">
                <p>Copyright &copy; MCA Portal 2025</p>
            </div>
        </div>
    </body>
</html>