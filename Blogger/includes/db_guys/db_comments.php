<?php
include_once 'db.php';

function GetAllComments()
{
    global $mysql;
    return mysqli_fetch_all(mysqli_query($mysql, 'SELECT 
        comment_id, comment_post_id, comment_author, comment_author_email, post_title, comment_content, comment_date, comment_status
        FROM comments 
        LEFT JOIN posts ON post_id = comment_post_id
        ORDER BY comment_id DESC'), MYSQLI_ASSOC);
}

function GetPostComments($postId)
{
    global $mysql;
    return mysqli_fetch_all(mysqli_query($mysql, 'SELECT * FROM comments 
        WHERE comment_post_id = '.$postId.' AND comment_status = "approved"
        ORDER BY comment_id DESC'), MYSQLI_ASSOC);
}

function DeleteComment($commentId)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'DELETE FROM comments WHERE comment_id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $commentId);
    mysqli_stmt_execute($stmt);
}


function InsertComment($postId, $author, $email, $content)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'INSERT INTO comments (comment_post_id, comment_content, comment_author, comment_author_email)
    VALUES (?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'isss', $postId, $content, $author, $email);
    mysqli_stmt_execute($stmt);
}

function AlterCommentStatus($postId, $status)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'UPDATE comments SET comment_status = ? WHERE comment_id = ?');
    mysqli_stmt_bind_param($stmt, 'si', $status, $postId);
    mysqli_stmt_execute($stmt);
}

function AlterSomeCommentsStatus($ids, $status)
{
    global $mysql;

    $stmt = mysqli_prepare($mysql, 'UPDATE comments SET comment_status = ? 
        WHERE comment_id IN (' . str_repeat('?,', count($ids) - 1) . '?)');
    mysqli_stmt_bind_param($stmt, 's' . str_repeat('i', count($ids)), $status, ...$ids);
    mysqli_stmt_execute($stmt);
}

function DeleteSomecomments($ids)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'DELETE FROM comments 
        WHERE comment_id IN (' . str_repeat('?,', count($ids) - 1) . '?)');
    mysqli_stmt_bind_param($stmt, str_repeat('i', count($ids)), ...$ids);
    mysqli_stmt_execute($stmt);
}
