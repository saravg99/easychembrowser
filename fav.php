
<?php
//add to favourites

session_start();

// Include config file
require_once "config.php";

$cid = $_SESSION['cid'];


//check if is saved in favourites
$isfav = false;

if ($_SESSION["loggedin"] == true) {

	$checkfav = "SELECT * FROM results_history r WHERE r.users_id=".$_SESSION["id"]." AND r.Compound_CID=".$cid ;
	$checkresults = mysqli_query($link, $checkfav) or print mysqli_error($link);
	if (mysqli_num_rows($checkresults)) {
		$isfav = true; 
	}
}

//print($isfav);


if (isset($_POST['fav'])) {

	if ($_SESSION["loggedin"] == true){
		if ($isfav == false)  {
			$addfav = "INSERT INTO results_history(users_id,Compound_CID) VALUES (". $_SESSION['id'] . "," . $cid .")";
			//print($addfav);
			mysqli_query($link, $addfav) or print mysqli_error($link);
		} else {
			$removefav = "DELETE FROM results_history r WHERE r.users_id=".$_SESSION["id"]." AND r.Compound_CID=".$cid;
			//print($removefav);
			mysqli_query($link, $removefav) or print mysqli_error($link);
		}
	
	header("Location: single_search.php?cid=". $cid);
		
	} else {

		header("Location: ./users/login.php");
	}

}
	

	
?>
