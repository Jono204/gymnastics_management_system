<?php
include 'db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullName = trim($_POST['full_name']);
    $membershipID = trim($_POST['membership_id']);
    $email = trim($_POST['email']);
    $contactNo = trim($_POST['contact_no']);
    $dob = $_POST['date_of_birth'];
    $trainingProgram = $_POST['training_program'];
    $enrollmentDate = $_POST['enrollment_date'];

    if (
        empty($fullName) ||
        empty($membershipID) ||
        empty($email) ||
        empty($contactNo)
    ) {

        $error = "All fields are required.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Invalid email format.";

    } elseif (!preg_match("/^[0-9]+$/", $contactNo)) {

        $error = "Contact number must contain only numbers.";

    } else {

        $stmt = $conn->prepare("INSERT INTO gymnasts 
        (full_name, membership_id, email, contact_no, date_of_birth, training_program, enrollment_date)
        VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "sssssss",
            $fullName,
            $membershipID,
            $email,
            $contactNo,
            $dob,
            $trainingProgram,
            $enrollmentDate
        );

        if ($stmt->execute()) {
            $success = "Gymnast registered successfully!";
        } else {
            $error = "Error registering gymnast.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    
<title>Gymnast Registration</title>

<link rel="stylesheet" href="style.css">

<style>

body{
    font-family: Arial;
    background: #f5f5f5;
}

h2{
    text-align: center;
    color: #1976D2;
}

input, select{
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    margin-bottom: 15px;
}

button{
    width: 100%;
    padding: 12px;
    background: #1976D2;
    color: white;
    border: none;
    cursor: pointer;
}

.error{
    color: red;
}

.success{
    color: green;
}

</style>

</head>

<body>

<div class="page">
    <div class="card">

<h2>Gymnast Registration</h2>

<?php if($error != "") { ?>
    <p class="error"><?php echo $error; ?></p>
<?php } ?>

<?php if($success != "") { ?>
    <p class="success"><?php echo $success; ?></p>
<?php } ?>

<form method="POST">

<input type="text" name="full_name" placeholder="Full Name">

<input type="text" name="membership_id" placeholder="Membership ID">

<input type="email" name="email" placeholder="Email">

<input type="text" name="contact_no" placeholder="Contact Number">

<input type="date" name="date_of_birth">

<select name="training_program">

<option value="Beginner">Beginner</option>
<option value="Intermediate">Intermediate</option>
<option value="Advanced">Advanced</option>

</select>

<input type="date" name="enrollment_date">

<button type="submit">Register Gymnast</button>

</form>

</div>
</div>

</body>
</html>