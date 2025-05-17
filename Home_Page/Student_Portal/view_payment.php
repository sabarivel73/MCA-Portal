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
                $sql="SELECT staff.SNAME,pannouncement.TITLE,pannouncement.AMOUNT,pannouncement.MESSAGE,pannouncement.DATE,pannouncement.DUE_DATE FROM pannouncement INNER JOIN staff on pannouncement.SID=staff.SID ORDER BY pannouncement.DUE_DATE";
                $res=$db->query($sql);
                if($res->num_rows>0)
                {
                    while($row=$res->fetch_assoc())
                    {
                        echo"<br>";
                        echo"<p><b>Payment Title : </b>{$row["TITLE"]}
                        <br>
                        <b>Amount : </b>{$row["AMOUNT"]}
                        <br>
                        <b>Payment Post by : </b>{$row["SNAME"]}
                        <br>
                        <b>Payment Post Date : </b>{$row["DATE"]}
                        <br>
                        <b>Payment Due Date : </b>{$row["DUE_DATE"]}
                        <br>
                        <b>Payment Description : </b>{$row["MESSAGE"]}
                        <br>
                        <b><button type='submit'>Pay</button></b>
                        </p>";
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