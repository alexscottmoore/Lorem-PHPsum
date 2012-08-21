<?php
/*
Lorem PHPsum
https://github.com/alexscottmoore/Lorem-PHPsum

by Alex Moore
8/20/2012
_____________

BASIC USAGE:
include "lorem-phpsum.php";

echo phpsum(); // print 100 random words
echo phpsum(20); // prints 20 random words
echo phpsum(20, 40); // prints a random number of 20 to 40 words
echo phpsum(20, 40, 2); // prints a random number of 20 to 40 words in 2 paragraphs
echo phpsum(20, 40, 2, 4); // prints a random number of 20 to 40 words in a random number of 2 to 4 paragraphs


ADVANCED USAGE:
include "lorem-phpsum.php";

$args = array( // All parameters are OPTIONAL -- these are the defaults
	'duplicateParagraphs' => 'false', 	// should all paragraphs be identical?
	'lorem' => 'true', 					// should we begin with "Lorem ipsum..."?
	'periods' => 'true', 				// should we include periods between sentences?
	'caps' => 'true', 					// should each sentence start with a capital letter?
	'html' => 'true', 					// should we include <p> tags between paragraphs? otherwise use tabs and line breaks
	'nums' => 'false', 					// should we include random numbers in the output? 
	'specialChars' => 'false', 			// should we include special characters in the output?
	'vowelSense' => 'true', 			// should each word look a little more Latin-like (with vowels between consonants)?
	'doubleSpace' => 'false', 			// should we include double spaces between sentences?
	'minCharsInWords' => 2,
	'maxCharsInWords' => 8,
	'minWordsInSentences' => 4,
	'maxWordsInSentences' => 12,
	);
	
echo phpsum(20, 40, 2, 4, $args);
*/
function phpsum($minWords=100, $maxWords=null, $minNumParagraphs=-1, $maxNumParagraphs=null, $options=null) {
	if (is_array($maxWords)) {$options = $maxWords; $maxWords=null; } elseif (is_array($minNumParagraphs)) { $options = $minNumParagraphs; $minNumParagraphs=-1; } elseif (is_array($maxNumParagraphs)) { $options = $maxNumParagraphs; $maxNumParagraphs=null; } // if options array is placed last
	if (is_array($minWords)) { // if options array is placed first
		$tempOptions = $options;
		$options = $minWords;
		$minWords = ($maxWords===null?100:$maxWords);
		$maxWords = ($minNumParagraphs==-1?null:$minNumParagraphs);
		$minNumParagraphs = ($maxNumParagraphs===null?-1:$maxNumParagraphs);
		$maxNumParagraphs = ($tempOptions===null?null:$tempOptions);
	}
	if ($minNumParagraphs<0) {
		$pTags=false;
		$minNumParagraphs = 1;
	}
	else {
		$pTags=true;
	}
	
	$duplicateParagraphs = (isset($options['duplicateParagraphs']) ? ($options['duplicateParagraphs'] == "true" ? true : false) : false);
	$nums = (isset($options['nums']) ? ($options['nums'] == "true" ? true : false) : false);
	$specialChars = (isset($options['specialChars']) ? ($options['specialChars'] == "true" ? true : false) : false);
	$doubleSpace = (isset($options['doubleSpace']) ? ($options['doubleSpace'] == "true" ? true : false) : false);
	
	$lorem = (isset($options['lorem']) ? ($options['lorem'] == "false" ? false : true) : true);
	$periods = (isset($options['periods']) ? ($options['periods'] == "false" ? false : true) : true);
	$caps = (isset($options['caps']) ? ($options['caps'] == "false" ? false : true) : true);
	$html = (isset($options['html']) ? ($options['html'] == "false" ? false : true) : true);
	$vowelSense = (isset($options['vowelSense']) ? ($options['vowelSense'] == "false" ? false : true) : true);

	$minCharsInWords = (isset($options['minCharsInWords']) ? $options['minCharsInWords'] : 2);
	$maxCharsInWords = (isset($options['maxCharsInWords']) ? $options['maxCharsInWords'] : 8);
	$minWordsInSentences = (isset($options['minWordsInSentences']) ? $options['minWordsInSentences'] : 4);
	$maxWordsInSentences = (isset($options['maxWordsInSentences']) ? $options['maxWordsInSentences'] : 12);
	
	if (!is_int($minCharsInWords) || !is_int($maxCharsInWords) || !is_int($minWordsInSentences) || !is_int($maxWordsInSentences)) { return "Must be an integer."; }
	if ($minCharsInWords>$maxCharsInWords || $minWordsInSentences>$maxWordsInSentences) { return "Min cannot be larger than max."; }
	if ($minCharsInWords<=0 || $maxCharsInWords<=0 || $minNumParagraphs<=0 || $minWordsInSentences<=0 || $maxWordsInSentences<=0 || $minWords<=0) { return "Must be greater than 0."; }
	if (($lorem==true && $minWordsInSentences<2) || $minWordsInSentences<=0) { return "Sentences are too short.".($lorem==true && $minWordsInSentences<2?" Set lorem='false' or minWordsInSentences to 2 or above.":""); }
	
	$myString = "";
	if ($maxNumParagraphs!==null && is_int($maxNumParagraphs)) { $numParagraphs = mt_rand($minNumParagraphs,$maxNumParagraphs); } else { $numParagraphs = $minNumParagraphs; }
	for ($i=0; $i<$numParagraphs; $i++) {
		if ($maxWords!==null) { $numWords = mt_rand($minWords,$maxWords); } else { $numWords = $minWords; }
		if ($lorem && $i==0) {
			if ($lorem && $i==0 && $numWords>2) { $myString="Lorem ipsum "; } elseif ($lorem && $i==0 && $numWords>1) { $myString="Lorem ipsum."; } elseif ($lorem && $i==0 && $numWords>0) { $myString="Lorem."; }
			$numWords = $numWords-2;
		}
		$j = 0;
		while ($j < $numWords) {
			$thisSentenceLength = mt_rand($minWordsInSentences,$maxWordsInSentences);
			if ($i>0 && $j==0 && $html==false) { $thisSentence = "\r\t"; }
			else { $thisSentence = ""; }
			if ($numWords==0) { break; }
			if ($i==0 && $j==0 && $lorem==true && ($thisSentenceLength<=$minWordsInSentences+1)) { $thisSentenceLength = $maxWordsInSentences-2; }
			for ($k = 0; $k < $thisSentenceLength; $k++) {
				$thisWordLength = mt_rand($minCharsInWords, $maxCharsInWords);
				$thisSentence .= randomWord($thisWordLength, ($k==0&&!($i==0 && $j==0 && $lorem==true)?true:false), $vowelSense, $nums, $specialChars) . " ";
				$j++;
				if ($j==$numWords) { break; }
			}
			$myString .= htmlspecialchars(rtrim($thisSentence)) . ". ".($doubleSpace?" ":"") ;
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
	if ($html) { return ($pTags?"<p>":"").rtrim($myString). ($pTags?"</p>":""); }
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