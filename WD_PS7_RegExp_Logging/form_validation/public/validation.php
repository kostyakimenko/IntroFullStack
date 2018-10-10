<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    exit;
}

// Class autoloader
spl_autoload_register(function($class) {
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
});

// Rules for form inputs validation
$rules = [
    'ip' => 'RequiredField|Ip',
    'url' => 'RequiredField|Url',
    'email' => 'RequiredField|Email',
    'date' => 'RequiredField|Date',
    'time' => 'RequiredField|Time'
];

// Validator for form
$formValidator = new app\validators\FormValidator($_POST, $rules);
$response = [];

if ($formValidator->isFormValid()) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['errors'] = $formValidator->getErrors();
}

header('Content-type: application/json');
echo json_encode($response);
