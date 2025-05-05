<?php
    session_start();
    include"database.php";
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
                    $v1=mysqli_real_escape_string($db,$_POST["mes"]);
                    $sql="INSERT INTO comment(UID, COMM, LOGS) VALUES ({$_SESSION["ID"]},'$v1',now())";
                    $db->query($sql);
                    echo "<p class='success'>Comment Sent Successfully</p>";
                }  
            ?>
            <form action="<?php echo $_SERVER["REQUEST_URI"];?>"method="post">
                <h3 class="heading">Send Suggestion</h3>
                <label>Your Suggestion : </label>
                <input name="mes" requried></input>
                <button type="submit" name="submit">Post</button>
                <a href="comment.php">Refresh</a>
                <a href="suggestion.php">Back</a>
            </form>
          </div>
          <div class="footer">
             <p>Copyright &copy; MCA Portal 2025</p>
          </div>
        </div>
    </body>
</html>