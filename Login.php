<?php
include "Connect.php";

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Vui lòng nhập tên đăng nhập.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Vui lòng nhập mật khẩu.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Nếu không có lỗi
    if (empty($username_err) && empty($password_err)) {
        // Chuẩn bị câu lệnh SQL
        $sql = "SELECT id, username, password, role_id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            // Liên kết tham số
            mysqli_stmt_bind_param($stmt, "s", $username);

            // Thực thi câu lệnh
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                // Kiểm tra xem tên đăng nhập có tồn tại không
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Liên kết các kết quả
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role_id);

                    // Lấy kết quả
                    if (mysqli_stmt_fetch($stmt)) {
                        // Kiểm tra mật khẩu
                        if (password_verify($password, $hashed_password)) {
                            // Mật khẩu đúng, lấy vai trò và chuyển hướng
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['role_id'] = $role_id;
                            header("location: main.php"); // Chuyển hướng đến trang chính
                        } else {
                            $password_err = "Mật khẩu không đúng.";
                        }
                    }
                } else {
                    $username_err = "Không tìm thấy tài khoản với tên đăng nhập này.";
                }
            } else {
                echo "Có lỗi xảy ra. Vui lòng thử lại sau.";
            }

            // Đóng kết nối
            mysqli_stmt_close($stmt);
        }
    }
}

// Đóng kết nối
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- CSS tùy chỉnh -->
    <style>
        body {
            background-color: #FFF0F5 ;
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
        .link-to-register {
            font-size: 14px;
            color: #007bff;
        }
        .link-to-register:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 style="display: flex; justify-content: center;">Login Form</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username">
            <span class="text-danger"><?php echo $username_err; ?></span>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
            <span class="text-danger"><?php echo $password_err; ?></span>
        </div>

        <button type="submit" class="btn btn-success">Login</button>
        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
    </form>
</div>
</body>
</html>
