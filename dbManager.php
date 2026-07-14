<?php
function getDBConn() {
    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "resume_scanner";

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("connection error: " . $conn->connect_error);
    }

    return $conn;
}

function saveApplicant($name, $email, $phone, $education, $gpa) {
    $conn = getDBConn();

    $sql = "INSERT INTO applicants (name, email, phone, education, gpa) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $phone, $education, $gpa);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

function getAllApplicants() {
    $conn = getDBConn();
    
    $sql = "SELECT id, name, email, phone, education, gpa FROM applicants ORDER BY id DESC";
    $result = $conn->query($sql);
    
    $applicants = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $applicants[] = $row;
        }
    }
    
    $conn->close();
    return $applicants;
}

function editData($id, $newName, $newEmail, $newPhone, $newEdu, $newGpa) {
    $conn = getDBconn();

    $sql = "UPDATE applicants SET name= ?, email = ?, phone = ?, education = ?, gpa = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi",$newName,$newEmail,$newPhone,$newEdu,$newGpa,$id);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

function deleteApplicant($id) {
    $conn = getDBConn();
    $sql = "DELETE FROM applicants WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

function getApplicantById($id) {
    $conn = getDBConn();
    $sql = "SELECT id, name, email, phone, education, gpa FROM applicants WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $applicant = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $applicant;
}
?>