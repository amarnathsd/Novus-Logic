<?php include('config.php'); ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form action="edit.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" <?php echo ($row['gender'] == 'Male') ? 'checked' : ''; ?> required> Male
        <input type="radio" name="gender" value="Female" <?php echo ($row['gender'] == 'Female') ? 'checked' : ''; ?> required> Female<br>
        <label>DOB:</label>
        <input type="date" name="dob" value="<?php echo $row['dob']; ?>" required><br>
        <label>Address:</label>
        <textarea name="address" required><?php echo $row['address']; ?></textarea><br>
        <label>Hobbies:</label>
        <select name="hobbies[]" multiple required>
            <option value="Reading" <?php echo (strpos($row['hobbies'], 'Reading') !== false) ? 'selected' : ''; ?>>Reading</option>
            <option value="Traveling" <?php echo (strpos($row['hobbies'], 'Traveling') !== false) ? 'selected' : ''; ?>>Traveling</option>
            <option value="Swimming" <?php echo (strpos($row['hobbies'], 'Swimming') !== false) ? 'selected' : ''; ?>>Swimming</option>
        </select><br>
        <label>Display Pic:</label>
        <input type="file" name="display_pic"><br>
        <img src="uploads/<?php echo $row['display_pic']; ?>" width="50"><br>
        <input type="submit" name="update" value="Update User">
    </form>
    <a href="index.php">Back to List</a>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $hobbies = implode(', ', $_POST['hobbies']);
    $display_pic = $_FILES['display_pic']['name'];
    if ($display_pic) {
        $target = "uploads/" . basename($display_pic);
        move_uploaded_file($_FILES['display_pic']['tmp_name'], $target);
        $sql = "UPDATE users SET name='$name', gender='$gender', dob='$dob', address='$address', hobbies='$hobbies', display_pic='$display_pic' WHERE id=$id";
    } else {
        $sql = "UPDATE users SET name='$name', gender='$gender', dob='$dob', address='$address', hobbies='$hobbies' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
