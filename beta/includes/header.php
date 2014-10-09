<div class="navbar navbar-fixed-top" >
    <div class="navbar-inner">
    	<div class="container">
    <a class="brand" href="/home">DASHBOARD <span style="font-size: 10px;">V.3.5</span></a>
    <ul class="nav"> 
    <li><a href="/projects">Projects</a></li>
    <li><a href="/clients">Clients</a></li>
    <li><a href="#">Clipboard</a></li>
    <li><a href="https://vimeo.com/kingdomcreative/videos" target="_blank">Vimeo</a></li>
    <li><a href="/logout">Logout</a></li>
    </ul>
    
    <form id="searchform" class="navbar-search pull-right" action="/search" method="post" name="searchform" enctype="multipart/form-data">
		<div>
			<input type="text" size="30" value="search dashboard" id="inputString" name="inputString" class="search-query" onkeyup="lookup(this.value);" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'search dashboard':this.value;" />
		</div>
		<div id="suggestions"></div>
	</form>
    
</div>
    </div>
    </div>