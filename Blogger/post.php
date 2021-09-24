<?php include_once 'includes/header.php';
include_once 'includes/nav.php';
include_once 'includes/db_guys/db_posts.php';
include_once 'includes/db_guys/db_comments.php';
$post = null;
if (isset($_POST['content']))
    SubmitTheComment();
if (!isset($_GET['id']))
    header('location:../');
else
    PreparePostView();
?>

<!-- Navigation -->

<!-- Page Content -->
<div class="container">

    <div class="row">
        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
            <?php if ($post) { ?>

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post['post_title'] ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post['username'] ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post['post_date'] ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="<?php echo $post['post_image'] ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p><?php echo $post['post_content'] ?></p>
                <br><br>

                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['post_author_id']) {?>
                    <a class="btn btn-primary" href="newpost.php?edit=<?php echo $post['post_id'] ?>">Edit post</a>
                <?php } ?>
                <hr>
                
                <div class="row m-5 grayed">
                    <p class="float-rt">Views: <?php echo $post['post_views_count'] ?></p>
                </div>
                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>

                    <form action="" id="frmCmnt" method="POST">
                        <div class="container-responsivr">
                            <div class="row m-5">
                                <div class="form-group form-row p-5">
                                    <label for="author" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="author" id="author" value="<?php echo $_SESSION['username'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row m-5">
                                <div class="form-group form-row p-5">
                                    <label for="authorEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="authorEmail" id="authorEmail" value="<?php echo $_SESSION['user_email'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row m-5">
                                <div class="form-group form-row p-5">
                                    <label for="comment" class="col-sm-2 col-form-label">Comment</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                                        <p class="error hidden" id="errCntnt">Please enter a valid comment</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-primary" id="btnCmnt">Comment</button>
                    <p class="success <?php echo isset($_GET['comment']) ? 'visible' : 'hidden' ?>">
                        Comment submitted waiting for approval, thank you for sharing with us
                    </p>
                </div>

                <hr>
                <!-- Posted Comments -->

                <!-- Comment -->
                <?php DisplayPostComments() ?>

            <?php } else {
                echo '<h1> Post not found or approved</h1>';
            } ?>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include_once 'includes/sidebar.php';
        include_once 'includes/footer.php';

        function PreparePostView()
        {
            global $post;
            $post = GetPostForViewing($_GET['id']);
        }

        function SubmitTheComment()
        {
            InsertComment($_GET['id'], empty($_POST['author']) ? 'Guest' : $_POST['author'], $_POST['authorEmail'], $_POST['content']);
            $_GET['comment'] = true;
        }

        function DisplayPostComments()
        {
            foreach (GetPostComments($_GET['id']) as $c) {
        ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="images/comment.png" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><b><?php echo $c['comment_author'] ?></b> -
                            <small><b><?php echo $c['comment_author_email'] ?></b></small> -
                            <small><?php echo $c['comment_date'] ?></small>
                        </h4>
                        <?php echo $c['comment_content'] ?>
                    </div>
                </div>
        <?php
            }
        }

        ?>
        <script src="js/comments.js"></script>