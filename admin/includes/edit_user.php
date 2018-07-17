<?php



if(isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];
    echo $the_user_id;
}




if(isset($_POST['edit_user'])) {

//    $user_id = $_POST['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

//    $post_image = $_FILES['image']['name'];
//    $post_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $post_date = date('d-m-y');
//    $post_comment_count = 4;

//    this will take the image that is placed into the server temporarily when a file is selected, and move it into the database on submit
//    move_uploaded_file($post_image_temp, "../images/$post_image");
//
//    this is the query to insert the post from the form into the DB
    $query = "INSERT INTO users(user_firstname,user_lastname,user_role,username,user_email,user_password) ";

//    for any of these values that are strings going into the DB, must use quotes around the value.  $post_category_id, for example though, is a number and does not need quote
    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}') ";


    $create_post_query = mysqli_query($connection, $query);

    confirmQuery($create_post_query);

}


?>


<form action="" method="post" enctype="multipart/form-data">
    <!--enctype multipart/form-data is used here because we are sending multiple types of data in the form, in this example, a file upload as well as plain text-->






    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>







    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <select name="user_role" id="">

            <option value="subscriber">Subscriber</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>

        </select>
    </div>



    <!--    <div class="form-group">-->
    <!--        <label for="post_image"></label>-->
    <!--        <input type="file" name="image">-->
    <!--    </div>-->

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>


</form>