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
            }
        </style>
    </head>
    <body>
       <div class="container">
          <div class="wrapper">
              <h1 class="heading">Welcome  <?php echo $_SESSION["NAME"]; ?></h1>
          </div>
          <div class="navi">
             <?php
               include "usersidebar.php";
             ?>
          </div>
       </div>
       <div class="main">
           <div class="content">
                <h2>Dear <?php echo $_SESSION["NAME"]; ?></h2>
                   <p>You can access most interesting things in this site like,</p>
                   <ul class="sectionpoint1">
                     <li>Store Documents</li>
                     <li>View Documents</li>
                     <li>Datahub</li>
                   </ul>
                   <br>
                <p><b>Store Documents :</b> By useing this functions you can store your files by uploading in the store documents.</p>
                <p><b>View Documents :</b> Your upload documents are view by using this page and you can upload,view and delete the file using this page.</p>
                <p><b>Datahub :</b> In datahub you can access many things and more useful for improve your knowledge.</p>
           </div>
       </div>
       <div class="footer">
             <p>Copyright &copy; MCA Portal 2025</p>
       </div>
    </body>
</html>