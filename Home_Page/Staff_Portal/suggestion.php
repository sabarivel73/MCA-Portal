<?php
    session_start();
    include"database.php";
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
            <h1>View Students Suggestions</h1>
            <nav>
                <ul>
                    <button><a href="smhome.php">Home</a></button>
                </ul>
            </nav>
        </div>
          <div class="main">
           <div class="content">
            <?php
                $sql="SELECT user.UNAME,comment.COMM,comment.LOGS,comment.CID FROM comment INNER JOIN user on comment.UID=user.UID ORDER BY comment.CID DESC";
                $res=$db->query($sql);
                if($res->num_rows>0)
                {
                    while($row=$res->fetch_assoc())
                    {
                        $cid = $row["CID"];
                        $lsql = "SELECT COUNT(*) as lc FROM `like` WHERE CID = $cid";
                        $lr = $db->query($lsql);
                        $lrow = $lr->fetch_assoc();
                        $lc = $lrow['lc'];
                        echo"<p>
                                <strong>{$row["UNAME"]} :</strong>
                                <ui>{$row["COMM"]}</ui>
                                <i>{$row["LOGS"]}</i>
                                <button>Like-{$lc}</button>
                              </form>
                        </p>";
                    }
                }
                else
                {
                    echo"<p class='error'>No Comment Yet...</p>";
                }
            ?>
          </div>
         </div>
          <div class="footer">
              <p>Copyright &copy; MCA Portal 2025</p>
          </div>
    </body>
</html>