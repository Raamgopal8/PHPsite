<?php

// ✅ absolutely NO whitespace before this line
ob_start();  // Start buffering before ANY output

// Load environment variables first
require __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Configure session settings before starting the session
ini_set('session.gc_maxlifetime', 3600);

// If env var not set, default path:
$savePath = $_ENV['SESSION_PATH'] ?? __DIR__ . '/../storage/sessions';
if (!is_dir($savePath)) {
    mkdir($savePath, 0777, true);
}
session_save_path($savePath);

// Start the session after configuration
session_start();

use App\Core\App;

// Create the App only after session initialized
$app = new App();

// Get the current URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = urldecode($uri);

// Get the request method (GET, POST, etc.)
$method = strtoupper($_SERVER['REQUEST_METHOD']);

// Only attempt database connection if we're not on a static asset
if (!preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ico)$/', $uri)) {
    try {
        // Test database connection
        $db = $app->db;
        $stmt = $db->query("SELECT VERSION()");
        $version = $stmt->fetchColumn();
        error_log("Successfully connected to MySQL server. Version: $version");
    } catch (\PDOException $e) {
        error_log("Database connection error: " . $e->getMessage());
        error_log("Connection details - Host: " . ($_ENV['DB_HOST'] ?? 'not set') . 
                 ", Port: " . ($_ENV['DB_PORT'] ?? 'not set') .
                 ", Database: " . ($_ENV['DB_DATABASE'] ?? 'not set') .
                 ", Username: " . ($_ENV['DB_USERNAME'] ?? 'not set'));
        die("Unable to connect to the database. Please check your configuration.");
    }
}

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
        '/student/gate' =>'ExamController@showGatepage',
        '/student/gate/cse' => 'ExamController@showCSEPage',
        '/student/gate/mech' => 'ExamController@showMECHPage',
        '/student/gate/ee' => 'ExamController@showEEPage',
        '/student/gate/civil' => 'ExamController@showCIVILPage',
        '/student/gate/ece' => 'ExamController@showECEPage',
        '/student/tnpsc' => 'ExamController@showTnspcpage',
        '/student/tnpsc/group1' => 'ExamController@showGroup1page',
        '/student/tnpsc/group2' => 'ExamController@showGroup2page',
        '/student/tnpsc/group4' => 'ExamController@showGroup4page',
        '/student/take' => 'ExamController@takeExam',
        '/admin/dashboard' => 'AdminController@dashboard',
        '/admin/exams' => 'ExamController@index',
        '/admin/exams/create' => 'AdminController@createExam',
        '/admin/exams/create' => 'AdminController@createExam',
        '/admin/exams/edit' => 'ExamController@edit',
        '/admin/exams/delete' => 'ExamController@delete',
        '/admin/questions/add' => 'AdminController@addQuestion',
        '/admin/exams/{id}/syllabus' => 'SyllabusController@uploadForm',
        '/admin/syllabus/view/{id}' => 'SyllabusController@viewSyllabus',
        '/student/exams/{id}/syllabus' => 'SyllabusController@studentView',
        '/admin/syllabi' => 'SyllabusManagementController@index',
        '/admin/syllabi/create' => 'SyllabusManagementController@create',
        '/admin/syllabi/{id}' => 'SyllabusManagementController@show',
        '/admin/syllabi/{id}/delete' => 'SyllabusManagementController@delete',
        '/admin/materials' => 'MaterialManagementController@index',
        '/admin/materials/create' => 'MaterialManagementController@create',
        '/admin/materials/{id}' => 'MaterialManagementController@show',
        '/admin/materials/{id}/delete' => 'MaterialManagementController@delete',
        '/materials' => 'MaterialController@list',
    ],
    'POST' => [
        '/login' => 'AuthController@postLogin',
        '/register' => 'AuthController@postRegister',
        '/exam/submit' => 'ExamController@submitExam',
        '/exam/submit' => 'ExamController@submitExam',
        '/admin/exams/create' => 'AdminController@postCreateExam',
        '/admin/exams/update' => 'ExamController@update',
        '/admin/questions/add' => 'AdminController@postAddQuestion',
        '/admin/syllabus/upload' => 'SyllabusController@upload',
        '/admin/syllabi' => 'SyllabusManagementController@store',
        '/admin/materials' => 'MaterialManagementController@store',
        '/materials/upload' => 'MaterialController@upload',
        // API endpoints
        '/api/questions/parse' => 'QuestionController@parseQuestions',
        '/admin/api/recent-logins' => 'AdminController@getRecentLogins',
        '/api/questions/save-parsed' => 'QuestionController@saveParsedQuestions',
        '/api/exams' => 'QuestionController@getExams'
    ]
];

// Find the route handler
$routeHandler = null;

// Check if the requested URI exists in the routes for the current method
if (isset($routes[$method][$uri])) {
    $routeHandler = $routes[$method][$uri];
} else {
    // Try to match dynamic routes (with parameters)
    foreach ($routes[$method] as $route => $handler) {
        // Convert route to regex pattern
        $pattern = '#^' . preg_replace('/\{([^\}]+)\}/', '(?P<$1>[^/]+)', $route) . '$#';
        
        if (preg_match($pattern, $uri, $matches)) {
            $routeHandler = $handler;
            // Add URL parameters to $_GET
            foreach ($matches as $key => $value) {
                if (!is_numeric($key)) {
                    $_GET[$key] = $value;
                }
            }
            break;
        }
    }
}

if (!$routeHandler) {
    http_response_code(404);
    echo "404 Not Found - The requested URL was not found on this server.";
    exit;
}

list($controllerName, $action) = explode('@', $routeHandler);
$controllerClass = "\\App\\Controllers\\{$controllerName}";
$controller = new $controllerClass();
call_user_func([$controller, $action]);

ob_end_flush(); // End buffer
