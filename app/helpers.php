<?php
require_once __DIR__ . '/class/user.class.php';
session_start();
// The clean_input function is used to sanitize user input.
function clean_input($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function auth()
{
    $accountObj = new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = clean_input(($_POST['username']));
        $password = clean_input($_POST['password']);
        if (!empty($username) || !empty($password)) {
            session_start();
            if ($accountObj->login($username, $password)) {
                $data = $accountObj->fetch($username);
                $_SESSION['account'] = $data;
                header('location: /resources/visitor/accDashboard.php');
            } else {
                $loginErr = 'Invalid username/password';
            }
        } else {
            $loginErr = 'Please fill in all fields';
        }
    } else {
        if (isset($_SESSION['account'])) {
            if ($_SESSION['account']['is_staff']) {
                header('location: /resources/admin/mDashboard.php');
            } else {
                header('location: /resources/visitor/accDashboard.php');
            }
        }
    }
}

function logout()
{
    session_start();
    session_destroy();
    header('Location: /public/index.php');
}
function login()
{
    session_start();
}

function redirect($url)
{
    header('Location: ' . $url);
}

