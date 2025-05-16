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
            <h2>View On Duty Form</h2>
            <a class="a1" href='smhome.php'>Back</a>
        </div>
        <div class="main">
            <div class="content">
                <?php
                    $sql="SELECT * FROM od WHERE SID={$_SESSION["ID"]}";
                    $res=$db->query($sql);
                    if($res->num_rows>0)
                    {
                       echo"<table>
                       <tr>
                       <th>SNO</th>
                       <th>STUDENT NAME</th>
                       <th>PERIOD DATE</th>
                       <th>PERIOD</th>
                       <th>MESSAGE</th>
                       <th>VIEW</th>
                       </tr>
                    ";
                    $i=0;
                    while($row=$res->fetch_assoc())
                    {
                       $i++;
                       echo"<tr>";
                       echo"<td>{$i}</td>";
                       echo"<td>{$row["UNAME"]}</td>";
                       echo"<td>{$row["PERIOD_DATE"]}</td>";
                       echo"<td>{$row["PERIOD"]}</td>";
                       echo"<td>{$row["MESSAGE"]}</td>";
                       if(!empty($row["FILE"]))
                       {
                        echo"<td><button><a href='{$row["FILE"]}' target='_blank'>View</a></button></td>";
                       }
                       else
                       {
                        echo"<td><p>No File</p></td>";
                       }
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