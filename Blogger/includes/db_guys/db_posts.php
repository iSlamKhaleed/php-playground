<?php
include_once 'db.php';

function GetPosts(int $limitOffset)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'SELECT * FROM posts
        LEFT JOIN categories ON cat_id = post_category_id
        LEFT JOIN users ON user_id = post_author_id
        LEFT JOIN (SELECT comment_post_id, COUNT(comment_id) AS comments FROM comments GROUP BY comment_post_id) AS comment_count ON comment_post_id = post_id
        ORDER BY post_id DESC LIMIT ?, 5;');

    mysqli_stmt_bind_param($stmt, 'i', $limitOffset);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
}

function GetAllPosts()
{
    global $mysql;
    return mysqli_fetch_all(mysqli_query($mysql, 'SELECT * FROM posts
        LEFT JOIN categories ON cat_id = post_category_id
        LEFT JOIN users ON user_id = post_author_id
        LEFT JOIN (SELECT comment_post_id, COUNT(comment_id) AS comments FROM comments GROUP BY comment_post_id) AS comment_count ON comment_post_id = post_id
        ORDER BY post_id DESC;'), MYSQLI_ASSOC);
}


function GetPostsCount()
{
    global $mysql;
    return mysqli_fetch_all(
        mysqli_query(
            $mysql,
            'SELECT IFNULL(COUNT(post_id),0) AS \'count\' FROM posts;'
        ),
        MYSQLI_ASSOC
    )[0]['count'];
}

function GetCategoryPosts($catId)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'SELECT * FROM posts
        LEFT JOIN categories on post_category_id = cat_id
        LEFT JOIN users on post_author_id = user_id WHERE post_category_id = ? ORDER BY post_id DESC;');
    mysqli_stmt_bind_param($stmt, 'i', $catId);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
}

function GetUserPosts($userId)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'SELECT * FROM posts
        LEFT JOIN categories on post_category_id = cat_id
        LEFT JOIN users on post_author_id = user_id 
        WHERE post_author_id = ? ORDER BY post_id DESC;');
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
}

function GetPostDetails($postId)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'SELECT * FROM posts
        LEFT JOIN categories on post_category_id = cat_id
        LEFT JOIN users on post_author_id = user_id WHERE post_id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $postId);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC)[0];
}

function SearchPosts($keyword)
{
    global $mysql;
    $keyword = '%' . $keyword . '%';

    $stmt = mysqli_prepare($mysql, "SELECT * FROM posts
        LEFT JOIN categories ON cat_id = post_category_id
        LEFT JOIN users ON user_id = post_author_id
        LEFT JOIN (SELECT comment_post_id, COUNT(comment_id),0 AS comments FROM comments GROUP BY comment_post_id) AS comment_count ON comment_post_id = post_id
        WHERE post_title LIKE ? or post_tags LIKE ? 
        ORDER BY post_id DESC;");
    mysqli_stmt_bind_param($stmt, "ss", $keyword, $keyword);
    mysqli_stmt_execute($stmt);

    return mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
}

function InsertPost($title, $content, $catId, $authId, $image, $tags)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'INSERT INTO posts 
        (post_category_id, post_title, post_author_id, post_image, post_content, post_tags) 
        VALUES (?,?,?,?,?,?)');

    mysqli_stmt_bind_param($stmt, 'isisss', $catId, $title, $authId, $image, $content, $tags);
    mysqli_stmt_execute($stmt);
}

function UpdatePost($postId, $title, $content, $catId, $image, $tags)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'UPDATE posts SET 
        post_category_id = ?, post_title = ?, post_image = ?, post_content = ?, post_tags = ? 
        WHERE post_id = ?');

    mysqli_stmt_bind_param($stmt, 'issssi', $catId, $title, $image, $content, $tags, $postId);
    mysqli_stmt_execute($stmt);
}

function DeletePost($postId)
{
    global $mysql;

    $stmt = mysqli_prepare($mysql, 'DELETE FROM posts WHERE post_id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $postId);
    mysqli_stmt_execute($stmt);
}

function GetPostForViewing($postId)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'SELECT * FROM posts
        LEFT JOIN categories on post_category_id = cat_id
        LEFT JOIN users on post_author_id = user_id WHERE post_id = ? AND post_status = "approved"');
    mysqli_stmt_bind_param($stmt, 'i', $postId);
    mysqli_stmt_execute($stmt);
    $posts = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    if (count($posts) < 1)
        return false;
    IncreaseViews($postId);
    return $posts[0];
}

function IncreaseViews($postId)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $postId);
    mysqli_stmt_execute($stmt);
}

function AlterPostStatus($postId, $status)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'UPDATE posts SET post_status = ? WHERE post_id = ?');
    mysqli_stmt_bind_param($stmt, 'si', $status, $postId);
    mysqli_stmt_execute($stmt);
}

function AlterSomePostsStatus($ids, $status)
{
    global $mysql;

    $stmt = mysqli_prepare($mysql, 'UPDATE posts SET post_status = ? 
        WHERE post_id IN (' . str_repeat('?,', count($ids) - 1) . '?)');
    mysqli_stmt_bind_param($stmt, 's' . str_repeat('i', count($ids)), $status, ...$ids);
    mysqli_stmt_execute($stmt);
}

function DeleteSomePosts($ids)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'DELETE FROM posts 
        WHERE post_id IN (' . str_repeat('?,', count($ids) - 1) . '?)');
    mysqli_stmt_bind_param($stmt, str_repeat('i', count($ids)), ...$ids);
    mysqli_stmt_execute($stmt);
}
