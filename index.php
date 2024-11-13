<?php

// require_once 'controllers/AuthController.php';

// // Lấy controller và action từ URL, mặc định là 'auth' và 'home'
// $controller = $_GET['controller'] ?? 'auth';
// $action = $_GET['action'] ?? 'home';

// // Kiểm tra controller hợp lệ và thực thi hành động tương ứng
// if ($controller === 'auth') {
//     $authController = new AuthController();

//     // Gọi action tương ứng
//     switch ($action) {
//         case 'home':
//             $authController->home();
//             break;
//         case 'login':
//             $authController->login();
//             break;
//         case 'logout':
//             $authController->logout();
//             break;
//         case 'admin':
//             $authController->admin();
//             break;
//         default:
//             // Nếu action không tồn tại, hiển thị thông báo lỗi 404
//             echo "404 - Page not found";
//             break;
//     }
// } else {
//     // Nếu controller không tồn tại, hiển thị thông báo lỗi 404
//     echo "404 - Controller not found";
// }

require_once 'controllers/AuthController.php';

// Lấy controller và action từ URL, mặc định là 'auth' và 'home'
$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'home';

// Kiểm tra controller hợp lệ và thực thi hành động tương ứng
if ($controller == 'auth') {
    $authController = new AuthController(); 

    // Gọi action tương ứng
    if ($action == 'home') {
        $authController->home();
    } elseif ($action == 'login') {
        $authController->login();
    } elseif ($action == 'logout') {
        $authController->logout();
    } elseif ($action == 'admin') {
        $authController->admin();
    } else {
        echo "404 - Page not found";
    }
} else {
    echo "404 - Controller not found";
}


?>
