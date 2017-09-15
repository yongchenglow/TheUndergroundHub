<?php 
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
if(isset($_POST['searchValue']) & count($_POST['searchValue'])) { $_SESSION['post'] = $_POST['searchValue']; }
if(isset($_SESSION['post']) && count($_SESSION['post'])) { $_POST['searchValue'] = $_SESSION['post']; }
if(isset($_POST['intake']) & count($_POST['intake'])) { $_SESSION['intake'] = $_POST['intake']; }
if(isset($_SESSION['intake']) && count($_SESSION['intake'])) { $_POST['intake'] = $_SESSION['intake']; }
if(!isset($_POST['intake'])){$_POST['intake'] = '2015/16 SEM 1';}
?>

<!--Setup-->
<!doctype html PUBLIC>
<html>
	<!--Header-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<!--Wepage Name-->
	  	<title>ModulePage</title>
	  	
	  	<!--Style-->
	  	<link rel="stylesheet" href="normalise.css" type="text/css">
	  	<link rel="stylesheet" href="ModulePageStyles.css" type="text/css">
	</head>

	<!--Web page Body-->
	<body class="textColor">
		<!--Advertisment Block-->
		<div class="container">
			<div class = "row">
				<div class = "col-12 advertisment">
					<a href="https://www.facebook.com/bakerybrera/" target="_blank">
						<img src="BakeryBrera.jpg" class="image" alt="Bakery Brera">
					</a>
					<div class="advertWords">Advertisment</div>
				</div>
			</div>
		</div>

		<!--Web page Menu-->
		<div class="container">
		  	<div class ="row">
				<!--Logo-->
				<div class ="col-4">
					<p class ="siteTitle">
						<a href="index.php">The Underground Hub</a>
					</p>
					<p class ="siteSlogan">
						the information that you need &copy; 2016
					</p>
				</div>
			
				
				<!--Search-->
				<form action= modulePage.php method="post">
					<!--Search Bar-->
					<div class="col-7">
					<p align="center">
						<input type="text" name="searchValue" id="searchValue" class="searchBar"  placeholder="Type in the module code"/>
					</p>
					</div>
								
					<!--Search Button-->
					<div class="col-1 alignSearchButton">
						<input type="submit" class="button" name="SearchButton" id="SearchButton" value="Search">
					</div>
				</form>
			</div>
		</div>
		
		<!--Module Heading-->
		<div class="container">
			<div class = "row">
				<?php
					// Connect to the database
					$db_host = "localhost";
					$db_username = "root";
					$db_pass = "KeepGoing88!";
					$db_name = "MainDatabase";

					$conn = new mysqli($db_host,$db_username,$db_pass,$db_name) or die("Unable to connect");

					//Query the database
					$code = $_POST["searchValue"];
					$sql = "SELECT * FROM Module WHERE ModuleCode = '$code'";
					$result = $conn->query($sql);

					if(!$result){
						echo "Could not run query: " . mysql_error();
						exit;
					}

					if($result-> num_rows > 0){
						while($rows = $result -> fetch_assoc())
						{
							$Mcode = $rows['ModuleCode'];
							$Mname = $rows['ModuleName'];
							$Sem1 = "15/16 SEM 1";
							$Sem2 = "15/16 SEM 2";
							$Sem1Val = "2015/16 SEM 1";
							$Sem2Val = "2015/16 SEM 2";
							$input = $_POST['intake'];
							if ($input == $Sem1Val) {
								$option1 = $Sem1;
								$option2 = $Sem2;
								$Value1 = $Sem1Val;
								$Value2 = $Sem2Val;
							} else {
								$option1 = $Sem2;
								$option2 = $Sem1;
								$Value1 = $Sem2Val;
								$Value2 = $Sem1Val;
							}

							

							//Display Results
							echo "<div class = 'col-1-5 alignRateButton'>
									<a href=RateModulePage.php class='button linkButton' role='button'>Rate Module</a>
								  </div>";
							echo "<div class='col-1-5 semester'>
									<form method='post'>
										<select class='dropdown form-control' name ='intake' id='intake' onchange='this.form.submit()'>
											<option value='$Value1'>$option1</option>
											<option value='$Value2'>$option2</option>
										</select>
									</form>
								</div>";
							echo "<div class = 'col-1-5 moduleCode'> $Mcode </div>";
							echo "<div class = 'col-8 moduleName'> $Mname </div>";
						}
					}else{
						echo "
							<div class = 'col-12'>
								<p align='center'> Sorry we don't have the following data yet. Stay tuned for the next update!</p>
							</div>
							";
					}
					$conn-> close();
				?>
			</div>
		</div>

		<!--Blank Line-->
		<div class="container">
			<div class = "row">
				<div class = "col-12"></div>
			</div>
		</div>

		<!--Module Description-->
		<div class="container">
			<div class = "row">
				<?php
					// Connect to the database
					$db_host = "localhost";
					$db_username = "root";
					$db_pass = "KeepGoing88!";
					$db_name = "MainDatabase";
					$conn = new mysqli($db_host,$db_username,$db_pass,$db_name) or die("Unable to connect");

					//Query the database for ID
					$code = $_POST['searchValue'];
					$year = $_POST['intake'];
					$sql1 = "SELECT Identification FROM Intake WHERE ModuleCode = '$code' AND Year = '$year'";
					$result1 = $conn->query($sql1);

					if(!$result1){
						echo "Could not run query 1: " . mysql_error();
						exit;
					}
					
					// Query the database for Module Information	
					$find = $result1 -> fetch_assoc();
					$id = $find['Identification'];
					$sql2 = "SELECT * FROM GeneralInformation WHERE Identification = '$id'";
					$result2 = $conn->query($sql2);

					if(!$result2){
						echo "Could not run query 2: " . mysql_error();
						exit;
					}
					
					if($result2-> num_rows > 0){
						while($rows = $result2 -> fetch_assoc())
						{
							$contributors = $rows['Contributors'];
							if($contributors == "0"){
								$difficulty = "2.5";
								$textbook = "N/A";
								$lectures = "N/A";
								$tutorials = "N/A";
								$webLectures = "N/A";
							} else {
								$difficulty = (round(((($rows['LevelOfDifficulty'])*10.0)/$contributors))/10.0);
								$text = round($rows['Textbook']/$contributors*100);
								$lec = round($rows['Lectures']/$contributors*100);
								$tut = round($rows['Tutorials']/$contributors*100);
								$web = round($rows['WebLecture']/$contributors*100);
								$textbook = "$text% Yes";
								$lectures = "$lec% Yes";
								$tutorials = "$tut% Yes";
								$webLectures = "$web% Yes";								
							}
							echo "
								<div class = 'col-4'>
									<table class = 'content padding'>
										<tr class = 'rowContent'>
											<td class = 'item'>Level of Difficulty</td>
											<td class = 'verdict'>$difficulty</td>
										</tr>
										<tr class = 'rowContent'>
											<td class = 'item'>Textbook Useful?</td>
											<td class = 'verdict'>$textbook</td>
										</tr>
										<tr class = 'rowContent'>
											<td class = 'item'>Lectures Useful?</td>
											<td class = 'verdict'>$lectures</td>
										</tr>
										<tr class = 'rowContent'>
											<td class = 'item'>Tutorials Useful?</td>
											<td class = 'verdict'>$tutorials</td>
										</tr>
										<tr class = 'rowContent'>
											<td class = 'item'>Web Lectures Useful?</td>
											<td class = 'verdict'>$webLectures</td>
										</tr>
									</table>
								</div>
							";
						}
					}
					
					$conn-> close();
				?>	
				<?php
					// Connect to the database
					$db_host = "localhost";
					$db_username = "root";
					$db_pass = "KeepGoing88!";
					$db_name = "MainDatabase";
					$conn = new mysqli($db_host,$db_username,$db_pass,$db_name) or die("Unable to connect");

					//Query the database for ID
					$code = $_POST["searchValue"];
					$year = $_POST['intake'];
					$sql1 = "SELECT * FROM Module WHERE ModuleCode = '$code'";
					$result1 = $conn->query($sql1);

					if(!$result1){
						echo "Could not run query 1: " . mysql_error();
						exit;
					}
					
					if($result1-> num_rows > 0){
						while($rows = $result1 -> fetch_assoc())
						{
							$Mcredit = $rows['ModularCredit'];
							$Mworkload = $rows['Workload'];
							$Mprereq = $rows['Prerequisites'];
							$Mcoreq = $rows['Co-requisites'];
							$Mpreclusions = $rows['Preclusions'];
							$McrossListings = $rows['Cross-Listings'];
							$Mdescription = $rows['ModuleDescription'];

							//Display Results
							echo "
							<div class = 'col-8'>
								<table class = 'content padding'>
									<tr class = 'moduleContent'>
										<td class = 'description'> Modular Credit: </td>
										<td class = 'value'> $Mcredit </td>
									</tr>
									<tr class = 'moduleContent'>
										<td class = 'description'> Workload: </td>
										<td class = 'value'> $Mworkload </td>
									</tr>
									<tr class = 'moduleContent'>
										<td class = 'description'> Prerequisites: </td>
										<td class = 'value'> $Mprereq </td>
									</tr>
									<tr class = 'moeduleContent'>
										<td class = 'description'> Co-requisites: </td>
										<td class = 'value'> $Mcoreq </td>
									</tr>
									<tr class = 'moduleContent'>
										<td class = 'description'> Preclusions: </td>
										<td class = 'value'> $Mpreclusions </td>
									</tr>
									<tr class = 'moduleContent'>
										<td class = 'description'> Cross-Listings: </td>
										<td class = 'value'> $McrossListings </td>
									</tr>
								</table>
								<p>$Mdescription</p>
							</div>";
						}
					}else{
						echo "
							<div class = 'col-12'>
								<p align='center'> Sorry we don't have the following data yet. Stay tuned for the next update!</p>
							</div>
							";
					}
					$conn-> close();
				?>
			</div>
		</div>

		<!--Professors-->
		<div class="container">
			<div class = "row">
				<div class = "col-12 moduleCode">Professors</div>
			</div>
		</div>

		<!--Professors Ratings-->
		<?php
			// Connect to the database
			$db_host = "localhost";
			$db_username = "root";
			$db_pass = "KeepGoing88!";
			$db_name = "MainDatabase";
			$conn = new mysqli($db_host,$db_username,$db_pass,$db_name) or die("Unable to connect");

			//Query the database for ID
			$code = $_POST["searchValue"];
			$year = $_POST['intake'];
			$sql1 = "SELECT Identification FROM Intake WHERE ModuleCode = '$code' AND Year = '$year'";
			$result1 = $conn->query($sql1);

			if(!$result1){
				echo "Could not run query 1: " . mysql_error();
				exit;
			}

			// Query the database for Module Information	
			$find = $result1 -> fetch_assoc();
			$id = $find['Identification'];
			$sql2 = "SELECT * FROM Professors WHERE Identification = '$id'";
			$result2 = $conn->query($sql2);

			if(!$result2){
				echo "Could not run query 2: ".mysql_error();
				exit;
			}
					
			if($result2-> num_rows > 0){
				while($rows = $result2 -> fetch_assoc())
				{
					$name = $rows['Name'];
					$contributors = $rows['Contributors'];
					$teachingLevel = round(($rows['TeachingLevel']*10)/$contributors)/10.0;
					$hotness = round(($rows['Hotness']*10)/$contributors)/10;
					$toughGrader = $rows['ToughGrader'];
					$goodFeedback = $rows['GoodFeedback'];
					$respectable = $rows['Respectable'];
					$quizMaster = $rows['QuizMaster'];
					$examFocused = $rows['ExamFocused'];
					$textbookFocused = $rows['TextbookFocused'];
					$helpSessions = $rows['HelpSessions'];
					$inspirational = $rows['Inspirational'];
					$slidesFocused = $rows['SlidesFocused'];
					$awesomeLectures = $rows['AwesomeLectures'];
					$halarious = $rows['Halarious'];
					$beReadyToRead = $rows['BeReadyToRead'];

					if($contributors == "0"){
						$teaching = "N/A";
						$hot = "N/A";
						$grade = $toughGrader;
						$feedback = $goodFeedback;
						$respect = $respectable;
						$quiz = $quizMaster;
						$exam = $examFocused;
						$textbook = $textbookFocused;
						$helpSess = $helpSessions;
						$inspire = $inspirational;
						$slides = $slidesFocused;
						$awesome = $awesomeLectures;
						$halar = $halarious;
						$read = $beReadyToRead;
					} else {
						if($teachingLevel > 4){
							$teaching = "Godlike";
						} else if($teachingLevel > 3){
							$teaching = "Excellent";
						} else if($teachingLevel > 2){
							$teaching = "Superb";
						} else if($teachingLevel > 1){
							$teaching = "Good";
						} else {
							$teaching = "Mediocre";
						}

						if($hotness > 4){
							$hot = "Lava";
						} else if($hotness > 3){
							$hot = "Scorching";
						} else if($hotness > 2){
							$hot = "Flaming";
						} else if($hotness > 1){
							$hot = "Spicy";
						} else {
							$hot = "Normal";
						}

						$grade = round($toughGrader/$contributors*100);
						$feedback = round($goodFeedback/$contributors*100);
						$respect = round($respectable/$contributors*100);
						$quiz = round($quizMaster/$contributors*100);
						$exam = round($examFocused/$contributors*100);
						$textbook = round($textbookFocused/$contributors*100);
						$helpSess = round($helpSessions/$contributors*100);
						$inspire = round($inspirational/$contributors*100);
						$slides = round($slidesFocused/$contributors*100);
						$awesome = round($awesomeLectures/$contributors*100);
						$halar = round($halarious/$contributors*100);
						$read = round($beReadyToRead/$contributors*100);
					}

					//Display Results
					echo "
						<div class='container'>
							<div class = 'row'>
								<div class = 'col-4'>
									<div class ='center'>
										<div class ='profName'>$name</div>
									</div>
									<table class = 'content'>
										<tr class = 'rowContent'>
											<td class = 'item'>Teaching Level</td>
											<td class = 'verdict'>$teaching</td>
										</tr>
										<tr class = 'rowContent'>
											<td class = 'item'>Hotness</td>
											<td class = 'verdict'>$hot</td>
										</tr>
									</table>
								</div>
								<div class = 'col-8'>
				                    <span class='label label-primary'>Tough Grader ($grade%)</span>
				                    <span class='label label-primary'>Gives Good Feedback ($feedback%)</span>
				                    <span class='label label-primary'>Pop Quiz Master ($quiz%)</span>
				                    <span class='label label-primary'>Help Sessions ($helpSess%)</span>
				                    <span class='label label-primary'>Awesome Lectures ($awesome%)</span>
				                    <span class='label label-primary'>Exam Focused ($exam%)</span>
				                    <span class='label label-primary'>Inspirational ($inspire%)</span>
				                    <span class='label label-primary'>Hilarious ($halar%)</span>
				                    <span class='label label-primary'>Respected by Students ($respect%)</span>
				                    <span class='label label-primary'>Textbook Focused ($textbook%)</span>
				                    <span class='label label-primary'>Lecture Slides Focused ($slides%)</span>
				                    <span class='label label-primary'>Be Ready to Read Up ($read%)</span>
								</div>
							</div>
							<div class = 'col-12'>
								<br>
							</div>
						</div>
					";
				}
			}else{
						echo "
							<div class = 'col-12'>
								<p align='center'> Sorry we don't have the following data yet. Stay tuned for the next update!</p>
							</div>
							";
			}
			$conn-> close();
		?>

		<!--Advice from Seniors Title-->
		<div class="container">
			<div class = "row">
				<div class = "col-12 moduleCode"> Advice from Seniors</div>
			</div>
		</div>


		<!--Function-->
		<script type="text/javascript">
			function reportAdvice()
			{
				var check = confirm("Are you sure you want to report this advice?");

				if(check == true)
				{
					confirm("Your report of this particular Advice is succesful!");
					<?php
						$db_host = "localhost";
						$db_username = "root";
						$db_pass = "KeepGoing88!";
						$db_name = "MainDatabase";
						$conn = new mysqli($db_host,$db_username,$db_pass,$db_name) or die("Unable to connect");
						$entry = $_POST['report'];

						$reportAdvice = "
							UPDATE Advice
							SET Report = Report + 1
							WHERE Entry = '$entry'
						";
						$conn->query($reportAdvice);
					?>	
				}
			}
		</script>
		
		<script type="text/javascript">
			function rateAdvice()
			{
				var check = confirm("Are you sure you want to like this advice?");

				if(check == true)
				{
					confirm("You have liked this advice!");
						<?php
							$db_host = "localhost";
							$db_username = "root";
							$db_pass = "KeepGoing88!";
							$db_name = "MainDatabase";
							$conn = new mysqli($db_host,$db_username,$db_pass,$db_name) or die("Unable to connect");
							$identifyer = $_POST['rate'];

							$addContributor = "
								UPDATE Advice
								SET Contributors = Contributors + 1
								WHERE Entry = '$identifyer'
							";
							$conn->query($addContributor);
						?>
				}
			}
		</script>

		<!--Advice given-->
		<?php
			// Connect to the database
			$db_host = "localhost";
			$db_username = "root";
			$db_pass = "KeepGoing88!";
			$db_name = "MainDatabase";
			$conn = new mysqli($db_host,$db_username,$db_pass,$db_name) or die("Unable to connect");

			//Query the database for ID
			$code = $_POST["searchValue"];
			$year = $_POST['intake'];
			$sql1 = "SELECT Identification FROM Intake WHERE ModuleCode = '$code' AND Year = '$year'";
			$result1 = $conn->query($sql1);

			if(!$result1){
				echo "Could not run query 1: " . mysql_error();
				exit;
			}

			// Query the database for Module Information	
			$find = $result1 -> fetch_assoc();
			$id = $find['Identification'];
			$sql2 = "SELECT * FROM Advice WHERE Identification = '$id' ORDER BY Contributors DESC";
			$result2 = $conn->query($sql2);

			if(!$result2){
				echo "Could not run query 2: ".mysql_error();
				exit;
			}
					
			if($result2-> num_rows > 0){
				while($rows = $result2 -> fetch_assoc())
				{
					$grade = $rows['Grade'];
					$advice = htmlentities($rows['Recommendation']);
					$likes = $rows['Contributors'];
					$entry = $rows['Entry'];

					//Display Results
					echo "
						<div class='container'>
							<div class = 'row'>
								<div class = 'col-4'>
									<table class = 'content padding'>
										<tr class = 'rowContent'>
											<td class = 'item'>Number of Likes</td>
											<td class = 'verdict'>$likes</td>
										</tr>
										<tr class = 'rowContent'>
											<td class = 'item'>Year Taken</td>
											<td class = 'verdict'>$year</td>
										</tr>
										<tr class = 'rowContent'>
											<td class = 'item'>Grade Obtained</td>
											<td class = 'verdict'>$grade</td>
										</tr>
									</table>
								</div>
								<div class = 'col-8'>
									<p>$advice</p>
								</div>
							</div>
							<div class = 'row'>
								<div class = 'col-12 alignLinkButtons'>
								<form action='' method='post'>
									<button type='submit' name='rate' class='button linkButton' onclick='rateAdvice()' value='$entry'>Like Advice </button>
									<button type='submit' name='report' class='button linkButton' onclick='reportAdvice()' value='$entry'>Report Advice </button>
								</form>
								</div>
							</div>
							<div class = 'col-12'>
								<br>
							</div>
						</div>
					";
				}
			}else{
				echo "
					<div class = 'col-12'>
						<p align='center'> Sorry we don't have the following data yet. Stay tuned for the next update!</p>
					</div>
					";
			}
			$conn-> close();
		?>
	</body>
</html>