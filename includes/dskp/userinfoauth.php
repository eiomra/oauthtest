 
 <?php
session_start();

if (!isset($_SESSION['access_token'])) {
    
    header('Location: auth.php');
    exit();
}

$userInfoEndpoint = 'https://id-sandbox.cashtoken.africa/oauth/userinfo';
$accessToken = $_SESSION['access_token'];

$ch = curl_init($userInfoEndpoint);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $accessToken));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$userData = json_decode($response, true);
?> 
  
  