<?php
    session_start();
    require('database.php');
    require('razorpay-php/Razorpay.php');
    use Razorpay\Api\Api;
    use Razorpay\Api\Errors\SignatureVerificationError;
    $k = 'rzp_test_API_KEY';
    $s_k = 'API_KEY';
    $api = new api($k, $s_k);
    $order_id = $_GET['order_id'] ?? '';
    $payment_id = $_GET['payment_id'] ?? '';
    $signature = $_GET['signature'] ?? '';
    $pid = $_GET['pid'] ?? '';
    $uid = $_GET['uid'] ?? '';
    $amount = $_GET['amount'] ?? '';
    $s = false;
    try
    {
        $a = [
            'razorpay_order_id' => $order_id,
            'razorpay_payment_id' => $payment_id,
            'razorpay_signature' => $signature
        ];
        $api->utility->verifyPaymentSignature($a);
        $s = true;
    }
    catch(SignatureVerificationError $e)
    {
        $s = false;
    }
    if($s)
    {
        $final_amount = $amount/100;
        $s1 = $db->prepare("INSERT INTO payment (order_id, rp_id, UID, price, status) VALUES (?, ?, ?, ?, 'success')");
        $s1->bind_param("ssii", $order_id, $pid, $uid, $final_amount);
        $s1->execute();
        $s1->close();
        header("Location: view_payment.php?status=success");
        exit; 
    }
    else
    {
        header("Location: view_payment.php?status=failed");
        exit;
    }
   ?>