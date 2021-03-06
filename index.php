
<?php

session_start();

if (isset($_REQUEST['new']) or !isset($_SESSION['data'])) {
    $_SESSION['data'] = [];
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>EasyChemBrowser</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="index.php"><span>EasyChemBrowser</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>

         <?php if ($_SESSION["loggedin"] == true) {?>
                      <?= '<li style="color:white"><a><b>Welcome '. $_SESSION['username'] .'!</b></a><li><a class="" href="index.php">Search page</a></li></li><li><a href="users/profile.php">My favourites</a></li><li><a href="users/logout.php">Log Out</a></li>'; ?>
                  <?php    } else {?>
                      <?= '<li><a class="" href="index.php">Search page</a></li><li><a href="users/register.php">Sign Up</a></li>
          <li><a href="users/login.php">Login</a></li>';?>
                  <?php } ?>



        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


  <!-- ======= Hero No Slider Section ======= -->
  <section id="hero-no-slider" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-8">
            <br></br>
            <h2>Welcome to EasyChemBrowser</h2>
            <p>An easy access to PubChem.</p>
        </div>
        </div>
      </div>
    </div>
  </section><!-- End Hero No Slider Sectio -->

  <main id="main">

  <form name="MainForm" action="multiple_search.php" method="POST" enctype="multipart/form-data">
      <div class="row justify-content-center">
        <div class="col-xl-8">
            <h2>Search compounds</h2>
            <p> Obtain a unique compound:</p>
                <div class="form__group field">
                  <input type="input" class="form__field" placeholder="Ex. 3542" name="cid" id='cid' value="<?= $_SESSION['data']['cid'] ?>" />
                  <label for="cid" class="form__label"><b>PubChem CID</b></label>
                </div>
                <br></br>
                <div class="row" style="border-bottom: 2px dashed">
                </div>
                <br></br>
            <h2>Advanced Search </h2>
            <p> Obtain multiple compounds:</p>
            <div class="form__group field">
                  <input type="input" class="form__field" placeholder="Ex. CC(=O)OC(CC(=O)[O-])C[N+](C)(C)C" name="smiles" id='smiles' value="<?= $_SESSION['data']['smiles'] ?>" />
                  <label for="smiles" class="form__label"><b>Search by canonical SMILES</b></label>
                </div>
                <p></p>
                <div class="form__group field">
                  <input type="input" class="form__field" placeholder="Ex. 3-acetyloxy-4-(trimethylazaniumyl)butanoate" name="iupac" id='iupac' value="<?= $_SESSION['data']['iupac'] ?>" />
                  <label for="iupac" class="form__label"><b>Search by IUPAC Name</b></label>
                </div>
             <p></p>
            <div class="form__group field">
              <input type="input" class="form__field" placeholder="Ex. C9H17NO4" name="molecularFormula" id='molecularFormula' value="<?= $_SESSION['data']['molecularFormula'] ?>" />
              <label for="name" class="form__label"><b>Search by Molecular Formula</b></label>
            </div>
            <p></p>
            <div class="form__group field">
             <label for="name" class="form__label"><b>Search by Molecular Weight</b></label>
             <p></p>
              <p>
                  <b>From</b> <input type="text" class="form__field" placeholder="Ex. 30" name="minWeight" value="<?= $_SESSION['data']['minWeight'] ?>" size="5">
                  <b>To</b> <input type="text" class="form__field" placeholder="Ex. 60" name="maxWeight" value="<?= $_SESSION['data']['maxWeight'] ?>" size="5">
              </p>
            </div>


            <div class="form__group field">

                <label class="toggle">
                <input type="checkbox" name="lipinski">
                <span class="slider"></span>
                </label>
                <label style="vertical-align: middle; margin-bottom: 12px; margin-left: 5px"><b>Follows Lipinski rule of 5</b></label>
            </div>


            <div class="row">
            <div class="form__group field">
                    <button type='submit' class="btn btn-primary" style="background-color: #1e4356; border-color:#1e4356">Submit</button>
                    <button type='button' class="btn btn-primary" style="background-color: #1e4356; border-color:#1e4356" onclick="window.location.href='index.php?new=1'">New search</button>
            </div>
            </div>
        </div>
</div>
<br></br>

</form>


  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">

    <div class="footer-top">
      <div class="container">
      </div>
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
