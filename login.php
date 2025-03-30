<?php
include_once 'include/config.php';
session_start();
if(isset($_POST['login'])) {
    $status = true;
    $email = $password = '';
    
    // Validate email
    if(empty($_POST['email'])) {
        $status = false;
        $error_email = "Email field is required";
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
    }

    // Validate password
    if(empty($_POST['password'])) {
        $status = false;
        $error_pass = "Password field is required";
    } else {
        $password = md5($_POST['password']);
    }

    if($status) {
        $sql = "SELECT * FROM users WHERE user_email='$email'";
        $run = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($run) > 0) {
            $user = mysqli_fetch_assoc($run);
            
            if($user['user_password'] == $password) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_email'] = $email;
                
                // Set admin flag
                if($email === 'admin@gmail.com') {
                    $_SESSION['is_admin'] = true;
                }
                
                header("Location: dashboard.php");
                exit();
            } else {
                $error_pass = "Password incorrect";
            }
        } else {
            $error_email = "Email not registered";
        }
    }
}
?>

<!-- Rest of your HTML remains the same -->

<?php include_once 'include/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 py-3 bg-white from-wrapper">
            <div class="container shadow-lg py-3">
            	<h3>Login</h3>
            	<hr>
                                <form action="" method="POST">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?=(isset($email)) ? $email : ''?>">
                        <small class="text-danger">
                            <?=(isset($error_email)) ? $error_email : ''?>
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="">
                        <small class="text-danger">
                            <?=(isset($error_pass)) ? $error_pass : ''?>
                        </small>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <input type="submit" value="login" name="login" class="btn btn-primary" />
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a href="register.php">Don't have an account yet?</a>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>  
</div>
<?php include_once 'include/footer.php'; ?>
