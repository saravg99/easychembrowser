<?php
session_start();

$cid = $_SESSION['data']['cid'];

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
  <!-- DataTable -->
  <link rel="stylesheet" href="DataTable/jquery.dataTables.min.css">
  <script type="text/javascript" src="DataTable/jquery-2.2.0.min.js"></script>
  <script type="text/javascript" src="DataTable/jquery.dataTables.min.js"></script>

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
          <li><a class="" href="index.html">Search page</a></li>
          <li><a href="about.html">About us</a></li>
          <li><a href="contact.html">Contact Us</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <table class="table table-hover">
      <tbody>
          <tr>
              <td>PubChem reference</td>
              <td><?= $_SESSION['data']['cid'] ?></td>
              <td rowspan="5">
                  <a href="https://pubchem.ncbi.nlm.nih.gov/compound/$cid">
                      <img src="https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/cid/$cid/png" border="0" width="250" ><br>
                          Link to PubChem</a>
              </td>
          </tr>
          <tr>
              <td>Header</td>
              <td><?= $data['header'] ?></td>
          </tr>
          <tr>
              <td>Title</td>
              <td><?= $data['compound'] ?></td>
          </tr>
          <tr>
              <td>Resolution</td>
              <td>
                  <?php if ($data['resolution']) {?>
                      <?= $data['resolution'] ?>
                  <?php    } else {?>
                          N.D.
                  <?php } ?>
              </td>
          </tr>
          <tr>
              <td>Ascession Date</td>
              <td><?= $data['ascessionDate'] ?></td>
          </tr>
          <tr>
              <!--$expTypeArray is generated in globals.inc.php-->
              <td>Experiment type</td>
              <td colspan="2"><?= $expTypeArray[$data['idExpType']]['ExpType'] ?></td>
          </tr>
          <tr>
              <td>Authors</td>
              <td colspan="2"><?= $data['auts']?></td>
          </tr>
          <tr>
              <td>Source</td>
              <td colspan="2"><?= $data['sources'] ?></td>
          </tr>
          <tr>
              <td>Sequence(s)</td>
              <td colspan="2"><?= $data['sequences'] ?></td>
          </tr>
      </tbody>
  </table>


  <!-- ======= Footer ======= -->
  <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">

    <div class="footer-top">
      <div class="container">
        <div class="row">
        </div>
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