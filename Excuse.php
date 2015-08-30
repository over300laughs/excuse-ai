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
		$person = self::get_person($scenario);
	}

	//Just starting simple
	function rainbow($scenario){
		//check context using rainbow array first
		$rainbow = array(
			"a" => "i'm late for work",		
			"d" => "won't leave me alone",		
			"e" => "don't want to go",
			"f" => "date",
			"g" => "didn't finish",
			"h" => "forgot about",
			"i" => "forgot to pick up",
			"j" => "avoid a",
			"l" => "leave early",
			"m" => "showed up late",
			"n" => "never showed",
			"o" => "stop going",
			"p" => "stopped",
			"q" => "leave a conversation",
		);

		$exact_match = array();
		foreach($rainbow as $key => $snippet) {
			if($scenario == $snippet) {
				$rainbow_answer = get_rainbow_answer($snippet);
				return $rainbow_answer;
			}
		}
		return false;
	}

	function get_person($scenario) {
		$persons = array(
			"wife",
			"husband",
			"friend",
			"friends",
			"mom",
			"dad",
			"sister",
			"brother",
			"aunt",
			"uncle",
			"cousin",
			"grandpa",
			"grandma",
			"g-pa",
			"g-ma",
			"great gran",
			"girlfriend",
			"boyfriend",
			"lover",
			"lover",
			"family",
			"families",
			"partner",
			"boss",
			"co-worker",
			"coworker",
			"employee",
			"manager",
			"customer",
			"client",
			"consultant",
			"therapist",
			"chef",
		);

		$tell = array(
			"said to ",
			"tell to ",
			"told ",
			"told my ",
			"tell ",
			"explain to ",
			"mentioned to ",
			"say to ",
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
				if($scen_ex[0] == "my" || $scen_ex[0] == "to");
					$directed_person = $scen_ex[1];

				return $directed_person;
 			}
		}


		/*** the world is not ready for this yet**/
		//try again for person if we somehow missed them
		// $persons_found = array();
		// foreach($persons as $snippet) {
		// 	if(strpos($scenario, $snippet) !== false)
		// 		$persons_found = $snippet;
		// }
		//$person = $snippets_found[0];

		//someone was likely not mentioned check for pronouns
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

 		//let's assume they didn't refer to anyone
 		return false;
	}

	function analyze($scenario, $rainbowResults){
		$subject_words = array(
			"work",
			"school",
			"house",
			"party",
			"funeral",
			"a date",
			"breakfast",
			"lunch",
			"dinner",
			"ticket",
			"hospital",
			"church",
			"game",
			"concert",
			"class",
			"meeting",
			"movies",
		);

		$action_words = array(
			"late",
			"in time",
			"missed",
			"don't want to",
			"can't go",
			"can't make it",
			"forgot to",
			"forgot about",
			"pay",
			"make it",
			"can't",
			"never showed up",
			"get out",
			"injured",
			"said I would",
			"not",
			"never",
			"made it",
			"couldn't",
			"on time",
		);


		// $persons = array(
		// 	"wife",
		// 	"husband",
		// 	"friend",
		// 	"friends",
		// 	"mom",
		// 	"dad",
		// 	"sister",
		// 	"brother",
		// 	"aunt",
		// 	"uncle",
		// 	"cousin",
		// 	"grandpa",
		// 	"grandma",
		// 	"g-pa",
		// 	"g-ma",
		// 	"great gran",
		// 	"girlfriend",
		// 	"boyfriend",
		// 	"lover",
		// 	"lover",
		// 	"family",
		// 	"families",
		// 	"partner",
		// 	"boss",
		// 	"co-worker",
		// 	"coworker",
		// 	"employee",
		// 	"manager",
		// 	"customer",
		// 	"client",
		// 	"consultant",
		// 	"therapist",
		// 	"chef",
		// );

		$segways = array(
			"Just tell ",
			"Just tell them ",
			"I would just say ",
			"Just explain that ",
			"It would probably go over best to say ",
			"I would just mention that you ",
		);


	}

	public $exc1 = "Just say traffic was terrible.";
	public $exc2 = "Just say your arm cramped up.";
	public $exc3 = "I hate those. Always start with fake crying. Then proceed to tell a bad experience you had at one.";
	public $exc4 = "People can be so selfish sometimes. Just tell him you have boyfriend who gets out of prison in a few days.";
	public $exc5 = "I never do that. Its way too time consuming and besides its so passe. I would just say I took my dog to the vet and found out she's having puppies. Its boys and girls! Tell them you like their name and say you'll be naming one after them.";
	public $exc6 = "You're one of those! Speeding is never a good thing. If you're not packing donuts then tell the officer you always drive that fast and nobody has said anything to you before.";
}

		// $exact_match = array();
		// foreach($rainbow as $key => $snippet) {
		// 	if(strpos($snippet, $scenario) !== false) {
		// 		$snippets_found[$key] = $snippet;
		// 	}
		


		// $rainbow = array(
		// 	"a" => "late for work",		
		// 	"b" => "dropped a knife",		
		// 	"c" => "have to go to a",		
		// 	"d" => "won't leave me alone",		
		// 	"e" => "don't want to go",
		// 	"f" => "date",
		// 	"g" => "didn't finish",
		// 	"h" => "forgot about",
		// 	"i" => "forgot to",
		// 	"j" => "avoid a",
		// 	"k" => "how can I say",
		// 	"l" => "leave early",
		// 	"m" => "showed up late",
		// 	"n" => "never showed",
		// 	"o" => "stop going",
		// 	"p" => "stopped",
		// 	"q" => "leave a conversation",
		// );


?>

