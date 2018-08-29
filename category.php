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

                if(isset($_GET['category'])) {

                    $post_category_id = $_GET['category'];

                }

//                TODO - FLESH THIS OUT MORE to customize content at top of each category page, maybe base it on the switch statement in posts.php
                if($post_category_id == 0) {
//                    echo "DEV";
                    ?><!-- Typer-->
                <p>dev@vaughnwalters.com:~$
      <span class="typer" data-words="Suuuuuup. Welcome to the dev nerd portion of the site.  Built with a homespun CMS called Cooms. You can find it on my github repo."
            data-colors="#55F72E" data-delay="69"></span>
                    <span class="cursor" data-cursorDisplay="▌" data-owner="second-id"></span>
                </p><?php

                } elseif ( $post_category_id == 1 ) {
//                    echo "MUSIC";
                } elseif ( $post_category_id == 2 ) {
//                    echo "GRUB";
                } elseif ( $post_category_id == 3 ) {
//                    echo "SOCIALITE";
                }





                $query = "SELECT * FROM posts WHERE post_category_id = {$post_category_id} ORDER BY post_id DESC";

                $select_all_posts_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0,100);

                    ?>
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <a href="post.php?p_id=<?php echo $post_id; ?>">

                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    </a>
                    <p><?php
                        echo $post_content;
                        if (strlen ( $post_content) >= 100) {
                            echo "...";
                        }
                        ?>
                    </p>

                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                <?php } ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->


<!-- Footer -->
<?php include "includes/footer.php"; ?>




