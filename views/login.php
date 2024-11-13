<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Thêm Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS tùy chỉnh cho nút vàng nhạt */
        .btn-custom {
            background-color: #f0e68c; /* Màu vàng nhạt */
            border-color: #f0e68c; /* Viền màu vàng nhạt */
            color: #000; /* Màu chữ đen */
        }

        .btn-custom:hover {
            background-color: #e0d700; /* Màu vàng đậm khi hover */
            border-color: #e0d700; /* Viền vàng đậm khi hover */
        }

        /* Màu vàng nhạt cho liên kết "Forgot Password?" */
        .forgot-password {
            color: #f0e68c; /* Màu vàng nhạt */
        }

        .forgot-password:hover {
            color: #e0d700; /* Màu vàng đậm khi hover */
        }
    </style>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="row w-100">
            <div class="col-md-6 col-lg-4 mx-auto">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Login</h2>
                    
                    <!-- Hiển thị lỗi nếu có -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form đăng nhập -->
                    <form action="index.php?controller=auth&action=login" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-custom">Login</button>
                            <a href="#" class="forgot-password text-decoration-none">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Thêm Bootstrap JS (tuỳ chọn nếu muốn sử dụng các tính năng tương tác) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
