<?php $path = 'student/take_exam.php'; 
// Set exam duration in minutes (default to 30 minutes if not specified)
$examDuration = isset($exam['duration']) ? (int)$exam['duration'] : 30;
?>

<style>
/* ── Take Exam Light UI ── */

.exam-header-card {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 24px;
    padding: 2rem;
    box-shadow: var(--shadow-md);
    position: sticky;
    top: 5.5rem; /* Adjusted for navbar */
    z-index: 40;
    margin-bottom: 2rem;
}
.question-card {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 2rem;
    transition: all 0.3s ease;
}
.question-card:hover { border-color: #c7d2fe; }
.option-label {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 12px;
    border: 1.5px solid #f1f5f9;
    background: #f8fafc;
    cursor: pointer;
    transition: all 0.2s ease;
}
.option-label:hover {
    background: #eff6ff;
    border-color: #3b82f6;
}
.option-label input:checked + span {
    color: #1d4ed8;
    font-weight: 700;
}
.option-label input:checked {
    border-color: #3b82f6;
    background-color: #3b82f6;
}
.timer-badge {
    background: #fee2e2;
    color: #dc2626;
    border: 1px solid #fecaca;
    padding: 8px 16px;
    border-radius: 12px;
    font-family: 'Outfit', sans-serif;
    font-weight: 900;
}
.progress-container {
    height: 8px;
    background: #f1f5f9;
    border-radius: 99px;
    overflow: hidden;
}
.progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #6366f1, #8b5cf6);
    transition: width 0.3s ease-out;
}
</style>

<div class="p-4 pb-24">
    <div class="max-w-4xl mx-auto pt-4">
        
        <!-- Exam Header with Timer -->
        <div class="exam-header-card">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-2xl font-black text-slate-900" style="font-family:'Outfit',sans-serif;"><?= htmlspecialchars($exam['title'] ?? 'Competitive Mock Exam') ?></h1>
                    <p class="text-sm text-slate-500 font-medium mt-1">Status: <span class="text-indigo-600 font-bold">In Progress</span></p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="timer-badge flex items-center gap-2">
                        <svg class="w-5 h-5 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span id="timer" class="text-lg"><?= sprintf('%02d:00', $examDuration) ?></span>
                    </div>
                </div>
            </div>
            
            <div class="mt-8">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Time Remaining Progress</span>
                    <span id="question-counter" class="text-[10px] font-black uppercase tracking-widest text-indigo-600">
                        <?= count($questions) ?> Questions Total
                    </span>
                </div>
                <div class="progress-container">
                    <div id="progress-bar" class="progress-bar-fill" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <!-- Exam Form -->
        <form id="examForm" action="/exam/submit" method="post" class="space-y-6">
            <input type="hidden" name="exam_id" value="<?= htmlspecialchars($exam['id']) ?>">
            
            <?php foreach($questions as $i => $q): ?>
                <div class="question-card" id="q-<?= $q['id'] ?>">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center font-black" style="font-family:'Outfit',sans-serif;">
                            <?= $i + 1 ?>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-slate-800 mb-6 leading-relaxed"><?= htmlspecialchars($q['question_text'] ?? '') ?></h3>
                            
                            <?php if (!empty($q['question_image'])): ?>
                                <div class="mb-6 p-2 bg-slate-50 border border-slate-100 rounded-2xl overflow-hidden">
                                    <img src="<?= htmlspecialchars($q['question_image']) ?>" alt="Question Visual" class="w-full h-auto rounded-xl">
                                </div>
                            <?php endif; ?>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <?php foreach((is_array($q['options']) ? $q['options'] : []) as $k => $opt): ?>
                                    <label class="option-label group">
                                        <input type="radio" name="answers[<?= htmlspecialchars($q['id']) ?>]" value="<?= $k ?>" 
                                               class="w-5 h-5 text-indigo-600 border-slate-300 focus:ring-indigo-500 mr-3">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors"><?= htmlspecialchars($opt) ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <!-- Bottom Action Bar -->
            <div class="bg-white/80 backdrop-blur-xl border border-slate-200 rounded-3xl p-8 shadow-2xl sticky bottom-4 z-40">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-black text-xl" style="font-family:'Outfit',sans-serif;">
                            <span id="answered-count">0</span>
                        </div>
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-slate-400">Questions Answered</p>
                            <p class="text-sm font-bold text-slate-700">Out of <?= count($questions) ?> total</p>
                        </div>
                    </div>
                    <div class="flex gap-4 w-full sm:w-auto">
                        <button type="button" id="clear-all" 
                                class="flex-1 sm:flex-none px-6 py-3 rounded-2xl border border-slate-200 text-sm font-bold text-slate-600 hover:bg-slate-50 active:scale-95 transition-all">
                            Clear Choices
                        </button>
                        <button type="submit" 
                                class="flex-1 sm:flex-none px-10 py-3 rounded-2xl bg-slate-900 text-white text-sm font-black shadow-xl hover:bg-indigo-600 active:scale-95 transition-all">
                            Submit Examination
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const timerDisplay = document.getElementById('timer');
    const progressBar = document.getElementById('progress-bar');
    const examForm = document.getElementById('examForm');
    const answeredCount = document.getElementById('answered-count');
    const clearBtn = document.getElementById('clear-all');
    
    const duration = <?= $examDuration * 60; ?>;
    let timeLeft = duration;
    let timer;
    
    function updateAnsweredCount() {
        const answered = document.querySelectorAll('input[type="radio"]:checked').length;
        answeredCount.textContent = answered;
    }
    
    function updateTimer() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        
        timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        const progress = (timeLeft / duration) * 100;
        progressBar.style.width = `${progress}%`;
        
        if (timeLeft <= 300) {
            document.querySelector('.timer-badge').classList.add('bg-rose-50', 'text-rose-600', 'border-rose-100');
            progressBar.style.background = 'linear-gradient(90deg, #f43f5e, #e11d48)';
        }
        
        if (timeLeft <= 0) {
            clearInterval(timer);
            examForm.submit();
        } else {
            timeLeft--;
        }
    }
    
    updateTimer();
    timer = setInterval(updateTimer, 1000);
    
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', updateAnsweredCount);
    });
    
    clearBtn.addEventListener('click', function() {
        if (confirm('Clear all your answers? This cannot be undone.')) {
            document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
                radio.checked = false;
            });
            updateAnsweredCount();
        }
    });
    
    window.addEventListener('beforeunload', function(e) {
        if (timeLeft > 0) {
            e.preventDefault();
            e.returnValue = 'Unsaved changes! Are you sure you want to end the exam?';
            return e.returnValue;
        }
    });
    
    updateAnsweredCount();
});
</script>
