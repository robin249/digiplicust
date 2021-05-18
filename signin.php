<?php
    session_start();

    require_once('domain.php');

    if (isset($_SESSION['fi_user'])) {
      header('Location: ' . $domain . 'institutions.php');
    }

    // check login with credentials
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $file = file_get_contents('ln_cred.json');
      $data = json_decode($file, true);
      $match = null;
      foreach ($data as $key => $items) {
        if ($items['email'] === $_POST['email']) {
          if ($items['password'] === $_POST['password']) {
            $match = $items;
            // We found a match so let's break the loop
            break;
          }
        }
      }

      if (!$match) {
        $error = "Invalid username and password.";
      } else {
        $_SESSION['fi_user'] = 'true';
        header('Location: ' . $domain . 'institutions.php');
      }
    }
  ?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head><meta charset="windows-1252">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="RAMBEE INC">
    <title>Digipli | Login</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="https://digiplicustomerdata.azurewebsites.net/DigiPli1.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/horizontal-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/style.css">
    <!-- END: Custom CSS-->

    <style>
    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
    }
    .bl2 {
      background-color: #1700b9;
    }
    .alert {
      margin: 0;
    }
    .fade.in {
      opacity: 1;
    }
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-static 1-column   footer-static bg-full-screen-image  blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- login page start -->
                <section id="auth-login" class="row flexbox-container">
                    <div class="col-xl-8 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="">
                                            <div class="card-title">
                                                <img src="app-assets/images/logo.png" alt="Logo" class="center">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                          <div class="">
                                            <?php if(isset($error)) { ?>
                                              <div class="alert alert-danger fade in">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Error!</strong> <?php if(isset($error)){ echo $error; } ?>
                                              </div>
                                            <?php } ?>
                                          </div>
                                            <div class="divider">
                                                <div class="divider-text text-uppercase text-muted"><small>login with
                                                        email</small>
                                                </div>
                                            </div>
                                            <form method="post" autocomplete="off" name="logindata" action="">
                                                <div class="form-group mb-50">
                                                    <label class="text-bold-600" for="exampleInputEmail1">Email address</label>
                                                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email address"></div>
                                                <div class="form-group">
                                                    <label class="text-bold-600" for="exampleInputPassword1">Password</label>
                                                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                </div>
                                                <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                                    <div class="text-left">
                                                        <div class="checkbox checkbox-sm">
                                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                            <label class="checkboxsmall" for="exampleCheck1"><small>Keep me logged
                                                                    in</small></label>
                                                        </div>
                                                    </div>
                                                    <div class="text-right"><a href="forgot-password.php" class="card-link"><small>Forgot Password?</small></a></div>
                                                </div>
                                                <button type="submit" class="btn text-white bl2 glow mr-sm-1">Login<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                            </form>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <!-- right section image -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <img class="img-fluid" src="app-assets/images/login.png" alt="branding logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- login page ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <script src="app-assets/js/app-menu.js"></script>
    <script src="app-assets/js/app.js"></script>
    <script src="app-assets/js/components.js"></script>
    <script src="app-assets/js/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>