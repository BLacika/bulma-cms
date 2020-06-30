<?php

function validateUser($user)
{
    $errors = array();

    if (empty($user['username'])) {
        array_push($errors, "Username is required!");
    }
    if (empty($user['email'])) {
        array_push($errors, "Email is required!");
    }
    if (empty($user['password'])) {
        array_push($errors, "Password is required!");
    }
    if ($user['password'] !== $user['confirm_password']) {
        array_push($errors, "Password do not match!");
    }

    $existingUsername = selectOne('users', ['username'=> $user['username']]);
    if (isset($existingUsername)) {
        array_push($errors, "Username is already exist!");
    }

    $existingEmail = selectOne('users', ['email'=>$user['email']]);
    if (isset($existingEmail)) {
        array_push($errors, "Email is already exist!");
    }
    
    return $errors;
}

function validateUpdatedUser($user)
{
    $errors = array();

    if (empty($user['username'])) {
        array_push($errors, "Username is required!");
    }
    if (empty($user['email'])) {
        array_push($errors, "Email is required!");
    }
    if (empty($user['password'])) {
        array_push($errors, "Password is required!");
    }
    if ($user['password'] !== $user['confirm_password']) {
        array_push($errors, "Password do not match!");
    }
    
    return $errors;
}

function validateLogin($user)
{
    $errors = array();

    if (empty($user['username'])) {
        array_push($errors, "Username is required!");
    }
    if (empty($user['password'])) {
        array_push($errors, "Password is required!");
    }
    
    return $errors;
}