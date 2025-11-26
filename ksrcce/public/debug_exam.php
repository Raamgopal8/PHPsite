<?php
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use App\Core\App;
use App\Models\Exam;

$app = new App();
$examModel = new Exam($app->db);
$exams = $examModel->all();

echo "<pre>";
if (!empty($exams)) {
    print_r($exams[0]);
} else {
    echo "No exams found.";
}
echo "</pre>";
