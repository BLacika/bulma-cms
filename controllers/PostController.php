<?php

include PATH_ROOT. '/config/db.php';
include PATH_ROOT. '/helpers/validate_post.php';
include PATH_ROOT. '/helpers/middleware.php';

$table = 'posts';
$errors = array();
$id = "";
$title = '';
$content = '';
$tags = '';
$status = '';
$category_id = '';

$posts = selectAll($table);
$categories = selectAll('categories');

if (isset($_POST["create_post"])) {
    adminOnly();
    
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $uploadOK = 1;
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = PATH_ROOT . "/assets/images/" . $image_name;
        $image_file_type = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['image']['tmp_name']);

        if ($check === false) {
            $uploadOK = 0;
            array_push($errors, "File is not an image!");
        }

        if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif" ) {
            array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }

        if ($uploadOK === 0) {
            array_push($errors, "Sorry, your file was not uploaded.");
        } else {
            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            if ($result) {
                $_POST["image"] = $image_name;
            } else {
                array_push($errors, "Failed to upload image!");
            }
        }
    } else {
        array_push($errors, "Post image required!");
    }

    if (count($errors) === 0) {
        unset($_POST["create_post"]);
        $_POST["user_id"] = $_SESSION['id'];
        $_POST["status"] = isset($_POST["status"]) ? 1 : 0;
        $_POST["content"] = htmlentities($_POST["content"]);

        $post_id = create($table, $_POST);
        $_SESSION["message"] = "Post created successfully!";
        $_SESSION["type"] = "success";
        header('location: ' . BASE_URL . "/admin/posts/index.php");
        exit();
    } else {
        $title = $_POST["title"];
        $tags = $_POST["tags"];
        $content = $_POST["content"];
        $category_id = $_POST["category_id"];
        $status = isset($_POST["status"]) ? 1 : 0;
    }
}

if (isset($_POST["update_post"])) {
    adminOnly();

    $errors = validatePost($_POST);

    // Image
    if (!empty($_FILES['image']['name'])) {
        $uploadOK = 1;
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = PATH_ROOT . "/assets/images/" . $image_name;
        $image_file_type = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['image']['tmp_name']);

        if ($check === false) {
            $uploadOK = 0;
            array_push($errors, "File is not an image!");
        }

        if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif" ) {
            array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }

        if ($uploadOK === 0) {
            array_push($errors, "Sorry, your file was not uploaded.");
        } else {
            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            if ($result) {
                $_POST["image"] = $image_name;
            } else {
                array_push($errors, "Failed to upload image!");
            }
        }
    } else {
        array_push($errors, "Post image required!");
    }

    if (count($errors) === 0) {
        $id = $_POST["id"];
        unset($_POST["update_post"], $_POST["id"]);
        $_POST["user_id"] = $_SESSION['id'];
        $_POST["status"] = isset($_POST["status"]) ? 1 : 0;
        $_POST["content"] = htmlentities($_POST["content"]);

        $post_id = update($table, $id, $_POST);
        $_SESSION["message"] = "Post updated successfully!";
        $_SESSION["type"] = "success";
        header('location: ' . BASE_URL . "/admin/posts/index.php");
        exit();
    } else {
        $title = $_POST["title"];
        $tags = $_POST["tags"];
        $content = $_POST["content"];
        $category_id = $_POST["category_id"];
        $status = isset($_POST["status"]) ? 1 : 0;
    }
}

if (isset($_GET["source"])) {
    adminOnly();

    $id = $_GET["id"];
    
    switch ($_GET["source"]) {
        case 'publish':
            $post = selectOne($table, ['id'=>$id]);
            $post['status'] = 1;
            $post_id = update($table, $id, ['status'=>1]);
            header('location: ' . BASE_URL . "/admin/posts/index.php");
            exit();
            break;
        case 'unpublish':
            $post = selectOne($table, ['id'=>$id]);
            $post['status'] = 0;
            $post_id = update($table, $id, ['status'=>0]);
            header('location: ' . BASE_URL . "/admin/posts/index.php");
            exit();
            break;            
    }
}

if (isset($_GET["id"])) {
    $post = selectOne($table, ['id'=>$_GET["id"]]);
    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $tags = $post['tags'];
    $status = $post['status'];
    $category_id = $post['category_id'];
    $image_name = $post["image"];
}

if (isset($_GET["delete_id"])) {
    adminOnly();
    $count = delete($table, $_GET["delete_id"]);
    header('location: ' . BASE_URL . "/admin/posts/index.php");
    exit();
}

if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $post_id) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case "published":
                $updated_post_id = update($table, $post_id, ['status'=>1]);
                break;
            case "unpublish":
                $updated_post_id = update($table, $post_id, ['status'=>0]);
                break;
            case "delete":
                $count = delete($table, $post_id);
                break;
            case "clone":
                $post_to_clone = selectOne($table, ['id'=>$post_id]);
                $new_post['category_id'] = $post_to_clone['category_id'];
                $new_post['user_id'] = $post_to_clone['user_id'];
                $new_post['title'] = $post_to_clone['title'];
                $new_post['content'] = $post_to_clone['content'];
                $new_post['tags'] = $post_to_clone['tags'];
                $new_post['image'] = $post_to_clone['image'];
                $new_post['status'] = $post_to_clone['status'];
                $new_post_id = create($table, $new_post);
                break;
        }
    }
    header('location: ' . BASE_URL . "/admin/posts/index.php");
    exit();
}
