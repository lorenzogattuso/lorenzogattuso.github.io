<?php
header('Content-Type: application/json');

$dir = './Articles';  // Assicurati che il percorso sia corretto
$files = array();

if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) == 'html') {
                $files[] = $file;
            }
        }
        closedir($dh);
    } else {
        echo json_encode(array('error' => 'Cannot open directory'));
        exit;
    }
} else {
    echo json_encode(array('error' => 'Not a directory'));
    exit;
}

// Debugging output
if (empty($files)) {
    echo json_encode(array('error' => 'No files found in the directory'));
    exit;
}

echo json_encode($files);
?>
