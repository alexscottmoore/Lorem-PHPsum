# Lorem-PHPsum

Lorem PHPsum (that's "Lorem Fipsum") is a random-text-generating PHP function. It is especially useful for creating blocks of text as placeholders in your web projects.

## Basic Usage

``` php

<?php
include "lorem-phpsum.php";

echo phpsum(); // prints 20 random words, starting with "Lorem ipsum"...
?>

```
## Advanced Usage

But wait, there's more!

``` php

<?php
include "lorem-phpsum.php";

// phpsum($minWords, $maxWords, $minNumParagraphs, $maxNumParagraphs);
echo phpsum(20); // prints 20 random words
echo phpsum(20, 40); // prints a random number of 20 to 40 words
echo phpsum(20, 40, 2); // prints a random number of 20 to 40 words in 2 paragraphs
echo phpsum(20, 40, 2, 4); // prints a random number of 20 to 40 words in a random number of 2 to 4 paragraphs
?>

```
## Optional Arguments

The function also accepts any number of the following optional arguments.  Defaults are depicted below:

``` php

<?php
include "lorem-phpsum.php";

$args = array( // All parameters are OPTIONAL -- these are the defaults
	'duplicateParagraphs' => 'false', 	// should all paragraphs be identical?
	'lorem' => 'true', 					// should we begin with "Lorem ipsum..."?
	'periods' => 'true', 				// should we include periods between sentences?
	'caps' => 'true', 					// should each sentence start with a capital letter?
	'html' => 'true', 					// should we include <p> tags between paragraphs?
	'nums' => 'false', 					// should we include random numbers in the output? 
	'specialChars' => 'false', 			// should we include special characters in the output?
	'vowelSense' => 'true', 			// should each word look a little more English-like (with vowels between consonants)?
	'doubleSpace' => 'false', 			// should we include double spaces between pargraphs?
	'minCharsInWords' => 2,
	'maxCharsInWords' => 8,
	'minWordsInSentences' => 4,
	'maxWordsInSentences' => 12,
	);
	
echo phpsum(20, 40, 2, 4, $args);
?>

```
Alternatively, the arguments can be placed first in the function, like so:

``` php

<?php
include "lorem-phpsum.php";

echo phpsum($args, 20, 40);
?>
```