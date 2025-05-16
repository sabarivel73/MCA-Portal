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
                    $target_dir = "OD_File/";
                    $target_dir2 = "../Staff_Portal/OD_File/";
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
                    $staff_id = intval($_POST["sname"]);
                    $period_date = $db->real_escape_string($_POST["pdate"]);
                    $period = $db->real_escape_string($_POST["pnum"]);
                    $message = $db->real_escape_string($_POST["mname"]);
                    $u_name = $_SESSION["NAME"];
                    $sql="INSERT INTO od(SID, UNAME, PERIOD_DATE, PERIOD, MESSAGE, FILE) VALUES ('$staff_id','$u_name','$period_date','$period','$message','$target_file')";
                    if($db->query($sql))
                    {
                        echo"<p class='success'>OD Applyed</p>";
                    }
                    else 
                    {
                        echo"<p class='error'>Error in Apply</p>";
                    }
                }   
            ?>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
                <h3>On Duty Apply</h3>
                <label>Select Staff :</label>
                <select name="sname" required>
                    <option value="">Select Staff</option>
                    <?php
                        $sq = "select SID,SNAME from staff";
                        $sr = $db->query($sq);
                        if($sr->num_rows > 0)
                        {
                            while($row = $sr->fetch_assoc())
                            {
                                echo"<option value='{$row['SID']}'>{$row['SNAME']}</option>";
                            }
                        }
                    ?>
                </select>
                <label>Period Date :</label>
                <input type="date" name="pdate" required>
                <label>Which period :</label>
                <input type="text" name="pnum" required>
                <label>Message :</label>
                <input type="text" name="mname" required>
                <label>Any Proof :</label>
                <input type="file" name="efile">
                <button type="submit" name="submit">Apply OD</button>
                <a href="odapply.php">Refresh</a>
                <a href='mhome.php'>Back</a>
            </form>      
          </div>
        </div>
        <div class="footer">
            <p>Copyright &copy; MCA Portal 2025</p>
        </div>
    </body>
</html>