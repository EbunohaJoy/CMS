 <?php

if(isset($_GET['p_id'])){
  $the_post_id =  $_GET['p_id'];
}


$query = "SELECT * FROM  posts WHERE post_id = $the_post_id ";
$select_post_by_id = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_post_by_id)) {
    $post_id =  $row['post_id'];
    $post_author =  $row['post_author'];
    $post_title =  $row['post_title'];
    $post_cat_id =  $row['post_cat_id'];
    $post_status =  $row['post_status'];
    $post_content =  $row['post_content'];
   $post_image =  $row['post_image'];
    $post_tags =  $row['post_tags'];
    $post_comment_count =  $row['post_comment_count'];
   $post_date =  $row['post_date'];
}

if(isset($_POST['update_post'])){
  // echo 0; die;
  
  $post_author =  $_POST['post_author'];
  $post_title =  $_POST['post_title'];
  $post_category =  $_POST['post_category'];
  $post_status =  $_POST['post_status'];
  $post_image =  $_FILES['post_image']['name'];
  $post_image_temp = $_FILES['post_image']['tmp_name'];
  $post_tags =  $_POST['post_tags'];
  $post_content =  $_POST['post_content'];
  $post_comment_count = 4;
 $post_date =  date('d-m-y');


  move_uploaded_file($post_image_temp,"../images/$post_image");

  if(empty($post_image)){
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_image = mysqli_query($connection,$query);

    while($row = mysqli_fetch_array($select_image)){
      $post_image = $row['post_image'];
    }
  }



  $update_query =  "UPDATE posts SET post_author='{$post_author}',post_title='{$post_title}',post_cat_id='{$post_category}',post_date = now(),post_status='{$post_status}',post_content='{$post_content}',post_image='{$post_image}' WHERE post_id= {$the_post_id}";

  // $query = "UPADATE posts SET";
  // $query .="post_author = '{$post_author}', " ;
  // $query .="post_title = '{$post_title}'," ;
  // $query .="post_cat_id = '{$post_cat_id}', " ;
  // $query .="post_date = now() ," ;
  // $query .="post_status = '{$post_status}', " ;
  // $query .="post_content = '{$post_content}'," ;
  // $query .="post_image = '{$post_image}'" ;
  // $query .="WHERE post_id = '{$the_post_id}' " ;

  $update = mysqli_query($connection,$update_query);

  if (!$update) {
    die('query failed' . mysqli_error($connection));
}

  

 
}
   ?>
    <form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post title</label>
    <input type="text" class="form-control" name="post_title" value="<?php  echo  $post_title?>">
  </div>
  <div class="form-group">
   <select name="post_category" id="post_category">
    <?php
      $query =  "SELECT * FROM  categories";
      $select_cat = mysqli_query($connection, $query);
      if (!$select_cat) {
        die('query failed' . mysqli_error($connection));
    }
      while ($row = mysqli_fetch_assoc($select_cat)) {
          $cat_id =  $row['cat_id'];
          $cat_title =  $row['cat_title'];
          echo "<option value='$cat_id'>$cat_title</option>";
      }
    
    ?>

   </select>
  
  </div>
  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input value="<?php  echo $post_author ?>" type="text" class="form-control" name="post_author">
  </div>

  <div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status" value="<?php  echo $post_status ?>">
  </div>

  <div class="form-group">

 
    <img width="100" src="../images/<?php echo $post_image ?>" alt="" name="post_image">
    <input type="file" class="form-control" name="post_image">
    </div>
  <div class="form-group">
    <label for="post_tags">Post tags</label>
    <input type="text" class="form-control" name="post_tags"  value="<?php  echo $post_tags ?>">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea  value="" name="post_content" id="" cols="30" rows="10">
    <?php  echo $post_content ?>
    </textarea>
  </div>
  <div class="form-group">
    
    <input type="submit" class="btn btn-primary" name="update_post" value="update_post">
  </div>
</form>


    </div>
    
<!-- </body>
</html> -->