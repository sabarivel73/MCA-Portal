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
            <h1>View Documents</h1>
            <a href="search_books.php">Search Documents</a>
            <a class="a1" href='shome.php'>Home</a>
        </div>
        <div class="main">
            <div class="content">
                <?php
                    $sql="SELECT * FROM sdocuments WHERE SID={$_SESSION["ID"]}";
                    $res=$db->query($sql);
                    if($res->num_rows>0)
                    {
                       echo"<table>
                       <tr>
                       <th>SNO</th>
                       <th>TITLE</th>
                       <th>KEYWORDS</th>
                       <th>VIEW</th>
                       <th>DELETE</th>
                       </tr>
                    ";
                    $i=0;
                    while($row=$res->fetch_assoc())
                    {
                       $i++;
                       echo"<tr>";
                       echo"<td>{$i}</td>";
                       echo"<td>{$row["BTITLE"]}</td>";
                       echo"<td>{$row["KEYWORD"]}</td>";
                       echo"<td><button><a href='{$row["FILE"]}' target='_blank'>View</a></button></td>";
                       echo"<td><a href='delete.php?id={$row["BID"]}'>Delete</a></td>";
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