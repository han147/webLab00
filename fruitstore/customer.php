<!DOCTYPE html>
<html>
	<head>
		<title>Fruit Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		if (!isset($_POST["name"])||!isset($_POST["MembershipNumber"])||!isset($_POST["fruit"])||!isset($_POST["quantity"])||!isset($_POST["Card"])||$_POST["name"]==""){
		?>
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. <a href="gradestore.html">Try again?</a></p>

		<!-- Ex 4 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. Try again?</p>
		--> 

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		} elseif (strpos($_POST["name"],"-"||" ")||(!preg_match("/^[a-zA-Z]*[\ \-]?[a-zA-Z]*$/",$_POST["name"]))) { 
		?>
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. <a href="fruitstore.html">Try again?</a></p>

		<!-- Ex 5 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>
		--> 

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		# } elseif () {
		} elseif (strlen($_POST["Card"])!=16||(($_POST["cc"]=="visa")&&($_POST["Card"][0]!="4"))||(($_POST["cc"]=="mastercard")&&($_POST["Card"][0]!="5"))) {

		?>
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="fruitstore.html">Try again?</a></p>

		<!-- Ex 5 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. Try again?</p>
		--> 

		<?php
		# if all the validation and check are passed 
		} else {
		?>

		<h1>Thanks!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<?php 
			$name=$_POST["name"];
			$membership=$_POST["MembershipNumber"];
			$options = isset($_POST["option"])? $_POST["option"] : ' ';
			$op = implode(", ", $options);
			$fruit =$_POST["fruit"];
			$quantity=$_POST["quantity"];
			$credit = $_POST["Card"];
			$card = $_POST["cc"]
			
		?>

		<ul> 
			<li>Name: <?=$name?></li>
			<li>Membership Number: <?=$membership?></li>
			<li>Options: <?=$op?></li>
			<li>Fruits: <?=$fruit." - ".$quantity?></li>
			<li>Credit <?=$credit." (".$card.")"?></li>
		</ul>
		
		<!-- Ex 3 : 
			<p>This is the sold fruits count list:</p> -->
		<?php
			$filename = "customers.txt";
			file_put_contents($filename, $name.";",FILE_APPEND);
			file_put_contents($filename, $membership.";",FILE_APPEND);
			file_put_contents($filename, $fruit.";",FILE_APPEND);
			file_put_contents($filename, $quantity."\n",FILE_APPEND);
			/* Ex 3: 
			 * Save the submitted data to the file 'customers.txt' in the format of : "name;membershipnumber;fruit;number".
			 * For example, "Scott Lee;20110115238;apple;3"
			 */
		?>
		
		<!-- Ex 3: list the number of fruit sold in a file "customers.txt".
			Create unordered list to show the number of fruit sold -->
		<ul>
		<?php 
		$fruitcounts = soldFruitCount($filename);
		$fruits=array("Melon","Apple","Orange","Strawberry");
		$cnt =0;
		foreach($fruitcounts as $word){
		?>
		<!-- <li></li> -->
			<li> <?=$fruits[$cnt++]?> - <?=$word?></li>
		<?php
		}
		?>
		</ul>
		
		<?php
		}
		?>
		
		<?php
			/* Ex 3 :
			* Get the fruits species and the number from "customers.txt"
			* 
			* The function parses the content in the file, find the species of fruits and count them.
			* The return value should be an key-value array
			* For example, array("Melon"=>2, "Apple"=>10, "Orange" => 21, "Strawberry" => 8)
			*/
			function soldFruitCount($filename) { 
				$lines = file($filename);
				$fruitcounts=array(0,0,0,0);
				foreach ($lines as $word) { 
                	$tmp = explode(";", $word);
                	if($tmp[2]=="Melon"){
                		$fruitcounts[0] += $tmp[3];
                	}else if($tmp[2]=="Apple"){
                		$fruitcounts[1] += $tmp[3];
                	}else if($tmp[2]=="Orange"){
                		$fruitcounts[2] += $tmp[3];
                	}else if($tmp[2]=="Strawberry"){
                		$fruitcounts[3] += $tmp[3];
                	}
                }
				return $fruitcounts;
			}
	?>
		
	</body>
</html>