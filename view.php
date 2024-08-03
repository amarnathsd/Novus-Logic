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
    <title>View User</title>
</head>
<body>
    <h2>View User</h2>
    <p>Name: <?php echo $row['name']; ?></p>
    <p>Gender: <?php echo $row['gender']; ?></p>
    <p>DOB: <?php echo $row['dob']; ?></p>
    <p>Address: <?php echo $row['address']; ?></p>
    <p>Hobbies: <?php echo $row['hobbies']; ?></p>
    <p>Display Pic: <img src="uploads/<?php echo $row['display_pic']; ?>" width="100"></p>
    <a href="index.php">Back to List</a>
</body>
</html>
