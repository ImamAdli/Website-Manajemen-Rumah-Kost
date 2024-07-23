<header>
  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <div class="logo"> <a href="index.php"><img style="width: 130px;" src="assets/images/Logo_Kost.png" alt="image"/></a> </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
            <?php 
              $sql2 ="SELECT admin.* FROM admin";
              $query = mysqli_query($koneksidb,$sql2);
              $result = mysqli_fetch_array($query);
            ?>
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
              <p class="uppercase_text">Untuk Sponsor, Email Kita ke : </p>
              <a href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=<?php echo htmlentities($result['email']);?>"><?php echo htmlentities($result['email']);?></a> 
            </div>
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
              <p class="uppercase_text">Untuk Layanan, Telpon Kita ke: </p>
              <a href="https://wa.me/<?php echo htmlentities($result['telp']);?>"><?php echo htmlentities($result['telp']);?></a> 
            </div>
          </div>
          <div class="login_info">
            <?php   
            if(strlen($_SESSION['ulogin'])==0){	
              echo "<div class='login_btn'> <a href='#loginform' class='btn btn-xs uppercase' data-toggle='modal' data-dismiss='modal'>Login / Register</a> </div>";
              }
            else{ 
              $nauser = $_SESSION['fname'];
              echo "<h5>Selamat Datang, $nauser!</h5>"; 
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="header_wrap">
        <div class="user_login">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> 
            <?php 
            $email=$_SESSION['ulogin'];
            $sql ="SELECT nama_user FROM users WHERE email='$email'";
            $query = mysqli_query($koneksidb,$sql);
            if(mysqli_num_rows($query)>0){
              while($results = mysqli_fetch_array($query)){
                echo htmlentities($results['nama_user']); }}?>
                <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                  <ul class="dropdown-menu">
                  <?php if($_SESSION['ulogin']){?>
                    <li><a href="profile.php">Profile Settings</a></li>
                    <li><a href="update-password.php">Update Password</a></li>
                    <li><a href="riwayatsewa.php">Riwayat Sewa</a></li>
                    <li><a href="logout.php">Sign Out</a></li>
                    <?php } else { ?>
                    <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Profile Settings</a></li>
                    <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Update Password</a></li>
                    <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Riwayat Sewa</a></li>
                    <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Sign Out</a></li>
                    <?php } ?>
                  </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>        	 
          <li><a href="page.php?type=aboutus">Tentang Kami</a></li>
          <li><a href="kost-listing.php">Daftar Kost</a>
          <li><a href="page.php?type=faqs">Pertanyaan Terkait</a></li>
        </ul>
      </div>
    </div>
  </nav> 
  
</header>

<style>
  .navbar-fixed {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
  }
  .navbar-default {
    transition: top 1s;
  }
</style>

<script>
  window.onscroll = function() {fixNavbar()};

  var navbar = document.getElementById("navigation_bar");
  var sticky = navbar.offsetTop;

  function fixNavbar() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("navbar-fixed")
    } else {
      navbar.classList.remove("navbar-fixed");
    }
  }
</script>