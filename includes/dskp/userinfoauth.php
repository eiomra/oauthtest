 
 <?php
session_start();

// Check if the user is authenticated (access token exists).
if (!isset($_SESSION['access_token'])) {
    // Redirect to the landing page for authentication.
    header('Location: auth.php');
    exit();
}

// Configuration data.
$userInfoEndpoint = 'https://id-sandbox.cashtoken.africa/oauth/userinfo';

// Request user profile information using the access token.
$accessToken = $_SESSION['access_token'];

$ch = curl_init($userInfoEndpoint);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $accessToken));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$userData = json_decode($response, true);

// Display user profile information.
?> 