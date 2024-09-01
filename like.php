<?php

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['id'])) {
        $id = $input['id'];

        $stmt = $pdo->prepare('UPDATE pdf_files SET likes = likes + 1 WHERE id = ?');
        $stmt->execute([$id]);

        $stmt = $pdo->prepare('SELECT likes FROM pdf_files WHERE id = ?');
        $stmt->execute([$id]);
        $likes = $stmt->fetchColumn();

        echo json_encode(['likes' => $likes]);
    }
}
?>
