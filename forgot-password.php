<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head><meta charset="windows-1252">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="RAMBEE INC">
    <title>Forgot Password - Dealer Talk - Vendor Management System</title>
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

    require_once "Mail.php";
    require_once('lib/request.php');
    require_once('domain.php');

    // forgot password submit
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $from = "<authentequi@gmail.com>";
      $to = "<$email>";
      $subject = "Digipli | Reset password instructions";

      $file = file_get_contents('ln_cred.json');
      $data = json_decode($file, true);
      $match = null;
      foreach ($data as $key => $items) {
        if ($items['email'] === $email) {
          $match = $items;
          $token = uniq_alphanum();
          $update_arr = array(
            'email' => $items['email'],
            'password' => $items['password'],
            'token' => $token
          );
          $data[$key] = $update_arr;
          //encode back to json
          $data_array = json_encode($data, JSON_PRETTY_PRINT);
          file_put_contents('ln_cred.json', $data_array);

          // We found a match so let's break the loop
          break;
        }
      }

      if ($match) {
        $body = "Hello,<br/>
          <br/>
          A password reset has been requested for your account. To change your password please follow this link:<br/>
          <br/>
          <a href='$domain/reset-password.php?token=$token'>Change Password</a>
          <br/>
          <br/>
          If you have not requested a password reset please ignore this email.";

        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject,
            'Content-type' => 'text/html; charset=iso-8859-1'
        );

        $smtp = Mail::factory('smtp', array(
            'host' => 'ssl://smtp.gmail.com',
            'port' => '465',
            'auth' => true,
            'username' => 'authentequi@gmail.com', //your gmail account
            'password' => 'Authenteq1!' // your password
        ));

        // Send the mail
        $mail = $smtp->send($to, $headers, $body);

        //check mail sent or not
        if (PEAR::isError($mail)) {
          $alert_type = 'danger';
          $alert_message = '<p>'.$mail->getMessage().'</p>';
        } else {
          $alert_type = 'success';
          $alert_message = 'Reset password email has been sent successfully.';
        }
      } else {
        $alert_type = 'danger';
        $alert_message = 'Please enter valid email.';        
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
                <!-- forgot password start -->
                <section class="row flexbox-container">
                    <div class="col-xl-7 col-md-9 col-10  px-0">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-forgot password -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Forgot Password?</h4>
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
                                            <form method="post" autocomplete="off" name="forgotpassword" action="">
                                                <div class="form-group mb-2">
                                                    <label class="text-bold-600" for="exampleInputEmailPhone1">Email</label>
                                                    <input name="email" type="email" class="form-control" id="exampleInputEmailPhone1" placeholder="Enter your Email"></div>
                                                <button type="submit" class="btn text-white bl2 glow mr-sm-1">SEND
                                                    PASSWORD<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- right section image -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center">
                                    <img class="img-fluid" src="app-assets/images/forgot-password.png" alt="branding logo" width="300">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- forgot password ends -->

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