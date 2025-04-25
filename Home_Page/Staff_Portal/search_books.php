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
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                        <h3 class="heading">Search Documents</h3>
                        <label>Enter Name or Keywords</label>
                        <input type="text" required name="name">
                        <button type="submit" name="submit">Search</button>
                        <a href="sview_documents.php">Back</a>
                        <a href="search_books.php">Refresh</a>
                </form> 
                <?php
                    if(isset($_POST["submit"]))
                    {
                        $sql="SELECT * FROM sdocuments WHERE BTITLE like '%{$_POST["name"]}%' or Keyword like '%{$_POST["name"]}%'";
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
                                    echo"<td><a href='{$row["FILE"]}' target='_blank' style='color:black;'>View</a></td>";
                                echo"</tr>";
                            }
                            echo"</table>";
                        }
                        else
                        {
                            echo"<p class='error'>No Books Found</p>";
                        }
                    }
                ?>
            </div>
            <div class="footer">
             <p>Copyright &copy; MCA Portal 2025</p>
            </div>
        </div>
    </body>
</html>