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
                                $sql="SELECT * FROM staff where SNAME='{$_POST["name"]}' and SPASS='{$_POST["pass"]}'";
                                $res=$db->query($sql);
                                if($res->num_rows>0)
                                {
                                    $row=$res->fetch_assoc();
                                    $_SESSION["ID"]=$row["SID"];
                                    $_SESSION["NAME"]=$row["SNAME"];
                                    header("location:shome.php");
                                }
                                else
                                {
                                    echo "<p class='error'>Invalid Staff Details</p>";
                                }
                            }
                        ?>
                        <form action="slogin.php" method="post">
                            <h3 class="heading">Staff Login Here</h3>
                            <label>Staff Name</label>
                            <input type="text" name="name" required>
                            <label>Password</label>
                            <input type="Password" name="pass" required>
                            <button type="submit" name="submit">Login</button>
                            <a href="index.php">Home</a>
                            <a href="fp.php">forget password?</a>
                            <a href="new.php">Didn't have account!</a>
                            <a href="slogin.php">Refresh</a>
                        </form>
                    </div>
                    <div class="footer">
                       <p>Copyright &copy; MCA Portal 2024</p>
                    </div>
            </div>
      </body>
</html>