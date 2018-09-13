<?php

use app\services\user\{Authorizer, User, UserDataIO, UserHandler};

// Create objects for authorization
$dbIO = new UserDataIO($pdo);
$auth = new Authorizer($dbIO);

$authAction = (isset($_POST['action'])) ? htmlspecialchars($_POST['action']) : null;

switch ($authAction) {
    case 'login':
        // Validation user name
        if (preg_match('/\W/', $_POST['user']) !== 0) {
            $response->responseData('user_error', 'Invalid char (allowed "a-z", "A-Z", "0-9", "_")');
            $response->sendResponse();
            exit;
        }

        // Check user name length
        if (!in_array(strlen(trim($_POST['user'])), range(1, 30))) {
            $response->responseData('user_error', 'Invalid name length (range 1-30)');
            $response->sendResponse();
            exit;
        }

        // Check empty password
        if (empty($_POST['pass'])) {
            $response->responseData('pass_error', 'Empty password');
            $response->sendResponse();
            exit;
        }

        $user = new User(trim($_POST['user']), htmlspecialchars($_POST['pass']));

        // User handling
        $userHandler = new UserHandler($dbIO);
        if ($userHandler->isNewUser($user)) {
            $userHandler->addUser($user);
        }

        // User authorization
        if ($auth->login($user)) {
            $response->responseData('success');
        } else {
            $response->responseData('pass_error', 'Invalid password');
        }

        $response->sendResponse();
        exit;

    case 'logout':
        $auth->logout();
        $pdo = null;
}
