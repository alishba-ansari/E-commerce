<?php
 include 'header.php';
 include 'insert.php';
 $query = "select * from users ";
 $result = $conn->query($query);

?>

<form action="" class="ml-100">

<select name="user" id="">

<?php while($row=$result->fetch_assoc()){   ?>
<option value="<?php echo $row['Id'] ?>"><?php echo $row['Username'] ?></option>
<?php  } ?>

</select>

</form>
