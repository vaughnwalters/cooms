<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->

            <div class="col-md-8">
                <!-- Typer-->
                <p>yo@vaughnwalters.com:~$
                    <span class="typer" data-words="Suuuuuuuuuuup"
            data-colors="#55F72E" data-delay="100"></span>
                    <span class="cursor" data-cursorDisplay="▌" data-owner="second-id"></span>
                </p>
                <hr>

                <?php

                if(isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = "";
                }

                if($page == "" || $page == 1) {
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * 8) - 8;
                }

                $post_query_count = "SELECT * FROM posts";
                $find_count = mysqli_query($connection, $post_query_count);
                $count = mysqli_num_rows($find_count);

                $count = ceil($count / 8);

                $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1, 8 ";

                $select_all_posts_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0,100);
                    $post_status = $row['post_status'];

                    if($post_status == 'published') {

                    ?>
                    <!-- Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        <?php if($post_author != '') { ?>
                        by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                        <?php } ?>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <a href="post.php?p_id=<?php echo $post_id; ?>">
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    </a>
                    <p>
                        <?php
                        echo $post_content;
                        if (strlen ( $post_content) >= 100) {
                            echo "...";
                        }
                        ?>
                    </p>

<!--                        if !dev category-->
<!--                        <a class="btn btn-primary" href="post.php?p_id=--><?php //echo $post_id; ?><!--">cat --><?php //echo $post_title ?><!-- | more</a>-->

                        <!-- if dev-->
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                <?php } }?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <ul class="pager">

            <?php

            for($i = 1; $i<=$count; $i++) {
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }

            ?>

        </ul>

<!-- Footer -->
<?php include "includes/footer.php"; ?>
