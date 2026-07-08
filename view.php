<?php

include 'db.php';

define("ACTIVE", "Active");
define("ON_HOLD", "On Hold");
define("COMPLETED", "Completed");

function getGymnastProfile($conn, $id){

    $stmt = $conn->prepare(
        "SELECT * FROM gymnasts WHERE id = ?"
    );

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_assoc();
}

$id = $_GET['id'];

$gymnast = getGymnastProfile($conn, $id);

$status = ACTIVE;

?>

<!DOCTYPE html>
<html>
<head>

<title>Gymnast Profile</title>

<link rel="stylesheet" href="style.css">

<style>

body{
    font-family: Arial;
    background: #f5f5f5;
}

h2{
    color: #1976D2;
}

.profile-item{
    margin-bottom: 15px;
}

.label{
    font-weight: bold;
}

.status{
    color: green;
    font-weight: bold;
}

a{
    text-decoration: none;
    background: #1976D2;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    margin-right: 10px;
}

</style>

</head>

<body>

<div class="page">
    <div class="card">

<h2>Gymnast Profile</h2>

<div class="profile-item">
    <span class="label">Full Name:</span>
    <?php echo htmlspecialchars($gymnast['full_name']); ?>
</div>

<div class="profile-item">
    <span class="label">Membership ID:</span>
    <?php echo htmlspecialchars($gymnast['membership_id']); ?>
</div>

<div class="profile-item">
    <span class="label">Email:</span>
    <?php echo htmlspecialchars($gymnast['email']); ?>
</div>

<div class="profile-item">
    <span class="label">Contact Number:</span>
    <?php echo htmlspecialchars($gymnast['contact_no']); ?>
</div>

<div class="profile-item">
    <span class="label">Date of Birth:</span>
    <?php echo htmlspecialchars($gymnast['date_of_birth']); ?>
</div>

<div class="profile-item">
    <span class="label">Training Program:</span>
    <?php echo htmlspecialchars($gymnast['training_program']); ?>
</div>

<div class="profile-item">
    <span class="label">Enrollment Date:</span>
    <?php echo htmlspecialchars($gymnast['enrollment_date']); ?>
</div>

<div class="profile-item">
    <span class="label">Performance Status:</span>

    <span class="status">
        <?php echo $status; ?>
    </span>
</div>

<br>

<a href="dashboard.php">Back to Dashboard</a>

    </div>
</div>

<br><br>

<div style="text-align:center; margin-top:25px;">
    
    <a href="report.php?id=<?php echo $gymnast['id']; ?>" class="button">
        Profile Report
    </a>

    <a href="confirmation.php?id=<?php echo $gymnast['id']; ?>" class="button">
        Confirmation Slip
    </a>

</div>

</body>
</html>