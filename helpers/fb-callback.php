<?php

if (session_id() == "") {
    session_start();
}

require_once './fb-config.php';

try {
    $accessToken = $helper->getAccessToken();
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
    echo "Response Exception: " . $e->getMessage();
    exit();
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
    echo "Response Exception: " . $e->getMessage();
    exit();
}

if (!$accessToken) {
    header('Location: login.php');
    exit();
}

$oAuth2Client = $FB->getOAuth2Client();
if (!$accessToken->isLongLived()) {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
}

$response = $FB->get("me?fields=id,name,email", $accessToken);
$userData = $response->getGraphNode()->asArray();
$_SESSION['userData'] = $userData;
$_SESSION['access_token'] = (string) $accessToken;
$_SESSION['loggedin'] = TRUE;

header('Location: /');

?>