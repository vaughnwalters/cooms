<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md-8">

            <?php

            if(isset($_GET['p_id'])) {

                $post_id = mysqli_real_escape_string($connection, trim($_GET['p_id']));

                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id ";
                $send_query = mysqli_query($connection, $view_query);


                $query = "SELECT * FROM posts WHERE post_id = {$post_id} ";

                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

                    ?>

                    <h2>
                        <a href="#"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by
                        <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <p><?php echo $post_content ?></p>

                    <hr>

                <?php }


                } else {

                header("location: index.php");


            }
            ?>
            <!-- Blog Comments -->
<!--            when form submits, the_post_id will get the p_id from the URL with the GET superglobal , the form that is submitted will have post fields, and then assign -->

            <?php

            if(isset($_POST['create_comment'])) {

                $the_post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                $the_post_id = mysqli_real_escape_string($connection, trim($_GET['p_id']));
                $comment_author = mysqli_real_escape_string($connection, trim($_POST['comment_author']));
                $comment_email = mysqli_real_escape_string($connection, trim($_POST['comment_email']));
                $comment_content = mysqli_real_escape_string($connection, trim($_POST['comment_content']));
                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";

                $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                $create_comment_query = mysqli_query($connection, $query);

                if(!$create_comment_query) {
                    die('QUERY FAILED' . mysqli_error($connection));
                } else {
                    echo "<p>Comment Received.  I'll have to approve it before it shows up here.</p>";
                    echo "'<p>Only God Can Judge Me' - Tupac</p>";
                }

                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                $query .= "WHERE post_id={$the_post_id} ";

                $update_comment_count = mysqli_query($connection, $query);
            }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">


                    <div class="form-group">
                        <label for="Author">What's Yer Name?</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>

                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>

                    <div class="form-group">
                        <label for="Comment">Comment</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" name="create_comment" class="btn">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php
            $the_post_id = $_GET['p_id'];
            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC ";
            $select_comment_query = mysqli_query($connection, $query);
            if(!$select_comment_query) {
                die('Query Failed' . mysqli_error($connection));
            }
            while ($row = mysqli_fetch_array($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];

            ?>
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <?php echo $comment_content ?>

                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>




