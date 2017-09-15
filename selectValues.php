<?php
	if (isset($_POST['submit'])) {
		if(isset($_POST['difficulty']))
		{
			$difficulty = $_POST['difficulty'];
			echo "<div>You have selected : $difficulty. </div>";
		}
		else
		{
			echo "<div>Please choose any radio button.</div>";
		}
	}
?>