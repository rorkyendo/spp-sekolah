<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/img/favicon.ico">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url()?>assets/img/apple-icon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    SMAN
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

  <!-- CSS Files -->
  <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url()?>assets/css/paper-dashboard.min.css?v=2.0.1" rel="stylesheet" />
  <link href="<?php echo base_url()?>assets/css/select2.css" rel="stylesheet" />
  <link href="<?php echo base_url()?>assets/plugins/sweetalert/sweetalert2.min.css" rel="stylesheet" />

  <!--   Core JS Files   -->
  <script src="<?php echo base_url()?>assets/js/core/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/core/popper.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/select2.full.min.js"></script>

  <!--  Plugin for Sweet Alert -->
  <script src="<?php echo base_url()?>assets/plugins/sweetalert/sweetalert2.all.min.js"></script>

  <!-- Fileupload -->
  <script src="<?php echo base_url()?>assets/js/plugins/jasny-bootstrap.min.js"></script>
  <style media="screen">
    .background-image{
    background-image: url(<?php echo base_url()?>assets/img/background-batik-png.png);
    background-position: unset;
    background-size: auto;
    }
  </style>
</head>
  <script>
  function tandaPemisahTitik(b){
    var _minus = false;
    if (b<0) _minus = true;
    b = b.toString();
    b=b.replace(".","");

    c = "";
    panjang = b.length;
    j = 0;
      for (i = panjang; i > 0; i--){
       j = j + 1;
       if (((j % 3) == 1) && (j != 1)){
         c = b.substr(i-1,1) + "." + c;
       } else {
         c = b.substr(i-1,1) + c;
       }
      }
    if (_minus) c = "-" + c ;
    return c;
  }

  function numbersonly(ini, e){
    if (e.keyCode>=49){
        if(e.keyCode<=57){
          a = ini.value.toString().replace(".","");
          b = a.replace(/[^\d]/g,"");
          b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
          ini.value = tandaPemisahTitik(b);
          return false;
        }
      else if(e.keyCode<=105){
        if(e.keyCode>=96){
            //e.keycode = e.keycode - 47;
            a = ini.value.toString().replace(".","");
            b = a.replace(/[^\d]/g,"");
            b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
            ini.value = tandaPemisahTitik(b);
            //alert(e.keycode);
            return false;
          }
        else {return false;}
      }
      else {
        return false;
      }
    }else if (e.keyCode==48){
        a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
        b = a.replace(/[^\d]/g,"");
      if (parseFloat(b)!=0){
        ini.value = tandaPemisahTitik(b);
        return false;
      } else {
        return false;
      }
    }else if (e.keyCode==95){
      a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
      b = a.replace(/[^\d]/g,"");
      if (parseFloat(b)!=0){
        ini.value = tandaPemisahTitik(b);
        return false;
      } else {
        return false;
      }
    }else if (e.keyCode==8 || e.keycode==46){
      a = ini.value.replace(".","");
      b = a.replace(/[^\d]/g,"");
      b = b.substr(0,b.length -1);
      if (tandaPemisahTitik(b)!=""){
        ini.value = tandaPemisahTitik(b);
      } else {
        ini.value = "";
      }

    return false;
    } else if (e.keyCode==9){
      return true;
    } else if (e.keyCode==17){
      return true;
    } else {
    //alert (e.keyCode);
      return false;
    }

  }
  </script>
