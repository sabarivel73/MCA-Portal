<?php
    session_start();
    require('database.php');
    require('razorpay-php/Razorpay.php');
    use Razorpay\Api\Api;
    if(!isset($_SESSION['ID']))
    {
        header("Location: ulogin.php");
        exit;
    }
    $amount = $_POST['amount'];
    $title = $_POST['title'];
    $pid = $_POST['pid'];
    $uid = $_SESSION['ID'];
    $k = 'rzp_test_API_KEY';
    $s_k = 'API_KEY';
    $api = new api($k, $s_k);
    $o_d = [
        'receipt' => uniqid(),
        'amount' => $amount,
        'currency' => 'INR',
        'payment_capture' => 1
    ];
    $rp_order = $api->order->create($o_d);
    $order_id = $rp_order['id'];
?>
<html>
    <head>
        <title>Processing...</title>
    </head>
    <body>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            var option = {
                "key": "<?php echo $k; ?>",
                "amount": "<?php echo $amount; ?>",
                "currency": "INR",
                "name": "MCA Portal",
                "description": "<?php echo htmlspecialchars($title); ?>",
                "order_id": "<?php echo $order_id; ?>",
                "handler": function (response) {
                    window.location.href = "verify.php?order_id=" + response.razorpay_order_id + "&payment_id=" + response.razorpay_payment_id + "&signature=" + response.razorpay_signature + "&pid=<?php echo $pid; ?>" + "&amount=<?php echo $amount; ?>" + "&uid=<?php echo $uid; ?>";
                },
                "modal": {
                    "ondismiss": function () {
                        window.location.href = "view_payment.php?status=failed";
                    }
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rp = new Razorpay(option);
            rp.open();
        </script>
    </body>
</html>