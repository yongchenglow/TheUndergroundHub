<?php 
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
if(isset($_POST['searchValue']) & count($_POST['searchValue'])) { $_SESSION['post'] = $_POST['searchValue']; }
if(isset($_SESSION['post']) && count($_SESSION['post'])) { $_POST['searchValue'] = $_SESSION['post']; }
?>

<!--Setup-->
<!doctype html PUBLIC>
<html>

	<!--Header-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<!--Wepage Name-->
	  	<title>RateModulePage</title>
	  	
	  	<!--Style-->
	  	<link rel="stylesheet" href="normalise.css" type="text/css">
	  	<link rel="stylesheet" href="RateModulePageStyles.css" type="text/css">
	</head>

	<!--Web page Body-->
	<body class="textColor">
		<!--Advertisment Block-->
		<div class="container">
			<div class = "row">
				<div class = "col-12 advertisment"> Advertisment Block</div>
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
						<input type="submit" class="button" name="SearchButton" id="SearchButton" value="Search"/>
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

							//Display Results
							echo "<div class = 'col-4 moduleCode'> $Mcode </div>";
							echo "<div class = 'col-8 moduleName'> $Mname </div>";
						}
					}else{
						echo "No results.";
					}
					$conn-> close();
				?>
			</div>
		</div>
		<!--General Module Information-->
		<div class="container">
			<div class = "row">
				<div class = "col-12 subTitle"><p>Note that all fields are compulsory in order for the form to be submitted</p></div>
			</div>
		</div>

		<!--General Module Information-->
		<div class="container">
			<div class = "row">
				<div class = "col-12 subTitle"><p>General Module Information</p></div>
			</div>
		</div>

		<!--Blank Line-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
				<p></p>
				</div>
			</div>
		</div>

		<form method="post">
		<!--Level of Difficulty-->
		<div class="container">
			<div class = "row">
				<div class = "col-4 description">
					Level of Difficulty
				</div>
				<div class = "col-8">
					<table class ="content">
						<tr class ="rowContent">
							
							<td class= "radio">
								<label>
									<input type="radio" name="difficulty" id="option1" value="1"> 1
								</label>
							</td>
							<td class= "radio"> 
								<label>
									<input type="radio" name="difficulty" id="option2" value="2"> 2
								</label>
							</td>
							<td class= "radio"> 
								<label>
									<input type="radio" name="difficulty" id="option3" value="3"> 3
								</label>
							</td>
							<td class= "radio"> 
								<label>
									<input type="radio" name="difficulty" id="option4" value="4"> 4
								</label>
							</td>
							<td class= "radio"> 
								<label>
									<input type="radio" name="difficulty" id="option5" value="5"> 5
								</label>
							</td>
						</tr>
						<tr class ="rowContent">
							<td class= "radio">
								Very Easy
							</td>
							<td class= "radio">
								Easy
							</td>
							<td class= "radio">
								Just Nice
							</td>
							<td class= "radio">
								Hard
							</td>
							<td class= "radio">
								Very Hard
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<!--Blank Line-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
				<p></p>
				</div>
			</div>
		</div>

		<!--Textbook Usefulness-->
		<div class="container">
			<div class="row">
				<div class = "col-4 description">
					Is the TextBook Useful?
				</div>
				<div class = "col-8">
					<table class ="content">
						<tr class ="rowContent">
							<td class= "radio">
								<label>
									<input type="radio" name="textbook" id="option1" value="yes"> Yes
								</label>
							</td>
							<td class= "radio"> 
								<label>
									<input type="radio" name="textbook" id="option2" value="no"> No
								</label>
							</td>
						</tr>
					</table>	
				</div>			
			</div>
		</div>

		<!--Blank Line-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
				<p></p>
				</div>
			</div>
		</div>

		<!--Lecture Usefulness-->
		<div class="container">
			<div class="row">
				<div class = "col-4 description">
					Is the Lecture Useful?
				</div>
				<div class = "col-8">
					<table class ="content">
						<tr class ="rowContent">
							<td class= "radio">
								<label>
									<input type="radio" name="lecture" id="option1" value="yes"> Yes
								</label>
							</td>
							<td class= "radio"> 
								<label>
									<input type="radio" name="lecture" id="option2" value="no"> No
								</label>
							</td>
						</tr>
					</table>	
				</div>			
			</div>
		</div>
		<!--Blank Line-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
				<p></p>
				</div>
			</div>
		</div>

		<!--Tutorials Usefulness-->
		<div class="container">
			<div class="row">
				<div class = "col-4 description">
					Is the Tutorials Useful?
				</div>
				<div class = "col-8">
					<table class ="content">
						<tr class ="rowContent">
							<td class= "radio">
								<label>
									<input type="radio" name="tutorials" id="option1" value="yes"> Yes
								</label>
							</td>
							<td class= "radio"> 
								<label>
									<input type="radio" name="tutorials" id="option2" value="no"> No
								</label>
							</td>
						</tr>
					</table>	
				</div>			
			</div>
		</div>
		<!--Blank Line-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
				<p></p>
				</div>
			</div>
		</div>

		<!--Web Lecture Usefulness-->
		<div class="container">
			<div class="row">
				<div class = "col-4 description">
					Is the Web Lecture Useful?
				</div>
				<div class = "col-8">
					<table class ="content">
						<tr class ="rowContent">
							<td class= "radio">
								<label>
									<input type="radio" name="webLecture" id="option1" value="yes"> Yes
								</label>
							</td>
							<td class= "radio"> 
								<label>
									<input type="radio" name="webLecture" id="option2" value="no"> No
								</label>
							</td>
						</tr>
					</table>	
				</div>			
			</div>
		</div>

		<!--Professors-->
		<div class="container">
			<div class = "row">
				<div class = "col-12 subTitle">
					<p>Professors</p>
				</div>
			</div>
		</div>

		<!--Blank Line-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
				<p></p>
				</div>
			</div>
		</div>
		<?php
			// Connect to the database
			$db_host = "localhost";
			$db_username = "root";
			$db_pass = "KeepGoing88!";
			$db_name = "MainDatabase";
			$conn = new mysqli($db_host,$db_username,$db_pass,$db_name) or die("Unable to connect");

			//Query the database for ID
			$code = $_POST["searchValue"];
			$year = "2015/16 SEM 2";
			$sql1 = "SELECT Identification FROM Intake WHERE ModuleCode = '$code' AND Year = '$year'";
			$result1 = $conn->query($sql1);

			if(!$result1){
				echo "Could not run query 1: " . mysql_error();
				exit;
			}

			// Query the database for Professors	
			$find = $result1 -> fetch_assoc();
			$id = $find['Identification'];
			$sql2 = "SELECT * FROM Professors WHERE Identification = '$id'";
			$result2 = $conn->query($sql2);

			if(!$result2){
				echo "Could not run query 2: ".mysql_error();
				exit;
			}

			$count = 0;
					
			if($result2-> num_rows > 0){
				while($rows = $result2 -> fetch_assoc())
				{
					$text = $count."[]";
					$name = $rows['Name'];
					echo "
						<div class='container'>
							<div class='row'>
								<div class = 'col-12 description'>
									<p><b>$name</b></p>
								</div>
							</div>
						</div>

						<!--Blank Line-->
						<div class='container'>
							<div class = 'row'>
								<div class = 'col-12'>
								<p></p>
								</div>
							</div>
						</div>

						<!--Teaching Level-->
						<div class='container'>
							<div class = 'row'>
								<div class = 'col-4 description'>
									Teaching Level
								</div>
								<div class = 'col-8'>
									<table class ='content'>
										<tr class ='rowContent'>
											<td class= 'radio'>
												<label>
													<input type='radio' name='teachingLevel$count' id='option1' value='1'> Mediocre
												</label>
											</td>
											<td class= 'radio'> 
												<label>
													<input type='radio' name='teachingLevel$count' id='option2' value='2'> Good
												</label>
											</td>
											<td class= 'radio'> 
												<label>
													<input type='radio' name='teachingLevel$count' id='option3' value='3'> Superb
												</label>
											</td>
											<td class= 'radio'> 
												<label>
													<input type='radio' name='teachingLevel$count' id='option4' value='4'> Excellent
												</label>
											</td>
											<td class= 'radio'> 
												<label>
													<input type='radio' name='teachingLevel$count' id='option5' value='5'> Godlike
												</label>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>

						<!--Blank Line-->
						<div class='container'>
							<div class = 'row'>
								<div class = 'col-12'>
								<p></p>
								</div>
							</div>
						</div>

						<!--Hotness-->
						<div class='container'>
							<div class = 'row'>
								<div class = 'col-4 description'>
									Hotness
								</div>
								<div class = 'col-8'>
									<table class ='content'>
										<tr class ='rowContent'>
											<td class= 'radio'>
												<label>
													<input type='radio' name='hotness$count' id='option1' value='1'> Normal
												</label>
											</td>
											<td class= 'radio'> 
												<label>
													<input type='radio' name='hotness$count' id='option2' value='2'> Spicy
												</label>
											</td>
											<td class= 'radio'> 
												<label>
													<input type='radio' name='hotness$count' id='option3' value='3'> Flaming
												</label>
											</td>
											<td class= 'radio'> 
												<label>
													<input type='radio' name='hotness$count' id='option4' value='4'> Scorching
												</label>
											</td>
											<td class= 'radio'> 
												<label>
													<input type='radio' name='hotness$count' id='option5' value='5'> Lava
												</label>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>

						<!--Blank Line-->
						<div class='container'>
							<div class = 'row'>
								<div class = 'col-12'>
								<p></p>
								</div>
							</div>
						</div>

						<!--Tags-->
						<div class='container'>
							<div class = 'row'>
								<div class = 'col-4 description'>
									Tags
								</div>
								<div class = 'col-8'>
									<table class ='content'>
										<tr class ='rowContent'>
											<td class= 'checkbox'>
											    <label>
											      <input type='checkbox' name='tags$text' value='ToughGrader'> Tough Grader
											    </label>
											</td>
											<td class= 'checkbox'>
											    <label>
											      <input type='checkbox' name='tags$text' value='QuizMaster'> Quiz Master
											    </label>
											</td>
											<td class= 'checkbox'>
											    <label>
											      <input type='checkbox' name='tags$text' value='HelpSession'> Help Sessions
											    </label>
											</td>
											<td class= 'checkbox'>
											    <label>
											      <input type='checkbox' name='tags$text' value='AwesomeLectures'> Awesome Lectures
											    </label>
											</td>
										</tr>
										<tr class ='rowContent'>
											<td class= 'checkbox'>
											    <label>
											      <input type='checkbox' name='tags$text' value='GoodFeedback'> Good Feedback
											    </label>
											</td>
											<td class= 'checkbox'>
											    <label>
											      <input type='checkbox' name='tags$text' value='ExamFocused'> Exam Focused
											    </label>
											</td>
											<td class= 'checkbox'>
											    <label>
											      <input type='checkbox' name='tags$text' value='Inspirational'> Inspirational
											    </label>
											</td>
											<td class= 'checkbox'>
											    <label>
											      <input type='checkbox' name='tags$text' value='Hilarious'> Hilarious
											    </label>
											</td>
										</tr>
										<tr class ='rowContent'>
											<td class= 'checkbox'>
											    <label>
											      <input type='checkbox' name='tags$text' value='Respectable'> Respectable
											    </label>
											</td>
											<td class= 'checkbox'>
											    <label>
											      <input type='checkbox' name='tags$text' value='TextbookFocused'> Textbook Focused
											    </label>
											</td>
											<td class= 'checkbox'>
											    <label>
											      <input type='checkbox' name='tags$text' value='SlidesFocused'> Slides Focused
											    </label>
											</td>
											<td class= 'checkbox'>
											    <label>
											      <input type='checkbox' name='tags$text' value='BeReadyToRead'> Be Ready To Read
											    </label>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>

						<!--Blank Line-->
						<div class='container'>
							<div class = 'row'>
								<div class = 'col-12'>
								<p></p>
								</div>
							</div>
						</div>
					";

					$count = $count + 1;
				}
			}
		?>

		<!--Advice from Seniors Title-->
		<div class="container">
			<div class = "row">
				<div class = "col-12 subTitle"><p>Advice</p></div>
			</div>
		</div>
		
		<!--Blank Line-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
				<p></p>
				</div>
			</div>
		</div>

		<!--Advice given-->
		<div class="container">
			<div class = "row">
				<div class = "col-6 description">
					<div class="selectList">
						<label for="sel1"> Year of Course:</label>
						<select class="selectList" name="year" id="year">
							<option>2015/16 Sem 1</option>
							<option>2015/16 Sem 2</option>
						</select>
					</div>
				</div>
				<div class = "col-6">
					<div class="selectList">
						<label for="sel1"> Grade Obtained:</label>
						<select class="selectList" name="grade" id="grade">
							<option>A+</option>
							<option>A</option>
							<option>A-</option>
							<option>B+</option>
							<option>B</option>
							<option>B-</option>
							<option>C+</option>
							<option>C</option>
							<option>D+</option>
							<option>D</option>
							<option>F</option>
						</select>
					</div>
					</table>
				</div>
				<div class = "col-2"></div>
				<div class = "col-8">
					<p> Type your Advice below </p>
					<textarea class="adviceInput" name="advice"></textarea>
				</div>
				<div class = "col-2"></div>
			</div>
		</div>

		<!--Blank Line-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
				<p></p>
				</div>
			</div>
		</div>

		<div class="container">
			<div class = "row">
				<div class = "col-12 alignSubmitButton">
					<input type="submit" name="submit" value="Submit" class="button submitButton" onclick="return confirm('Are you sure you want to submit?')"/>
					<?php
						if (isset($_POST['submit']))
						{
							// Connect to the database
							$db_host = "localhost";
							$db_username = "root";
							$db_pass = "KeepGoing88!";
							$db_name = "MainDatabase";
							$code = $_POST["searchValue"];
							$year = "2015/16 SEM 2";

							$conn = new mysqli($db_host,$db_username,$db_pass,$db_name) or die("Unable to connect");

							//Select the database
							$difficulty = $_POST["difficulty"];
							$textbook = $_POST["textbook"];
							$lecture = $_POST["lecture"];
							$tutorials = $_POST["tutorials"];
							$webLecture = $_POST["webLecture"];
							$teachingLevel = $_POST["teachingLevel"];
							$hotness = $_POST["hotness"];

							if(!$difficulty && !$textbook && !$lecture && !$tutorials && !$webLecture && !$teachingLevel && !$hotness){
								echo "please ensure that all the required fields are filled out";
							} else {
								//Query the database for ID
								$sql1 = "SELECT Identification FROM Intake WHERE ModuleCode = '$code' AND Year = '$year'";
								$result1 = $conn->query($sql1);
								$find = $result1 -> fetch_assoc();
								$id = $find['Identification'];

								// Updating of General Information
								$updateDiffculty = "
									UPDATE GeneralInformation
									SET LevelOfDifficulty = (LevelOfDifficulty*Contributors + '$difficulty')/(Contributors+1)
									WHERE Identification = '$id'
								";
								$conn->query($updateDiffculty);
								
								$updateTextbook = "
									UPDATE GeneralInformation
									SET Textbook = Textbook + 1
									WHERE Identification = '$id'
								";
								$conn->query($updateTextbook);
								
								$updateLectures = "
									UPDATE GeneralInformation
									SET Lectures = Lectures + 1
									WHERE Identification = '$id'
								";
								$conn->query($updateLectures);
								
								$updateTutorials = "
									UPDATE GeneralInformation
									SET Tutorials = Tutorials + 1
									WHERE Identification = '$id'
								";
								$conn->query($updateTutorials);
								
								$updateWebLecture= "
									UPDATE GeneralInformation
									SET WebLecture = WebLecture + 1
									WHERE Identification = '$id'
								";
								$conn->query($updateWebLecture);
								
								$updateContributors = "
									UPDATE GeneralInformation
									SET Contributors = Contributors + 1
									WHERE Identification = '$id'
								";
								$conn->query($updateContributors);
								
								// Updating of Professors
								$sql2 = "SELECT * FROM Professors WHERE Identification = '$id'";
								$result2 = $conn->query($sql2);
								$count = 0;

								if($result2-> num_rows > 0){
									while($rows = $result2-> fetch_assoc())
									{

										$teachingLevel = "teachingLevel".$count;
										$hotness = "hotness".$count;
										$tagsSubmitted = "tags".$count;
										$teach = $_POST["$teachingLevel"];
										$hot = $_POST["$hotness"];
										$tags = $_POST["$tagsSubmitted"];
										$name = $rows["Name"];

										$updateTeach = "
											UPDATE Professors
											SET TeachingLevel = (TeachingLevel*Contributors + '$teach')/(Contributors+1)
											WHERE Name = '$name'
										";
										$conn->query($updateTeach);

										$updateHot = "
											UPDATE Professors
											SET Hotness = (Hotness*Contributors + '$hot')/(Contributors+1)
											WHERE Name = '$name'
										";
										$conn->query($updateHot);

										foreach($tags as $selected) {
											$updateTag = "
											UPDATE Professors
											SET $selected = $selected + 1
											WHERE Name = '$name'
											";
											$conn->query($updateTag);
										}
										
										$updateCon = "
											UPDATE Professors
											SET Contributors = Contributors + 1
											WHERE Name = '$name'
										";
										$conn->query($updateCon);

										$count = $count + 1;
									}
								}
								
								// Updating of Advice
								$grade = $_POST["grade"];
								$advice = $_POST["advice"];
								$insertAdvice = "INSERT INTO Advice(Identification,Grade,Advice) VALUES ('$id','$grade','$advice')";
								$conn->query($insertAdvice);
							}
							$conn->close();
						}
					?>
				</div>
			</div>
		</div>
		</form>
		<!--Blank Line-->
		<div class="container">
			<div class = "row">
				<div class = "col-12">
				<p></p>
				</div>
			</div>
		</div>
	</body>
</html>