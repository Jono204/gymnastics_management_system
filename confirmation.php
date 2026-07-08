<?php

include 'db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM gymnasts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$gymnast = $result->fetch_assoc();
if (!$gymnast) {
    die("<h2 style='text-align:center;color:red;'>Invalid gymnast ID.</h2>");
}

$timestamp = date("Y-m-d H:i:s");

define("ACTIVE", "Active");

?>

<!DOCTYPE html>
<html>
<head>

<title>Confirmation Slip</title>

<link rel="stylesheet" href="style.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<style>

body{
    font-family: Arial;
    background: #f5f5f5;
}

h2{
    text-align: center;
    color: #1976D2;
}

.item{
    margin-bottom: 10px;
}

button{
    padding: 10px;
    background: #1976D2;
    color: white;
    border: none;
    margin-top: 15px;
}

.status{
    color: green;
    font-weight: bold;
}

</style>

</head>

<body>

<div class="page">
    <div class="card">

<h2>Enrollment Confirmation Slip</h2>

<div class="item">Name: <?php echo htmlspecialchars($gymnast['full_name']); ?></div>
<div class="item">Membership ID: <?php echo htmlspecialchars($gymnast['membership_id']); ?></div>
<div class="item">Program: <?php echo htmlspecialchars($gymnast['training_program']); ?></div>
<div class="item">Enrollment Date: <?php echo htmlspecialchars($gymnast['enrollment_date']); ?></div>
<div class="item">Registered: <?php echo $timestamp; ?></div>

<div class="item status">
Status: <?php echo ACTIVE; ?>
</div>

<button onclick="downloadSlip()">Download PDF</button>

    </div>
</div>

<script>

function downloadSlip(){

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.text("Enrollment Confirmation Slip", 20, 20);

    doc.text("Name: <?php echo $gymnast['full_name']; ?>", 20, 40);
    doc.text("ID: <?php echo $gymnast['membership_id']; ?>", 20, 50);
    doc.text("Program: <?php echo $gymnast['training_program']; ?>", 20, 60);
    doc.text("Enrollment: <?php echo $gymnast['enrollment_date']; ?>", 20, 70);
    doc.text("Status: Active", 20, 80);

    doc.save("confirmation_slip.pdf");
}

</script>

</body>
</html>