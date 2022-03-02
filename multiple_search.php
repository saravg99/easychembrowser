<?php
session_start();

$_SESSION['data'] = $_REQUEST;


// If PubChem CID provided, redirect to the unique search page
if ($_SESSION['data']['cid']) {
    header('Location: single_search.php');
}



// If

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
<br></br>
<br></br>
<div class="row justify-content-center">
  <div class="col-xl-8">
  <h1>Search results</h1>
  Num Hits: <?= mysqli_num_rows($rs) ?>
  <table border="0" cellspacing="2" cellpadding="4" id="dataTable">
      <thead>
          <tr>
              <th>idCode</th>
              <th>Header</th>
              <th>Compound</th>
              <th>Resolution</th>
              <th>Exp. Type</th>
              <th>Source</th>
          </tr>
      </thead>
      <tbody>
          <?php while ($rsF = mysqli_fetch_assoc($rs)) { ?>
          <tr>
              <td><a href="getStruc.php?idCode=<?= $rsF['idCode'] ?>"><?= $rsF['idCode'] ?></a></td>
              <td><?= ucwords(strtolower($rsF['header'])) ?></td>
              <td><?= ucwords(strtolower($rsF['compound'])) ?></td>
              <td><?= $rsF['resolution'] ?></td>
              <td><?= $rsF['expType'] ?></td>
              <td><?= ucwords(strtolower($rsF['source'])) ?></td>
          </tr>
          <?php } ?>
      </tbody>
  </table>

  <p class="button"><a href="index.php?new=1">New Search</a></p>
  <script type="text/javascript">
  <!-- this activates the DataTable element when page is loaded-->
      $(document).ready(function () {
          $('#dataTable').DataTable();
      });
  </script>
</div>
</div>


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
