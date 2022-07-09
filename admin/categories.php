<?php include 'includes/header.php' ?>

<div id="wrapper">

<!-- Navigation -->
<?php include 'includes/nav.php' ?>

<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
Welcome to Admins
<small>Author</small>
</h1>
<div class="col-xs-6">
<?php
if (isset($_POST['submit'])) {
$cat_title = $_POST['cat_title'];
if ($cat_title == " " || empty($cat_title)) {
echo " field should not be empty";
} else {
$query = "INSERT INTO categories(cat_title)";
$query .= "VALUE('{$cat_title}') ";
$create_cat = mysqli_query($connection, $query);
if (!$create_cat) {
    die('query failed' . mysqli_error($connection));
}
}
}

?>


<form action="" method="post">
<div class="form-group">
<label for="cat_title">Add Category </label>
<input type="text" class="form-control" name="cat_title">

</div>
<div class="form-group">
<input type="submit" name="submit" class="btn btn-primary" value="Add Category">

</div>



</form>
<?php if (isset($_GET['edit'])) {
$cat_id = $_GET['edit'];

include "includes/update_cat.php";
}
?>
</div>

<div class="col-xs-6">


<?php
?>
<table class="table table-bordered">
<thead>
<tr>
    <th>ID</th>
    <th>Category_Title</th>
</tr>
</thead>
<tbody>
<?php


$query = "SELECT * FROM  categories ";
$select_all_cat = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_all_cat)) {
    $cat_id =  $row['cat_id'];
    $cat_title =  $row['cat_title'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete<a/></td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit<a/></td>";
    echo "</tr>";
}
?>
<?php
if (isset($_GET['delete'])) {
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = $the_cat_id";
    $delete = mysqli_query($connection, $query);

    header("Location:categories.php");
}

?>

</tbody>
</table>
</div>

</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include 'includes/footer.php' ?>