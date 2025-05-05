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
            <div class="wrapper">
              <h1>Student Portal</h1>
            </div>
            <div class="navi">
             <?php
               include "mainsidebar.php";
             ?>
            </div>
       </div>
       <div class="main">
           <div class="content">
                <h2>Hi <?php echo $_SESSION["NAME"]; ?></h2>
                <p>Dear <?php echo $_SESSION["NAME"]; ?>,you can use the digital data for your gathering informations and you can also utilize
                   main features given in the page like<span> will you select given options to explore the digital data hub </span>and many 
                   more things you can access.
                </p>
           </div>
       </div>
       <div class="footer">
             <p>Copyright &copy; MCA Portal 2025</p>
       </div>
    </body>
</html>