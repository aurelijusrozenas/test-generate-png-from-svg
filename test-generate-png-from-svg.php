<?php

/** @noinspection ALL */

declare(strict_types=1);

error_reporting(E_ALL);

$imagick = new Imagick();
/* get svg content */
$svgContent = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 666 348" width="666" height="348"><circle r="1.5" cx="333" cy="175.60000610351562" fill="black"></circle></svg>';
$encodedPng1 = null;
$encodedPng2 = null;
try {
    echo "\nSvg image:\n$svgContent\n";
    $imagick->readImageBlob($svgContent);
    $imagick->setImageFormat('png');
    $pngContent = $imagick->getImageBlob();
    echo "===== Success!!! =======\n";
    $encodedPng1 = sprintf('%s%s', 'data:image/png;base64,', base64_encode($pngContent));
    echo "\nEncoded png image:\n$encodedPng1\n";
} catch (Throwable $throwable) {
    echo "====== Failed! ======\n";
    echo $throwable->getMessage()."\n";
}

try {
    echo "\n======= Let's try adding xml tag ========";
    $wrappedSvgContent = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>'.$svgContent;
    echo "\nWrapped svg image:\n$wrappedSvgContent\n";
    $imagick->readImageBlob($wrappedSvgContent);
    $imagick->setImageFormat('png');
    $pngContent = $imagick->getImageBlob();
    echo "===== Success!!! =======\n";
    $encodedPng2 = sprintf('%s%s', 'data:image/png;base64,', base64_encode($pngContent));
    echo "\nEncoded png image:\n$encodedPng2\n";
} catch (Throwable $throwable) {
    echo "====== Wrapped version failed! ======\n";
    echo $throwable->getMessage()."\n";
}

if ($encodedPng1 && $encodedPng2) {
    if ($encodedPng1 === $encodedPng2) {
        echo "\n****** Converted png content is the same. Hooray. ******\n";
    } else {
        echo "\n****** Converted png content is NOT the same. :/ ******\n";
    }
}
