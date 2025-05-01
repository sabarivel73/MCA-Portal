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
        <?php
            session_start();
            include"database.php";
            if(isset($_POST["submit"]))
            {
                $otp=$_POST["verification_code"];
                $sql="UPDATE otp SET otp_verified_at = NOW() WHERE verification_code = '".$otp."'";
                $result=mysqli_query($db,$sql);
                if(mysqli_affected_rows($db)>0)
                {
                    header("Location: otpchangepass.php?email=".$email);
                }
                else
                {
                    echo"<p class='error'>OTP Not Match</p>";
                }
            }
        ?>
        <div class="center"> 
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                    <h3>OTP Send Successfully</h3>  
                    <label>Enter OTP : </label>
                    <input type="text" name="verification_code" required>
                    <button type="submit" name="submit">Submit</button>
                    <a href="otp_verification.php">Refresh</a>
                </form> 
        </div>
        <div class="footer">
            <p>Copyright &copy; MCA Portal 2025</p>
        </div>
     </div>
    </body>
</html>