<?php

function validatePost($post)
{
    $errors = array();

    if (empty($post['title'])) {
        array_push($errors, "Title is required!");
    }
    if (empty($post['category_id'])) {
        array_push($errors, "Choose a category!");
    }
    if (empty($post['content'])) {
        array_push($errors, "Content is required!");
    }

    return $errors;
}