<?php
// require_once 'models/Customer.php';
// session_start();

// class AuthController {

//     // Hiển thị trang chủ
//     public function home() {
//         $userLoggedIn = isset($_SESSION['user']);
//         if ($userLoggedIn) {
//             $user = $_SESSION['user'];
//         } else {
//             $user = null;
//         }
//         require 'views/home.php';
//     }

//     // Xử lý đăng nhập
//     public function login() {
//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             $email = $_POST['email'];
//             $password = $_POST['password'];
    
//             $customer = new Customer();
//             $user = $customer->login($email, $password);
    
//             if ($user) {
//                 session_start();
//                 $_SESSION['user'] = $user;

//                 // Phân quyền theo vai trò của người dùng
//                 if ($user['Role'] === 'Admin') {
//                     // Chuyển hướng đến trang admin nếu là admin
//                     header("Location: views/admin/admin_page.php");
//                 } else {
//                     // Chuyển hướng đến trang home nếu là customer
//                     header("Location: index.php?controller=auth&action=home");
//                 }
//                 exit();
//             } else {
//                 $error = "Invalid email or password";
//                 require 'views/login.php';
//             }
//         } else {
//             require 'views/login.php';
//         }
//     }
//  // Trang dành cho Admin
//     public function admin() {
//         if (isset($_SESSION['user']) && $_SESSION['user']['Role'] === 'Admin') {
//             require 'views/admin/admin_page.php';
//         } else {
//             // Nếu không phải Admin, chuyển hướng về trang home
//             header("Location: index.php?controller=auth&action=home");
//             exit();
//         }
//     }

//     public function logout() {
//         session_start();
//         session_unset();
//         session_destroy();
        
//         // Chuyển hướng về trang home
//         header("Location: index.php?controller=auth&action=home");
//         exit();
//     }
// }


    
require_once 'models/Customer.php';
session_start();

class AuthController {

    // Hiển thị trang chủ
    public function home() {
        $userLoggedIn = isset($_SESSION['user']);
        $user = $userLoggedIn ? $_SESSION['user'] : null;
        require 'views/home.php';
    }

    // Xử lý đăng nhập
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $customer = new Customer();
            $user = $customer->login($email, $password);
    
            if ($user) {
                $_SESSION['user'] = $user;

                // Phân quyền theo vai trò của người dùng
                if ($user['Role'] === 'Admin') {
                    // Chuyển hướng đến trang admin nếu là admin
                    header("Location: index.php?controller=auth&action=admin");
                } else {
                    // Chuyển hướng đến trang home nếu là customer
                    header("Location: index.php?controller=auth&action=home");
                }
                exit();
            } else {
                $error = "Invalid email or password";
                require 'views/login.php';
            }
        } else {
            require 'views/login.php';
        }
    }

    // Trang dành cho Admin
    public function admin() {
        if (isset($_SESSION['user']) && $_SESSION['user']['Role'] === 'Admin') {
            require 'views/admin/admin_page.php';
        } else {
            // Nếu không phải Admin, chuyển hướng về trang home
            header("Location: index.php?controller=auth&action=home");
            exit();
        }
    }

    // Xử lý đăng xuất
    public function logout() {
        session_unset();
        session_destroy();
        
        // Chuyển hướng về trang home
        header("Location: index.php?controller=auth&action=home");
        exit();
    }
}


?> 
