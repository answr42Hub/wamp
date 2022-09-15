<?php
// JWT - Json Web Token

$header = base64_encode(json_encode([
    'typ' => 'JWT',
    'alg' => 'HS256'
]));
$payload = base64_encode(json_encode([
    'id' => 5,
    'role' => 1
]));
$signature = base64_encode(hash_hmac(
    'sha256',
    $header . '.' . $payload,
    'slaglduahgiur',
    true
));
$jwt = "$header.$payload.$signature";
echo $jwt . '<br>';



//Decoder

$parts = explode('.', $jwt);
$payload = json_decode(base64_decode($parts[1]));
var_dump($payload);
$signature = base64_encode(hash_hmac(
    'sha256',
    $parts[0] . '.' . $parts[1],
    'slaglduahgiur',
    true
));
$isValid = $signature == $parts[2];
var_dump($isValid);