


<html>
	<body>
		<?php 
			
			function make_random_password($len, $inc_nums=true, $inc_punctuation=true) {
				// Characters to include in passwd
				$alphas_lower = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
				$alphas_upper = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
				$nums = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
				$punctuation = array('!', '"', '#', '$', '%', '&', "'", '(', ')', '*', '+', ',', '-', '.', '/', ':', ';', '<', '=', '>', '?', '@', '[', '\\', ']', '^', '_', '`', '{', '|', '}', '~');
				
				// Array of all characters
				$all = array($alphas_lower, $alphas_upper, $punctuation, $nums);
				
				
				// Result randomly generated passwd
				$password = "";
				for ($counter=0; $counter<$len; $counter++) {
					if ($inc_nums && $inc_punctuation) {
						// Passwd with alphabets, nums, punctuation
						
						// mt_rand(min, max) max in inclusive
						// Random selection of list of characters
						$all_element = $all[mt_rand(0, sizeof($all)-1)];
						
						// Random selection of item in specific list of characters
						$password .= $all_element[mt_rand(0, sizeof($all_element)-1)];
						
					} else if ($inc_nums && !$inc_punctuation) {
						// Passwd with only alphabets, nums not punctuation
						
						// Same technique as before
						$all_index = mt_rand(0, sizeof($all)-2);
						if ($all_index == 2) { $all_index += 1; }
						$password .= $all[$all_index][rand(0, sizeof($all[$all_index])-1)];
						
					} else if (!$inc_nums && $inc_punctuation) {
						// Passwd with only alphabets, punctuation not nums
						
						// Again, Same technique as before
						$all_element = $all[mt_rand(0, sizeof($all)-2)];
						$password .= $all_element[mt_rand(0, sizeof($all_element)-1)];
						
					} else {
						// Passwd with only alphabets no nums or punctuation
						
						// Again again, Same technique as before
						$all_element = $all[mt_rand(0, sizeof($all)-3)];
						$password .= $all_element[mt_rand(0, sizeof($all_element)-1)];
						
					}
				}
				
				// Business as usual
				return $password;
			}
				
			// Test
			// echo make_random_password(16, false, false);
			// echo "\n";
			
			// Matches the config. of above conditions
			if (isset($_POST['include_nums']) && isset($_POST['include_punctuation']) && $_POST['length_of_passwd'] >= 8) {
				echo make_random_password($_POST['length_of_passwd'], true, true);
				
			} else if (isset($_POST['include_nums']) && !isset($_POST['include_punctuation']) && $_POST['length_of_passwd'] >= 8) {
				echo make_random_password($_POST['length_of_passwd'], true, false);
				
			} else if (!isset($_POST['include_nums']) && isset($_POST['include_punctuation'])  && $_POST['length_of_passwd'] >= 8) {
				echo make_random_password($_POST['length_of_passwd'], false, true);
				
			} else if ($_POST['length_of_passwd'] >= 8) {
				echo make_random_password($_POST['length_of_passwd'], false, false);
				
			} else {
				echo "Please put password length greater than 7!";
			}
			
		?>
	</body>
</html>
