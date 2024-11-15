<?php
include '../inc/session.php';
include '../inc/config.php';
include '../inc/links.php';


$sql = "SELECT * FROM services";
$result = $conn->query($sql);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_service'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "../images/services/" . basename($image_name);

    
    move_uploaded_file($image_tmp, $image_path);

   
    $stmt = $conn->prepare("INSERT INTO services (name, description, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $description, $image_name);
    $stmt->execute();
    echo "<script> document.location='services.php?notifications1=1';</script>";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $service_id = $_POST['id'];

   
    $stmt = $conn->prepare("DELETE FROM services WHERE id = ?");
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    echo "<script> document.location='services.php?notifications2=1';</script>";
}


$service_to_edit = null; 
if (isset($_POST['edit_service_id'])) {
    $service_id = $_POST['edit_service_id'];

   
    $stmt = $conn->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $service_to_edit = $stmt->get_result()->fetch_assoc();

   
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_service'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];

       
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_path = "../images/services/" . basename($image_name);

            
            move_uploaded_file($image_tmp, $image_path);

            
            $stmt = $conn->prepare("UPDATE services SET name = ?, description = ?, image = ? WHERE id = ?");
            $stmt->bind_param("sssi", $name, $description, $image_name, $service_id);
        } else {
           
            $stmt = $conn->prepare("UPDATE services SET name = ?, description = ? WHERE id = ?");
            $stmt->bind_param("ssi", $name, $description, $service_id);
        }

        if ($stmt->execute()) {
          
            echo "<script> document.location='services.php?notifications3=1';</script>";
            exit();
        }
    }
}




if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_service'])) {
    $service_id = $_POST['edit_service_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

   
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "../images/services/" . basename($image_name);
        move_uploaded_file($image_tmp, $image_path);

        
        $stmt = $conn->prepare("UPDATE services SET name = ?, description = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $description, $image_name, $service_id);
    } else {
      
        $stmt = $conn->prepare("UPDATE services SET name = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $description, $service_id);
    }

    if ($stmt->execute()) {
       
        header("Location: services.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../inc/title.php'; ?>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>

<div class="dashboard-container">
    <?php include 'header.php'; ?>

    <div class="main-content">
        <h1>Services Management</h1>

        <table>
            <thead>
                <tr>
                    <th>Service ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td style="width:100px;"><?php echo $row['id']; ?></td>
                        <td style="width:100px;"><?php echo $row['name']; ?></td>
                        <td style="width:100px;"><?php echo $row['description']; ?></td>
                        <td style="width:100px;"><img src="../images/services/<?php echo $row['image']; ?>" alt="Service Image" class="service-img"></td>
                        <td style="width:100px;">
                        <button class="edit-btn" onclick="openEditModal('<?php echo $row['id']; ?>', '<?php echo addslashes($row['name']); ?>', '<?php echo addslashes($row['description']); ?>')">Edit</button>

                            <form style="display:inline-block; border-color:transparent; background-color: transparent;" action="services.php" method="post" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h2>Add New Service</h2>
        <form action="services.php" method="POST" enctype="multipart/form-data">
            <label for="name">Service Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="description">Service Description:</label>
            <textarea name="description" id="description" required></textarea>

            <label for="image">Service Image:</label>
            <input type="file" name="image" id="image" required>

            <button type="submit" name="add_service">Add Service</button>
        </form>
    </div>


    <div id="editModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Service</h2>
        <form id="editForm" action="services.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="edit_service_id" id="edit_service_id">
            
            <label for="edit_name">Service Name:</label>
            <input type="text" name="name" id="edit_name" required>

            <label for="edit_description">Service Description:</label>
            <textarea name="description" id="edit_description" required></textarea>

            <label for="edit_image">Service Image (Leave blank to keep existing):</label>
            <input type="file" name="image" id="edit_image">

            <button type="submit" name="update_service">Update Service</button>
        </form>
    </div>
</div>



    <script>
   
   function openEditModal(serviceId, serviceName, serviceDescription) {
    document.getElementById('edit_service_id').value = serviceId;
    document.getElementById('edit_name').value = serviceName;
    document.getElementById('edit_description').value = serviceDescription;

    document.getElementById('editModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

</script>

                <div class="success2" id="alertBox1">
                    <i class="fa fa-check  fa-2x"></i> 
                    <span class="message-text">New Service Added Successfully</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>

                <div class="alert2" id="alertBox2">
                    <i class="fa fa-trash  fa-2x"></i> 
                    <span class="message-text">Service Deleted Successfully</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
                <div class="success2" id="alertBox3">
                    <i class="fa fa-check  fa-2x"></i> 
                    <span class="message-text">Services Updated Successfully</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>


<script src="../js/notifications.js"></script>
</body>
</html>


