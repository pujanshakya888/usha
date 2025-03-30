<?php 
include_once 'include/config.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("location:login.php");
    exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT username as user_name, user_email FROM users WHERE user_id = '$user_id'";
$run = mysqli_query($conn, $sql);
$user_data = mysqli_fetch_assoc($run);

if (!$user_data) {
    die("User data not found");
}

// Handle password change
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        $hashed_password = md5($new_password);
        $update_sql = "UPDATE users SET user_password = '$hashed_password' WHERE user_id = '$user_id'";
        if (mysqli_query($conn, $update_sql)) {
            header("Location: dashboard.php"); // Redirect to dashboard after successful password change
            exit();

            echo "Password changed successfully.";
        } else {
            echo "Error updating password: " . mysqli_error($conn);
        }
    } else {
        echo "Passwords do not match.";
    }
}
?>

<?php include_once './include/header.php'; ?>       
<div class="mx-3 shadow-lg p-3 m-2"> 
    <div class="row">
        <div class="col-12 col-md-12">
            <h1 class="text-center">Change Password</h1>
        </div>
    </div>
</div>
<div class="mx-3 shadow p-3 m-2"> 
    <form method="POST">
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
</div>
<?php include_once 'include/footer.php'; ?>
