<?php
//header('Content-Type: image/png');
//readfile(DIR.'includes/images/bg.png');
session_start();
$_SESSION[codelogin]=rand(100000,999999);
header("Content-Type: image/png");


$im = imagecreatetruecolor(220, 42);

// Create some colors
$white = imagecolorallocate($im, 249, 249, 249);
$grey = imagecolorallocate($im, 10, 148, 148);
$black = imagecolorallocate($im, 0, 168, 198);
imagefilledrectangle($im, 0, 0, 220, 42, $white);


// The text to draw
$text = $_SESSION[codelogin];
// Replace path by your own font path
$font = ROOT.DS.'includes/themes/fonts/iransans.ttf';

// Add some shadow to the text
imagettftext($im, 20, 0, 60, 31, $grey, $font, $text);

// Add the text
imagettftext($im, 20, 0, 60, 30, $black, $font, $text);

$values = array(
    rand(0,220), rand(0,42), // Point 1 (x, y)
    rand(0,220), rand(0,42), // Point 2 (x, y)
    rand(0,220), rand(0,42), // Point 3 (x, y)
);


$values2 = array(
    rand(0,220), rand(0,42), // Point 1 (x, y)
    rand(0,220), rand(0,42), // Point 2 (x, y)
    rand(0,220), rand(0,42), // Point 3 (x, y)
);


$col_poly = imagecolorallocate($im, 0, 168, 198);
$col_poly2 = imagecolorallocate($im, 10, 148, 148);
// Draw the polygon
imagepolygon($im, $values, 3, $col_poly);
imagepolygon($im, $values2, 3, $col_poly2);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
?>
