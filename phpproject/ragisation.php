<?php
session_start();

// Generate CAPTCHA if not set
if (!isset($_SESSION['captcha_answer'])) {
  $num1 = rand(1, 10);
  $num2 = rand(1, 10);
  $_SESSION['captcha_answer'] = $num1 + $num2;
  $_SESSION['captcha_question'] = "$num1 + $num2";
}

// Initialize variables
$error1 = $error2 = $error3 = $error4 = $error5 = $error6 = "";
$username = $_POST["username"] ?? '';
$email = $_POST["email"] ?? '';
$password = $_POST["password"] ?? '';
$confirm_password = $_POST["confirm-password"] ?? '';
$mobile = $_POST["mobile"] ?? '';
$captcha_answer = $_POST["captcha"] ?? '';

$unamepat = "/^[a-zA-Z ]+$/";
$mobpat = "/^[0-9]{10}$/";
$emailpat = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

if (isset($_POST["submit"])) {
  // Validate CAPTCHA first
  if (empty($captcha_answer)) {
    $error6 = "Please solve the CAPTCHA";
  } elseif ((int) $captcha_answer !== $_SESSION['captcha_answer']) {
    $error6 = "CAPTCHA answer is incorrect";
    // Generate new CAPTCHA
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $_SESSION['captcha_answer'] = $num1 + $num2;
    $_SESSION['captcha_question'] = "$num1 + $num2";
  } else {
    // Validate other inputs
    if (empty($username)) {
      $error1 = "Enter username";
    } elseif (!preg_match($unamepat, $username)) {
      $error1 = "Name is invalid, only letters and spaces allowed";
    } elseif (empty($email)) {
      $error2 = "Enter email";
    } elseif (!preg_match($emailpat, $email)) {
      $error2 = "Enter a valid email";
    } elseif (!preg_match($mobpat, $mobile)) {
      $error5 = "Enter a valid mobile number";
    } elseif (empty($password)) {
      $error3 = "Enter password";
    } elseif ($password !== $confirm_password) {
      $error4 = "Passwords do not match";
    } else {
      include 'connect.php';
      if ($con) {
        $check_query = "SELECT * FROM `tbl_user` WHERE `email` = '$email'";
        $check_result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
          $error2 = "Email already registered";
        } else {
          $query = "INSERT INTO `tbl_user` (`user_id`,`username`,`email`,`password`,`pic`,`moblieno`) 
                              VALUES (NULL,'$username','$email','$password','','$mobile')";
          $result = mysqli_query($con, $query);
          if ($result) {
            echo "<script>alert('Registration Successful! You can now login.'); window.location.href='login.php';</script>";
            // Generate new CAPTCHA
            $num1 = rand(1, 10);
            $num2 = rand(1, 10);
            $_SESSION['captcha_answer'] = $num1 + $num2;
            $_SESSION['captcha_question'] = "$num1 + $num2";
          } else {
            echo "<script>alert('Registration Failed. Please try again later.');</script>";
          }
        }
      } else {
        echo "<script>alert('Database Connection Error.');</script>";
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
  <title>Music Registration</title>
  <link rel="stylesheet" href="style1.css" />
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
    }

    .input-box i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #a6a6a6;
    }

    .captcha-container {
      display: flex;
      align-items: center;
    }

    .captcha-question {
      font-weight: bold;
      color: #ee2b6f;
      margin-right: 10px;
    }

    .captcha-refresh {
      background-color: #ee2b6f;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 5px 10px;
      cursor: pointer;
    }

    .captcha-refresh:hover {
      background-color: #d41c5c;
    }

    .error1 {
      color: red;
      margin-top: 5px;
      font-size: 14px;
    }

    .ragisation-box {
      height: 730px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="box">
      <div class="text-content">
        <div class="text">
          <h1 class="text-1">Your Music,</h1>
          <h1 class="text-2">Everywhere</h1>
        </div>
        <p class="content">
          Stream millions of songs, discover new artists, and create<br />
          the perfect soundtrack for your life. Join the ultimate music experience.
        </p>
      </div>
      <div class="ragisation-box">
        <h1 class="name"><i class="fas fa-music"></i> Groovo</h1>
        <h1 class="crate-account">Create Your Account</h1>
        <form action="#" method="post">
          <div class="input-box">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Enter username" value="<?php echo $username; ?>" />
          </div>
          <p class="error1"><?php echo $error1; ?></p>

          <div class="input-box">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Enter email" value="<?php echo $email; ?>" />
          </div>
          <p class="error1"><?php echo $error2; ?></p>

          <div class="input-box">
            <i class="fas fa-phone"></i>
            <input type="text" name="mobile" placeholder="Enter mobile number" value="<?php echo $mobile; ?>" />
          </div>
          <p class="error1"><?php echo $error5; ?></p>

          <div class="input-box">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Enter Password" value="<?php echo $password; ?>" />
          </div>
          <p class="error1"><?php echo $error3; ?></p>

          <div class="input-box">
            <i class="fas fa-lock"></i>
            <input type="password" name="confirm-password" placeholder="Confirm Password"
              value="<?php echo $confirm_password; ?>" />
          </div>
          <p class="error1"><?php echo $error4; ?></p>

          <div class="input-box">
            <div class="captcha-container">
              <span class="captcha-question">CAPTCHA: What is <?php echo $_SESSION['captcha_question']; ?>?</span>
              <button type="button" class="captcha-refresh"><i class="fas fa-sync-alt"></i> New Question</button>
            </div>
            <input type="text" name="captcha" placeholder="Enter answer" />
          </div>
          <p class="error1"><?php echo $error6; ?></p>

          <div class="options-ragisation">
            <label>
              <input type="checkbox" name="remember" class="remember" /> I agree to the
            </label>
            <a href="#" class="Terms-of-Service">Terms of Service</a> and
            <a href="#" class="Terms-of-Service">Privacy Policy</a>
          </div>

          <button type="submit" class="ragisatr-btn" name="submit">Create Account</button>
          <div class="signup-link">
            Already have an account? <a href="login.php">Sign in</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Enable submit button only if checkbox is checked
    const registerBtn = document.querySelector('.ragisatr-btn');
    const rememberCheckbox = document.querySelector('.remember');
    function updateButtonState() { registerBtn.disabled = !rememberCheckbox.checked; }
    updateButtonState();
    rememberCheckbox.addEventListener('change', updateButtonState);

    // CAPTCHA refresh via AJAX
    document.addEventListener('DOMContentLoaded', function () {
      const refreshBtn = document.querySelector('.captcha-refresh');
      const captchaQuestion = document.querySelector('.captcha-question');

      refreshBtn.addEventListener('click', function () {
        fetch('refresh_captcha.php')
          .then(res => res.json())
          .then(data => { captchaQuestion.textContent = 'CAPTCHA: What is ' + data.question + '?'; })
          .catch(err => console.error('Error:', err));
      });
    });
  </script>
</body>

</html>