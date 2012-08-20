<?php
/*
Lorem PHPsum
https://github.com/alexscottmoore/Lorem-PHPsum

by Alex Moore
8/20/2012
_____________

USAGE:
echo loremIpsum();
or:
echo loremIpsum(20,40,2,4);

OPTIONS:
loremIpsum($minWords=20, $maxWords=null, $minNumParagraphs=1, $maxNumParagraphs=null, $duplicateParagraphs=false, $lorem=true, $periods=true, $caps=true, $html=true, $nums=false, $specialChars=false, $vowelSense=true, $doubleSpace=false, $minCharsInWords=2, $maxCharsInWords=8, $minWordsInSentences=4, $maxWordsInSentences=12)

*/
function loremIpsum($minWords=20, $maxWords=null, $minNumParagraphs=1, $maxNumParagraphs=null, $duplicateParagraphs=false, $lorem=true, $periods=true, $caps=true, $html=true, $nums=false, $specialChars=false, $vowelSense=true, $doubleSpace=false, $minCharsInWords=2, $maxCharsInWords=8, $minWordsInSentences=4, $maxWordsInSentences=12) {
	if (!is_int($minWords) || !is_int($maxWords) || !is_int($minNumParagraphs) || !is_int($maxNumParagraphs) || !is_int($minCharsInWords) || !is_int($maxCharsInWords) || !is_int($minWordsInSentences) || !is_int($maxWordsInSentences)) { return "Must be an integer."; }
	if (!is_bool($duplicateParagraphs) || !is_bool($lorem) || !is_bool($periods) || !is_bool($caps) || !is_bool($html) || !is_bool($nums) || !is_bool($specialChars) || !is_bool($vowelSense) || !is_bool($doubleSpace)) { return "Must be a boolean (true or false)."; }
	if ($minCharsInWords>$maxCharsInWords || $minWordsInSentences>$maxWordsInSentences) { return null; }
	if (($lorem==true && $minWordsInSentences<2) || $minWordsInSentences<=0) { return null; }
	$myString = "";
	if ($maxNumParagraphs!==null) { $numParagraphs = mt_rand($minNumParagraphs,$maxNumParagraphs); } else { $numParagraphs = $minNumParagraphs; }
	for ($i=0; $i<$numParagraphs; $i++) {
		if ($maxWords!==null) { $numWords = mt_rand($minWords,$maxWords); } else { $numWords = $minWords; }
		if ($lorem && $i==0 && $numWords>=2) { $numWords = $numWords-2; }
		$j = 0;
		while ($j < $numWords) {
			$thisSentenceLength = mt_rand($minWordsInSentences,$maxWordsInSentences);
			if ($i>0 && $j==0 && $html==false) { $thisSentence = "\r\t"; }
			else { $thisSentence = ""; }
			if ($numWords==0) { break; }
			if ($i==0 && $j==0 && $lorem==true && ($thisSentenceLength<=$minWordsInSentences+1)) { $thisSentenceLength = $maxWordsInSentences-2; }
			for ($k = 0; $k < $thisSentenceLength; $k++) {
				$thisWordLength = mt_rand($minCharsInWords, $maxCharsInWords);
				$thisSentence .= randomWord($thisWordLength, ($k==0?true:false), $vowelSense, $nums, $specialChars) . " ";
				$j++;
				if ($j==$numWords) { break; }
			}
			$myString .= htmlspecialchars(rtrim($thisSentence)) . ". ".($doubleSpace?" ":"") ;
		}
		if ($i==0 && $lorem && $numWords>0) {
			$myString{0} = strtolower($myString{0});
			if ($numWords>2) { $myString = substr("Lorem",0,$maxCharsInWords) . " " . substr("ipsum",0,$maxCharsInWords) . " " . $myString; }
			elseif ($numWords==2) { $myString = substr("Lorem",0,$maxCharsInWords) . " " . substr("ipsum",0,$maxCharsInWords) . "."; }
			elseif ($numWords==1) { $myString = substr("Lorem",0,$maxCharsInWords) . "."; }
		}
		if ($numParagraphs>1 && ($numParagraphs-1!==$i)) { $myString = rtrim($myString) . "</p>".PHP_EOL.PHP_EOL."<p>"; }
		if ($duplicateParagraphs) {
			$initialParagraph = $myString;
			for ($l=0; $l<$numParagraphs-1; $l++) {
				$myString = $myString . $initialParagraph;
			}
			break;
		}
	}
	if ($caps==false) { $myString = strtolower($myString); }
	if ($periods==false) { $myString = str_replace(".","",$myString); }
	if ($html) { return "<p>".rtrim($myString)."</p>"; }
	else { return "\t".str_replace(array("<p>","</p>"),"",rtrim($myString)); }
}
function randomWord($length, $capitalize=false, $vowelSense, $nums, $specialChars) {
	if ($specialChars) { $consonants = implode(range(chr(33), chr(255))); }
	else { $consonants = "bcdfghjlmnpqrst".($nums?"1234567890":""); }
	$vowels = "aeiouy";
	$wordString = "";
	for ($i = 0; $i < $length; $i++) {
		if ($vowelSense) {
			if (strpos($vowels, (!isset($lastRandomChar)?"a":$lastRandomChar)) === false) { $randomChar = randomLetter($vowels); }
			else { $randomChar = randomLetter($consonants); }
			$lastRandomChar = $randomChar;
		}
		else {
			$randomChar = randomLetter($vowels.$consonants);
		}
		$wordString .= $randomChar;
	}
	if ($capitalize) { return ucfirst($wordString); } else { return $wordString; }
}
function randomLetter($string) {
	$randomPick = mt_rand(1, strlen($string));
	return $string[$randomPick-1];
}