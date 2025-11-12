// In your routes file (e.g., routes/web.php)
Route::get('/admin/api/scores/stream', 'AdminController@streamScores');

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