<?php
$host = 'sql.freesqldatabase.com';
$dbname = 'sql1234567';
$username = 'sql1234567';
$password = 'yourpassword';
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

define('JWT_SECRET', 'capstone_super_secret_key_2025');

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
    $remainder = strlen($data) % 4;
    if ($remainder) {
        $data .= str_repeat('=', 4 - $remainder);
    }
    return base64_decode(strtr($data, '-_', '+/'));
}

function generate_jwt($payload) {
    $header = json_encode(array('typ' => 'JWT', 'alg' => 'HS256'));
    $header64 = base64url_encode($header);
    $payload_json = json_encode($payload);
    $payload64 = base64url_encode($payload_json);
    $signing_input = $header64 . '.' . $payload64;
    $signature = hash_hmac('sha256', $signing_input, JWT_SECRET, true);
    $signature64 = base64url_encode($signature);
    return $header64 . '.' . $payload64 . '.' . $signature64;
}

function verify_jwt($token) {
    $parts = explode('.', $token);
    if (count($parts) !== 3) {
        return false;
    }
    $header64 = $parts[0];
    $payload64 = $parts[1];
    $signature64 = $parts[2];
    $header = json_decode(base64url_decode($header64), true);
    if (!$header || !isset($header['alg']) || $header['alg'] !== 'HS256') {
        return false;
    }
    $payload = json_decode(base64url_decode($payload64), true);
    if (!$payload) {
        return false;
    }
    $signing_input = $header64 . '.' . $payload64;
    $expected_signature = hash_hmac('sha256', $signing_input, JWT_SECRET, true);
    $expected_signature64 = base64url_encode($expected_signature);
    if (!hash_equals($signature64, $expected_signature64)) {
        return false;
    }
    if (isset($payload['exp']) && $payload['exp'] < time()) {
        return false;
    }
    return $payload;
}
?>