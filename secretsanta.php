<?php
	$names = array('person1', 'person2', 'person3', 'person4', 'person5', 'person6');
	$emails = array('person1'=>'person1@host.com', 'person2'=>'person2@host.com', 'person3'=>'person3@host.net', 'person4'=>'person4@host.com', 'person5'=>'person5@host.com', 'person6'=>'person6@host.com');
	santa($names, $gifter, $giftee);
	email($gifter, $giftee, $emails);
	echo "sent.";
	function santa($names, &$gifter, &$giftee) {
		shuffle($names);
		$shuffled = $names;
		$gifter = $names;
		shuffle($shuffled);
		$giftee = $shuffled;
		$size = count($gifter);
		$error = '';
		for ($i = 0; $i < $size; ++$i)
			if (($gifter[$i] == $giftee[$i]) or ($gifter[$i] == 'person1' and $giftee[$i] == 'person2' or $gifter[$i] == 'person2' and $giftee[$i] == 'person1') or ($gifter[$i] == 'person3' and $giftee[$i] == 'person4' or $gifter[$i] == 'person4' and $giftee[$i] == 'person3'))
				$error .= 1;
		if ($error) //re-shuffle till you get it right
			santa($names, $gifter, $giftee);
	}
	function email($gifter, $giftee, $emails) {
		$i = 0;
		foreach ($gifter as $thisgifter) {
			mail($emails[$thisgifter], 'Your Swiss Family Robinson secret santa recipient!', 'Secret santa says you must buy a gift for: '.$giftee[$i]."!", "From: Santa <santa@northpole>\r\n"."Reply-to: person@host.com\r\n");
			++$i;
		}
	}
?>