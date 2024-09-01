<?php
require 'vendor/autoload.php';
require_once('vendor/setasign/fpdf/fpdf.php');
require_once('vendor/setasign/fpdi/src/autoload.php');

use setasign\Fpdi\Fpdi;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdfFile'])) {
    $file = $_FILES['pdfFile'];
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($file['name']);

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // The FCKING database connection
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

    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        // For a BTCH uploading pdf file
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($uploadFile);
        $newText = $pdf->getText();

        // For the SHT abstract
        $abstractText = '';
        if (preg_match('/ABSTRACT(.*?)(INTRODUCTION|BACKGROUND|MATERIALS AND METHODS|RESULTS|DISCUSSION|CONCLUSION|REFERENCES)/si', $newText, $matches)) {
            $abstractText = trim($matches[1]);
        }

        // Water MODOFOKING marking
        $watermarkedFile = $uploadDir . 'watermarked_' . basename($file['name']);
        $pdf = new FPDI();
        $pageCount = $pdf->setSourceFile($uploadFile);

        function addWatermarkText($pdf, $text, $x, $y) {
            $pdf->SetFont('Helvetica', 'B', 50);
            $pdf->SetTextColor(200, 200, 200);
            $pdf->SetXY($x, $y);
            $pdf->Text($x, $y, $text);
        }

        for ($i = 1; $i <= $pageCount; $i++) {
            $template = $pdf->importPage($i);
            $pdf->AddPage();
            $pdf->useTemplate($template);
            addWatermarkText($pdf, 'DHVSU', 30, 120);
            addWatermarkText($pdf, 'DHVSU', 100, 200);
            addWatermarkText($pdf, 'DHVSU', 170, 280);
            addWatermarkText($pdf, 'DHVSU', 120, 220);
            addWatermarkText($pdf, 'DHVSU', 90, 170);
            addWatermarkText($pdf, 'DHVSU', 60, 140);
        }

        $pdf->Output($watermarkedFile, 'F');

        // For FCKING comparison of file
        $stmt = $pdo->query('SELECT id, filename, content FROM pdf_files');
        $files = $stmt->fetchAll();
        $similarities = [];

        foreach ($files as $existingFile) {
            $existingAbstract = '';
            if (preg_match('/ABSTRACT(.*?)(INTRODUCTION|BACKGROUND|MATERIALS AND METHODS|RESULTS|DISCUSSION|CONCLUSION|REFERENCES)/si', $existingFile['content'], $matches)) {
                $existingAbstract = trim($matches[1]);
            }

            if ($existingAbstract) {
                similar_text($abstractText, $existingAbstract, $percent);

                $similarities[] = [
                    'filename' => $existingFile['filename'],
                    'similarity' => $percent,
                    'commonWords' => array_intersect(
                        explode(' ', strtolower($abstractText)),
                        explode(' ', strtolower($existingAbstract))
                    )
                ];
            }
        }

        // Sorting file(Why am I here)
        usort($similarities, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        // The top 3 files(Just to suffer)
        echo '<h2>Top 3 Most Similar Project</h2>';
        echo '<table border="1">';
        echo '<tr><th>Uploaded Project</th><th>Stored Project</th><th>Similarity (%)</th><th>Common Words</th></tr>';

        $topSimilarities = array_slice($similarities, 0, 3);
        foreach ($topSimilarities as $similarity) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars(basename($file['name'])) . '</td>';
            echo '<td>' . htmlspecialchars($similarity['filename']) . '</td>';
            echo '<td>' . htmlspecialchars(number_format($similarity['similarity'], 2)) . '</td>';
            echo '<td>' . htmlspecialchars(implode(', ', $similarity['commonWords'])) . '</td>';
            echo '</tr>';
        }

        if (empty($topSimilarities)) {
            echo '<tr><td colspan="4">No similar files found.</td></tr>';
        }

        echo '</table>';

        // The details of files(GET ME OUT OF HERE!!)
        $title = $_POST['title'];
        $abstract = $_POST['abstract'];
        $authors = $_POST['authors'];
        $description = $_POST['description'];
        $academicYear = $_POST['academicYear'];

        $stmt = $pdo->prepare('INSERT INTO pdf_files (filename, title, abstract, authors, description, academicYear, content) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([basename($file['name']), $title, $abstract, $authors, $description, $academicYear, $newText]);

        echo 'File uploaded and watermarked successfully!<br>';
        echo '<a href="' . $watermarkedFile . '" target="_blank">View Watermarked PDF</a>';
    } else {
        echo 'File upload failed!';
    }
} else {
    echo 'No file uploaded!';
}
?>
