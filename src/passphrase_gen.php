




<html>
	<body>
		
		<?php 

			// Debug/Testing
			//if (isset($_POST['include_nums_passphrase'])) { echo $_POST['passphrase']." THERE WE GO:request //received<br/>"."INCLUDE NUMBERS IN PASSPHRASE"; }

			// How the password is generated from input phrase? Good Ques.
			// Well, first phrase is separated into singular words
			// then each of their first character is taken randomly then 
			// converted to uppercase or lowercase put into password string,
			// and in between such characters a random number or special char is 
			// placed in to password string
			// And Bravo that's it!

			function passphrase_gen($phrase, $include_nums=true, $include_punctuation=true) {
				// Punctuation and nums to put between characters
				$nums = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
				$punctuation = array('!', '"', '#', '$', '%', '&', "'", '(', ')', '*', '+', ',', '-', '.', '/', ':', ';', '<', '=', '>', '?', '@', '[', '\\', ']', '^', '_', '`', '{', '|', '}', '~');
				$auxillary_strength = array($nums, $punctuation);
				
                
				// Separation of phrase into individual words
				$phrase = explode(" ", $phrase);
				
				// Password string
				$pass_phrase = "";
				
				// Debug
				// Password string uncut
				$uncut_phrase = "";

                
				// Processing of passphrase to generate passwd
				foreach ($phrase as $word) { 
					// Random uppercasing lowercasing of first character 
					// of each word 
					$rand_n = mt_rand(0, 1);
					if ($rand_n == 0) {
						$pass_phrase .= strtoupper($word[0]);
						// Debug
						$uncut_phrase .= strtoupper($word);
					} else {
						$pass_phrase .= strtolower($word[0]);
						// Debug
						$uncut_phrase .= strtolower($word);
					}
					$uncut_phrase .= " ";
					
                    
                    // Pre-definition for use in $uncut_phrase later
                    $tempor = null;
                    
                    // When user customizes the option of adding 
                    // numbers and/or punctuation into password for extra strength
                    if ($include_nums && $include_punctuation) {
                        // Placing random nums/punctuation between consecutive characters of words
                        $first_dimension = $auxillary_strength[mt_rand(0, sizeof($auxillary_strength)-1)];
                        $second_dimension = $tempor = $first_dimension[mt_rand(0, sizeof($first_dimension)-1)];
                        $pass_phrase .= $second_dimension;   
                        
                    } else if ($include_nums && !$include_punctuation) {
                        // Placing only random nums not punctuation between consecutive characters of words
                        $first_dimension = $tempor = $auxillary_strength[0][mt_rand(0, sizeof($auxillary_strength[0])-1)];
                        $pass_phrase .= $first_dimension;   
                        
                    } else if (!$include_nums && $include_punctuation) {
                        // Placing only random punctuation not nums between consecutive characters of words
                        $first_dimension = $tempor = $auxillary_strength[1][mt_rand(0, sizeof($auxillary_strength[0])-1)];
                        $pass_phrase .= $first_dimension;  
                        
                    } else {  
                        // Carry on nothing to do here, whatever has to be done is already complete, added for readers precision
                    
                    }
                    
                    // Debug 
					$uncut_phrase .= $tempor;
					$uncut_phrase .= " ";
					
				}

				return array($pass_phrase, $uncut_phrase);
				
			}


            if (isset($_POST["include_nums_passphrase"]) && isset($_POST["include_punctuation_passphrase"])) {
                // First case where user wants both nums and punctuation in his password
                $hold_space = passphrase_gen($_POST['passphrase'], true, true);
                echo "<br/>".$hold_space[0]."<br/><br/>Remember Your Password:<br/>&emsp;".$hold_space[1]."<br/>";
                
            } else if (isset($_POST["include_nums_passphrase"]) && !isset($_POST["include_punctuation_passphrase"])) {
                // second case where user wants only nums and no punctuation in his password
                $hold_space = passphrase_gen($_POST['passphrase'], true, false);
                echo "<br/>".$hold_space[0]."<br/><br/>Remember Your Password:<br/>&emsp;".$hold_space[1]."<br/>"; 
                
            } else if (!isset($_POST["include_nums_passphrase"]) && isset($_POST["include_punctuation_passphrase"])) {
                // First case where user wants only punctuation and no nums in his password
                $hold_space = passphrase_gen($_POST['passphrase'], false, true);
                echo "<br/>".$hold_space[0]."<br/><br/>Remember Your Password:<br/>&emsp;".$hold_space[1]."<br/>"; 
                
            } else {
                // When user wants neither nums not punctuation in in password
                $hold_space = passphrase_gen($_POST['passphrase'], false, false);
                echo "<br/>".$hold_space[0]."<br/><br/>Remember Your Password:<br/>&emsp;".$hold_space[1]."<br/>";  
                
            }
			
			
		?>


	</body>
</html>
