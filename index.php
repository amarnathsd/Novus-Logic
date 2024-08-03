<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Application</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Users List</h2>
    <a href="add.php">Add New User</a>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Address</th>
                <th>Hobbies</th>
                <th>Display Pic</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['dob']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['hobbies']}</td>
                        <td><img src='uploads/{$row['display_pic']}' width='50'></td>
                        <td>
                            <a href='view.php?id={$row['id']}'>View</a> |
                            <a href='edit.php?id={$row['id']}'>Edit</a> |
                            <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
