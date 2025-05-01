<?php
    session_start();
    include"database.php";
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;

   require 'phpmailer/vendor/autoload.php';

   if(isset($_POST["submit"]))
   {
    $email=$_POST["email"];
    $mail=new PHPMailer(true);
    try
    {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gskgsk3773@gmail.com';
        $mail->Password = 'fcgq sojw hmyl tzhv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('mcaportal@gmail.com','MCA Portal');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $verification_code = substr(number_format(time() * rand(),0,'',''),0,6);
        $mail->Subject = 'MCA Portal OTP Verification';
        $mail->Body = '<p><h3>Your OTP is : </h3> <b style="font-size:35px;">'.$verification_code.'</b><br><br><b>Thanks for spending your golden time in our MCA Portal Web Page.</b></p>';
        $mail->send();
        $encryption_password = password_hash($password, PASSWORD_DEFAULT);
        $sql="INSERT INTO otp(verification_code) values ('".$verification_code."')";
        mysqli_query($db,$sql);
        header("Location: otp_verification.php?email=".$email);
        exit();
    }
    catch(Exception $e)
    {
        echo"OTP could not send.Mailer Error: {$mail->ErrorInfo}";
    }
   }
?>
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
            <form action="fp.php" method="post">
                <h3>OTP Verification</h3>
                <label>Email :</label>
                <input type="email" name="email" required>
                <button type="submit" name="submit">Submit</button>
                <a href="fp.php">Refresh</a>
                <a href="slogin.php">Back</a>
            </form>
        </div>
        <div class="footer">
            <p>Copyright &copy; MCA Portal 2025</p>
        </div>
    </div>
    </body>
</html>