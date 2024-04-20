<?php
include 'RegisterIPN.php';
$merchantreference = rand(1, 1000000000000000000);
if (isset($_GET['tel'])) {
  $phone =$_GET['tel'];
  $amount = $_GET['money'];
}else{
$phone = "0768168060";
$amount =10;
}

$callbackurl = "https://12eb-41-81-142-80.ngrok-free.app/pesapal/response-page.php";
$branch = "UMESKIA SOFTWARES";
$first_name = "Alvin";
$middle_name = "Odari";
$last_name = "Kiveu";
$email_address = "alvo967@gmail.com";
if(APP_ENVIROMENT == 'sandbox'){
  $submitOrderUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/SubmitOrderRequest";
}elseif(APP_ENVIROMENT == 'live'){
  $submitOrderUrl = "https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest";
}else{
  echo "Invalid APP_ENVIROMENT";
  exit;
}
$headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer $token"
);

// Request payload
$data = array(
    "id" => "$merchantreference",
    "currency" => "KES",
    "amount" => $amount,
    "description" => "Payment description goes here",
    "callback_url" => "$callbackurl",
    "notification_id" => "$ipn_id",
    "branch" => "$branch",
    "billing_address" => array(
        "email_address" => "$email_address",
        "phone_number" => "$phone",
        "country_code" => "KE",
        "first_name" => "$first_name",
        "middle_name" => "$middle_name",
        "last_name" => "$last_name",
        "line_1" => "Pesapal Limited",
        "line_2" => "",
        "city" => "",
        "state" => "",
        "postal_code" => "",
        "zip_code" => ""
    )
);
$ch = curl_init($submitOrderUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $response =json_decode(curl_exec($ch))->redirect_url;
$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ishyura access kuri awacourses</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<style>
    *{
        color: #fff;
    }
</style>
</head>
<body>
    <div class="container-fluid d-flex flex-column " style="align-items: center; justify-content: center; height:100vh;background-color: rgb(24, 42, 97);">
      <h1>awa courses online </h1>
      <h2 style="font-size: small;">korera provisoure mugihe gito</h2>
        <a href="<?php echo $response;?>" class="btn btn-primary btn-lg" style="min-width: 200px; max-width: 400px;">ishyura nonaha</a>
    </div>
</body>
</html>