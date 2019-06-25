
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="<?php echo base_url();?>assets/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="<?php echo base_url();?>assets/css/style.min.css" rel="stylesheet">
  <style>

    .map-container{
overflow:hidden;
padding-bottom:56.25%;
position:relative;
height:0;
}
.map-container iframe{
left:0;
top:0;
height:100%;
width:100%;
position:absolute;
}

  </style>
</head>

<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand waves-effect " href="https://mdbootstrap.com/docs/jquery/" target="_blank">
          <strong class="blue-text">CRUD AWAL</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

          <!-- Left -->

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="https://www.facebook.com/mdbootstrap" class="nav-link waves-effect" target="_blank">
                <strong class="green-text"><?php  echo ucfirst($this->session->userdata('is')); ?></strong>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php  echo base_url('index.php/welcome/logout') ?>" class="nav-link border border-light rounded waves-effect"
              >
                <i class="fab fa-github mr-2"></i>Log Out
              </a>
            </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

  <!--Main Navigation-->