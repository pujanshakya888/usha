<?php 
include_once 'include/config.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("location:login.php");
    exit();
}

// Check if current user is admin
$is_admin = false;
if (isset($_SESSION['user_email']) && $_SESSION['user_email'] === 'admin@gmail.com') {
    // Verify admin password (assuming it's stored as MD5 in database)
    $sql = "SELECT user_password FROM users WHERE user_email = 'admin@gmail.com'";
    $result = mysqli_query($conn, $sql);
    $admin_data = mysqli_fetch_assoc($result);
    
    if ($admin_data && $admin_data['user_password'] === md5('admin')) {
        $is_admin = true;
    }
}

// Fetch current user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT username as user_name, user_email, user_mobile FROM users WHERE user_id = '$user_id'";
$run = mysqli_query($conn, $sql);
$user_data = mysqli_fetch_assoc($run);

if (!$user_data) {
    die("User data not found");
}
?>

<?php include_once './include/header.php'; ?>       
<div class="mx-3 shadow-lg p-3 m-2"> 
    <div class="row">
        <div class="col-12 col-md-12">
            <h1 class="text-center">User Dashboard</h1>
        </div>
    </div>
</div>
<div class="mx-3 shadow p-3 m-2"> 
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h3><?= htmlspecialchars($user_data['user_name'] ?? 'User') ?></h3>
                            <p class="card-text"><?= htmlspecialchars($user_data['user_email']) ?></p>
                            <p class="card-text"><?= !empty($user_data['user_mobile']) ? htmlspecialchars($user_data['user_mobile']) : 'N/A' ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                <a href="change_password.php" class="btn btn-sm btn-outline-primary ml-2">Change Password</a>
                                    <?php if($is_admin): ?>
                                    <a href="admin/dashboard.php" class="btn btn-sm btn-outline-primary ml-2">Admin Interface</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
                <div class="mx-5 shadow table-responsive">
                   <table class="table table-bordered table-hover table-primary">
                       <thead>
                           <tr>
                               <th>Appointment Id</th>
                               <th>Patient Name</th>
                               <th>Patient Age</th>
                               <th>Patient Gender</th>
                               <th>Appointment Date</th>
                               <th>Appoint Doctor Name</th>
                               <th>Department</th>
                               <th>Appointment Status</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td>101</td>
                               <td>Chuli KC</td>
                               <td>30</td>
                               <td>female</td>
                               <td>25/06/2025</td>
                               <td>Dr. Eve</td>
                               <td>General Surgery</td>
                               <td>Not Completed</td>
                           </tr>
                       </tbody>
                   </table>
               </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'include/footer.php'; ?>