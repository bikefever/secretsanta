<?php
    //participants
    $names =  array(
        'Person 1'=>'person1@host.com',
        'Person 2'=>'person2@host.com',
        'Person 3'=>'person3@host.com',
        'Person 4'=>'person4@host.com',
        'Person 5'=>'person5@host.com'
    );

    $gifter = array();
    $giftee = array();

    santa($names, $gifter, $giftee);
    email($gifter, $giftee, $emails);
    echo "done.";

    function santa($names, &$gifter, &$giftee) {
        uksort($names, "randCompare");
        $shuffled = $names;
        $gifter = $names;
        uksort($shuffled, "randCompare");
        $giftee = $shuffled;

        $size = count($gifter);
        $error = '';

        $gifterKeys = array_keys($gifter);
        $gifteeKeys = array_keys($giftee);

        for ($i = 0; $i < $size; ++$i) {
            if ((
                //prevention cases
                $gifter[$gifterKeys[$i]] == $giftee[$gifteeKeys[$i]]) or ((
                //example; disallow this couple from being assigned each other
                $gifter[$gifterKeys[$i]] == $names['Person 1'] and 
                $giftee[$gifteeKeys[$i]] == $names['Person 2'] or
                $gifter[$gifterKeys[$i]] == $names['Person 2'] and
                $giftee[$gifteeKeys[$i]] == $names['Person 1']))
            ) {
                $error .= 1; //flag
            }
        }

        if ($error) {
            //re-shuffle till you get it right
            santa($names, $gifter, $giftee);
        }
    }

    function email($gifter, $giftee, $emails) {
        $i = 0;
        foreach ($gifter as $giftername=>$gifteremail) {
            $gifteeKeys = array_keys($giftee);
            echo "<p>to: $gifteremail buys for ".$gifteeKeys[$i]."</p>";
            
            //example mail() call:
            /*mail(
                $gifteremail,
                'Your secret santa recipient!', // subject
                'Secret santa says you must buy a gift for: '.$gifteeKeys[$i]."!", //body
                "From: Santa <santa@northpole>\r\n"."Reply-to: replyaddress@host.com\r\n" //from
            );*/

            ++$i;
        }
    }

    function randCompare() {
        return rand() > rand();
    }
?>