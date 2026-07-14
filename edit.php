<?php
include 'dbManager.php';

if (!isset($_GET['id'])) {
    echo ("No ID");
    exit;
}

$id = intval($_GET['id']);
$current = getApplicantById($id);

if(!$current) {
    echo ("No Data");
}

if ($_SERVER['REQUEST_METHOD']=='POST') {
   $name=$_POST['name'];
   $email=$_POST['email'];
   $phone=$_POST['phone'];
   $education=$_POST['education'];
   $gpa=$_POST['gpa'];

   if (editData($id, $name, $email, $phone, $education, $gpa)) {
       header("Location: index.php");
       exit;
   } else {
       echo ("Failed to update data.");
   }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Applicant</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial;
            margin: 40px;
            color: #333;
        }

        h2 {
            color: #4444aa;
        }

        form {
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: inline-block;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 250px;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4444aa;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #333388;
        }

        a {
            margin-left: 10px;
            color: #4444aa;
        }
    </style>
</head>
<body>
    <h2>Edit Applicant Details</h2>
    
    <form method="post">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $current['name']; ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $current['email']; ?>" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="<?php echo $current['phone']; ?>"><br><br>

        <label>Education:</label><br>
        <input type="text" name="education" value="<?php echo $current['education']; ?>"><br><br>

        <label>GPA:</label><br>
        <input type="text" name="gpa" value="<?php echo $current['gpa']; ?>"><br><br>

        <button type="submit">Save Changes</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>