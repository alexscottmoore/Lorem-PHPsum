Lorem PHPsum (that's "Lorem Fipsum") is a random-text-generating PHP function.  It is especially useful for creating blocks of text as placeholders in your web projects.

BASIC USAGE:
<?php
echo phpsum(); // prints 20 random words enclosed in <p> tags, starting with the words "Lorem ipsum"...
?>

ADVANCED USAGE:
But wait, there's more!  Just take a look at all these juicy options:

// phpsum($minWords=20, $maxWords=null, $minnumParagraphs=1, $maxnumParagraphs=null, $duplicateParagraphs=false, $lorem=true, $periods=true, $caps=true, $html=true, $nums=false, $specialChars=false, $vowelSense=true, $doubleSpace=false, $minCharsInWords=2, $maxCharsInWords=8, $minWordsInSentences=4, $maxWordsInSentences=12)

EXAMPLES:
<?php
echo phpsum(20,40); // prints a random number of 20 to 40 words

echo phpsum(20,40,2,4) // prints a random number of 20 to 40 words in a random number of 2 to 4 paragraphs

echo phpsum(20,40,2,4,true) // same as above, but paragraphs will all be identical

echo phpsum(20,40,2,4,true,false) // same as above, but with "Lorem Ipsum" left out

echo phpsum(20,40,2,4,true,false,false) // no periods (.) or full stops

echo phpsum(20,40,2,4,true,false,true,false) // no capital letters

echo phpsum(20,40,2,4,true,false,true,true,false) // text only (no <p> tags)

echo phpsum(20,40,2,4,true,false,true,true,false,true) // throw in some integers

echo phpsum(20,40,2,4,true,false,true,true,false,false,true) // throw in special characters (chaos!)

echo phpsum(20,40,2,4,true,false,true,true,false,false,false,true) // ignore the rule to alternate between vowels and consonants

echo phpsum(20,40,2,4,true,false,true,true,false,false,false,true,false) // get rid of double spaces after sentences

echo phpsum(20,40,2,4,true,false,true,true,false,false,false,true,true,2,8) // all words will have between 2 and 8 characters

echo phpsum(20,40,2,4,true,false,true,true,false,false,false,true,true,2,8,4,12) // all sentences will have between 4 and 12 words
?>