<?php

include PATH_ROOT. '/config/db.php';
include PATH_ROOT. '/helpers/validate_user.php';
include PATH_ROOT. '/helpers/middleware.php';

$table = 'users';
$users = selectAll('users');
$errors = array();
$id = '';
$username = "";
$password = "";
$email = "";
$firstname = '';
$lastname = '';
$role = '';

function loginUser($user)
{
    $_SESSION["id"] = $user['id'];
    $_SESSION["username"] = $user['username'];
    $_SESSION["role"] = $user['role'];
    $_SESSION["message"] = "You are now logged in.";
    $_SESSION["type"] = "success";

    if ($_SESSION["role"] === "admin") {
        header("location: ".BASE_URL."/admin/dashboard.php");
        exit();
    } else {
        header("location: ".BASE_URL."/");
        exit();
    }
    exit();
}

if (isset($_POST["register_user"])) {
    $errors = validateUser($_POST);

    if (count($errors) === 0) {
        unset($_POST["confirm_password"], $_POST["register_user"]);

        $_POST["username"] = mysqli_real_escape_string($db, $_POST["username"]);
        $_POST["email"] = mysqli_real_escape_string($db, $_POST["email"]);
        $_POST["password"] = mysqli_real_escape_string($db, $_POST["password"]);

        $_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT, array('cost'=>10));

        $user_id = create('users', $_POST);
        $user = selectOne('users', ['id' => $user_id]);

        loginUser($user);
    } else {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
    }
}

if (isset($_POST["login_user"])) {
    $errors = validateLogin($_POST);

    if (count($errors) === 0) {
        $_POST["username"] = mysqli_real_escape_string($db, $_POST["username"]);
        $_POST["password"] = mysqli_real_escape_string($db, $_POST["password"]);

        $user = selectOne("users", ['username' => $_POST["username"]]);

        if ($user && password_verify($_POST["password"], $user['password'])) {
            loginUser($user);
        } else {
            array_push($errors, "Wrong credetials!");
        }
    }

    $username = $_POST["username"];
    $password = $_POST["password"];
}

if (isset($_POST["create_user"])) {
    adminOnly();
    $errors = validateUser($_POST);

    if (count($errors) === 0) {
        unset($_POST["confirm_password"], $_POST["create_user"]);

        $_POST["username"] = mysqli_real_escape_string($db, $_POST["username"]);
        $_POST["email"] = mysqli_real_escape_string($db, $_POST["email"]);
        $_POST["password"] = mysqli_real_escape_string($db, $_POST["password"]);

        $_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT, array('cost'=>10));

        $user_id = create('users', $_POST);
        $user = selectOne('users', ['id' => $user_id]);

        $_SESSION["message"] = "User created successfully!";
        $_SESSION["type"] = "success";
        header("location: ".BASE_URL."/admin/users/index.php");
        exit();
    } else {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $role = $_POST["role"];
    }
}

if (isset($_GET["delete_id"])) {
    adminOnly();
    $count = delete($table, $_GET["delete_id"]);
    header('location: ' . BASE_URL . "/admin/users/index.php");
    exit();
}

if (isset($_GET["id"])) {
    $user = selectOne($table, ['id'=>$_GET["id"]]);
    $id = $user['id'];
    $username = $user['username'];
    $email = $user['email'];
    $firstname = $user['firstname'];
    $lastname = $user['lastname'];
    $role = $user['role'];
}

if (isset($_POST["update_user"])) {
    adminOnly();
    $errors = validateUpdatedUser($_POST);

    if (count($errors) === 0) {
        $id = $_POST["id"];
        $user = selectOne($table, ['id'=>$id]);
        unset($_POST["confirm_password"], $_POST["update_user"], $_POST["id"]);

        $_POST["username"] = mysqli_real_escape_string($db, $_POST["username"]);
        $_POST["email"] = mysqli_real_escape_string($db, $_POST["email"]);
        $_POST["password"] = mysqli_real_escape_string($db, $_POST["password"]);
        $_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT, array('cost'=>10));

        $user_id = update($table, $id, $_POST);
        $_SESSION["message"] = "User updated successfully!";
        $_SESSION["type"] = "success";
        header('location: ' . BASE_URL . "/admin/users/index.php");
        exit();
    } else {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $role = $_POST["role"];
    }
}
