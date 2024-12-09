<?php
include "Connect.php";  // Kết nối cơ sở dữ liệu

// Khai báo các biến và thông báo lỗi
$username = $email = $password = $confirm_password = $dob = $address = "";
$username_err = $email_err = $password_err = $confirm_password_err = $dob_err = $address_err = "";
$role_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra và xử lý các trường nhập liệu
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);

        // Kiểm tra xem username đã tồn tại trong cơ sở dữ liệu chưa
        $sql = "SELECT id FROM users WHERE username = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password != $confirm_password) {
            $confirm_password_err = "Password did not match.";
        }
    }

    if (empty(trim($_POST["dob"]))) {
        $dob_err = "Please enter your date of birth.";
    } else {
        $dob = trim($_POST["dob"]);
    }

    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter your address.";
    } else {
        $address = trim($_POST["address"]);
    }
    $role_id = isset($_POST['role']) ? $_POST['role'] : 3; // Default to 3 (student) if no role is selected


    // Kiểm tra lỗi và nếu không có lỗi, thực hiện lưu vào cơ sở dữ liệu
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($dob_err) && empty($address_err)) {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Chuẩn bị câu lệnh SQL để chèn người dùng vào bảng 'users'
        $sql = "INSERT INTO users (username, email, password, dob, address, role_id) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Gắn tham số vào câu lệnh SQL
            mysqli_stmt_bind_param($stmt, "sssssi", $username, $email, $hashed_password, $dob, $address, $role_id);

            // Thực thi câu lệnh
            if (mysqli_stmt_execute($stmt)) {
                // Nếu lưu thành công, chuyển hướng người dùng đến trang login
                header("location: login.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Đóng statement
            mysqli_stmt_close($stmt);
        }
    }

    // Đóng kết nối
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- CSS tùy chỉnh -->
    <style>
        body {
            background-color: #FFFFE0;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            font-size: 36px;
            margin-bottom: 30px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 14px;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            color: white;
            font-size: 16px;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .text-danger {
            color: red;
            font-size: 12px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .link-to-login {
            font-size: 14px;
            color: #007bff;
        }
        .link-to-login:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 style="display: flex; justify-content: center;">Register Form</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
            <span class="text-danger"><?php echo $username_err; ?></span>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
            <span class="text-danger"><?php echo $email_err; ?></span>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
            <span class="text-danger"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            <span class="text-danger"><?php echo $confirm_password_err; ?></span>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>">
            <span class="text-danger"><?php echo $dob_err; ?></span>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
            <span class="text-danger"><?php echo $address_err; ?></span>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" id="role" name="role">
                <option value="1">Admin</option>
                <option value="2">Teacher</option>
                <option value="3" selected>Student</option>
            </select>
            <span class="text-danger"><?php echo $role_err; ?></span>
        </div>

        <button type="submit" class="btn btn-success">Register</button>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</div>
</body>
</html>
