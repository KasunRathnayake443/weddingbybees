<?php
include '../inc/session.php';
include '../inc/config.php';
include '../inc/links.php';
?>


<?php



$sql = "SELECT id, name, email, subject, message, created_at FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);

$messages = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
} else {
    echo "No messages found.";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../inc/title.php'?>
      <link rel="stylesheet" href="../css/dashboard.css">
   
</head>
<body>
<div class="dashboard-container">

    <?php include 'header.php' ?>
        <div class="main-content">         


        <div class="message-section">
    <h1>Customer Messages</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date Received</th>
            </tr>
        </thead>
        <tbody>
            <?php
              

            if (!empty($messages)) {
                foreach ($messages as $message) {
                    echo "<tr>";
                    echo "<td>" . $message['id'] . "</td>";
                    echo "<td>" . $message['name'] . "</td>";
                    echo "<td>" . $message['email'] . "</td>";
                    echo "<td>" . $message['subject'] . "</td>";
                    echo "<td>" . $message['message'] . "</td>";
                    echo "<td>" . $message['created_at'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No messages found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>



</div>

</div>


</body>
</html>

