<?php 
  session_start();
  $_SESSION['test_user'] = 'testing';

  $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
  $hostName = $_SERVER['HTTP_HOST'];
  $domain = $protocol.'://'.$hostName."/";

  // unset($_SESSION["is_user"]);
  if (!isset($_SESSION['is_user'])) {
    header('Location: ' . $domain . 'login.php');
    // exit();
  }
  require_once('database.php');
  require_once('Masking/country.php');
  require_once('Masking/state.php');
  require_once('Masking/product.php');
  require_once('Masking/dob_month.php');
  require_once('Masking/dob_day.php');
  require_once('lib/request.php');
?>

<style>
.iti {
  position: relative;
  display: inline-block;
  width: 12%;
}
.iti__selected-flag {
  padding: 0 4px 0 20px !important;
}
.btn-default {
  background-color: transparent !important;
}
.dropup .dropdown-menu, .navbar-fixed-bottom .dropdown .dropdown-menu {
  height:300px !important;
}
.btn {
  padding: 12px 18px 12px 11px !important;
}
.tdf
{
  border: none;
  -webkit-box-shadow: none !important;
  box-shadow:  none !important;
  -webkit-transition:  none !important;
  -o-transition:  none !important;
  transition:  none !important;
}
.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
  color: white !important;
  text-decoration: none;
  background-color: #007bff !important;
}
select:required:invalid {
  color: gray;
}
option[value=""][disabled] {
  display: none;
}
option {
  color: #555;
}
#success_message {
  text-align: center;
  color: green;
}
</style>
<!--<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">   </script>-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/css/inputmask.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
  function insert_mask(str, index, value) {
      return str.substr(0, index) + value + str.substr(index);
  }
  function phoneMasking(text) {
    str = text.val();
    if (text.val().length >= 3) {
      str = insert_mask(str, 3, '-')
      text.val(str);
    }
    if (text.val().length >= 7) {
      str = insert_mask(str, 7, '-')
      text.val(str);
    }
  }
  function phoneMask(key, text) {
    if (key !== 8 && key !== 9) {
      if (text.val().length === 3) {
        text.val(text.val() + '-');
      }
      if (text.val().length === 7) {
        text.val(text.val() + '-');
      }
    }
    return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
  }
  $(function () {

    $('#txtphone').keydown(function (e) {
      var key = e.charCode || e.keyCode || 0;
      if(key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105)){

      } else {
        return false;
      }
      if($("#phone").val() == '+1') {
        $text = $(this);
        phoneMask(key, $text);
      }
    })

  });
  $(function () {

    $('#txtphone1').keydown(function (e) {
      var key = e.charCode || e.keyCode || 0;
      if(key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105)){

      } else {
        return false;
      }
      if($("#phone1").val() == '+1') {
        $text = $(this);
        phoneMask(key, $text);
      }
    })

  });
  $(document).on('change', '#phone', function() {
    var txtphone = $("#txtphone");
    if($("#phone").val() == '+1') {
      phoneMask('97', txtphone);
    } else {
      txtphone.val(txtphone.val().replace("-",""));
    }

  });
</script>
<script>
  $(function () {

    $('#txtsss2').keydown(function (e) {

      var key = e.charCode || e.keyCode || 0;
      $text = $(this);
      if (key !== 8 && key !== 9) {
        if ($text.val().length === 3) {
          $text.val($text.val() + '-');
        }
        if ($text.val().length === 6) {
          $text.val($text.val() + '-');
        }
      }
    })
  });
</script>
    
<link rel="stylesheet" href="Phonenewjs/build/css/intlTelInput.css">  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

<div>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once('Responses/put_responses.php');
}
?>
</div>
   
  <!--<link rel="stylesheet" href="Phonenewjs/build/css/demo.css">-->
   <form method="post" autocomplete="off" name="postdata" action="">
      <input type="hidden" name="EntityType" value="sdi_EntityTypecc82fc64978042bb9c864899ab9e4913">
      <div class="container mj">
         <div class="row">
            <div class="col-md-4"><img src="DigiPli1.png" alt="Logo" width="150px" height="118px" /></div>
            <div class="col-md-8">
               <h1 style="margin-top: 40px;" class="">Open an Account</h1>
            </div>
         </div>
         </br></br>
        <div class="row">
          <div class="col-md-12">

            <?php if(isset($success)) { ?>
              <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> <?php if(isset($success)){ echo $success; } ?>
              </div>
            <?php } ?>
          </div>
        </div>
         <div class="row">
            <div class="col-md-1">
               <select class="form-control" name="CustomerTitle" style="padding-right:0px;" id="title" required>
                  <option value="" disabled selected>Title</option>
                  <option value="sdi_0bf7cb4b0af3438f993466dd3d9dc68a">Mr</option>
                  <option value="sdi_5410d3117cd84d4a83182c7ad4fa59b3">Ms</option>
                  <option value="sdi_441a238361ef4841acb6f21084babe54">Mrs</option>
               </select>
            </div>
            <div class="col-md-3">
               <input autofocus type="text" class="form-control"  placeholder="First Name" name="CDDCustomerFirstName" required />
            </div>
            <div class="col-md-2">
               <input type="text" class="form-control" id="Enter Middle Name" placeholder="Middle Name" name="CDDClientMiddleName">
            </div>
            <div class="col-md-3">
               <input type="text" class="form-control" id="Enter Last name" placeholder="Last Name" name="CDDCustomersLastName" required />
            </div>
            <div class="col-md-3">
               <label for="vehicle1"> I currently use another name</label>
               <input type="checkbox" onclick="myFunction1()" name="CustomerOtherNameYN" value="true">
            </div>
         </div>
         <!--secondery name-->
         <div  style="display:none; margin-top: 2%" id="another_name">
            <div class="row">
               <div class="col-md-6">
                  <select class="form-control" id="typeOtherName" placeholder="Type of Other Name" name="OtherNameType" style="padding-right:0px;">
                     <option value="" disabled selected>Type of Other Name</option>
                     <option value="sdi_OtherName0a6ad30969ef49588d659f6974e2554c">Maiden Name</option>
                     <option value="sdi_OtherName81ab9956fb3e44f7b0a5d65f565d41eb">Formal Legal Name</option>
                     <option value="sdi_OtherName94017cb65be148d6a86a8af8e5925f05">Alias</option>
                  </select>
               </div>
               <div class="col-md-6">
                  <input type="text" class="form-control" id="Enter First Name" placeholder="Full Name" name="CustomerOtherName"/>
               </div>
            </div>
         </div>
         </br>
         <!--secondery Name closing -->
         <div class="row">
            <div class="col-md-6" id="datepairExample">
               <input type="text" name="dob" class="date start form-control" placeholder="Date of Birth" required />
            </div>
             <script src="http://jonthornton.github.io/Datepair.js/dist/datepair.js"></script>
         <script src="http://jonthornton.github.io/Datepair.js/dist/jquery.datepair.js"></script>
         <script>
            $('#datepairExample .time').timepicker({
              'showDuration': true,
              'timeFormat': 'g:ia'
            });
            
            $('#datepairExample .date').datepicker({
              'format': 'mm/dd/yyyy',
              'autoclose': true
            });
            
            $('#datepairExample').datepair();
         </script>
            <div class="col-md-6">
               <input type="email" id="email" class="form-control" name="Email" id="txtemail" placeholder="Email" onchange="validateEmail(this);" required />
            </div>
         </div>
         </br>
         <div class="row">
            <div class="col-md-6">
                <div style="display:flex;">
                    <input id="phone" name="PhoneCountryCodePrimary" type="tel"  class="form-control"  value="+1">
                    <input type="tel" name="CustomerPrimaryPhonenumber" class="form-control" placeholder="Primary Phone Number" maxlength="12" id="txtphone" autocomplete="off" required  />
                    </div>
                  <br>
            <script src="Phonenewjs/build/js/intlTelInput.js"></script>
            <script>
              var input = document.querySelector("#phone");
              window.intlTelInput(input, {
             
                utilsScript: "Phonenewjs/build/js/utils.js",
              });
              $("#phone").on('countrychange', function(e, countryData){
                var txtphone = $("#txtphone");
                if($("#phone").val() == '+1') {
                  if (txtphone.val().indexOf('-') == -1)
                    phoneMasking(txtphone);
                } else {
                  txtphone.val(txtphone.val().replace(/-/g,""));
                }
              });
            </script>
  
            </div>
            <div class="col-md-6">
                <!--
               <input type="Number" class="form-control" placeholder="Enter Alternate Phone Number (optional)" pattern="[0-9]{10}"  alert="please match correct format">-->
               <div style="display:flex;">
                  <input id="phone1" name="PhoneCountryCodeAlternate" type="tel"  class="form-control"  value="+1" >
                  <input type="tel" name="AlternatePhone" class="form-control" placeholder="Alternate Phone Number (optional)" maxlength="12" id="txtphone1" autocomplete="off">
                </div>
            </div>
            <script>
              var input = document.querySelector("#phone1");
              window.intlTelInput(input, {
             
                utilsScript: "Phonenewjs/build/js/utils.js",
              });
              $("#phone1").on('countrychange', function(e, countryData){
                var txtphone = $("#txtphone1");
                if($("#phone1").val() == '+1') {
                  if (txtphone.val().indexOf('-') == -1)
                    phoneMasking(txtphone);
                } else {
                  txtphone.val(txtphone.val().replace(/-/g,""));
                }
              });
            </script>
         </div>
         
         <div class="row">
            <div class="col-md-6">
              <textarea class="form-control" style="height:35px;" id="comment" pattern="\d+(\.\d{2})?" name="PhysicalAddress" placeholder="Residential Street Address" required></textarea>
            </div>
            <div class="col-md-6">
              <textarea class="form-control" style="height:35px;" id="comment" name="PhysicalAddressLine2" placeholder="Residential Street Address Line 2 (optional)"></textarea>
            </div>
         </div>
         </br>
         <div class="row">
            <div class="col-md-3">
              <select class="form-control" name="CountryOfResidence" id="drpCountry1" required>
                <option value="" disabled selected>Country of Residence</option>
                  <?php foreach ($country_list as $key => $value) {             ?>
                    <option value="<?php echo $key;?>"><?php echo $value ?></option>
                  <?php } ?>
              </select>
            </div>
            <div class="col-md-3 pl-0">

                <input type="text" class="form-control" id="state1_inp" placeholder="State/Province" name="LNStateString"  required/>
                <select class="form-control" style="display:none;" name="LNStateString" id="state1_drp">
                  <option value="" disabled selected>State/Province</option>
                  <?php foreach ($state_list as $key => $value) {             ?>
                    <option value="<?php echo $key;?>"><?php echo $value ?></option>
                  <?php } ?>
               </select>
            </div>
            <div class="col-md-3">
              <input type="text" autofocus class="form-control" id="Enter City" placeholder="City" name="City"  required/>
            </div>
            <div class="col-md-3">
               <input type="text" class="form-control" id="Zip Code" type="text" placeholder="Zip Code" name="ZipCode" match="(/[0-9]/))"  required/>
            </div>
            
         </div>
         </br>
         <div class="row">
            <div class="col-md-6">
              <select class="form-control" id="Country" placeholder="Country of Citizenship" name="CountryofCitizenship" required>
                <option value="" disabled selected>Country of Citizenship</option>
                <?php foreach ($country_list as $key => $value) {             ?>
                  <option value="<?php echo $key;?>"><?php echo $value ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="vehicle1"> My mailing address is different from my residential address</label>
              <input type="checkbox" onclick="myFunction()" name="CopyToMailing" value="" >
            </div>
         </div>
         <!--Start My mailing address is different from my residential address optional  -->
         <div style="display:none; margin-top: 2%;" id="mailing_address">
            <div class="row">
              <div class="col-md-6">
                  <div class="input-group">
                     <textarea class="form-control" style="height:35px;" rows="5" id="mailing_street1" pattern="\d+(\.\d{2})?" name="MailingAddress" placeholder="Mailing Street Address"></textarea>
                  </div>
              </div>
              <div class="col-md-6">
                <textarea class="form-control" style="height:35px;" rows="5" id="mailing_street2" name="MailingAddressLine2" placeholder="Mailing Street Address Line 2 (optional)"></textarea>
              </div>
            </div>
            </br>
            <div class="row">
               <div class="col-md-3">
                   <!--Address is different from my residential address country open-->
                  <select class="form-control" name="MailingCountry" id="drpCountry2">
                    <option value="" disabled selected>Country of Mailing</option>
                    <?php foreach ($country_list as $key => $value) {             ?>
                      <option value="<?php echo $key;?>"><?php echo $value ?></option>
                    <?php } ?>
                </select>
                 <!--Address is different from my residential address country close-->
               </div>

               <div class="col-md-3">                   
                  <input type="text" class="form-control" id="state2_inp" placeholder="State/Province" name="ProvinceMailing" />
                  <select class="form-control" style="display:none;" name="ProvinceMailing" id="state2_drp">
                    <option value="" disabled selected>State/Province</option>
                    <?php foreach ($state_list as $key => $value) {             ?>
                      <option value="<?php echo $key;?>"><?php echo $value ?></option>
                    <?php } ?>
                 </select>
               </div>
               <div class="col-md-3">
                   <input type="text" class="form-control" id="Enter City" placeholder="City" name="MailingCity" />
               </div>
               <div class="col-md-3">
                   <input type="text" class="form-control" id="Zip Code" type="text" placeholder="Zip Code" name="MailingZipCode" match="(/[0-9]/))" />
               </div>
            </div>
         </div>
         </br>
         <!--My mailing address is different from my residential address End-->
         <div class="row">
            <div class="col-md-3">
              <select class="form-control" name="IndividualCountryTIN" id="country_tin" required>
                <option value="" disabled selected>Country Issuing TIN / SSN</option>
                  <?php foreach ($country_list as $key => $value) {             ?>
                    <option value="<?php echo $key;?>"><?php echo $value ?></option>
                  <?php } ?>
              </select>
            </div>
            <div class="col-md-3 pl-0">
              <!--<input class="form-control" type="password" id=""  maxlength="9" placeholder="Tax Identification / Social Security Number" name="TIN"  />-->
              <input id="tin" name="TIN" type="text" class="form-control form-control-lg ssnInputMask" placeholder="Tax Id / Social Security Number" autocomplete="off" required>
            </div>
            <div class="col-md-6">
               <!--
               <select class="form-control" id="Primary Purpose for Opening Account" placeholder="Primary Purpose for Opening Account" name="Primary Purpose for Opening Account"  />
                  <option value="">Primary Purpose for Opening Account</option>
                  <option>Investment</option>
                  <option>Savings</option>
                  <option>Funding Purchases</option>
                  <option>Transferring Funds</option>
               </select>-->
               <div class="">
                  <select style="background:transparent;" class="form-control selectpicker" name="AccountPurpose[]" id="DDLActivites" required multiple  data-none-selected-text >
				            <option value="sdi_PurposeOfAccount4eca647df55d4f84a32433e1acdf6a92">Investment</option>
                    <option value="sdi_PurposeOfAccount2cc8fdb383f8461d90704546fce57fdc">Savings</option>
                    <option value="sdi_PurposeOfAccount753160f5fcd34684a0b3440c4b733ad8">Funding Purchases</option>
                    <option value="sdi_PurposeOfAccountd9d69c2cc3b84555a30eb94df9a50a2d">Transferring Funds</option>				
				          </select>              
                </div>
            </div>
         </div>
         </br>
         <div class="row">
            <div class="col-md-6">
              <select class="form-control selectpicker" name="ProductsAndServices[]" id="DDLActivites1" required multiple  data-none-selected-text  >
                  <?php foreach ($product_list as $key => $value) {             ?>
                    <option value="<?php echo $key;?>"><?php echo $value ?></option>
                  <?php } ?>
               </select>
            </div>
            <div class="col-md-6">
               <select class="form-control" id="expectedAverage" placeholder="Expected Average Account Value" name="AccountValue" required>
                  <option value="" disabled selected>Expected Average Account Value</option>
                  <option value="sdi_AccountValuef06bf491c6c640dc9174a9f45c85bef9">Less than $50,000</option>
                  <option value="sdi_AccountValueebb2067958024a1a9d41d02205f07b9d">$50,000 to $500,000</option>
                  <option value="sdi_AccountValued7fdc72d7d4a44e699bcde73b36ffeae">$500,000 to $1,000,000</option>
                  <option value="sdi_AccountValue0290a908bb1c45e5a9eb8ff4328a50bc">$1,000,000 +</option>
               </select>
            </div>
         </div>
         </br>
         <div class="row">
            <div class="col-md-6">
            <select class="form-control selectpicker" name="FundingSource[]" id="DDLActivites2" style="background-color: #ed1651;" multiple data-none-selected-text required >
                  
                  <option value="sdi_FundingSources944ab9798b22465997260fdd19ad0708">Investment Income</option>
                  <option value="sdi_FundingSources8ac35e5623fb45cea88ab5063131e8de">Government Payments</option>
                  <option value="sdi_FundingSourcesb282c0b28f4f491b8d4f355e7fdd83b0">Grants</option>
                  <option value="sdi_FundingSourcesee42b4e1212e434c8656c5ad710cb344">Employment Income</option>
                  <option value="sdi_FundingSourcesde6018bce198429083e74ddb8bcc2ae5">Royalty Fees</option>
                  <option value="sdi_FundingSourcesdb61434beeca4c0bb7160d6c791f9a5b">Trust Income</option>
                  <option value="sdi_FundingSources3da611f76c5246489d2d953f93f37dd9">Rental Income</option>
                  <option value="sdi_FundingSourcesd808a317173b4e1584c0714dcb01096d">Family Support Income</option>
                  <option value="sdi_FundingSourcescdc8ed823cb648dcb0ac1ca5fea4d7be">Loans</option>
                  <option value="sdi_FundingSourcesb17b6d6c3e114d5cbc7862c4b0c500d0">Other Funding </option>
                  <option value="sdi_FundingSources311c4298cee840b289fa4d67078cc6a0">Sale of Property</option>
                  <option value="sdi_FundingSources178c18d061e44741af3a4338c44f2ed7">Sale of Investments</option>
               </select>
            </div>
            <div class="col-md-6">
               <select class="form-control" id="employmentStatus" placeholder="Employment Status" name="EmploymentStatus" required>
                  <option value="" disabled selected>Employment Status</option>
                  <option value="sdi_EmploymentStatus5ba5b952782146ef96b4375955e43eee">Employed</option>
                  <option value="sdi_EmploymentStatus689868294d654d11adb132878af18331">Unemployed</option>
                  <option value="sdi_EmploymentStatus39780b8ab9c443dfb7f56a6e75592790">Self-Employed</option>
                  <option value="sdi_EmploymentStatuseb7ce9984cc949cb97f26125781ae588">Retired</option>
                  <option value="sdi_EmploymentStatus85e3e34dbb52421cbbfd51cbcfd97040">Student</option>
               </select>
            </div>
         </div>
         </br>
         <div class="row" style="text-align: center;">
            <div class="col-md-12">
               <label for="vehicle1"> By continuing I certify that I am 18 years of age, and I agree to the <a href="">User Agreement</a> and <a href="">Privacy Policy</a></label>
               <input type="checkbox" id="different from my residential address"  name="confirm" value=""  />
            </div>
         </div>
         </br>
        
         </br>
         <!--Submit Button Start-->
         <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
               <input style="background-color:#1800b9;" type="submit" class="btn btn-success btn-lg btn-block" name="btn" placeholder="DATE" value="SUBMIT"  />
            </div>
            <div class="col-md-3"></div>
         </div>
         <!--Submit Button Close-->
         </br>
      </div>
   </form>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.1/jquery.inputmask.bundle.min.js"></script>
   <script>
    $(function(){$(".ssnInputMask").inputmask("999-99-9999")})
      function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField.value) == false) 
        {
            alert('Invalid Email Address');
            return false;
        }

        return true;

}
$("#DDLActivites").selectpicker({
        noneSelectedText : 'Primary Purpose for Opening Account' // by this default 'Nothing selected' -->will change to Please Select
    });
    $("#DDLActivites1").selectpicker({
        noneSelectedText : 'Products & Services Requested' // by this default 'Nothing selected' -->will change to Please Select
    });
    $("#DDLActivites2").selectpicker({
        noneSelectedText : 'Source of Funds Being Deposited' // by this default 'Nothing selected' -->will change to Please Select
    });
   </script>
<script type="text/javascript">
  $("#drpCountry1").change(function(){
    var id_country = $('#drpCountry1').val();
    if (id_country == 'sdi_f481ee9efb0249daa1c8bea1e064f326') {
      $("#state1_inp").hide();
      $("#state1_drp").show();
      $("#state1_inp").attr("required", false);
      $("#state1_drp").attr("required", true);
    } else {
      $("#state1_inp").show();
      $("#state1_drp").hide();
      $("#state1_inp").attr("required", true);
      $("#state1_drp").attr("required", false);
    }
  });
</script>
<script type="text/javascript">
  $("#drpCountry2").change(function(){
    var id_country = $('#drpCountry2').val();
    if (id_country == 'sdi_f481ee9efb0249daa1c8bea1e064f326') {
      $("#state2_inp").hide();
      $("#state2_drp").show();
      $("#state2_inp").attr("required", false);
      $("#state2_drp").attr("required", true);
    } else {
      $("#state2_inp").show();
      $("#state2_drp").hide();
      $("#state2_inp").attr("required", true);
      $("#state2_drp").attr("required", false);
    }
  });
  $("#country_tin").change(function(){
    var country_tin = $('#country_tin').val();
    if (country_tin == 'sdi_f481ee9efb0249daa1c8bea1e064f326') {
      $(".ssnInputMask").inputmask("999-99-9999");
    } else {
      $(".ssnInputMask").inputmask('remove');
    }
  });
</script>


