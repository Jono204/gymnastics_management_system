<?php

include 'db.php';

$error = "";
$success = "";

$id = $_GET['id'];

$stmt = $conn->prepare(
    "SELECT * FROM gymnasts WHERE id = ?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();

$gymnast = $result->fetch_assoc();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $fullName = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $contactNo = trim($_POST['contact_no']);
    $trainingProgram = $_POST['training_program'];

    if(empty($fullName) || empty($email)){

        $error = "Please fill in all fields.";

    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){

        $error = "Invalid email format.";

    } else {

        $updateStmt = $conn->prepare(
            "UPDATE gymnasts
            SET full_name = ?, email = ?, contact_no = ?, training_program = ?
            WHERE id = ?"
        );

        $updateStmt->bind_param(
            "ssssi",
            $fullName,
            $email,
            $contactNo,
            $trainingProgram,
            $id
        );

        if($updateStmt->execute()){

            $success = "Gymnast updated successfully!";

            $stmt = $conn->prepare(
                "SELECT * FROM gymnasts WHERE id = ?"
            );

            $stmt->bind_param("i", $id);

            $stmt->execute();

            $result = $stmt->get_result();

            $gymnast = $result->fetch_assoc();

        } else {

            $error = "Update failed.";

        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Update Gymnast</title>

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

<h2>Update Gymnast</h2>

<?php if($error != "") { ?>
    <p class="error"><?php echo $error; ?></p>
<?php } ?>

<?php if($success != "") { ?>
    <p class="success"><?php echo $success; ?></p>
<?php } ?>

<form method="POST">

<input
type="text"
name="full_name"
value="<?php echo htmlspecialchars($gymnast['full_name']); ?>"
>

<input
type="email"
name="email"
value="<?php echo htmlspecialchars($gymnast['email']); ?>"
>

<input
type="text"
name="contact_no"
value="<?php echo htmlspecialchars($gymnast['contact_no']); ?>"
>

<select name="training_program">

<option value="Beginner"
<?php if($gymnast['training_program'] == "Beginner") echo "selected"; ?>>
Beginner
</option>

<option value="Intermediate"
<?php if($gymnast['training_program'] == "Intermediate") echo "selected"; ?>>
Intermediate
</option>

<option value="Advanced"
<?php if($gymnast['training_program'] == "Advanced") echo "selected"; ?>>
Advanced
</option>

</select>

<button type="submit">Update Gymnast</button>

</form>

<br>

<a href="dashboard.php">Back to Dashboard</a>

    </div>
</div>

</body>
</html>