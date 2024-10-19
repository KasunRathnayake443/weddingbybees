<?php
include 'config.php';

$sql_general_settings = "SELECT * FROM general_settings WHERE id = 1";
$result_general_settings = $conn->query($sql_general_settings);
$result_general = $result_general_settings->fetch_assoc();

?>

<link rel="shortcut icon" href="../images/logo/<?php echo $result_general['logo']?>" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="../css/alerts.css">
<link rel="stylesheet" href="../css/header.css">