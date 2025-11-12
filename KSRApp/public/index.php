<?php

// ✅ absolutely NO whitespace before this line
ob_start();  // Start buffering before ANY output

// Configure session settings before starting the session
ini_set('session.gc_maxlifetime', 3600);

// If env var not set, default path:
$savePath = getenv('SESSION_PATH') ?: __DIR__ . '/../storage/sessions';
if (!is_dir($savePath)) {
    mkdir($savePath, 0777, true);
}
session_save_path($savePath);

// Start the session after configuration
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Core\App;

// Create the App only after session initialized
$app = new App();

// Router
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Remove trailing slash
if ($uri !== '/' && substr($uri, -1) === '/') {
    header("Location: " . rtrim($uri, '/'));
    exit;
}

// Define routes
$routes = [
    'GET'  => [
        '/' => 'AuthController@login',
        '/login' => 'AuthController@login',
        '/register' => 'AuthController@register',
        '/logout' => 'AuthController@logout',
        '/student/dashboard' => 'ExamController@studentDashboard',
        '/student/exams' => 'ExamController@listExams',
        '/student/take' => 'ExamController@takeExam',
        '/admin/dashboard' => 'AdminController@dashboard',
        '/admin/exams/create' => 'AdminController@createExam',
        '/admin/questions/add' => 'AdminController@addQuestion',
        '/materials' => 'MaterialController@list',
    ],
    'POST' => [
        '/login' => 'AuthController@postLogin',
        '/register' => 'AuthController@postRegister',
        '/exam/submit' => 'ExamController@submitExam',
        '/admin/exams/create' => 'AdminController@postCreateExam',
        '/admin/questions/add' => 'AdminController@postAddQuestion',
        '/materials/upload' => 'MaterialController@upload',
    ]
];

$routeHandler = $routes[$method][$uri] ?? null;

if (!$routeHandler) {
    http_response_code(404);
    echo "404 Not Found";
    exit;
}

list($controllerName, $action) = explode('@', $routeHandler);
$controllerClass = "\\App\\Controllers\\{$controllerName}";
$controller = new $controllerClass();
call_user_func([$controller, $action]);

ob_end_flush(); // End buffer
