<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category </label>
        <?php
        if (isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];

            $query =  "SELECT * FROM  categories WHERE cat_id = $cat_id";
            $select_all_cat = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_all_cat)) {
                $cat_id =  $row['cat_id'];
                $cat_title =  $row['cat_title'];

        ?>
                <input type="text" value="<?php if (isset($cat_title)) {
                                                echo $cat_title;
                                            } ?>" class="form-control" name="cat_title">

        <?php }
        } ?>
        <?php
        if (isset($_POST['Update_Category'])) {
            $the_cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id}";
            $Update_Category = mysqli_query($connection, $query);
            if (!$Update_Category) {
                die('query failed' . mysqli_error($connection));
            }
        }
        ?>








    </div>
    <div class="form-group">
        <input type="submit" name="Update_Category" class="btn btn-primary" value="Update_Category">

    </div>



</form>