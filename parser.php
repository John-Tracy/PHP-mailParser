<?php

function mailParse($currentEmail){  // this function contains all the logic to pick specific parts of the email.

	$bodyContent = false; // variables used in the logic 
	$bodyString = false; // to parse only the body text as long as
	$bodyParsed = false; // because it cannot be picked out with preg_match

	for($i = 0; $i < count($currentEmail); $i++){ // for loop that iterates completely through every string taken from the raw email

		if(trim($currentEmail[$i]) != ""){ // conditional checks if the current string is an empty string

			// logic that grabs corresponding header info
			if(preg_match("/^From: (.*)/", $currentEmail[$i], $matches)){ // conditional checks for specific text and pulls all text after it out
			  	// in a production applicaton this info would be sent to a variable to be saved in a database.
			  	echo $matches[1] . "\n" . "\n"; // this is the string extracted for Sender info

			}
			else if(preg_match("/^To: (.*)/", $currentEmail[$i], $matches)){ // conditional checks for specific text and pulls all text after it out
			  	// in a production applicaton this info would be sent to a variable to be saved in a database.
			  	echo $matches[1] . "\n" . "\n"; // this is the string extracted for the email that recieved

			}
			else if(preg_match("/^Subject: (.*)/", $currentEmail[$i], $matches)){ // conditional checks for specific text and pulls all text after it out
			  	// in a production applicaton this info would be sent to a variable to be saved in a database.
			  	echo $matches[1] . "\n" . "\n"; // this is the string extracted for Subject 

			}
			else if(preg_match("/^Date: (.*)/", $currentEmail[$i], $matches)){ // conditional checks for specific text and pulls all text after it out
			  	// in a production applicaton this info would be sent to a variable to be saved in a database.
			  	echo $matches[1] . "\n" . "\n"; // this is the string extracted for Date the email was sent

			}

		}// end of conditional if statement that checks for empty line

	// This is the logic to grab the body text **** only works or hotmail messages recieved.
		if(preg_match("/^Content-Transfer-Encoding: quoted-printable/", $currentEmail[$i], $matches) && $bodyContent == false){

			$bodyContent = true;

		}
		else if($bodyContent == true && $bodyString == false && $currentEmail[$i] == ""){

			$bodyString = true;

		}
		else if($bodyContent == true && $bodyString == true && $bodyParsed == false){

			echo trim($currentEmail[$i]) . "\n" . "\n";
			$bodyParsed = true;
			
		}
	}
};


// get mail  ***for this instance i am grabbing a raw email locally.
$email = file_get_contents('email.txt');


// splits email into an array of strings **split after each new line
$splitEmail = explode("\n", $email);

// sends "exploded" raw email to mailParse function to parse it in relevant fields
mailParse($splitEmail);