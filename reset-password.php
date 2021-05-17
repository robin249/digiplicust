<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head><meta charset="windows-1252">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="RAMBEE INC">
    <title>Reset Password - Dealer Talk - Vendor Management System</title>
    <link rel="apple-touch-icon" href="https://digiplicustomerdata.azurewebsites.net/DigiPli1.png">
    <link rel="shortcut icon" type="image/x-icon" href="https://dt-dash.rambee.website/rambee/html/ltr/images/DT%20vendor.ico">
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
    .bl2 {
      background-color: #1700b9;
    }
    .alert {
      margin-bottom: 10px;
    }
    .fade.in {
      opacity: 1;
    }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-static 1-column   footer-static bg-full-screen-image  blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">
  <?php

    require_once('domain.php');

    $is_valid_token = null;
    // reset password token
    $token = $_GET['token'];
    if(isset($token)) {      
      $file = file_get_contents('ln_cred.json');
      $data = json_decode($file, true);

      foreach ($data as $key => $items) {
        if ($items['token'] === $token) {
          $is_valid_token = $items;

          // We found a match so let's break the loop
          break;
        }
      }
    }

    if (!$is_valid_token) {
      $alert_type = 'danger';
      $alert_message = "Reset password token is invalid or expired. Please click <a href='$domain/forgot-password.php'>here</a> to regenerate the token.";
    }

    // reset password submit
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];
      if ($password === $confirm_password) {

        // update new password
        $update_arr = array(
          'email' => $is_valid_token['email'],
          'password' => $password
        );
        $data[$key] = $update_arr;
        //encode back to json
        $data_array = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents('ln_cred.json', $data_array);
        $alert_type = 'success';
        $alert_message = 'New password has been reset successfully. Now you can login with your latest credentials.';
      } else {
        $alert_type = 'danger';
        $alert_message = "New password and confirm password does not match.";        
      }
    }
  ?>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- reset password start -->
                <section class="row flexbox-container">
                    <div class="col-xl-7 col-10">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right d-flex justify-content-center mb-0 p-2 h-100">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Reset your Password</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                          <div class="">
                                            <?php if(isset($alert_message)) { ?>
                                              <?php $alert_class = "alert alert-$alert_type fade in"; ?>
                                              <div class="<?php echo $alert_class;?>">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong><?php echo ($alert_type == 'success') ? 'Success!' : 'Error!' ?></strong> <?php if(isset($alert_message)){ echo $alert_message; } ?>
                                              </div>
                                            <?php } ?>
                                          </div>
                                            <form method="post" autocomplete="off" name="resetpassword" action="">
                                                <div class="form-group">
                                                    <label class="text-bold-600" for="exampleInputPassword1">New Password</label>
                                                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter a new password" required="true"></div>
                                                <div class="form-group mb-2">
                                                    <label class="text-bold-600" for="exampleInputPassword2">Confirm New
                                                        Password</label>
                                                    <input name="confirm_password" type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm your new password" required="true">
                                                </div>
                                                <button type="submit" class="btn text-white bl2 glow mr-sm-1">Reset my
                                                    password<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                                    <div class="text-left"><a href="signin.php" class="card-link"><small>Do you want to Signin?</small></a></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- right section image -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <img class="img-fluid" src="app-assets/images/reset-password.png" alt="branding logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- reset password ends -->

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

</body>
<!-- END: Body-->

</html>