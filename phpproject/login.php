<?php
session_start();
include 'connect.php';

$username = $password = "";
$error1 = $error2 = "";

if (isset($_POST['btnsubmit'])) {
  $username = trim($_POST['uname']);
  $password = trim($_POST['pass']);

  // Validate fields
  if (empty($username)) {
    $error1 = "Please enter username";
  }

  if (empty($password)) {
    $error2 = "Please enter password";
  }

  // If both fields are filled, check login
  if (empty($error1) && empty($error2)) {
    if ($username === "admin" && $password === "admin") {
      header("Location:add_home.php");
      exit;
    } else {
      $query = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";
      $result = mysqli_query($con, $query);
      if (mysqli_num_rows($result) > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location:uhome.php");
        exit;
      } else {
        $error2 = "Invalid username or password";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MusicStream Login</title>
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <style>
    .input-box {
      position: relative;
      margin: 20px 0;
    }

    .input-box input {
      width: 100%;
      padding: 12px 12px 12px 40px;
      border-radius: 10px;
      border: none;
      background: #26262680;
      color: #fafafa;
      font-size: 15px;
    }

    .input-box i {
      position: absolute;
      left: 12px;
      top: 35%;
      transform: translateY(-50%);
      color: #a6a6a6;
      font-size: 16px;
    }

    .error {
      color: red;
      margin-top: 10px;
      font-size: 13px;
    }

    .login-btn {
      background-color: #ee2b6f;
      color: #fafafa;
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      border: none;
      font-size: 16px;
      cursor: pointer;
      margin-top: 15px;
    }

    .login-btn:hover {
      background-color: #d41c5c;
    }

    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 10px 0;
    }

    .options label {
      color: #fafafa;
    }

    .options a {
      color: #ee2b6f;
      font-size: 14px;
    }

    .signup-link {
      text-align: center;
      margin-top: 15px;
      color: #fafafa;
    }

    .signup-link a {
      color: #ee2b6f;
      text-decoration: underline;
    }

    .login-box {
      width: 400px;
      height: 500px;
      background-color: #141414;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    .logo i {
      font-size: 50px;
      color: #ee2b6f;
      display: flex;
      justify-content: center;
      margin: 0 auto 10px auto;
    }

    .fa-music {
      color: #ee2b6f;
      font-size: 30px;
    }

    h1.name {
      color: #ffffff;
      text-align: center;
      margin: 10px 0;
    }

    h3 {
      color: #a6a6a6;
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="box">
      <!-- Login form -->
      <div class="login-box">

        <h1 class="name"><i class="fas fa-music"></i> Groovo</h1>
        <h3>Sign in to your account</h3>
        <form action="#" method="post">
          <div class="input-box">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Enter username" name="uname"
              value="<?php echo htmlspecialchars($username); ?>" />
            <p class="error"><?php echo $error1; ?></p>
          </div>

          <div class="input-box">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Enter password" name="pass" />
            <p class="error"><?php echo $error2; ?></p>
          </div>

          <div class="options">
            <label>
              <input type="checkbox" name="remember" /> Remember me
            </label>
            <a href="#">Forgot password?</a>
          </div>

          <button type="submit" class="login-btn" name="btnsubmit">Sign In</button>

          <div class="signup-link">
            Don't have an account? <a href="ragisation.php">Sign up for free</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>