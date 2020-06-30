<?php

include PATH_ROOT. '/config/db.php';
include PATH_ROOT. '/helpers/middleware.php';
include PATH_ROOT. '/helpers/validate_post.php';
include PATH_ROOT. '/helpers/validate_user.php';

$user = selectOne('users', ['id'=>$_SESSION['id']]);
$posts = selectAll('posts', ['user_id'=>$user['id']]);
$categories = selectAll('categories');
$post_title = 'Recent Posts';

$errors = array();
$id = "";
$title = '';
$content = '';
$tags = '';
$status = '';
$category_id = '';

if (isset($_POST["create_post"])) {
    usersOnly();
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

        $post_id = create('posts', $_POST);
        $_SESSION["message"] = "Post created successfully!";
        $_SESSION["type"] = "success";
        header('location: ' . BASE_URL . "/user/posts.php");
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
    usersOnly();
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

        $post_id = update('posts', $id, $_POST);
        $_SESSION["message"] = "Post updated successfully!";
        $_SESSION["type"] = "success";
        header('location: ' . BASE_URL . "/user/posts.php");
        exit();
    } else {
        $title = $_POST["title"];
        $tags = $_POST["tags"];
        $content = $_POST["content"];
        $category_id = $_POST["category_id"];
        $status = isset($_POST["status"]) ? 1 : 0;
    }
}

if (isset($_GET["id"])) {
    usersOnly();
    $post = selectOne('posts', ['id'=>$_GET["id"]]);
    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $tags = $post['tags'];
    $status = $post['status'];
    $category_id = $post['category_id'];
    $image_name = $post["image"];
}

if (isset($_GET["delete_id"])) {
    usersOnly();
    $count = delete('posts', $_GET["delete_id"]);
    header('location: ' . BASE_URL . "/user/posts.php");
    exit();
}

if (isset($_GET["source"])) {
    usersOnly();
    $id = $_GET["id"];
    
    switch ($_GET["source"]) {
        case 'publish':
            $post = selectOne('posts', ['id'=>$id]);
            $post['status'] = 1;
            $post_id = update('posts', $id, ['status'=>1]);
            header('location: ' . BASE_URL . "/user/posts.php");
            exit();
            break;
        case 'unpublish':
            $post = selectOne('posts', ['id'=>$id]);
            $post['status'] = 0;
            $post_id = update('posts', $id, ['status'=>0]);
            header('location: ' . BASE_URL . "/user/posts.php");
            exit();
            break; 
        case 'delete_profile':
            $count = delete('users', $user['id']);
            header('location: ' . BASE_URL . "/logout.php");
            exit();           
    }
}

if (isset($_POST['checkBoxArray'])) {
    usersOnly();
    foreach ($_POST['checkBoxArray'] as $post_id) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case "published":
                $updated_post_id = update('posts', $post_id, ['status'=>1]);
                break;
            case "unpublish":
                $updated_post_id = update('posts', $post_id, ['status'=>0]);
                break;
            case "delete":
                $count = delete('posts', $post_id);
                break;
            case "clone":
                $post_to_clone = selectOne('posts', ['id'=>$post_id]);
                $new_post['category_id'] = $post_to_clone['category_id'];
                $new_post['user_id'] = $post_to_clone['user_id'];
                $new_post['title'] = $post_to_clone['title'];
                $new_post['content'] = $post_to_clone['content'];
                $new_post['tags'] = $post_to_clone['tags'];
                $new_post['image'] = $post_to_clone['image'];
                $new_post['status'] = $post_to_clone['status'];
                $new_post_id = create('posts', $new_post);
                break;
        }
    }
    header('location: ' . BASE_URL . "/user/posts.php");
    exit();
}

if (isset($_POST["update_user"])) {
    usersOnly();
    $_POST['username'] = $user['username'];

    $errors = validateUpdatedUser($_POST);

    if (count($errors) === 0) {
        $id = $_POST["id"];
        $user = selectOne('users', ['id'=>$id]);
        unset($_POST["confirm_password"], $_POST["update_user"], $_POST["id"]);
        $_POST["email"] = mysqli_real_escape_string($db, $_POST["email"]);
        $_POST["password"] = mysqli_real_escape_string($db, $_POST["password"]);
        $_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT, array('cost'=>10));

        $user_id = update('users', $id, $_POST);
        $_SESSION["message"] = "User updated successfully!";
        $_SESSION["type"] = "success";
        header('location: ' . BASE_URL . "/user/index.php");
        exit();
    }
}
