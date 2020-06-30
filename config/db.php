<?php
session_start();
require('connect.php');

function executeQuery($query, $data)
{
    global $db;
    $stmt = $db->prepare($query);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}

function selectAll($table, $conditions = []) {
    global $db;
    $query = "SELECT * FROM $table";
    if (empty($conditions)) {
        $stmt = $db->prepare($query);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else {
        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $query .= " WHERE $key=?";
            } else {
                $query .= " AND $key=?";
            }
            $i++;
        }
        $stmt = executeQuery($query, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}

function selectOne($table, $conditions) {
    global $db;
    $query = "SELECT * FROM $table";
    
    $i = 0;
    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $query .= " WHERE $key=?";
        } else {
            $query .= " AND $key=?";
        }
        $i++;
    }

    $query .= " LIMIT 1";
    $stmt = executeQuery($query, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}

function create($table, $data)
{
    global $db;
    $sql = "INSERT INTO $table SET ";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql .= " $key=?";
        } else {
            $sql .= ", $key=?";
        }
        $i++;
    }

    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

function update($table, $id, $data)
{
    global $db;
    $sql = "UPDATE $table SET ";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql .= " $key=?";
        } else {
            $sql .= ", $key=?";
        }
        $i++;
    }
    $sql .= " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $stmt->affected_rows;
}

function delete($table, $id)
{
    global $db;
    $sql = "DELETE FROM $table WHERE id=?";

    $stmt = executeQuery($sql, ['id' => $id]);
    return $stmt->affected_rows;
}

function getPublishedPost()
{
    global $db;
    $sql = "SELECT *
            FROM posts
            WHERE status=?";
    $stmt = executeQuery($sql, ["status"=>1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function searchPosts($term)
{
    global $db;
    $match = '%' . $term . '%';
    $sql = "SELECT * 
            FROM posts 
            WHERE status=? 
            AND title LIKE ? OR tags LIKE ? OR content LIKE ?";

    $stmt = executeQuery($sql, [
        'status'=>1, 
        'title'=>$match,
        'tags'=>$match,
        'content'=>$match
    ]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;

}

function getPostsByCategory($category_id)
{
    global $db;
    $sql = "SELECT *
            FROM posts
            WHERE status=?
            AND category_id=?";
    $stmt = executeQuery($sql, ["status"=>1, 'category_id'=>$category_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function printDatas($value) {
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}
