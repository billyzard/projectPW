<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>eAt IT - Order Your Food Easily</title>
  <link rel="icon" type="image/gif" href="<?php echo base_url('assets/head.png')?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;
  }
  </style>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#myModal").modal('show');
    });
  </script>
</head>
<body style="background-color:#f1f1f1">
<!--NAVBAR-->
<div class="container">
  <div id="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
    <a href="<?php echo base_url('index.php/Paws/home'); ?>"><img src="<?php echo base_url('assets/eatit.png'); ?>" height="50" width="150" class="gambar"></a>
    </div>
      <ul class="nav navbar-nav">
      <li><a href="<?php echo base_url('index.php/Paws/about'); ?>">About Us</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Top-Up<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="<?php echo base_url('index.php/Paws/topup'); ?>" class="dropdown">Top-Up Saldo</a></li>
        <li><a href="<?php echo base_url('index.php/Paws/riwayat'); ?>" class="dropdown">Riwayat Transaksi</a></li>
      </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Help<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="<?php echo base_url('index.php/Paws/caramembeli'); ?>" class="dropdown">Cara Pembelian</a></li>
        <li><a href="<?php echo base_url('index.php/Paws/caratopup'); ?>" class="dropdown">Cara Top-Up</a></li>
      </ul>
      </li>
      </ul>
  </div>
</div>
</div>
<!--SLIDE-->
<div class="container-fluid">
<div class="row" style="background-color:#45444A; padding-top:20px; padding-bottom:20px;">
<div class="container">
<div class="col-sm-8">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
      <li data-target="#myCarousel" data-slide-to="5"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="<?php echo base_url('assets/KroketAyamJepang.png'); ?>" alt="Chania" width="460">
      </div>

      <div class="item">
        <img src="<?php echo base_url('assets/PenneBeetRootSalmon.png'); ?>" alt="Chania" width="460">
      </div>
    
      <div class="item">
        <img src="<?php echo base_url('assets/Oreo Goreng.png'); ?>" alt="Flower" width="460">
      </div>

      <div class="item">
        <img src="<?php echo base_url('assets/Bananamon Milkshake.png'); ?>" alt="Flower" width="460">
      </div>
    
    <div class="item">
        <img src="<?php echo base_url('assets/Bola Kornet Asam Manis.png'); ?>" alt="Flower" width="460">
      </div>
    
    <div class="item">
        <img src="<?php echo base_url('assets/Pisang Molen Keju.png'); ?>" alt="Flower" width="460">
      </div>
    </div>
  </div>
</div>

<!--LOGIN-->
<div class="col-sm-4"  width="100%" height="100%" style="padding-left: 25px">
        <div class="container col-sm-12" style="background-color:#FCB315; border-radius: 25px; padding-bottom:30px">
        <?php  
          if($this->session->userdata('logged_in')!='true'){
        ?>
        <form method="post"  action="<?php echo base_url().'index.php/Paws/login'; ?>">
          <div class="form-group">
            <h3>LOGIN</h3>
            <label>Email address:</label>
            <input type="email" class="form-control" name="email">
          </div>
          <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" name="pwd">
          </div>
          <div class="checkbox">
            <label><input type="checkbox"> Remember me</label>
          </div>
          <button type="submit" class="btn" style="background-color:#45444A; color:white">Login</button>
          <a href="<?php echo base_url('index.php/Paws/register'); ?>" class="btn" role="button" style="background-color:#45444A; color:white">Register</a>
       </form>
       <?php  
        if($this->session->userdata('salah')=='gagal'){
       ?>
        <div id="myModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Email atau password anda salah</h4>
                </div>        
            </div>
          </div>
        </div>
        <?php $this->session->unset_userdata('salah');} if($this->session->userdata('hrs_login')=='belom'){?>
          <div id="myModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Login terlebih dahulu</h4>
                </div>        
            </div>
          </div>
        </div>
        <?php $this->session->unset_userdata('hrs_login');} ?>
</div>
</div>
</div>
</div>
</div>
<?php 
  } 
  else{
?>
    <h3>Hai <?php echo $this->session->userdata('nama'); ?></h3>
    Saldo anda Rp.<?php echo $this->session->userdata('saldo'); ?>
    <br><br>
    <a href="<?php echo base_url('index.php/Paws/topup'); ?>" class="btn" role="button" style="background-color:#45444A; color:white">Top-Up Saldo</a>
    <br><br>
    <a href="<?php echo base_url('index.php/Paws/logout'); ?>" class="btn" role="button" style="background-color:#45444A; color:white">Logout</a>
</div>
</div>
</div>
</div>
</div>
<?php } ?>
<?php if($this->session->userdata('beda')=='benar'){ ?>
  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Password dan Confirm Password tidak sesuai</h4>
        </div>        
      </div>
    </div>
  </div>
<?php $this->session->unset_userdata('beda');} ?>
<!--KONTEN-->
<div id="contents">
<div  class="container" style="margin-bottom:20px"><br>
    <div class="row">
        <form action="<?php echo base_url('index.php/Paws/tambahProfil'); ?>" method="post">
            <div class="col-sm-8">
            <h2><span>Register</span></h2>
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span> Required Field</strong></div>
                <div class="form-group">
                    <label for="InputName">Enter Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nama"placeholder="Enter Name" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputEmail">Enter Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputPassword">Password</label>
                    <div class="input-group">
                        <input type="Password" class="form-control" name="pass" placeholder="Password" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputPassword">Confrim Password</label>
                    <div class="input-group">
                        <input type="Password" class="form-control" name="repass" placeholder="Confirm Passowrd" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <input value="Submit" style="background:#FCB315; height: 50; width: 150; " type="submit" class="btn">                
</div>
<br><br>
</td>
</tr>
</div>
</div>
</div>
</center>
</form>
</div>
<!--FOOTER-->
<div style="background-color:#FCB315; padding-top:8px; padding-bottom:3px">
  <div style="background-color:#45444A; padding-top:6px; padding-bottom:6px">
    <div class="container">
      <div class="row">
        <div class="col-sm-3" style="color:white; font-size:10px"><center><br>eAt IT</center></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-3" style="color:white"><center>Get Social With Us</center>
          <center>
            <a href="#"><img src="<?php echo base_url('assets/twitter.png'); ?>" width="25px" height="25px"> </a>
            <a href="#"><img src="<?php echo base_url('assets/g+.png'); ?>" width="25px" height="25px"> </a>
            <a href="#"><img src="<?php echo base_url('assets/fb.png'); ?>" width="25px" height="25px"></a>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html> 