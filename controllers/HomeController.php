<?php

include PATH_ROOT. '/config/db.php';
include PATH_ROOT. '/helpers/middleware.php';

$categories = selectAll('categories');
$post_title = 'Recent Posts';
$posts = array();

if (isset($_GET['cat_id'])) {
    $posts = getPostsByCategory($_GET['cat_id']);
    $post_title = "You searched for posts 
                with category of '" . $_GET['cat_title'] . "'.";
} else if (isset($_POST['search_post'])) {
    $posts = searchPosts($_POST['search_post']);
    $post_title = "You searched for '" . $_POST['search_post'] . "'.";
} else {
    $posts = getPublishedPost();
}

if (isset($_GET['id'])) {
    $post = selectOne('posts', ['id'=>$_GET['id']]);
}
