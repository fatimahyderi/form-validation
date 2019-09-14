<?php
	$nameError ="";
	$genderError ="";
	$countryError ="";
	$complete = false;
	$text = $name  = $gender = $country = "";
	
	function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if(isset($_POST['submit'])){
	
	if(empty($_POST["name"])){
		$nameError = "Name is required";
	} else {
		$name = test_input($_POST["name"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameError = "Only letters and white space allowed";
		}
	}
	
	if (empty($_POST["comment"])) {
		$text = "";
	} else {
		$text = test_input($_POST["comment"]);
	}
	
	if (empty($_POST["gender"])) {
		$genderError = "Gender is required";
	} else {
		$gender = test_input($_POST["gender"]);
	}
	
	if (empty($_POST["country"])) {
		$countryError = "Country is required";
	} else {
		$country = test_input($_POST["country"]);
	}
	
	if($nameError == "" && $genderError == "" && $countryError == "" ){
		
		unset($text);
		unset($name);
		unset($gender);
		unset($country);
		
		$text = $name = $gender =  $country = "";
		$complete = true;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
	
	<script>
		function validateForm() {
			var name = document.forms["myForm"]["fname"].value;
			if (name == "") {
			alert("Name must be filled out"); 
			return false;
			}
			
			var gender =  document.forms["myForm"]["gender"];
			if ( ( gender[0].checked == false ) && ( gender[1].checked == false ) ){
			alert ( "Please choose your Gender: Male or Female" );
			return false;
			} 

			var selection =  document.forms["myForm"]["country"];
			if (selection.selectedIndex < 1){ 
			alert("Please select your country."); 
			 return false; 
			} 	
			
		}
		
	</script>
		<title>Form Validation</title>
	</head>
	<body>
	
	<?php if($complete){ 
	echo "Thank You for Submission.";
}?>
		<form method='post' name='myForm' action='#' onsubmit='return(validateForm())'>
			<p>Name:<input id='fname' type='text' name='name' value="<?php echo $name; ?>"/>
			<span id='name_error'><?php echo $nameError;?></span></p>
		
			<p>Gender:<input id='gend-male' type='radio' name='gender' value="male" <?php echo $gender == "male" ? 'checked' : ''; ?> />Male
			<input id='gend-female' type='radio' name='gender' value="female" <?php echo $gender == "female" ? 'checked' : ''; ?> />Female
			<span id='gender_error'><?php echo $genderError;?></span></p>
			
			<p><select id='country' name='country' >
					<option value="<?php echo $country; ?>">Select</option>
					<option>PAKISTAN</option>
					<option>INDIA</option>
				</select>
				<span id='country_error'><?php echo $countryError;?></span></p>
			
			<p>Comment:
			<textarea cols="40" name="comment" rows="5"><?php echo $text; ?></textarea></p>
	
			<p><input type='submit' name='submit'></p>
		</form>
	</body>
</html>