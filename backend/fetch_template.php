<?php
$template = $_GET['template'] ?? '';

$allowedTemplates = ['login', 'signup', 'my-basket'];

if (in_array($template, $allowedTemplates)) {
    $filePath = __DIR__ . "/../frontend/$template.html";

    if (file_exists($filePath)) {
        readfile($filePath);
    } else {
        echo "Error: Template not found.";
    }
} else {
    echo "Error: Invalid template requested.";
}
?>
