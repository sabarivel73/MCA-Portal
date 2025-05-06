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
            <h1>View Announcements</h1>
            <nav>
                <ul>
                    <button><a href="mhome.php">Back</a></button>
                </ul>
            </nav>
        </div>
          <div class="main">
           <div class="content">
            <?php
                $sql="SELECT staff.SNAME,announcement.MESSAGE,announcement.FILE,announcement.LOGS FROM announcement INNER JOIN staff on announcement.SID=staff.SID ORDER BY announcement.AID DESC";
                $res=$db->query($sql);
                if($res->num_rows>0)
                {
                    while($row=$res->fetch_assoc())
                    {
                        echo"<br>";
                        echo"<strong>{$row["SNAME"]} [{$row["LOGS"]}]</strong>";
                        echo"<br>";
                        echo"<strong style='margin-left:10px;'>Documents</strong>";
                        if(!empty($row["FILE"]))
                        {
                            echo"<p style='margin-left:25px;'>Click Here to View Document - <button><a href='{$row["FILE"]}' target='_blank'>View</a></button></p>";
                        }
                        else
                        {
                            echo"<p style='margin-left:25px;'>No Document Attached</p>";
                        }
                        echo"<strong style='margin-left:10px;'>Announcement Message</strong>";
                        echo"<p style='margin-left:25px;'>{$row["MESSAGE"]}</p>";
                    }
                }
                else
                {
                    echo"<p class='error'>No Announcements Yet...</p>";
                }
            ?>
          </div>
         </div>
          <div class="footer">
              <p>Copyright &copy; MCA Portal 2025</p>
          </div>
    </body>
</html>