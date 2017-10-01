<!--Setup-->
<!doctype html PUBLIC>
<html>

	<!--Header-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!--Wepage Name-->
	  	<title>aboutPage</title>
	  	
	  	<!--Style-->
	  	<link rel="stylesheet" href="normalise.css" type="text/css">
	  	<link rel="stylesheet" href="aboutPageStyles.css" type="text/css">
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
	<body class="textColour">
			
		<!--Web page Title and subtitle-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
				  	<p class ="siteTitle">The Underground Hub</p>
					<p class ="siteSlogan">the information that you need &copy; 2016</p>
				</div>
			</div>
		</div>

		<!--Empty Line-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
					<p></p>
				</div>
			</div>
		</div>

		<!--Body-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
					<form method="post">
						<p class="normalText">Your feedback about our website is kindly appreciated</p>
						<p class="normalText">please provide suggestions on how we can improve</p>
						<textarea class="adviceInput" name="feedback"></textarea>
						<p></p>

						<?php
							if (isset($_POST['submit']))
							{
								// Connect to the database
								$db_host = "localhost";
								$db_username = "root";
								$db_pass = "KeepGoing88!";
								$db_name = "MainDatabase";

								$conn = mysql_connect($db_host,$db_username,$db_pass);
								if(! $conn )
								{
									die('Could not connect: ' . mysql_error());
								}

								//Select the database
								$feedback = $_POST["feedback"];

								if(!$feedback){
									echo "<p>Error you submitted a blank feedback</p>";
								} else {
									$query = "INSERT INTO Feedback (feedback) VALUES ('$feedback')";
									mysql_select_db($db_name);
									$insert = mysql_query( $query, $conn);
								}
							}
						?>

						<input type="submit" name="submit" value="Submit" class="button submitButton" onclick="return confirm('Are you sure you want to submit?')"/>
					</form>
				</div>
			</div>
		</div>

		<!--Empty Line-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
					<p></p>
				</div>
			</div>
		</div>						
	</body>
</html>