<?php

function mailParse($current_email){ 

	$bodyContent = false;
	$bodyString = false;

	for($i = 0; $i < count($current_email); $i++){

		if(trim($current_email[$i]) != ""){

			// logic that grabs corresponding header info
			if(preg_match("/^From: (.*)/", $current_email[$i], $matches)){

			  	echo $matches[1] . "\n"; 

			}
			else if(preg_match("/^To: (.*)/", $current_email[$i], $matches)){

			  	echo $matches[1] . "\n"; 

			}
			else if(preg_match("/^Subject: (.*)/", $current_email[$i], $matches)){

			  	echo $matches[1] . "\n"; 

			}
			else if(preg_match("/^Date: (.*)/", $current_email[$i], $matches)){

			  	echo $matches[1] . "\n"; 

			}

		}// end of if statement that checks for empty line

		if(preg_match("/^Content-Transfer-Encoding: quoted-printable/", $current_email[$i], $matches) && $bodyContent == false){

			$bodyContent = true;

		}
		else if($bodyContent == true && $bodyString == false && $current_email[$i] == ""){

			$bodyString = true;

		}
		else if($bodyContent == true && $bodyString == true){

			echo trim($current_email[$i]) . "\n";
			$bodyContent = null;
			
		}
	}
};


// get mail  ***for this instance i am grabbing a raw email locally.
$email = file_get_contents('email.txt');


// splits email into an array of strings **split after each new line
$split_email = explode("\n", $email);

// sends "exploded" raw email to mailParse function
mailParse($split_email);