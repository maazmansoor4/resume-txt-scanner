<?php
include 'dbManager.php';
$applicants = getAllApplicants();
?>
<!DOCTYPE html>
<html>

<head>
<style>
    body {
        background-color: #f0f0f0;
        font-family: Arial;
        margin: 40px;
        color: #333;
    }

    h1 {
        color: #4444aa;
    }

    form {
        background-color: white;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: #4444aa;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        margin-top: 10px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #333388;
    }

    table {
        background-color: white;
        border-collapse: collapse;
    }

    th {
        background-color: #4444aa;
        color: white;
        padding: 8px;
    }

    td {
        padding: 8px;
    }

    .error {
        color: red;
    }
</style>
</head>

<body>


    <h1> Resume Reader</h1><br>

    <form method="post" action="processor.php"   enctype="multipart/form-data">
        <input type="file" name="upload" id="upload" accept=".txt" required><br>
        <input type="submit">
        <?php if (isset($_GET["error"])) { echo '<p class="error">' . htmlspecialchars($_GET["error"]) . '</p>'; } ?>
    </form>

    <br><br>

    <h2>Scanned Applicants</h2>
<table border="1" id="applicantsTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Education</th>
            <th>GPA</th>
            <th>Actions</th> </tr>
    </thead>
    <tbody>
<?php
foreach ($applicants as $row) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["phone"] . "</td>";
    echo "<td>" . $row["education"] . "</td>";
    echo "<td>" . $row["gpa"] . "</td>";
    echo "<td>";
    echo '<a href="edit.php?id=' . $row["id"] . '">Edit</a> | ';
    echo '<a href="actionHandler.php?action=delete&id=' . $row["id"] . '" style="color: red;">Delete</a>';
    echo "</td>";
    echo "</tr>";
}
?>
    </tbody>
</table>