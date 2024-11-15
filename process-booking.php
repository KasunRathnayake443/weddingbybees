<?php



include 'inc/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $package_price = mysqli_real_escape_string($conn, $_POST['package_price']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $wedding_date = mysqli_real_escape_string($conn, $_POST['wedding_date']);
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);

   
    $sql = "INSERT INTO bookings (package_name, package_price, customer_name, email, wedding_date, venue)
            VALUES ('$package_name', '$package_price', '$customer_name', '$email', '$wedding_date', '$venue')";

    if (mysqli_query($conn, $sql)) {
       
        echo "<script>
               
                window.location.href = 'index.php?notifications2=1'; 
              </script>";
    } else {
        
        echo "Error: " . mysqli_error($conn);
    }

  
    mysqli_close($conn);
} else {
  
    echo "Invalid request.";
}
?>
