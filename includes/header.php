
    
    
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="header" style="display:none;">
      <div class="container">
      <div class="col-sm-4 col-md-2 col-lg-1">
      <img src="img/kingdom-full-tertiary.svg" class="logo">
      </div>
      
       <div class="col-sm-8 col-md-8 col-lg-10 right-cl">
<h2>Howdy, <?php echo $staffData->shortname_STAFF; ?></h2>
      </div>
      
        <div class="col-sm-8 col-md-2 col-lg-1">
        <img src="img/meet-<?php echo $staffData->username_STAFF; ?>.png">
      </div>
      
      </div>
    </div> <!-- /HEADER -->
    
    <nav class="navbar" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
       <i class="fa fa-bars"></i>
      </button>
      <a class="navbar-brand" href="#">Dashboard <span style="font-size: 10px;">4.0</span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <li><a href="home">Home</a></li>
      <li><a href="home">Projects</a></li>
      <li><a href="clients">Clients</a></li>
      <li><a href="info">Key Info</a></li>
      <li><a href="clipboard">Clipboard</a></li>
    
      <?php  if (strpos($staffData->type_STAFF, 'Production Manager') !== false) { ?>
      <li><a href="http://dev.kingdom-creative.co.uk/today">Today</a></li>
      <?php   } ?>
    
      <li><a href="https://vimeo.com/kingdomcreative/videos" target="_blank">Vimeo</a></li>
      <li><a href="logout">Logout</a></li>
      </ul>
      


      <form class="navbar-form navbar-right search-right" role="search">
        <div class="form-group">
		<div>
			<input type="text" size="30" value="Search dashboard" id="inputString" name="inputString" class="search-query form-control" onkeyup="lookup(this.value);" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'search dashboard':this.value;" />
		</div>
		<div id="suggestions"></div>
	</form>
        </div>
      </form>
      
        <!--
<ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-folder-open-o hidden-xs"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>      </ul>
-->


        </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
