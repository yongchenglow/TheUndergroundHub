<!--Setup-->
<!doctype html PUBLIC>
<html>

	<!--Header-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!--Wepage Name-->
	  	<title>HomePage</title>
	  	
	  	<!--Style-->
	  	<link rel="stylesheet" href="normalise.css" type="text/css">
	  	<link rel="stylesheet" href="HomePageStyles.css" type="text/css">
	</head>

	<!--Navigation Bar-->
	<div>
		<ul class="navigation">
			<li><a href="index.php">Home</a></li>
			<li><a href="aboutPage.php">About</a></li>
			<li><a href="feedbackPage.php">Feedback</a></li>
		</ul>
	</div>

	<!--Web page Body-->
	<div class="container">
		<body class="textColour">
			
			<!--Web page Title and subtitle-->
		  	<div class ="billBoard">
			  	<p class ="siteTitle">The Underground Hub</p>
				<p class ="siteSlogan">the information that you need &copy; 2016</p>
			</div>
			
			<br>

			<!--Search Bar-->
			<div>
				<form action= modulePage.php method="post">
					<p align="center">
					  <input type="text" name="searchValue" id="searchValue" class="searchBar"  placeholder="Type in the module code"/>
					</p>

					<!--Search Button-->
					<p><center>
						<input type="submit" class="searchButton" name="SearchButton" id="SearchButton" value="Search"/>
					</center></p>
				</form>
			</div>
		</body>
	</div>
</html>