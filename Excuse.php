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
		if($subject !== false && $person['person'] !== false) {
			$response = create_response($person, $subject);
		}
		return $person;
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

				return array('pronoun' => false, 'person' => $directed_person);
 			}
		}

		//someone was likely not mentioned so check for pronouns
		$pronouns = array(
			"him",
			"her",
			"them",
		);

		$scen_ex = explode(" ", $scenario);

		foreach($scen_ex as $word) {
			if(in_array($word, $pronouns)){
				return array('pronoun' => true, "person" => $word);
			}
 		}

 		// use levenshtein
 		// double check with metaphone

 		//let's assume they didn't refer to anyone
 		return array('pronoun' => false, "person" => false);
	}

	function find_subject($scenario) {
		$english_constructs = array(
			"go to ",
			"going to ",
			"late for ",
			"asking me on ",
			// "asking me for ",
			"asking me to attend ",
			"get out of ",
			"avoid ",
			"go on ",
		);
		
		$construct_found = array();
		foreach($english_constructs as $construct) {
			if(strpos($scenario, $construct) !== false){
				$construct_found[] = $construct;
				break; //break to improve performance
				//TODO bring in second foreach for performance
			}
		}
		if(!empty($construct_found[0])) {
			foreach($construct_found as $constrct) {
				$test_var = "made it here ";
				$position = strpos($scenario, $constrct);
				$position += strlen($constrct);
				$clip = substr($scenario, $position);
				$scen_ex = explode(" ", $clip);
				//likely at the end of the sentence
				$prep_words = array(
					"a",
					"an",
					"the",
					"my",
				); 

				if(in_array($scen_ex[0], $prep_words) && count($scen_ex) <= 2) {
					$subject = $scen_ex[1];
					return $subject;
				}
				else if(count($scen_ex) <= 2) {
					$subject = $scen_ex[0];
					return $subject;
				}
 			}
 		}
 		return false;
	}

	function create_response($person, $subject) {
		$segway = create_segway($person);
		$subject_phrase = mk_subj_phrase($subject);
	}

	function create_segway($person) {
		if($person['pronoun'] === true) {
			//List out pronouns
			$pronoun_phrases = array(
				'I would tell ',
				'Just tell',
				'Try telling ',
				'Tell ',
				'I would just say to ',
			);
			//grammatically deal with a pronoun
			$generate = rand(0, 4);
			$segway = $pronoun_phrases[$generate] . ' ' . $person  .  ' ';
			return $segway;
		}
		else if($person['person'] === true){
			$segways = array(
				'I would just explain to this ',
				'Just tell your ',
				'Maybe tell your ',
				'I would just tell your ',
			);
			$generate = rand(0, 3);
			$segway = $pronoun_phrases[$generate];
			if($generate === 0) {
				$segway = $segways[0] . $person['person'] . ' of yours ';
			}
			else {
				$segway = $segways[0] . $person['person'] . ' ';
			}
			return $segway;
		}
		return false;
	}

	function mk_subj_phrase() {
		
	}

	public $exc1 = "Just say traffic was terrible.";
	public $exc2 = "Just say your arm cramped up.";
	public $exc3 = "I hate those. Always start with fake crying. Then proceed to tell a bad experience you had at one.";
	public $exc4 = "People can be so selfish sometimes. Just tell him you have boyfriend who gets out of prison in a few days.";
	public $exc5 = "I never do that. Its way too time consuming and besides its so passe. I would just say I took my dog to the vet and found out she's having puppies. Its boys and girls! Tell them you like their name and say you'll be naming one after them.";
	public $exc6 = "You're one of those! Speeding is never a good thing. If you're not packing donuts then tell the officer you always drive that fast and nobody has said anything to you before.";
}

?>

