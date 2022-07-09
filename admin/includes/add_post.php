
        <?php
        if(isset($_POST['create_post'])){
          // echo 40;die;
          // var_dump($_POST);
        
          $post_author =  $_POST['post_author'];
          $post_title =  $_POST['post_title'];
          $post_cat_id =  $_POST['post_category'];
          $post_status =  $_POST['post_status'];
          $post_image =  $_FILES['post_image']['name'];
          $post_image_temp = $_FILES['post_image']['tmp_name'];
          $post_tags =  $_POST['post_tags'];
          $post_content =  $_POST['post_content'];
        
         $post_date =  date('d-m-y');

         move_uploaded_file($post_image_temp,"../images/$post_image");
        //  echo $post_author;
        //  echo $post_cat_id;

         $query = "INSERT INTO posts(post_cat_id,post_title,post_author,post_content,post_date,post_image,post_tags,post_status) VALUES ($post_cat_id,' $post_title','$post_author','$post_content',now(),'$post_image',' $post_tags','$post_status')";

         $create_post_query = mysqli_query($connection, $query);

         if(!$create_post_query){
          die("Query FAILED" . mysqli_error($connection));
         }


       





        }
        ?>
    <form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post title</label>
    <input type="text" class="form-control" name="post_title">
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
    <input type="text" class="form-control" name="post_author">
  </div>

  <div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status">
  </div>

  <div class="form-group">
    <label for="post_image">Post images</label>
    <input type="file" class="form-control" name="post_image">
  </div>
  <div class="form-group">
    <label for="post_tags">Post tags</label>
    <input type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" id="" cols="30" rows="10"></textarea>
  </div>
  <div class="form-group">
    
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
  </div>
</form>


    </div>
    
<!-- </body>
</html> -->