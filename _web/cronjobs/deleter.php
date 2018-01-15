<?php
$directory = "../archive/";
$filecount = 0;
$files = glob($directory . "*.txt");
if ($files){
    $filesinarchive = count($files);
}
for ($j = 5; $j < $filesinarchive; $j++) {
    $path = "../archive/";
    $file = "archived_" . $j . ".txt";
    $filebase = $path . $file;
    unlink($filebase);
}
echo "Archive cleared!";