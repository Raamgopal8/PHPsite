<?php

// ✅ absolutely NO whitespace before this line
ob_start();  // Start buffering before ANY output

// Production security: Disable direct error display
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Set timezone to IST
date_default_timezone_set('Asia/Kolkata');

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
        '/student/gate/ae' => 'ExamController@showAEPage',
        '/student/gate/aids' => 'ExamController@showAIDSPage',
        '/student/gate/bme' => 'ExamController@showBMEPage',
        '/student/gate/csd' => 'ExamController@showCSDPage',
        '/student/gate/cs' => 'ExamController@showCSPage',
        '/student/gate/iot' => 'ExamController@showIOTPage',
        '/student/gate/it' => 'ExamController@showITPage',
        '/student/gate/sfe' => 'ExamController@showSFEPage',
        '/student/gate/mba' => 'ExamController@showMBAPage',
        '/student/gate/mca' => 'ExamController@showMCAPage',
        '/student/tnpsc' => 'ExamController@showTnspcpage',
        '/student/banking' => 'ExamController@showBankingPage',
        '/student/upsc' => 'ExamController@showUPSCPage',
        
        // Banking Sub-routes
        '/student/banking/ibps-po' => 'ExamController@showBankingIBPSPO',
        '/student/banking/ibps-clerk' => 'ExamController@showBankingIBPSClerk',
        '/student/banking/sbi-po' => 'ExamController@showBankingSBIPO',
        '/student/banking/sbi-clerk' => 'ExamController@showBankingSBIClerk',
        '/student/banking/rrb' => 'ExamController@showBankingRRB',
        '/student/banking/rbi' => 'ExamController@showBankingRBI',

        // UPSC Sub-routes
        '/student/upsc/cse' => 'ExamController@showUPSCCSE',
        '/student/upsc/ifos' => 'ExamController@showUPSCIFoS',
        '/student/upsc/ese' => 'ExamController@showUPSCESE',
        '/student/upsc/capf' => 'ExamController@showUPSCCAPF',
        '/student/upsc/cds' => 'ExamController@showUPSCCDS',
        '/student/upsc/nda' => 'ExamController@showUPSCNDA',
        '/student/upsc/cms' => 'ExamController@showUPSCCMS',
        '/student/upsc/geoscientist' => 'ExamController@showUPSCGeoscientist',

        '/student/tnpsc/group1' => 'ExamController@showGroup1page',
        '/student/tnpsc/group2' => 'ExamController@showGroup2page',
        '/student/tnpsc/group4' => 'ExamController@showGroup4page',
        '/student/take' => 'ExamController@takeExam',
        '/admin/dashboard' => 'AdminController@dashboard',
        '/admin/available' => 'AdminController@available',
        '/admin/exams' => 'ExamController@index',
        '/admin/exams/create' => 'AdminController@createExam',
        '/admin/exams/edit' => 'ExamController@edit',
        '/admin/exams/edit/{id}' => 'ExamController@edit',
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
        '/admin/exam-countdowns' => 'ExamCountdownController@index',
        '/admin/achievements' => 'AchievementController@index',
        '/admin/category/{domain}' => 'AdminController@categoryDashboard',
        '/admin/add-question' => 'QuestionController@showAddQuestionForm',
        // API endpoints
        '/api/exam-countdowns' => 'ExamCountdownController@getCountdowns',
        '/api/achievements' => 'AchievementController@getAchievements',
        '/api/achievements/{id}' => 'AchievementController@getAchievementById',
        '/admin/api/recent-logins' => 'AdminController@getRecentLogins',
        '/api/admin/results' => 'ResultController@adminResults',
        '/admin/dashboard' => 'AdminController@dashboard',
        '/achievers/gallery' => 'AchievementController@publicGallery',
        '/events/gallery' => 'EventController@publicGallery',
        '/admin/events' => 'EventController@index',
        '/api/events' => 'EventController@getEvents',
        '/api/events/{id}' => 'EventController@getEventById',
        '/admin/logins/print' => 'AdminController@printLogins',
        '/admin/scores/print' => 'AdminController@printScores',
        '/api/updates' => 'ResultController@updates',
        '/api/official-links' => 'OfficialLinkController@getLinks',
        '/admin/official-links/delete/{id}' => 'OfficialLinkController@destroy',
        '/admin/quick-links/all' => 'QuickLinkController@getAll',
    '/api/heartbeat' => 'AuthController@heartbeat', // Heartbeat route

        // Static Pages
        '/privacy-policy' => 'PageController@privacy',
        '/terms-of-service' => 'PageController@terms',

        // Forgot Password
        '/forgot-password' => 'ResetPasswordController@showForgotForm',
        '/reset-password' => 'ResetPasswordController@showResetForm',
    ],
    'POST' => [
        '/login' => 'AuthController@postLogin',
        '/register' => 'AuthController@postRegister',
        '/exam/submit' => 'ExamController@submitExam',
        '/admin/exams/create' => 'AdminController@postCreateExam',
        '/admin/exams/update' => 'ExamController@update',
        '/admin/exams/update/{id}' => 'ExamController@update',
        '/admin/questions/add' => 'AdminController@postAddQuestion',
        '/admin/syllabus/upload' => 'SyllabusController@upload',
        '/admin/syllabi' => 'SyllabusManagementController@store',
        '/admin/materials' => 'MaterialManagementController@store',
        '/materials/upload' => 'MaterialController@upload',
        // API endpoints
        '/api/questions/parse' => 'QuestionController@parseQuestions',
        '/api/questions/save-parsed' => 'QuestionController@saveParsedQuestions',
        '/api/exams' => 'QuestionController@getExams',
        // Exam Countdown API
        '/api/exam-countdowns/create' => 'ExamCountdownController@create',
        '/api/exam-countdowns/update' => 'ExamCountdownController@update',
        '/api/exam-countdowns/delete' => 'ExamCountdownController@delete',
        '/api/exam-countdowns/toggle' => 'ExamCountdownController@toggle',
        // Achievement API
        '/admin/achievements/create' => 'AchievementController@create',
        '/admin/achievements/update' => 'AchievementController@update',
        '/api/achievements/delete' => 'AchievementController@delete',
        '/api/achievements/toggle' => 'AchievementController@toggleStatus',
        '/api/achievements/featured' => 'AchievementController@toggleFeatured',
        '/admin/events/create' => 'EventController@create',
        '/admin/events/update' => 'EventController@update',
        '/api/events/delete' => 'EventController@delete',
        '/api/events/toggle' => 'EventController@toggleStatus',
        '/api/events/featured' => 'EventController@toggleFeatured',
        '/api/exam-countdowns/sync' => 'ExamCountdownController@syncCountdowns',
        // Question API
        '/api/questions/create' => 'QuestionController@createQuestion',
        '/admin/official-links/store' => 'OfficialLinkController@store',
        '/admin/quick-links/store' => 'QuickLinkController@store',
        '/admin/quick-links/update/{id}' => 'QuickLinkController@update',
        '/admin/quick-links/delete/{id}' => 'QuickLinkController@delete',
        '/admin/quick-links/toggle/{id}' => 'QuickLinkController@toggleStatus',
        '/admin/quick-links/reorder' => 'QuickLinkController@reorder',
        
        // Forgot Password
        '/forgot-password' => 'ResetPasswordController@sendResetLink',
        '/reset-password' => 'ResetPasswordController@resetPassword',
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
