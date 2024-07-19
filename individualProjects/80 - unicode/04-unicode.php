<?php
header('Content-Type: text/html');

// cyrillic characters in text
$text1 = 'Hеllо Wоrld!';
var_dump($text1);
// var_dump('аpplе.com');

echo "-----\n";

// non-breaking whitespace character
$text2 = 'Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World ';
echo '$ 123.00';
var_dump($text2);

echo "-----\n";
// Invisible Whitespace
$text3 = 'Hello​WorldHello​WorldHello​WorldHello​WorldHello​WorldHello​WorldHello​WorldHello​WorldHello​World';
var_dump($text3);

echo "-----\n";
// Invisible plus
$text4 = 'Hello⁤World!';
var_dump($text4);

echo "-----\n";
// Unicode full width characters
$text5 = 'Ｈｅｌｌｏ Ｗｏｒｌｄ';
var_dump($text5);

echo "-----\n";

// RTL within LTR text
$text6 = 'The title is "مفتاح معايير الويب!" in Arabic.';
var_dump(mb_str_split($text6));
echo "-----\n";