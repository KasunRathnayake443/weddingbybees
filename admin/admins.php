<?php
include '../inc/session.php';
include '../inc/config.php';
include '../inc/links.php';

$sql_admins = "SELECT * FROM users";
$result_admins = $conn->query($sql_admins);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_admin'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);
    $stmt->execute();
    echo "<script> document.location='admins.php?notifications1=1';</script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_admin'])) {
    $admin_id = $_POST['admin_id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    echo "<script> document.location='admins.php?notifications2=1';</script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_admin'])) {
    $admin_id = $_POST['edit_admin_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $hashed_password, $admin_id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $email, $admin_id);
    }
    $stmt->execute();
    echo "<script> document.location='admins.php?notifications3=1';</script>";
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
        <h1>Admins Management</h1>

     
        <table>
    <thead>
        <tr>
            <th>Admin ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result_admins->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <button class="edit-btn" 
                            onclick="openEditModal('<?php echo $row['id']; ?>', 
                                                   '<?php echo addslashes($row['name']); ?>', 
                                                   '<?php echo addslashes($row['email']); ?>')">
                        Edit
                    </button>

                    <form style="display:inline-block; border-color:transparent; background-color: transparent;" action="admins.php" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this admin?');">
                        <input type="hidden" name="admin_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_admin" class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div id="editModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Admin</h2>
        <form id="editForm" action="admins.php" method="POST">
            <input type="hidden" name="edit_admin_id" id="edit_admin_id">

            <label for="edit_name">Admin Name:</label>
            <input type="text" name="name" id="edit_name" required>

            <label for="edit_email">Admin Email:</label>
            <input type="email" name="email" id="edit_email" required>

            <label for="edit_password">Password (Leave blank to keep existing):</label>
            <input type="password" name="password" id="edit_password">

            <button type="submit" name="update_admin">Update Admin</button>
        </form>
    </div>
</div>


   
        <h2>Add New Admin</h2>
        <form action="admins.php" method="POST">
            <label for="name">Admin Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Admin Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" name="add_admin">Add Admin</button>
        </form>
    </div>
</div>


<script>
function openEditModal(adminId, adminName, adminEmail) {
    document.getElementById('edit_admin_id').value = adminId;
    document.getElementById('edit_name').value = adminName;
    document.getElementById('edit_email').value = adminEmail;
    document.getElementById('edit_password').value = '';

    document.getElementById('editModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}
</script>


<script src="../js/notifications.js"></script>



                <div class="success2" id="alertBox1">
                    <i class="fa fa-check  fa-2x"></i> 
                    <span class="message-text">New Admin Added Successfully</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>

                <div class="alert2" id="alertBox2">
                    <i class="fa fa-trash  fa-2x"></i> 
                    <span class="message-text">Admin Deleted Successfully</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
                <div class="success2" id="alertBox3">
                    <i class="fa fa-check  fa-2x"></i> 
                    <span class="message-text">Admin Updated Successfully</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>


</body>
</html>
