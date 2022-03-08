<?php
session_start();

// Include config file
require_once "config.php";

$cid = $_REQUEST['cid'];
$_SESSION['cid'] = $cid;

//get data form compound
$sql = "SELECT * from Compound WHERE CID=" . $cid ;
$rs = mysqli_query($link, $sql) or print mysqli_error($link);

if (!mysqli_num_rows($rs)) { //search is empty
    header("Location: notfound.php?cid=". $cid);
}

$data = mysqli_fetch_assoc($rs);

$data['synonyms'] = str_replace(";", "<br>", $data['synonyms']);


//get target info

$data['targets'] = '';
$rsT = mysqli_query($link, "SELECT * FROM Target t INNER JOIN Target_has_Compound tc ON t.idTarget=tc.Target_idTarget WHERE Compound_CID=" . $data['CID']) or print mysqli_error($link);

if (mysqli_num_rows($rsT)) {
    $targets = [];
    while ($rsTF = mysqli_fetch_assoc($rsT)) {
        $targets[] = $rsTF['name'];
    }
    $data['targets'] = join("<br>", $targets);
}

//get source info

$data['sources'] = '';
$rsS = mysqli_query($link, "SELECT * FROM sources s INNER JOIN sources_has_Compound sc ON s.source_name=sc.sources_source_name WHERE Compound_CID=" . $data['CID']) or print mysqli_error($link);


if (mysqli_num_rows($rsS)) {
    $sources = [];
    $sourcesurl = [];
    while ($rsSF = mysqli_fetch_assoc($rsS)) {
        $sources[] = $rsSF['source_name'];
        $sourcesurl[$rsSF['source_name']] = $rsSF['source_url'];
    }
    $sourcesandurls = [];
    foreach ($sources as $sourcename) {

	array_push($sourcesandurls, '<a href="'.$sourcesurl[$sourcename].'">'.$sourcename.'</a>' );

//<a href="url">text</a>

    }

    $data['sources'] = join("<br>", $sourcesandurls);
}




//check if is saved in favourites
$isfav = false;

if ($_SESSION["loggedin"] == true) {

	$checkfav = "SELECT * FROM results_history r WHERE r.users_id=".$_SESSION["id"]." AND r.Compound_CID=".$cid ;
	$checkresults = mysqli_query($link, $checkfav) or print mysqli_error($link);
	if (mysqli_num_rows($checkresults)) {
		$isfav = true;
	}
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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


<br><br><br><br><br><br>

<div class="row justify-content-center">
<div class="col-xl-8">

	<h2>

		  <?php if ($data['header']) {?>
                      <?= $data['header'] ?>
                  <?php    } else {?>
                      <?= $data['IUPAC'] ?>
                  <?php } ?>

	</h2>



  <table class="table table-hover">
      <tbody>
          <tr>
              <td><b>PubChem CID</b></td>
              <td><?= $data['CID'] ?></td>
              <td rowspan="5">
                  <a href="https://pubchem.ncbi.nlm.nih.gov/compound/<?=$cid?>">
                      <img src="https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/cid/<?=$cid?>/png" border="0" width="300" ><br>
                        <label class="row justify-content-center">Link to PubChem</label></a>
                        <form action="fav.php" method="post">
                        <label  id="iconlabel" for="fav" class="custom-checkbox active">
                          <input type="submit" id="fav" name="fav" />
                          <i class=
                          <?php if ($isfav == true) {?>
                      <?= '"fa fa-heart fa1 heart1"'; ?>
                  <?php    } else {?>
                      <?= '"fa fa-heart fa2 heart2"';?>
                  <?php } ?>
                          ></i>
                          <i class=
                          <?php if ($isfav == true) {?>
                      <?= '"fa fa-heart fa1 heart"'; ?>
                  <?php    } else {?>
                      <?= '"fa fa-heart fa2 heart"';?>
                  <?php } ?>
                          ></i>
                          <span style="font-size: 16px; vertical-align: middle;">
                          <?php if ($isfav == true) {?>
                      <?= 'Added as favourite'; ?>
                  <?php    } else {?>
                      <?= 'Add to favourites';?>
                  <?php } ?></span>
                        </label>
                        </form>
              </td>
          </tr>
          <tr>
              <td><b>IUPAC name</b></td>
              <td><?= $data['IUPAC'] ?></td>
          </tr>
          <tr>
              <td><b>Molecular Formula</b></td>
              <td><?= $data['mol_formula'] ?></td>
          </tr>
          <tr>
              <td><b>Molecular Weight</b></td>
              <td><?= $data['mol_weight'] ?></td>
          </tr>
          <tr>
              <td><b>Lipinski</b> <br> <b>rule of 5</b></td>
              <td><b><?= $data['lipinski'] ?></b> <br>
                  LogP: <?=$data['XLogP'] ?><br>
                  H bond donors: <?=$data['HBondDonorCount'] ?><br>
                  H bond acceptors: <?=$data['HBondAcceptorCount'] ?><br>
                  Molecular weight: <?=$data['mol_weight'] ?>
              </td>
          </tr>
          <tr>
              <td><b>Description</b></td>
              <td>		  <?php if ($data['description']) {?>
                      <?= $data['description'] ?>
                  <?php    } else {?>
                      <?= '<em>No data available</em>' ?>
                  <?php } ?></td>
          </tr>
	  <tr>
              <td><b>Synonyms</b></td>
              <td colspan="2"><?php if ($data['synonyms']) {?>
                      <?= $data['synonyms'] ?>
                  <?php    } else {?>
                      <?= '<em>No data available</em>' ?>
                  <?php } ?></td>
          </tr>
          <tr>
              <td><b>Protein targets</b></td>
              <td colspan="2"><?= $data['targets']?></td>
          </tr>
          <tr>
              <td><b>Sources</b></td>
              <td colspan="2"><?php if ($data['sources']) {?>
                      <?= $data['sources'] ?>
                  <?php    } else {?>
                      <?= '<em>No data available</em>' ?>
                  <?php } ?></td>
          </tr>
      </tbody>
  </table>
</div>
</div>


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
