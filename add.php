<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Add User</h2>
    <form action="add.php" method="POST" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female<br>
        <label>DOB:</label>
        <input type="date" name="dob" required><br>
        <label>Address:</label>
        <textarea name="address" required></textarea><br>
        <label>Hobbies:</label>
        <select name="hobbies[]" multiple required>
            <option value="Reading">Reading</option>
            <option value="Traveling">Traveling</option>
            <option value="Swimming">Swimming</option>
        </select><br>
        <label>Display Pic:</label>
        <input type="file" name="display_pic" required><br>
        <input type="submit" name="submit" value="Add User">
    </form>
    <a href="index.php">Back to List</a>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $hobbies = implode(', ', $_POST['hobbies']);
    $display_pic = $_FILES['display_pic']['name'];
    $target = "uploads/" . basename($display_pic);

    $sql = "INSERT INTO users (name, gender, dob, address, hobbies, display_pic) VALUES ('$name', '$gender', '$dob', '$address', '$hobbies', '$display_pic')";

    if ($conn->query($sql) === TRUE) {
        move_uploaded_file($_FILES['display_pic']['tmp_name'], $target);
        echo "New record created successfully";
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
