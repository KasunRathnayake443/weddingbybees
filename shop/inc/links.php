<?php 
$sql_general_settings = "SELECT * FROM general_settings WHERE id = 1";
$result_general_settings = $conn->query($sql_general_settings);
$result_general = $result_general_settings->fetch_assoc();

?>