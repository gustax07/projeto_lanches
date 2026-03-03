<?php
function validarCaptcha($response) {
    $env = parse_ini_file(__DIR__ . '/../.env');
    $secretKey = getenv('RECAPTCHA_SECRET') ?: $env['RECAPTCHA_SECRET'] ?? '';
    
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    
    $data = [
        'secret' => $secretKey,
        'response' => $response
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captchaSuccess = json_decode($verify);

    return $captchaSuccess->success;
}