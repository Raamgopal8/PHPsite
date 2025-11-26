// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() use ($router) {
    // Existing routes...
    
    // Dashboard route
    Route::get('/dashboard', 'AdminController@dashboard');
    
    // MCQ Management Routes removed as per requirements
    // Exam Management Routes
    Route::get('/exams', 'ExamController@index');
    Route::get('/exams/manage', 'ExamController@manage');
    Route::get('/exams/manage/{id}', 'ExamController@manage');
    Route::post('/exams/save', 'ExamController@save');
    Route::post('/exams/parse-questions', 'ExamController@parseQuestions');

    // Syllabus Management Routes
    Route::get('/admin/exams/{id}/syllabus', 'SyllabusController@uploadForm');
    Route::post('/admin/syllabus/upload', 'SyllabusController@upload');
    Route::get('/admin/syllabus/view/{id}', 'SyllabusController@viewSyllabus');
    Route::get('/student/exams/{id}/syllabus', 'SyllabusController@studentView');
     
    // Question management routes
    $router->post('/api/questions/upload-text', 'QuestionController@handleTextFileUpload');
    $router->post('/api/questions/save-parsed', 'QuestionController@saveParsedQuestions');
    $router->get('/api/exams', 'QuestionController@getExams');
    
    // Legacy routes (keep for backward compatibility, can be removed later)
    Route::get('/questions', 'QuestionController@index');
    Route::get('/questions/add', 'QuestionController@showAddForm');
    Route::post('/questions/add', 'QuestionController@addQuestion');
    
    // Existing API routes
    Route::get('/api/scores/stream', 'AdminController@streamScores');
});

// In your AdminController.php
public function streamScores() {
    // Set headers for SSE
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('Connection: keep-alive');
    
    // Function to send SSE
    function sendSSE($data) {
        echo "data: " . json_encode($data) . "\n\n";
        ob_flush();
        flush();
    }
    
    // Initial connection message
    sendSSE(['type' => 'connected', 'message' => 'Connected to score updates']);
    
    // Keep the connection open
    while (true) {
        // Check for new scores (you'll need to implement this logic)
        // This is a simplified example - you might want to use database polling or an event system
        
        // Example: Send a ping every 30 seconds to keep the connection alive
        sendSSE(['type' => 'ping', 'time' => now()]);
        
        // Wait before sending the next update
        sleep(30);
    }
}