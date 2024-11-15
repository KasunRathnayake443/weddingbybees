<?php
include '../inc/session.php';
include '../inc/config.php';
include '../inc/links.php';
?>

<?php
// Query to get booking details from the bookings table
$sql = "SELECT id, package_name, package_price, customer_name, email, wedding_date, venue, created_at FROM bookings ORDER BY created_at DESC";
$result = $conn->query($sql);

$bookings = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
} else {
    echo "No bookings found.";
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

        <div class="booking-section">
            <h1>Booking Details</h1>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Package Name</th>
                        <th>Package Price</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Wedding Date</th>
                        <th>Venue</th>
                        <th>Date Booked</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display the booking details in the table
                    if (!empty($bookings)) {
                        foreach ($bookings as $booking) {
                            echo "<tr>";
                            echo "<td>" . $booking['id'] . "</td>";
                            echo "<td>" . $booking['package_name'] . "</td>";
                            echo "<td>Rs. " . number_format($booking['package_price'], 2) . "</td>";
                            echo "<td>" . $booking['customer_name'] . "</td>";
                            echo "<td>" . $booking['email'] . "</td>";
                            echo "<td>" . $booking['wedding_date'] . "</td>";
                            echo "<td>" . $booking['venue'] . "</td>";
                            echo "<td>" . $booking['created_at'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No bookings found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>
</html>
