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

$search = isset($_GET['query']) ? $_GET['query'] : '';
$search = "%$search%";

$stmt = $pdo->prepare('SELECT * FROM pdf_files WHERE title LIKE ? ORDER BY uploaded_at DESC');
$stmt->execute([$search]);
$results = $stmt->fetchAll();

echo json_encode($results);
?>
