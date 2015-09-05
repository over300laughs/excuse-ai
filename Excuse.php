<?php
class Excuse_Generator {
	function getPing(){
		return "POOOOOONG!";
	}

	function generateExcuse($scenario) {
		//do this later
		//$rainbowResults = self::rainbow($scenario);
		// if($rainbowResults) {
		// 	return 
		// }

		$scenario = strtolower($scenario);
		$person = self::find_person($scenario);
		$subject = self::find_subject($scenario);
		echo $subject;
		exit;

	}

	function find_person($scenario) {
		
		//TODO: take into account present tense such as whispers as well as the such as officer
		//adjectives still not accounted for :(
		$tell = array (
			"said to ",
			"spoke to ",
			"whispered to ",
			"say to ",
			//"tell to ", shouldn't need this
			"told ",
			//"told my ", shouldn't need this
			"tell ",
			"explain to ",
			"mentioned to ",
		);

		//confirm recipient
		$recipient_directive = array();
		foreach($tell as $snippet) {
			if(strpos($scenario, $snippet) !== false)
				$recipient_directive[] = $snippet;
		}
		if(!empty($recipient_directive)) {
			//go get em!
			foreach($recipient_directive as $recipient) {
				$position = strpos($scenario, $recipient);
				$position += strlen($recipient);
				$clip = substr($scenario, $position);
				$scen_ex = explode(" ", $clip);
				$directed_person = $scen_ex[0];

				//likely only going to be one we hope. 
				if($scen_ex[0] == "my" || $scen_ex[0] == "to")
					$directed_person = $scen_ex[1];

				return $directed_person;
 			}
		}

		//someone was likely not mentioned so check for pronouns
		$pronouns = array(
			"he",
			"she",
			"him",
			"her",
			"they",
			"them",
		);

		$scen_ex = explode(" ", $scenario);

		foreach($scen_ex as $word) {
			if(in_array($word, $pronouns)){
				return $word;
			}
 		}

 		// use levenshtein
 		// double check with metaphone

 		//let's assume they didn't refer to anyone
 		return false;
	}

	function find_subject($scenario) {
		$english_constructs = array(
			"go to ",
			"going to ",
			"late for ",
			"asking me on ",
			"asking me for ",
			"asking me to attend ",
			"get out of ",
			"avoid ",
		);
		$construct_found = array();
		foreach($english_constructs as $construct) {
			if(strpos($scenario, $construct) !== false){
				$construct_found[] = $construct;
				break 2; //break to improve performance
				//TODO bring in second foreach for performance
			}
		}
		if(!empty($construct_found)) {
			foreach($construct_found as $constrct) {
				$position = strpos($scenario, $constrct);
				$position += strlen($constrct);
				$clip = substr($scenario, $position);
				$scen_ex = explode(" ", $clip);

				//likely at the end of the sentence
				//has room for one adjective
				$prep_words = array(
					"a",
					"an",
					"the",
				); 
				if(in_array($prep_words, $scen_ex) && count($scen_ex) <= 1) {
					$subject = $scen_ex[1];
					return $subject;
				}
 			}
 		}
 		return false;
	}


	public $exc1 = "Just say traffic was terrible.";
	public $exc2 = "Just say your arm cramped up.";
	public $exc3 = "I hate those. Always start with fake crying. Then proceed to tell a bad experience you had at one.";
	public $exc4 = "People can be so selfish sometimes. Just tell him you have boyfriend who gets out of prison in a few days.";
	public $exc5 = "I never do that. Its way too time consuming and besides its so passe. I would just say I took my dog to the vet and found out she's having puppies. Its boys and girls! Tell them you like their name and say you'll be naming one after them.";
	public $exc6 = "You're one of those! Speeding is never a good thing. If you're not packing donuts then tell the officer you always drive that fast and nobody has said anything to you before.";
}

?>

