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
            <h1>Coding Contest</h1>
            <nav>
                <ul>
                    <button><a href="mhome.php">Back</a></button>
                </ul>
            </nav>
        </div>
       <div class="main">
           <div class="content">
                <p>Dear <?php echo $_SESSION["NAME"]; ?>, are you willing to participate in this contest, then click the link</p>
                <b>Current Contest : <a href="https://www.hackerrank.com/mca-portal">Click here to start the contest</a></b>
                <p>All The Best</p>
           </div>
       </div>
       <div class="footer">
             <p>Copyright &copy; MCA Portal 2025</p>
       </div>
    </body>
</html>