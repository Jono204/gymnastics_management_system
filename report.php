<?php

include 'db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM gymnasts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

$gymnast = $result->fetch_assoc();

if (!$gymnast) {
    die("<h2 style='text-align:center;color:red;'>No gymnast found for this ID.</h2>");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Profile Report</title>

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
    cursor: pointer;
    margin-top: 15px;
}

</style>

</head>

<body>

<div class="page">
    <div class="card" id="content">

<h2>Gymnast Profile Report</h2>

<div class="item">Name: <?php echo htmlspecialchars($gymnast['full_name']); ?></div>
<div class="item">Membership ID: <?php echo htmlspecialchars($gymnast['membership_id']); ?></div>
<div class="item">Email: <?php echo htmlspecialchars($gymnast['email']); ?></div>
<div class="item">DOB: <?php echo htmlspecialchars($gymnast['date_of_birth']); ?></div>
<div class="item">Program: <?php echo htmlspecialchars($gymnast['training_program']); ?></div>
<div class="item">Enrollment Date: <?php echo htmlspecialchars($gymnast['enrollment_date']); ?></div>

<button onclick="downloadPDF()">Download PDF</button>

    </div>
</div>
<script>

function downloadPDF(){

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.text("Gymnast Profile Report", 20, 20);

    doc.text("Name: <?php echo $gymnast['full_name']; ?>", 20, 40);
    doc.text("ID: <?php echo $gymnast['membership_id']; ?>", 20, 50);
    doc.text("Email: <?php echo $gymnast['email']; ?>", 20, 60);
    doc.text("Program: <?php echo $gymnast['training_program']; ?>", 20, 70);
    doc.text("Enrollment: <?php echo $gymnast['enrollment_date']; ?>", 20, 80);

    doc.save("profile_report.pdf");
}

</script>

</body>
</html>