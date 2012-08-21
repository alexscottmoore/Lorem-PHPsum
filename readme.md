# Lorem-PHPsum

Lorem PHPsum (that's pronounced "Lorem Fipsum") is a random-text lorem ipsum generator for PHP. It is especially useful for creating blocks of text as placeholders in your web projects.

## Basic Usage

``` php

<?php
include "lorem-phpsum.php";

echo phpsum(); // prints 100 random words, starting with "Lorem ipsum"...
?>

```

## Advanced Usage

But wait, there's more!

``` php

<?php
include "lorem-phpsum.php";

// phpsum($minWords, $maxWords, $minNumParagraphs, $maxNumParagraphs, $options);
echo phpsum(20); // prints 20 random words
echo phpsum(20, 40); // prints a random number of 20 to 40 words
echo phpsum(20, 40, 2); // prints a random number of 20 to 40 words in 2 paragraphs (with <p> tags)
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
?>

```
The array of arguments can be passed first or last in the function, like so:

``` php

<?php
echo phpsum($args);
echo phpsum($args, 20);
echo phpsum($args, 20, 40);
echo phpsum($args, 20, 40, 3);
echo phpsum($args, 20, 40, 3, 5);
echo phpsum(20, $args);
echo phpsum(20, 40, $args);
echo phpsum(20, 40, 3, $args);
echo phpsum(20, 40, 3, 5, $args);
?>

```
## Examples

``` php

<?php
include "lorem-phpsum.php";

echo phpsum();
// Lorem ipsum ros bebune ridy cujerusa pycetin fegynuro dejo. Qijumo gu su segaly... (for 100 words)

echo phpsum(4, 8);
// Lorem ipsum fubopy nafi fo pi.


echo phpsum(4, 8, 2);
// <p>Lorem ipsum sujoq puqyboc.</p>
// <p>Lupo cup re soc facasaty.</p>


echo phpsum(4, 20, 2, 5);
// <p>Lorem ipsum lacefic hebu.</p>
// <p>Ta godycisu sa qasa no nacurej rotipa mametof tum.</p>
// <p>Tulyjib facy pun mo. Mot mube sin musatudu tyfes macyb jen py dytar. Nyqapuli gecalej.</p>


$args = array(
	'duplicateParagraphs' => 'true',
	'lorem' => 'false',
	);
echo phpsum($args, 15, 20, 2);
// <p>Pijoto qecaje gegapa sydo tetegigi sipu diq. Can cujaniq tegebuny focijo muqe nisat fe jat dag by. Qumej.</p>
// <p>Pijoto qecaje gegapa sydo tetegigi sipu diq. Can cujaniq tegebuny focijo muqe nisat fe jat dag by. Qumej.</p>


$args = array(
	'specialChars' => 'true',
	'minWordsInSentences' => 10,
	);
echo phpsum($args, 10);
// Lorem ipsum yso†eÌi »oÇaü ¢eÈeAu• duŒiì !o™y-y Òy:u» Þe>eãe ku·eÅ.


$args = array(
	'lorem' => 'false',
	'periods' => 'false',
	'caps' => 'false',
	'nums' => 'true',
	);
echo phpsum($args, 15, 20, 1, 3);
// 2eqej so bu 8yb gu5i6y 8o 6e0ily 5ycyro 3e9 ciquhe hedyqu6u 2enypa3y ce to2u5i3 3o8o3 se

?>

```