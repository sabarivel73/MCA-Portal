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
            <h1>View Payments</h1>
            <nav>
                <ul>
                    <button><a href="mhome.php">Back</a></button>
                </ul>
            </nav>
        </div>
          <div class="main">
           <div class="content">
            <?php
                $sql="SELECT pannouncement.PID,staff.SNAME,pannouncement.TITLE,pannouncement.AMOUNT,pannouncement.MESSAGE,pannouncement.DATE,pannouncement.DUE_DATE FROM pannouncement INNER JOIN staff on pannouncement.SID=staff.SID ORDER BY pannouncement.PID DESC";
                $res=$db->query($sql);
                if($res->num_rows>0)
                {
                    while($row=$res->fetch_assoc())
                    {
                        $pid = $row['PID'];
                        $title = $row["TITLE"];
                        $amount = $row["AMOUNT"];
                        $d_d = $row["DUE_DATE"];
                        $check = $db->query("SELECT status FROM payment WHERE rp_id='$pid' AND UID='{$_SESSION['ID']}' ORDER BY order_id DESC LIMIT 1");
                        if($check && $check->num_rows>0)
                        {
                            $p_s = strtolower($check->fetch_assoc()['status']);
                        }
                        else
                        {
                            $p_s = 'Not Paid';
                        }
                        $t = date("Y-m-d");
                        $dp = strtotime($d_d) < strtotime($t);
                        echo"<br><p>";
                        echo"<b>Payment Title :</b> $title<br>";
                        echo"<b>Amount :</b> $amount<br>";
                        echo"<b>Posted by :</b> {$row["SNAME"]}<br>";
                        echo"<b>Posted Date :</b> {$row["DATE"]}<br>";
                        echo"<b>Due Date :</b> $d_d<br>";
                        echo"<b>Description :</b> {$row["MESSAGE"]}<br>";
                        echo"<b>Payment Status :</b> " . ucfirst($p_s) . "<br>";
                        if($p_s !== 'success' && $p_s !== 'credited')
                        {
                            if(!$dp)
                            {
                                echo"<form action='pay.php' method='POST'>
                                    <input type='hidden' name='amount' value='" . ($amount * 100) . "'>
                                    <input type='hidden' name='title' value='" . htmlspecialchars($title, ENT_QUOTES) . "'>
                                    <input type='hidden' name='pid' value='$pid'>
                                    <button type='submit'>Pay</button>
                                </form>";
                            }
                            else
                            {
                                echo"<b>Due Date Passed</b><br>";
                            }
                        }
                        else
                        {
                            echo"<b>Payment Already Credited</b>";
                        }
                        echo"</p>";
                    }
                }
                else
                {
                    echo"<p class='error'>No Payment Pending...</p>";
                }
            ?>
          </div>
         </div>
          <div class="footer">
              <p>Copyright &copy; MCA Portal 2025</p>
          </div>
    </body>
</html>