<?php

if(isset($_POST['create_post'])) {

    $post_title = escape($_POST['title']);
    $post_author = escape($_POST['author']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_status = escape($_POST['post_status']);

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');
//    $post_comment_count = 4;

//    this will take the image that is placed into the server temporarily when a file is selected, and move it into the database on submit
    move_uploaded_file($post_image_temp, "../images/$post_image");

//    this is the query to insert the post from the form into the DB
    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date, post_image,post_content,post_tags,post_status) ";

//    for any of these values that are strings going into the DB, must use quotes around the value.  $post_category_id, for example though, is a number and does not need quote
$query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(), '{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";


$create_post_query = mysqli_query($connection, $query);

confirmQuery($create_post_query);

}


?>


<form action="" method="post" enctype="multipart/form-data">
<!--enctype multipart/form-data is used here because we are sending multiple types of data in the form, in this example, a file upload as well as plain text-->


    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <select name="post_category_id" id="">

            <?php
            $query = "SELECT * FROM categories ";
            $select_categories = mysqli_query($connection, $query);

            confirmQuery($select_categories);

            while($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10">


        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>


</form>