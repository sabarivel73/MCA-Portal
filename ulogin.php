<?php
    session_start();
    include"database.php";
?>
<!DOCTYPE HTML>
<html>
      <head>
            <title>MCA Portal </title>
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
                                $sql="SELECT * FROM user where UNAME='{$_POST["name"]}' and UPASS='{$_POST["pass"]}'";
                                $res=$db->query($sql);
                                if($res->num_rows>0)
                                {
                                    $row=$res->fetch_assoc();
                                    $_SESSION["ID"]=$row["UID"];
                                    $_SESSION["NAME"]=$row["UNAME"];
                                    header("location:uhome.php");
                                }
                                else
                                {
                                    echo "<p class='error'>Invalid User Details</p>";
                                }
                            }
                        ?>
                        <form action="ulogin.php" method="post">
                            <h3 class="heading">User Login Here</h3>
                            <label>User Name</label>
                            <input type="text" name="name" required>
                            <label>Password</label>
                            <input type="Password" name="pass" required>
                            <button type="submit" name="submit">Login</button>
                            <a href="index.php">Home</a>
                            <a href="fp.php">forget password?</a>
                            <a href="new.php">Didn't have account!</a>
                            <a href="ulogin.php">Refresh</a>
                        </form>
                    </div>
                    <div class="footer">
                       <p>Copyright &copy; MCA Portal 2024</p>
                    </div>
            </div>
      </body>
</html>