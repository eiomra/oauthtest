<?php
session_start();

if (isset($_GET['code'])) {
    $authorization_code = $_GET['code'];

    if (!isset($_SESSION['code_verifier'])) {
        echo "Error: Code verifier not found.";
        exit;
    }

    $code_verifier = $_SESSION['code_verifier'];
    $token_endpoint = 'https://id-sandbox.cashtoken.africa/oauth/token';
    $client_id = 'wprQYMZBqqx-dgszFUfQG';
    $redirect_uri = 'http://localhost:3000/oauth-callback';

    $data = array(
        'grant_type' => 'authorization_code',
        'code' => $authorization_code,
        'client_id' => $client_id,
        'redirect_uri' => $redirect_uri,
        'code_verifier' => $code_verifier
    );

    $ch = curl_init($token_endpoint);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if ($response === false) {
        echo "Error exchanging authorization code for access token: " . curl_error($ch);
        exit;
    }

    curl_close($ch);

    $token_data = json_decode($response, true);
    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];
        $_SESSION['access_token'] = $access_token;

        header('Location: profile');
        exit;
    } else {
        echo "Error exchanging authorization code for access token.";
        exit;
    }
} else {
    echo "Error: Authorization code not found.";
}


$response = curl_exec($ch);

if ($response === false) {
    echo "Error executing cURL request: " . curl_error($ch);
    exit;
}

$token_data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Error parsing JSON response: " . json_last_error_msg();
    exit;
}

?>
