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
                    $sql="INSERT INTO pannouncement(SID,TITLE,MESSAGE,AMOUNT,DATE,DUE_DATE) VALUES ({$_SESSION["ID"]},'{$_POST["tname"]}','{$_POST["mname"]}','{$_POST["amount"]}',now(),'{$_POST["addate"]}')";
                    if($db->query($sql))
                    {
                        echo"<p class='success'>Payment Posted</p>";
                    }
                    else 
                    {
                        echo"<p class='error'>Error in Post</p>";
                    }
                }   
            ?>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
                <h3>Payment Announcement for Students</h3>
                <label>Payment Title :</label>
                <input type="text" name="tname" required>
                <label>Message :</label>
                <input type="text" name="mname" required>
                <label>Amount :</label>
                <input type="number" name="amount" required>
                <label>Due Date :</label>
                <input type="date" name="addate" required>
                <button type="submit" name="submit">Post Payment</button>
                <a href="payment_announcement.php">Refresh</a>
                <a href='smhome.php'>Back</a>
            </form>      
          </div>
        </div>
        <div class="container">
            <h3>View Payments</h3>
            <a class="a1" href='smhome.php'>Back</a>
        </div>
        <div class="main">
            <div class="content">
                <?php
                    $sql="SELECT * FROM pannouncement WHERE SID={$_SESSION["ID"]}";
                    $res=$db->query($sql);
                    if($res->num_rows>0)
                    {
                       echo"<table>
                       <tr>
                       <th>SNO</th>
                       <th>PAYMENT TITLE</th>
                       <th>MESSAGE</th>
                       <th>AMOUNT</th>
                       <th>DATE POSTED</th>
                       <th>DUE DATE</th>
                       <th>DELETE</th>
                       </tr>
                    ";
                    $i=0;
                    while($row=$res->fetch_assoc())
                    {
                       $i++;
                       echo"<tr>";
                       echo"<td>{$i}</td>";
                       echo"<td>{$row["TITLE"]}</td>";
                       echo"<td>{$row["MESSAGE"]}</td>";
                       echo"<td>{$row["AMOUNT"]}</td>";
                       echo"<td>{$row["DATE"]}</td>";
                       echo"<td>{$row["DUE_DATE"]}</td>";
                       echo"<td><a href='delete3.php?id={$row["PID"]}'>Delete</a></td>";
                       echo"</tr>";
                    }
                    echo"</table>";
                    }
                    else
                    {
                        echo"<p class='error'>No Documents Found</p>";
                    }
                ?>
            </div>
        </div>
        <div class="footer">
            <p>Copyright &copy; MCA Portal 2025</p>
        </div>
    </body>
</html>