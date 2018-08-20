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


                $post_id = $_GET['p_id'];
                $the_author_name = $_GET['author'];


            }
            ?>
                <h1 class="page-header">
                    Here are all the posts by <?php echo $the_author_name ?>
                </h1>
            <?php

            $query = "SELECT * FROM posts WHERE post_author = '{$the_author_name}' ORDER BY post_id DESC " ;

            $select_all_posts_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

                ?>





                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>

            <?php } ?>



<!--            mysqli_real_escape_string($connection, trim($string));-->

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
                    echo "<p>'Only God Can Judge Me' - Tupac</p>";
                }

                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                $query .= "WHERE post_id={$the_post_id} ";

                $update_comment_count = mysqli_query($connection, $query);




            }


            ?>




        </div>
<!---->
<!--        <!-- Blog Sidebar Widgets Column -->
<!--        --><?php //include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->


    <!-- Footer -->
    <?php include "includes/footer.php"; ?>




