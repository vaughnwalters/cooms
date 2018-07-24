<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">VW</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php

                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";

                }

                ?>






<!---->
<!--                --><?php
//
//                $query = "SELECT * FROM categories";
//                $select_categories_sidebar = mysqli_query($connection, $query);
//
//
//                ?>
<!---->
<!--                <div class="well">-->
<!--                    <h4>Blog Categories</h4>-->
<!--                    <div class="row">-->
<!--                        <div class="col-lg-12">-->
<!--                            <ul class="list-unstyled">-->
<!---->
<!--                                --><?php
//
//                                while($row = mysqli_fetch_assoc($select_categories_sidebar)) {
//                                    $cat_title = $row['cat_title'];
//                                    $cat_id = $row['cat_id'];
//
//                                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
//
//                                }
//
//
//                                ?>
<!---->
<!--                            </ul>-->
<!--                        </div>-->
<!--                        <!-- /.col-lg-12 -->-->
<!--                    </div>-->
<!--                    <!-- /.row -->-->
<!--                </div>-->
<!--                -->
<!--                -->
<!--                -->
<!--                -->





























                <?php
                    if(isset($_SESSION['user_role'])) {
                        echo "<li><a href='admin'>Admin</a></li>";
                        if(isset($_GET['p_id'])) {
                            echo $the_post_id = $_GET['p_id'];
                            echo "<li><a href='/admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                        }
                    }

                ?>


            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>