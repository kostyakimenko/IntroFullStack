<?php

use app\services\user\{Authorizer, User, UserDataIO, UserHandler};

// Create objects for authorization
$dbIO = new UserDataIO($pdo);
$auth = new Authorizer($dbIO);

// Request data
$authAction = $_POST['action'] ?? null;
$username = $_POST['user'] ?? null;
$password = $_POST['pass'] ?? null;

switch ($authAction) {
    case 'login':
        // Validation user name
        if (preg_match('/\W/', $username) !== 0) {
            $response->setResponseData('user_error', 'Invalid name (allowed "a-z", "A-Z", "0-9", "_")');
            $response->sendResponse();
            $logger->logging('authorization', $response);
            exit;
        }

        // Check user name length
        if (!in_array(strlen(trim($username)), range(1, 30))) {
            $response->setResponseData('user_error', 'Invalid name length (range 1-30)');
            $response->sendResponse();
            $logger->logging('authorization', $response);
            exit;
        }

        // Check password length
        if (!in_array(strlen($password), range(4, 72))) {
            $response->setResponseData('pass_error', 'Invalid pass length (range 4-72)');
            $response->sendResponse();
            $logger->logging('authorization', $response);
            exit;
        }

        $user = new User(trim($username), $password);

        // User handling
        $userHandler = new UserHandler($dbIO);
        if ($userHandler->isNewUser($user)) {
            $userHandler->addUser($user);
        }

        // User authorization
        if ($auth->login($user)) {
            $response->setResponseData('success', 'User login');
        } else {
            $response->setResponseData('pass_error', 'Invalid password');
        }

        $response->sendResponse();
        $logger->logging('authorization', $response);
        exit;

    case 'logout':
        $auth->logout();
        $pdo = null;
        $response->setResponseData('success', 'User logout');
        $response->sendResponse();
        $logger->logging('authorization', $response);
}
