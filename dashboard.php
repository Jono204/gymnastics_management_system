<?php
include 'db.php';

$sql = "SELECT * FROM gymnasts";
$result = $conn->query($sql);

$gymnasts = [];

while($row = $result->fetch_assoc()) {
    $gymnasts[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link rel="stylesheet" href="style.css">

<style>

body{
    font-family: Arial;
    background: #f5f5f5;
}


table{
    width: 100%;
    border-collapse: collapse;
    background: white;
}

th, td{
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

th{
    background: #1976D2;
    color: white;
}

a{
    text-decoration: none;
    padding: 5px 10px;
}

.delete{
    color: red;
}

</style>

<script>

function confirmDelete(){
    return confirm("Are you sure you want to delete this gymnast?");
}

</script>

</head>

<body>

<div class="page">
    <div class="card">

<h2>Gymnast Dashboard</h2>

<table>

<tr>
<th>Name</th>
<th>Membership ID</th>
<th>Email</th>
<th>Program</th>
<th>Actions</th>
</tr>

<?php foreach($gymnasts as $gymnast) { ?>

<tr>

<td><?php echo htmlspecialchars($gymnast['full_name']); ?></td>

<td><?php echo htmlspecialchars($gymnast['membership_id']); ?></td>

<td><?php echo htmlspecialchars($gymnast['email']); ?></td>

<td><?php echo htmlspecialchars($gymnast['training_program']); ?></td>

<td>

<a href="view.php?id=<?php echo $gymnast['id']; ?>">View</a>

<a href="update.php?id=<?php echo $gymnast['id']; ?>">Update</a>

<a
class="delete"
href="delete.php?id=<?php echo $gymnast['id']; ?>"
onclick="return confirmDelete()"
>
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

    </div>
</div>

</body>
</html>