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
                    $target_dir = "upload/";
                    $target_file = $target_dir.basename($_FILES["efile"]["name"]);
                    if(move_uploaded_file($_FILES["efile"]["tmp_name"],$target_file))
                    {
                        $sql="insert into sdocuments(BTITLE,KEYWORD,FILE,SID) values ('{$_POST["bname"]}','{$_POST["keys"]}','{$target_file}',{$_SESSION["ID"]})";
                        $db->query($sql);
                        echo"<p class='success'>Uploaded Successfully</p>";
                    }
                    else 
                    {
                        echo"<p class='error'>Error in Upload</p>";
                    }
                }   
            ?>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
                <h3>Upload Documents</h3>
                <label>Title</label>
                <input type="text" name="bname" required>
                <label>Keyword</label>
                <input type="text" name="keys" required>
                <label>Upload File</label>
                <input type="file" name="efile" required>
                <button type="submit" name="submit">Upload</button>
                <a href="supload_documents.php">Refresh</a>
                <a href='shome.php'>Home</a>
            </form>      
          </div>
        </div>
        <div class="footer">
            <p>Copyright &copy; MCA Portal 2025</p>
        </div>
    </body>
</html>