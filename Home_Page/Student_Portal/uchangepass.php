<?php
    session_start();
    include"database.php";
    function countRecord($sql,$db)
    {
        $res=$db->query($sql);
        return $res->num_rows;
    }
    if(!isset($_SESSION["ID"]))
    {
	    header("location:ulogin.php");
    }
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
                        $sql="SELECT * from user WHERE UPASS='{$_POST["opass"]}' and UID='{$_SESSION["ID"]}'";
                        $res=$db->query($sql);
                        if($res->num_rows>0)
                        {
                            $s="update user set UPASS='{$_POST["npass"]}' WHERE UID=".$_SESSION["ID"];
                            $db->query($s);
                            echo"<p class='success'>Password Changed Successfully</p>";
                        }
                        else
                        {
                            echo"<p class='error'>Invalid Password</p>";
                        }
                    }   
                ?>
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                    <h3 class="heading">Change Password</h3>
                    <label>Old Password : </label>
                    <input type="password" name="opass" required>
                    <label>New Password : </label>
                    <input type="password" name="npass" required>
                    <button type="submit" name="submit">Update</button>
                    <a href="fp.php">forget password?</a>
                    <a href="uhome.php">Home</a>
                    <a href="uchangepass.php">Refresh</a>
                </form>
            </div>        
            <div class="footer">
                <p>Copyright &copy; MCA Portal 2025</p>
            </div>
        </div>
    </body>
</html>