<?php
    session_start();

    require_once('domain.php');

    $getfile = file_get_contents('fi_institutions.json');
    $jsonfile = json_decode($getfile);

    // unset($_SESSION["fi_user"]);
    if (!isset($_SESSION['fi_user'])) {
      header('Location: ' . $domain . 'signin.php');
      // exit();
    }

    // add new record
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["add"])) {
      $file = file_get_contents('fi_institutions.json');
      $data = json_decode($file, true);
      unset($_POST["add"]);
      $data = array_values($data);
      array_push($data, $_POST);
      // print_r($data);
      // echo 'robin';
      // print_r($_POST);
      $data = json_encode($data, JSON_PRETTY_PRINT);
      // echo "<br>";
      // print_r($data);
      file_put_contents("fi_institutions.json", $data);
      $_SESSION['message'] = "Record has been created successfully!";
      header('Location: ' . $domain . 'institutions.php');
      // echo("<script>location.href = '".$domain."institutions.php';</script>");
    }
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }

    // delete record
    if (isset($_GET["delete_id"])) {
      $delete_id = $_GET['delete_id'];
      $data = file_get_contents('fi_institutions.json');
      $data = json_decode($data, true);

      unset($data[$delete_id]);

      //encode back to json
      $data = json_encode($data, JSON_PRETTY_PRINT);
      file_put_contents('fi_institutions.json', $data);
      $_SESSION['message'] = "Record has been deleted successfully!";
      header('Location: ' . $domain . 'institutions.php');
    }

    // update record
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["edit"])) {
      $edit_id = $_GET['id'];
      //get json data
      $data = file_get_contents('fi_institutions.json');
      $data_array = json_decode($data, true);
      // $row = $data_array[$edit_id];
      $update_arr = array(
        'fi' => $_POST['fi'],
        'fi_code' => $_POST['fi_code'],
        'endpoint' => $_POST['endpoint'],
        'user_id' => $_POST['user_id'],
        'client_secret' => $_POST['client_secret'],
        'scope' => $_POST['scope'],
        'username' => $_POST['username'],
        'password' => $_POST['password']
      );
      $data_array[$edit_id] = $update_arr;
      //encode back to json
      $data = json_encode($data_array, JSON_PRETTY_PRINT);
      file_put_contents('fi_institutions.json', $data);
      $_SESSION['message'] = "Record has been updated successfully!";
      header('Location: ' . $domain . 'institutions.php');
    }
  ?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
  <meta charset="windows-1252">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="RAMBEE INC">
  <title>Digipli | Institutions</title>
  <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="https://digiplicustomerdata.azurewebsites.net/DigiPli1.png">
  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

  <!-- BEGIN: Vendor CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
  <!-- END: Vendor CSS-->

  <!-- BEGIN: Theme CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/dark-layout.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/semi-dark-layout.css">
  <!-- END: Theme CSS-->

  <!-- BEGIN: Page CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/vertical-menu.css">
  <!-- END: Page CSS-->

  <!-- BEGIN: Custom CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/style.css">
  <!-- END: Custom CSS-->
  <style>
    .bl {
      color: #1700b9;
    }
    .bl2 {
      background-color: #1700b9;
    }
    .dpk {
      padding: 10px;
    }
    .rbn {
      cursor: pointer;
    }
    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }
    .bdy{
      padding: 50px;
      background: #f5f9fd;
    }
    .tbl {
      background: #1700b9 !important;
    }
    .wht {
      color: #ffffff !important;
    }
    .fade.in {
      opacity: 1;
    }
    .alert-dismissible {
      padding: 15px;
    }
    .alert.alert-dismissible .close {
      color: inherit;
      top: 2px;
    }

  </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body>

  <!-- BEGIN: Content-->
  <div class="bdy">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <h1 class="dpk">Manage Financial Institutions</h1>

      <div class="content-body">
        <?php if(isset($_SESSION['message'])) { ?>
         <?php $alert_class = "alert alert-success fade in alert-dismissible"; ?>
           <div class="<?php echo $alert_class;?>" style="margin-top:18px;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
              <strong>Success!</strong> <?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; } ?>
          </div>
        <?php } ?>
        <section id="form-control-repeater">
          <div class="row">
            <!-- phone repeater -->
            <div class="col-xl-12 col-lg -12">
              <div class="card">
                <div class="card-body">
                  <form action="" class="add-record" method="POST" autocomplete="off">
                    <div>
                      <div class="row">
                        <div class="col-12 mb-2">
                          <span class="font-weight-bold bl">ADD NEW FINANCIAL INSTITUTION</span>
                        </div>
                      </div>
                      <div class="row justify-content-between" data-repeater-item>
                        <div class="col-md-3 col-12 form-group d-flex align-items-center">
                          <input name="fi" type="text" class="form-control" placeholder="Name of the FI">
                        </div>
                        <div class="col-md-3 col-12 form-group">
                          <input name="fi_code" type="text" class="form-control" placeholder="FI Code (3 digit)">
                        </div>
                        <div class="col-md-3 col-12 form-group">
                          <input name="endpoint" type="text" class="form-control" placeholder="Endpoints for the FI">
                        </div>
                        <div class="col-md-3 col-12 form-group">
                          <input name="user_id" type="text" class="form-control" placeholder="User-ID">
                        </div>
                        <div class="col-md-3 col-12 form-group d-flex align-items-center">
                          <input name="client_secret" type="text" class="form-control" placeholder="Client_secret">
                        </div>
                        <div class="col-md-3 col-12 form-group">
                          <input name="scope" type="text" class="form-control" placeholder="Scope">
                        </div>
                        <div class="col-md-3 col-12 form-group">
                          <input name="username" type="text" class="form-control" placeholder="Username">
                        </div>
                        <div class="col-md-3 col-12 form-group">
                          <input name="password" type="text" class="form-control" placeholder="Password">
                        </div>


                        <div class="col-md-3 col-12 form-group">
                          <button  name="add" type="submit" class="btn text-white bl2 glow mr-sm-1">Save Changes</button>
                          <button class="btn btn-icon text-white bl2 rounded-circle clear-form-fields" type="button">
                            <i class="bx bx-x"></i>
                          </button>
                        </div>

                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /phone repeater -->
          </div>
        </section>
        <!-- Table head options start -->
        <div class="row" id="table-head">
          <div class="col-12">
            <div class="card">
              <!-- table head dark -->
              <div class="table-responsive">
                <table class="table mb-0">
                  <thead class="tbl">
                    <tr>
                      <th class="wht">S.No.</th>
                      <th class="wht">FI</th>
                      <th class="wht">FI Code</th>
                      <th class="wht">Endpoints</th>
                      <th class="wht">User-Id</th>
                      <th class="wht">Client_secret</th>
                      <th class="wht">Scope</th>
                      <th class="wht">Username</th>
                      <th class="wht">Password</th>
                      <th class="wht">Edit</th>
                      <th class="wht">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=0; foreach ($jsonfile as $index => $obj): $no++;  ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td class="text-bold-500 fi-name"><?php echo $obj->fi; ?></td>
                        <td class="fi-code"><?php echo $obj->fi_code; ?></td>
                        <!-- Tap to Copy -->
                        <td class="text-bold-500 fi-endpoint"><?php echo $obj->endpoint; ?></td>
                        <td class="fi-user"><?php echo $obj->user_id; ?></td>
                        <td class="fi-cs"><?php echo $obj->client_secret; ?></td>
                        <td class="fi-scope"><?php echo $obj->scope; ?></td>
                        <td class="fi-username"><?php echo $obj->username; ?></td>
                        <td class="fi-password"><?php echo $obj->password; ?></td>
                        <!-- Tap to Copy -->
                        <td><a class="rbn edit-record" data-id="<?php echo $index; ?>" data-toggle="modal" data-target="#full-scrn"><i class="badge-circle text-white bl2 bx bx-pencil font-medium-1"></i></a></td>
                        <td><a class="rbn delete-record" data-id="<?php echo $index; ?>" data-toggle="modal" data-backdrop="false" data-target="#backdrop"><i class="badge-circle badge-circle-danger bx bx-x font-medium-1"></i></a></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <!-- full size modal-->
                <div class="modal fade text-left w-100" id="full-scrn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel20">Edit Chase Financial Institution</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <i class="bx bx-x"></i>
                        </button>
                      </div>
                      <form action="" class="update-record" method="POST" autocomplete="off">
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-3 col-12 form-group d-flex align-items-center">
                              <input name="fi" type="text" class="form-control fi-name" placeholder="Name of the FI">
                            </div>
                            <div class="col-md-3 col-12 form-group">
                              <input name="fi_code" type="text" class="form-control fi-code" placeholder="FI Code (3 digit)">
                            </div>
                            <div class="col-md-3 col-12 form-group">
                              <input name="endpoint" type="text" class="form-control fi-endpoint" placeholder="Endpoints for the FI">
                            </div>
                            <div class="col-md-3 col-12 form-group">
                              <input name="user_id" type="text" class="form-control fi-user" placeholder="User-ID">
                            </div>
                            <div class="col-md-3 col-12 form-group d-flex align-items-center">
                              <input name="client_secret" type="text" class="form-control fi-cs" placeholder="Client_secret">
                            </div>
                            <div class="col-md-3 col-12 form-group">
                              <input name="scope" type="text" class="form-control fi-scope" placeholder="Scope">
                            </div>
                            <div class="col-md-3 col-12 form-group">
                              <input name="username" type="text" class="form-control fi-username" placeholder="Username">
                            </div>
                            <div class="col-md-3 col-12 form-group">
                              <input name="password" type="text" class="form-control fi-password" placeholder="Password">
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                          </button>
                          <button  name="edit" type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Submit</span>
                          </button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!--Disabled Backdrop Modal -->
                <div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel4">Delete Record</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <i class="bx bx-x"></i>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="mb-0">
                          Are you sure you want to delete this record?
                        </p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" onclick="location.href='institutions.php'" class="btn btn-light-secondary delete-yes">
                          <i class="bx bx-x d-block d-sm-none"></i>
                          <span class="d-none d-sm-block">Yes</span>
                        </button>
                        <button type="button" class="btn btn-primary ml-1" data-dismiss="modal">
                          <i class="bx bx-check d-block d-sm-none"></i>
                          <span class="d-none d-sm-block">No</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- Table head options end -->

      </div>
    </div>
  </div>
  <!-- END: Content-->


  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  <!-- BEGIN: Footer-->
  <footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-left d-inline-block">2021 &copy; DigiPli Inc.</span>
      <button class="btn btn-danger btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
    </p>
  </footer>
  <!-- END: Footer-->


  <!-- BEGIN: Vendor JS-->
  <script src="app-assets/vendors/js/vendors.min.js"></script>
  <!-- BEGIN Vendor JS-->

  <!-- BEGIN: Page Vendor JS-->
  <script src="app-assets/vendors/js/jquery.repeater.min.js"></script>
  <!-- END: Page Vendor JS-->

  <!-- BEGIN: Theme JS-->
  <script src="app-assets/js/app-menu.js"></script>
  <script src="app-assets/js/app.js"></script>
  <script src="app-assets/js/components.js"></script>
  <script src="app-assets/js/footer.js"></script>
  <!-- END: Theme JS-->

  <!-- BEGIN: Page JS-->
  <script src="app-assets/js/form-repeater.js"></script>
  <!-- END: Page JS-->
  <script type="text/javascript">
    $(document).on('click', '.clear-form-fields', function(){
      $(".add-record")[0].reset();
    })

    $(document).on('click', '.delete-record', function(){
      var rec_id = $(this).attr('data-id');
      $('.delete-yes').attr('onclick', "location.href='institutions.php?delete_id=" + rec_id + "'")
    })

    $(document).on('click', '.edit-record', function(){
      console.log('hello')
      var rec_id = $(this).attr('data-id');
      var parent_tr = $(this).parents("tr");
      var edit_modal = $("#full-scrn");
      edit_modal.find(".fi-name").val(parent_tr.find(".fi-name").text());
      edit_modal.find(".fi-code").val(parent_tr.find(".fi-code").text());
      edit_modal.find(".fi-endpoint").val(parent_tr.find(".fi-endpoint").text());
      edit_modal.find(".fi-user").val(parent_tr.find(".fi-user").text());
      edit_modal.find(".fi-cs").val(parent_tr.find(".fi-cs").text());
      edit_modal.find(".fi-scope").val(parent_tr.find(".fi-scope").text());
      edit_modal.find(".fi-username").val(parent_tr.find(".fi-username").text());
      edit_modal.find(".fi-password").val(parent_tr.find(".fi-password").text());
      $('.update-record').attr('action', "institutions.php?id=" + rec_id)
    })
  </script>
</body>
<!-- END: Body-->

</html>