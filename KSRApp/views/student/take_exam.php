<?php $path = 'student/take_exam.php'; 
// Set exam duration in minutes (default to 30 minutes if not specified)
$examDuration = isset($exam['duration']) ? (int)$exam['duration'] : 30;
?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 pt-6">
    <div class="max-w-4xl mx-auto">
        <!-- Exam Header with Timer -->
        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($exam['title'] ?? 'Exam') ?></h1>
                    <p class="text-gray-600">Answer all questions before time runs out</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-red-50 text-red-700 px-4 py-2 rounded-lg border border-red-100 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span id="timer" class="font-mono text-lg font-bold"><?= sprintf('%02d:00', $examDuration) ?></span>
                    </div>
                    <span id="question-counter" class="text-sm text-gray-600">
                        <?= count($questions) ?> Questions
                    </span>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="mt-4 w-full bg-gray-200 rounded-full h-2.5">
                <div id="progress-bar" class="bg-blue-600 h-2.5 rounded-full transition-all duration-300 ease-out" style="width: 100%"></div>
            </div>
        </div>

        <!-- Exam Form -->
        <form id="examForm" action="/exam/submit" method="post" class="space-y-6">
            <input type="hidden" name="exam_id" value="<?= htmlspecialchars($exam['id']) ?>">
            
            <?php foreach($questions as $i => $q): ?>
                <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-medium">
                            <?= $i + 1 ?>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-medium text-gray-900 mb-4"><?= htmlspecialchars($q['text'] ?? $q['question_text'] ?? '') ?></h3>
                            <div class="space-y-3">
                                <?php foreach((is_array($q['options']) ? $q['options'] : []) as $k => $opt): ?>
                                    <label class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-blue-50 cursor-pointer transition-colors duration-200">
                                        <input type="radio" name="answers[<?= htmlspecialchars($q['id']) ?>]" value="<?= $k ?>" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <span class="ml-3 text-gray-700"><?= htmlspecialchars($opt) ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm mt-6">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <div class="text-sm text-gray-600">
                        <span id="answered-count">0</span> of <?= count($questions) ?> questions answered
                    </div>
                    <div class="flex space-x-3">
                        <button type="button" id="clear-all" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Clear All
                        </button>
                        <button type="submit" class="px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            Submit Exam
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Timer and Auto-Submit Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const timerDisplay = document.getElementById('timer');
    const progressBar = document.getElementById('progress-bar');
    const examForm = document.getElementById('examForm');
    const answeredCount = document.getElementById('answered-count');
    const clearBtn = document.getElementById('clear-all');
    
    // Set exam duration in minutes (from PHP)
    const duration = <?= $examDuration * 60; ?>; // Convert to seconds
    let timeLeft = duration;
    let timer;
    
    // Update answered questions counter
    function updateAnsweredCount() {
        const answered = document.querySelectorAll('input[type="radio"]:checked').length;
        answeredCount.textContent = answered;
    }
    
    // Format time as MM:SS
    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }
    
    // Update timer display and progress bar
    function updateTimer() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        
        // Update display
        timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        // Update progress bar
        const progress = (timeLeft / duration) * 100;
        progressBar.style.width = `${progress}%`;
        
        // Change color when time is running low
        if (timeLeft <= 300) { // 5 minutes or less
            progressBar.classList.remove('bg-blue-600');
            progressBar.classList.add('bg-red-600');
            
            // Add animation when 1 minute or less
            if (timeLeft <= 60) {
                progressBar.classList.add('animate-pulse');
            }
        }
        
        if (timeLeft <= 0) {
            clearInterval(timer);
            // Auto-submit the form when time is up
            examForm.submit();
        } else {
            timeLeft--;
        }
    }
    
    // Start the timer
    updateTimer(); // Initial call
    timer = setInterval(updateTimer, 1000);
    
    // Update answered count when radio buttons change
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', updateAnsweredCount);
    });
    
    // Clear all selections
    clearBtn.addEventListener('click', function() {
        if (confirm('Are you sure you want to clear all your answers?')) {
            document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
                radio.checked = false;
            });
            updateAnsweredCount();
        }
    });
    
    // Warn before leaving the page
    window.addEventListener('beforeunload', function(e) {
        if (timeLeft > 0) {
            e.preventDefault();
            e.returnValue = 'You have an ongoing exam. Are you sure you want to leave?';
            return e.returnValue;
        }
    });
    
    // Initial count of answered questions
    updateAnsweredCount();
});
</script>
