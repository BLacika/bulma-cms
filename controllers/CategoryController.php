<?php

include PATH_ROOT. '/config/db.php';
include PATH_ROOT. '/helpers/middleware.php';

$table = 'categories';
$id = '';
$title = "";
$categories = selectAll($table);
$btn_name = 'add_category';
$empty_error = "";

if (isset($_POST["add_category"])) {
    adminOnly();
    unset($_POST["add_category"]);

    if (empty($_POST["title"])) {
        $empty_error = "Category title is required!";
    }

    $existingCategory = selectOne('categories', ['title'=> $_POST["title"]]);
    if (isset($existingCategory)) {
        $empty_error = "This category is already exist!";
    }

    if (empty($empty_error)) {
        $cat_id = create($table, $_POST);
        $_SESSION["message"] = "Category created successfully!";
        $_SESSION["type"] = "success";
        header('location: index.php');
        exit();
    }
}

if (isset($_GET["source"])) {
    adminOnly();

    $id = $_GET["id"];

    switch ($_GET["source"]) {
        case 'edit':
            $btn_name = 'update_category';
            $category = selectOne($table, ['id'=>$id]);
            $title = $category['title'];
            break;
        case 'delete':
            delete('categories', $id);
            header('location: index.php');
            exit();
            break;
    }
}

if (isset($_POST["update_category"])) {
    adminOnly();
    $id = $_POST["id"];

    unset($_POST["update_category"], $_POST["id"]);

    $cat_id = update($table, $id, $_POST);

    $_SESSION["message"] = "Category successfully updated!";
    $_SESSION["type"] = "success";
    header('location: index.php');
    exit();
}
