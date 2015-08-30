<?php
	//Just start simple
	$scenario = $_POST['scenario'];

	//check context using rainbow array first
	$rainbow = array(
		"late for work",		
		"dropped a knife",		
		"have to go to a",		
		"won't leave me alone",		
		"don't want to go",
		"date",
		"didn't finish",
		"forgot about",
		"forgot to",
		"avoid a",
		"how can I say",
		"leave early",
		"showed up late",
		"never showed",
		"stop going",
		"stopped",
		"leave a conversation",
		);

	foreach($rainbow as $snippet) {
		$snippets_found = array();
	
		if(strpos($scenario, $snippet) !== false) {
			$snippets_found[] = $snippet;
		}
	}

	



	// $phrase = explode(' ', $scenario);
	// foreach($phrase as $word) {

	// }


?>