<?php
include ("config.php");
?>

<html> 
	<head> 
		<title>My Phone Book</title> 
	</head> 
			<link rel="stylesheet" href="css/style.css"> 
	<body> 
		<header class="w3-container w3-teal">
		<h1>My Phone Book</h1>
		</header> 
	<div class="w3-container w3-half w3-margin-top">

	<form name="form1" id="form1" method="post" action="" class="w3-container w3-card-4">
		<p>
		<input name="name" id="name" class="w3-input" type="text" style="width:90%" onkeypress="return onlyAlphabets(event,this);" required>
		<label class="w3-label w3-validate">Name</label></p>
		
		<p>
		<input name="phno" id="phno" value="" class="w3-input" type="text" style="width:90%" onkeypress="return isNumber(event)" required>
		<label class="w3-label w3-validate">Phone No.</label></p>
		
		<p>
		<input name="save" type="submit" id="save" value="Save" button class="w3-btn w3-section w3-teal w3-ripple" /> 
		<input type="reset" name="Submit2" value="Reset" button class="w3-btn w3-section w3-teal w3-ripple" />
		</p>
	</form> 

	<form name="form2" method="get" action=""> 
		<p><b>Search:</b> 
		<input name="search" type="text" id="search"> 
		<input name="searchb" type="submit" id="searchb" value="Search"> 
		</p> 
		
		<div class="w3-container">
		<div class="w3-text-red">
		<h2>
		List Of Contacts:
		</h2>
		</div>
		</div>
	</form>  
	</body> 
	
	<script>
	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
	}

	function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        }
	</script>
	</html> 
	
<?php 

if(isset($_GET['searchb'])) 
    { 
        $search=$_GET['search']; 
        $query="select * from phno where (name like '$search%' OR phnum like '$search%')";
    } 
	else 
    
    $query="select * from phno"; 
	
		if(!$db->select_db('phonebook')) 
	{ 
    echo "<p><i>NONE</i></p>"; 
    exit; 
	} 
		else 
		$result=$db->query($query); 
		$num_rows=$result->num_rows; 
//if no rows present probably 
//searching 
		if($num_rows<=0) 
		echo "<p><i>No Match Found!</i></p>"; 
//process all the rows one-by-one 
		for($i=0;$i<$num_rows;$i++) 
		{ 
		//fetch one row 
		$row=$result->fetch_row(); 
		//print the values 
		echo "<p><span style=\"font-size: 100%;\">$row[1]: </span> $row[2]</p>"; 
		} 
//close MySQL connection 
		$db->close(); 
?>