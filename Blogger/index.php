<?php include 'includes/header.php';
include 'includes/nav.php';
include 'includes/db_guys/db_posts.php';

$pageCount = 0;
if (isset($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <?php
            if (isset($_GET['search']))
                ViewPosts($_GET['search']);
            else
                ViewPosts();
            ?>
            <!-- Pager -->
            <ul class="pager">
                <?php if ($page != 1) { ?>
                    <li class="previous">
                        <a href="?page=<?php echo $page - 1 ?>">&larr; Older</a>
                    </li>
                <?php }
                for ($i = 1; $i <= $pageCount; $i++) {
                ?>
                    <li>
                        <a <?php echo $i == $page ? 'class="active-page" ' : '' ?> href="?page=<?php echo $i ?>"><?php echo $i ?></a>
                    </li>
                <?php }
                if ($page < $pageCount) { ?>
                    <li class="next">
                        <a href="?page=<?php echo $page + 1 ?>">Newer &rarr;</a>
                    </li>
                <?php } ?>
            </ul>

        </div>

        <?php
        include 'includes/sidebar.php';
        include 'includes/footer.php';
        ?>
        <div id="footer"></div>
        <?php
        function ViewPosts($keyword = '')
        {
            global $pageCount, $page;
            $pageCount = ceil(GetPostsCount() / 5);
            if ($page > $pageCount || $page < 1)
                header('location:./');

            $posts = $keyword == '' ? GetPosts(($page - 1) * 5) : SearchPosts($keyword);
            foreach ($posts as $p) {
                if ($p['post_status'] != 'approved')
                    continue;
        ?>
                <h2>
                    <a href="post.php?id=<?php echo $p['post_id'] ?>"> <?php echo $p['post_title'] ?> </a>
                </h2>
                <p class="lead">
                    by <a href="user.php?id=<?php echo $p['post_author_id'] ?>"> <?php echo $p['username'] ?> </a>
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