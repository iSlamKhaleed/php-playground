<?php
include 'db.php';

function GetCategories()
{
    global $mysql;
    return mysqli_fetch_all(mysqli_query($mysql, 'SELECT * FROM categories'), MYSQLI_ASSOC);
}

function GetCategoryName($catId)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'SELECT * FROM categories WHERE cat_id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $catId);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC)[0]['cat_title'];
}

function InsertCategory($catName)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'INSERT INTO categories (cat_title) VALUES (?);');
    mysqli_stmt_bind_param($stmt, 's', $catName);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_error($stmt);
}

function CategoryExists($catName)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'SELECT count(cat_id) FROM categories WHERE cat_title = ?;');
    mysqli_stmt_bind_param($stmt, 's', $catName);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_all(mysqli_stmt_get_result($stmt))[0][0];
}

function RemoveCategory($id)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'DELETE FROM categories WHERE cat_id =?;');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}

function UpdateCategory($id, $cat_title)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'UPDATE categories SET cat_title = ? WHERE cat_id =?;');
    mysqli_stmt_bind_param($stmt, 'si', $cat_title, $id);
    mysqli_stmt_execute($stmt);
}
