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

$projectId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($projectId > 0) {
    $stmt = $pdo->prepare('SELECT * FROM pdf_files WHERE id = ?');
    $stmt->execute([$projectId]);
    $project = $stmt->fetch();

    if ($project) {
        header('Content-Type: application/json');
        echo json_encode($project);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Project not found']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid project ID']);
}
?>
