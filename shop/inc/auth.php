<?php
session_start();
include('config.php'); 
include('session.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
 
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
  
    if ($_FILES['profile_image']['name']) {
        $profileImage = $_FILES['profile_image']['name'];
        $targetDir = "../../images/profile_pics/";
        $targetFile = $targetDir . basename($profileImage);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile);
    } else {
        $profileImage = null;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO customer (name, email, phone, address, password, profile_pic) 
            VALUES ('$name', '$email', '$phone', '$address', '$hashedPassword', '$profileImage')";
    
    if (mysqli_query($conn, $sql)) {
     
        $_SESSION['customer_id'] = mysqli_insert_id($conn); 
        header('Location: ../shop.php'); 
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

   
    $sql = "SELECT * FROM customer WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
     
        if (password_verify($password, $row['password'])) {
            login($row['id']); 
            header('Location: ../shop.php'); 
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that email!";
    }
}
?>

<?php
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    logout();
}
?>
