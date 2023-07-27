

<?php 
session_start(); 
$clientId = 'wprQYMZBqqx-dgszFUfQG';
$scope = 'openid email profile'; 
$redirectUri = 'http://localhost:3000/oauth-callback'; 
$state = bin2hex(random_bytes(16));
$_SESSION['state'] = $state; 
$codeVerifier = base64url_encode(random_bytes(32));
$_SESSION['code_verifier'] = $codeVerifier;
$codeChallenge = base64url_encode(hash('sha256', $codeVerifier, true)); 
$authUrl = 'https://id-sandbox.cashtoken.africa/oauth/authorize';
$authUrl .= '?response_type=code';
$authUrl .= '&client_id=' . urlencode($clientId);
$authUrl .= '&scope=' . urlencode($scope);
$authUrl .= '&redirect_uri=' . urlencode($redirectUri);
$authUrl .= '&state=' . urlencode($state);
$authUrl .= '&code_challenge=' . urlencode($codeChallenge);
$authUrl .= '&code_challenge_method=S256'; 
header('Location: ' . $authUrl);
exit(); 
function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
?> 
 