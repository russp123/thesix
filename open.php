<?php
if (isset($_GET['id'])) {
    $host = 'localhost';
    $db = 'pdf_uploads';
    $user = 'pdf_uploads';
    $pass = '123';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    $stmt = $pdo->prepare('SELECT filename FROM pdf_files WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $file = $stmt->fetch();

    if ($file) {
        $filePath = 'uploads/' . $file['filename'];
        if (file_exists($filePath)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $file['filename'] . '"');
            readfile($filePath);
            exit;
        } else {
            echo 'File not found!';
        }
    } else {
        echo 'Invalid file ID!';
    }
} else {
    echo 'No file ID specified!';
}
?>
