<?php
include "header.php";
require_once "class/DatabaseC.php";
require_once "class/User.php";
$pdo = DatabaseConnection::getConn();
$username = $_SESSION["UserName"];
$user = User::findUsername($pdo, $username);
if (empty($username)) {
    die("Người dùng không tồn tại");
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamingtheme.kiendaotac.com/html/akasha/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Apr 2024 12:43:46 GMT -->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/chosen.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.scrollbar.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/lightbox.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/megamenu.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/dreaming-attribute.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>

    <div class="banner-wrapper has_background">
        <img src="assets/images/banner-for-all2.jpg" class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">My Account</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="Home.php"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>My Account</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <main class="site-main  main-container no-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Thông tin tài khoản</h2>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên đăng nhập</th>
                            <th>Tên người dùng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                        </tr>
                        <tr>
                            <td><?= $user->Username ?></td>
                            <td><?= $user->Name  ?></td>
                            <td><?= $user->Phone  ?></td>
                            <td><?= $user->Email  ?></td>
                            <td><a href="#">Đổi mật khẩu</a></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
        </div>
    </main>
    <footer id="footer" class="footer style-01">
        <div class="section-001 section-009">
            <div class="container">
                <div class="akasha-newsletter style-01">
                    <div class="newsletter-inner">
                        <div class="newsletter-info">
                            <div class="newsletter-wrap">
                                <h3 class="title">Newsletter</h3>
                                <h4 class="subtitle">Get Discount 30% Off</h4>
                                <p class="desc">Suspendisse netus proin eleifend fusce sollicitudin potenti vel magnis
                                    nascetur</p>
                            </div>
                        </div>
                        <div class="newsletter-form-wrap">
                            <div class="newsletter-form-inner">
                                <input class="email email-newsletter" name="email" placeholder="Enter your email ..." type="email">
                                <a href="#" class="button btn-submit submit-newsletter">
                                    <span class="text">Subscribe</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-010">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>© Copyright 2020 <a href="#">Akasha</a>. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="akasha-socials style-01">
                            <div class="content-socials">
                                <ul class="socials-list">
                                    <li>
                                        <a href="https://facebook.com/" target="_blank">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/" target="_blank">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.pinterest.com/" target="_blank">
                                            <i class="fa fa-pinterest-p"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="backtotop active">
        <i class="fa fa-angle-up"></i>
    </a>
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/chosen.min.js"></script>
    <script src="assets/js/countdown.min.js"></script>
    <script src="assets/js/jquery.scrollbar.min.js"></script>
    <script src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/magnific-popup.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/jquery.zoom.min.js"></script>
    <script src="assets/js/threesixty.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/mobilemenu.js"></script>
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC3nDHy1dARR-Pa_2jjPCjvsOR4bcILYsM'></script>
    <script src="assets/js/functions.js"></script>
</body>

<!-- Mirrored from dreamingtheme.kiendaotac.com/html/akasha/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Apr 2024 12:43:46 GMT -->

</html>