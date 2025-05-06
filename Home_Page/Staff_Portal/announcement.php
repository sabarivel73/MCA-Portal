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
	    header("location:slogin.php");
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
                    $target_dir = "Announcement/";
                    $target_dir2 = "../Student_Portal/Announcement/";
                    $fbv = false;
                    $target_file = "";
                    $target_file2 = "";
                    if(!empty($_FILES["efile"]["name"]))
                    {
                        $target_file = $target_dir.basename($_FILES["efile"]["name"]);
                        $target_file2 = $target_dir2.basename($_FILES["efile"]["name"]);
                        if(move_uploaded_file($_FILES["efile"]["tmp_name"],$target_file))
                        {
                            if(copy($target_file,$target_file2))
                            {
                                $fbv = true;
                            }
                            else
                            {
                                echo"<p>Error in Copying File</p>";
                            }
                        }
                        else
                        {
                            echo"<p>Error in File Upload</p>";
                        }
                    }
                    $sql="INSERT INTO announcement(MESSAGE, FILE, LOGS, SID) VALUES ('{$_POST["mname"]}','{$target_file}',now(),{$_SESSION["ID"]})";
                    if($db->query($sql))
                    {
                        echo"<p class='success'>Announcement Posted</p>";
                    }
                    else 
                    {
                        echo"<p class='error'>Error in Post</p>";
                    }
                }   
            ?>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
                <h3>Announcement for Students</h3>
                <label>Message :</label>
                <input type="text" name="mname" required>
                <label>Upload File</label>
                <input type="file" name="efile">
                <button type="submit" name="submit">Post Announcement</button>
                <a href="announcement.php">Refresh</a>
                <a href='smhome.php'>Back</a>
            </form>      
          </div>
        </div>
        <div class="footer">
            <p>Copyright &copy; MCA Portal 2025</p>
        </div>
    </body>
</html>