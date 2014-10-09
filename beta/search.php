<?php

include ('db.php');
include ('functions.php');


	//Check if user is logged in first
	if (!checkStaffLoggedIn()) {
	header("Location: index.php"); }
	
	//Then fetch the staff record from cookie or session variable
	if(isset($_COOKIE['staff-ID'])) {
	$staffData = fetchStaffviaID($_COOKIE['staff-ID']); } else {
	$staffData = fetchStaffviaID($_SESSION['staff-ID']);
	}

	$localPage="search results"; 
	

	//Set up page numbering
	if(empty($_GET['page'])) { $pageNum = 1; } else {
	$pageNum = (int) $_GET['page']; }
	if($pageNum <= 1) { 
	$pageLimit = PROJECT_RESULTS_PER_PAGE;
	$currPage = 0; } else {
	
	$pageLimit = PROJECT_RESULTS_PER_PAGE;
	$currPage = ($pageNum - 1) * PROJECT_RESULTS_PER_PAGE;	}
	
	//Set up variables for passing between pages
	
	if(!empty($_POST['inputString'])) { $_SESSION['inputString'] = $_POST['inputString']; }
	
	
?>



<!doctype html> 
<html lang="en">

<?php include('includes/head.php'); ?>

<body>

  <?php include('includes/header.php'); ?> 
<div class="subpage-header">

    <div class="container">

        <div class="span10 first">
        <h1>SEARCH <span style="font-weight: 200;">RESULTS</span></h1>
        </div>

        <div class="span2 pag-num">
        	<?php if (searchFilms($_SESSION['inputString'],"","")) { ?>

<div class="pagination">
<ul>
    
      <?php $totalPages = ceil((fetchSearchCount($_SESSION['inputString'])) / PROJECT_RESULTS_PER_PAGE);
	 
	 $pageIndex = 1;
	 
	 while ($pageIndex <= $totalPages) {
     
     if($pageIndex == $pageNum) { ?>
      <li class="active"><a href="#"><?php echo $pageIndex; ?></a></li>
      <?php } else { ?>
      <li><a href="/search/page-<?php echo $pageIndex; ?>"><?php echo $pageIndex; ?></a></li>
      <?php 
         }		
		$pageIndex++; 
	 }
  ?>

</ul>

<?php } ?>
    </div>
    
</div>
</div>
<div class="fold-single-full">
<div class="container">
    <div class="row">
<div class="span 12">


<!-- See if search string is empty and also if no results are found then display error page -->

<?php if (!searchFilms($_SESSION['inputString'],"","")) { ?>

<h2>No results found<h2>

<p ><a href="/projects">Search again?</a></p>

<form action="/search" method="post" name="searchForm" enctype="multipart/form-data">
    
    <input name="inputString" type="text"  placeholder="Search content"/>
<p>Type in your search term & press enter</p>
</form>

<?php } else {?>

<?php 

	$counter = 1; 
	
	if($pageNum > 1) {
	$foundResults = searchFilms($_SESSION['inputString'],$currPage,$pageLimit); } else {
	$foundResults = searchFilms($_SESSION['inputString'],"","");	
	}
	
	$foundResults = searchFilms($_SESSION['inputString'],$currPage,$pageLimit);
	$counter = 1;
	
?>

<ul class="single-list-projects">
<li>
            <div class="film-name table-top-dark">PROJECT - FILM</div>
            <div class="date-added table-top-dark">DATE ADDED</div>
            </li>



<?php while( $itemData = $foundResults->fetch_object()) { 

$title_VIDEO = str_replace(' -','',$itemData->title_VIDEO);

$title_VIDEO = preg_replace("/[^a-zA-Z0-9s]/", "-", $title_VIDEO); ?>

<li>
	<div class="film-name">
<a  href="/film/<?php echo $itemData->_kp_VIDEO;?>/<?php echo $title_VIDEO; ?>"><?php echo $itemData->title_PROJECT; ?> - <?php echo $itemData->title_VIDEO; ?>
</div>
<div class="date-added dark"> <?php echo $itemData->added_VIDEO;?></div>
</a>
</li>



<?php $counter++; 

}  } /*END WHILE PROJECT  END IF */ ?>
</div>



        
        
        
    </div>
</div>
    </div>
</div>



  
  </body>
</html>
