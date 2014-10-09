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

	$localPage="clients";

?>

<!doctype html>
<html lang="en">
<?php include('includes/head.php'); ?>

<body>

  <?php include('includes/header.php'); ?> 

<div class="menu-header">
	<div class="container">

        <div class="span8 first">
		<h1>VIEW <span style="font-weight: 200;">CLIENTS</span></h1>
        </div>

        <div class="span4 staff">
        <img src="img/meet-<?php echo $staffData->shortname_STAFF; ?>.png">
        </div>

	</div>
</div>


<! Header Options !>
<div class="header-full">
<div class="container header-option">
	    <div class="row">


</div>

</div>

</div>

<div class="tab-full">
<div class="container">
    <div class="row">
        <div class="span12"><!-- Span 12 -->


  <div class="tab-content tab-bg">






  <! Clients Tab !>
  <div class="tab-pane active" id="tab2">

    

    <div class="side-opt">
  <ul class="nav span1">
      <li class="add transition active"><a href="#pane5" data-toggle="tab"><i class="icon-group"></i></a></li>
    <li class="view transition"><a href="#pane4" data-toggle="tab"><i class="icon-plus"></i></a></li>
    <li class="end-fill transition"></li>
  </ul>
</div>


     <div class="tab-content span11 first project">

    <! Add Project !>
    <div id="pane4" class="tab-pane">
      <h2 class="sub-title">ADD <span style="font-weight: 200;">CLIENT</span></h2>
<!--       Add new client form -->
<p>Coming Soon</p>
    </div>


    <! CLIENT LIST !>
    <div id="pane5" class="tab-pane active">
        <h2 class="sub-title">CLIENT <span style="font-weight: 200;">LIST</span></h2>

            <div class="action-filter">
            <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                SORT<span class="caret"></span> </a>

            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
            <!-- dropdown menu links -->
            <li><a tabindex="-1" href="#" class="clientSortToggle" data-sort="name">BY NAME</a></li>
            <li><a tabindex="-1" href="#" class="clientSortToggle" data-sort="login">BY ACTIVITY</a></li>
            </ul>
            </div>
            </div>

    <div class="clearboth"></div>

    <!-- CLIENT DATA AJAX -->

    <div id="client-data">
    

    </div> <!-- END CLIENT DATA -->

    </div>


    

  </div><!-- END Clients -->

</div>
</div>
</div>

        </div><!-- END Span 12 -->
    </div>
</div><!-- END Container -->
</div>

</body>

</html>
		
