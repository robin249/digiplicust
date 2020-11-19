<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Application Form</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <script type="text/javascript" src="datepicker/jquery.timepicker.js"></script>
     
      <script type="text/javascript" src="datepicker/bootstrap-datepicker.js"></script>
      <link rel="stylesheet" type="text/css" href="datepicker/bootstrap-datepicker.css" />
      <link rel="stylesheet" href="Phonejs/css/intlInputPhone.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <script type="text/javascript" src="datepicker/site.js"></script>
      <!--date picker close-->
      <script>
         function myFunction() {
           var x = document.getElementById("mailing_address");
           if (x.style.display === "none") {
             x.style.display = "block";
             setRequired("mailing_address", true);
             $("#mailing_street1").attr("required", true);
           } else {
             x.style.display = "none";
             setRequired("mailing_address", false);
             $("#mailing_street1").attr("required", false);
           }
         }
      </script>
      <script>
         function myFunction1() {
           var x = document.getElementById("another_name");
           if (x.style.display === "none") {
             x.style.display = "block";
             setRequired("another_name", true);
           } else {
             x.style.display = "none";
             setRequired("another_name", false);
           }
         }
         function setRequired(id_ref, val){
          input = document.getElementById(id_ref).getElementsByTagName('input');
          for(i = 0; i < input.length; i++){
            input[i].required = val;
          }
          select = document.getElementById(id_ref).getElementsByTagName('select');
          for(i = 0; i < select.length; i++){
            select[i].required = val;
          }
        }
      </script>
      <!--<script src="build/js/intlTelInput.js"></script>-->
      <style type="text/css">
         input::-webkit-outer-spin-button,
         input::-webkit-inner-spin-button {
         -webkit-appearance: none;
         margin: 0;
         }
         /* Firefox */
         input[type=number] {
         -moz-appearance:textfield;
         }
         .ui-widget-header {
         border: 1px solid #1800b9 !important;
         /* background: #f6a828 url(images/ui-bg_gloss-wave_35_f6a828_500x100.png) 50% 50% repeat-x; */
         color: #ffffff;
         font-weight: bold;
         background: #1800b9 !important;
         } 
         body
         {
         background: aliceblue;
         }
         .mj
         {
         border: 1px solid #ffffff;
         padding: 1%;
         }
         .form-control
         {
         background: transparent !important;
         }
         .caret
         {
             display:none !important;
         }
      </style>
   </head>
   <body style="background-color:#f5f9fd"; "font-family:Cambria;">