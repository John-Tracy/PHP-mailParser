<?php

// declaring variables that will hold the info parsed from email
$from = "";

$subject = "";

$to = "";

$headers = "";

$body = "";



function mailParse($current_email){ 

	for($i = 0; $i < count($current_email); $i++){

		if(trim($current_email[$i]) != ""){

			// logic that grabs corresponding header info
			if(preg_match("/^From: (.*)/", $current_email[$i], $matches)){
			  	echo $matches[0] . "\n";
			}

		}else if(trim($current_email[$i] == "")){ 

		echo "empty line\n";

		}
	}

};


// get mail  ***for this instance i am grabbing a raw email locally.
$email = file_get_contents('email.txt');


// splits email into an array of strings **split after each new line
$split_email = explode("\n", $email);

// sends "exploded" raw email to mailParse function
mailParse($split_email);
