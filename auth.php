  
<?php

session_start();  
    $authorization_endpoint = 'https://id-sandbox.cashtoken.africa/oauth/authorize';
    $client_id = 'wprQYMZBqqx-dgszFUfQG';
    $redirect_uri = 'http://localhost:3000/oauth-callback';
    $scope = 'openid email profile';
    $code_verifier = base64UrlEncode(random_bytes(32));

    $code_challenge = base64UrlEncode(hash('sha256', $code_verifier, true));
    $_SESSION['code_verifier'] = $code_verifier;
    $authorization_url = sprintf(
        '%s?response_type=code&client_id=%s&redirect_uri=%s&scope=%s&code_challenge=%s&code_challenge_method=S256',
        $authorization_endpoint,
        urlencode($client_id),
        urlencode($redirect_uri),
        urlencode($scope),
        urlencode($code_challenge)
    );
 
    
header('Location: ' . $authorization_url);
 

function base64UrlEncode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
?>