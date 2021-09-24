<?php include_once 'includes/header.php';
include_once 'includes/nav.php';
include_once 'includes/db_guys/db_posts.php';
include_once 'includes/db_guys/db_users.php';


if (!isset($_GET['id']))
    header('location:../');
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php $userFound =  GetUserDetails() ?>
            <h1 class="page-header">
                <small>Posts</small>
            </h1>

            <!-- First Blog Post -->
            <?php
            if ($userFound) 
                DisplayUserPosts();
            ?>
            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <?php
        include 'includes/sidebar.php';
        include 'includes/footer.php';

        function GetUserDetails()
        {
            $user = GetUserData($_GET['id']);
            if ($user) {
        ?>
                <h1 class="page-header">
                    <?php echo $user['user_firstname'] . ' ' . $user['user_lastname'] ?><br>
                    <small><?php echo $user['username'] . ', ' . $user['user_role'] ?></small><br>
                    <small><?php echo $user['user_email'] ?></small><br>
                    <small>lastseen: <?php echo $user['last_seen'] ?></small>
                </h1>

            <?php
                return true;
            } else
                echo '<h1 class="text-center">User doesn\'t exist.</h1>';
            return false;
        }

        function DisplayUserPosts()
        {
            $posts = GetUserPosts($_GET['id']);
            foreach ($posts as $p) {
                if ($p['post_status'] != 'approved')
                    continue;
            ?>
                <h2>
                    <a href="post.php?id=<?php echo $p['post_id'] ?>"> <?php echo $p['post_title'] ?> </a>
                </h2>
                <p class="lead">
                    by <a href="?id=<?php echo $p['post_author_id'] ?>"> <?php echo $p['username'] ?> </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $p['post_date'] ?> </p>
                <hr>
                <div class="text-center">
                    <img class="img-fluid img-responsive" src="<?php echo $p['post_image'] ?>" alt="">
                </div>
                <hr>
                <p><?php echo substr($p['post_content'], 0, 100) . (strlen($p['post_content']) > 100 ? '....' : '.') ?></p>
                <a class="btn btn-primary" href="post.php?id=<?php echo $p['post_id'] ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
        <?php
            }
        }
        ?>