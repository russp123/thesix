<?php
// Include the content of upload1.php
ob_start();
include 'upload1.php';
$content = ob_get_clean();

// Return the content as JSON
echo json_encode(['content' => $content]);
?>
