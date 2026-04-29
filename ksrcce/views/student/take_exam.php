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

/* Proctoring Overlay */
#proctoring-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(15, 23, 42, 0.98);
    backdrop-filter: blur(12px);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    padding: 2rem;
}
.proctoring-card {
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 32px;
    padding: 3rem;
    max-width: 600px;
    width: 100%;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}
.violation-flash {
    animation: flash-red 0.5s infinite alternate;
}
@keyframes flash-red {
    from { background-color: transparent; }
    to { background-color: rgba(239, 68, 68, 0.2); }
}
</style>

<!-- Proctoring Overlay -->
<div id="proctoring-overlay">
    <div class="proctoring-card">
        <div class="w-20 h-20 bg-indigo-500/20 rounded-3xl flex items-center justify-center mx-auto mb-8">
            <svg class="w-10 h-10 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>
        <h2 class="text-3xl font-black mb-4" style="font-family:'Outfit',sans-serif;">Proctoring Mode Active</h2>
        <p class="text-slate-400 font-medium mb-8 leading-relaxed">
            This exam is monitored. To ensure a fair assessment, the following rules apply:
            <br><span class="text-indigo-400 font-bold">• Full-screen mode is mandatory</span>
            <br><span class="text-indigo-400 font-bold">• Tab switching or exiting full-screen will auto-submit the exam</span>
        </p>
        <button id="start-proctoring" class="w-full py-4 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl font-black text-lg transition-all shadow-xl shadow-indigo-500/20 active:scale-95">
            Start Exam Now
        </button>
    </div>
</div>

<div class="p-4 pb-24 blur-sm" id="exam-content">
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
    const overlay = document.getElementById('proctoring-overlay');
    const startBtn = document.getElementById('start-proctoring');
    const examContent = document.getElementById('exam-content');
    
    const duration = <?= $examDuration * 60; ?>;
    let timeLeft = duration;
    let timer;
    let isExamStarted = false;

    // Proctoring Logic
    function enterFullscreen() {
        const elem = document.documentElement;
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
        }
    }

    function autoSubmit(reason) {
        if (!isExamStarted) return;
        
        // Disable proctoring listeners to avoid multiple submissions
        isExamStarted = false;
        clearInterval(timer);
        
        // Show violation message
        document.body.classList.add('violation-flash');
        overlay.style.display = 'flex';
        overlay.innerHTML = `
            <div class="proctoring-card border-red-500/50">
                <div class="w-20 h-20 bg-red-500/20 rounded-3xl flex items-center justify-center mx-auto mb-8">
                    <svg class="w-10 h-10 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-white mb-4" style="font-family:'Outfit',sans-serif;">Exam Terminated</h2>
                <p class="text-red-400 font-bold mb-8">${reason}</p>
                <p class="text-slate-400 mb-4">Auto-submitting your answers now...</p>
                <div class="w-full bg-slate-800 rounded-full h-2 overflow-hidden">
                    <div class="bg-red-500 h-full animate-[progress_2s_ease-in-out]" style="width: 100%"></div>
                </div>
            </div>
        `;

        setTimeout(() => {
            examForm.submit();
        }, 3000);
    }

    startBtn.addEventListener('click', function() {
        enterFullscreen();
        overlay.style.display = 'none';
        examContent.classList.remove('blur-sm');
        isExamStarted = true;
        startTimer();
    });

    // Detect Escape or Fullscreen Exit
    document.addEventListener('fullscreenchange', function() {
        if (!document.fullscreenElement && isExamStarted) {
            autoSubmit('Violation: Exited Full-screen Mode');
        }
    });

    // Detect Tab Switch / Window Blur
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'hidden' && isExamStarted) {
            autoSubmit('Violation: Tab Switch Detected');
        }
    });

    window.addEventListener('blur', function() {
        if (isExamStarted) {
            autoSubmit('Violation: Focus Lost (Tab switch or Window change)');
        }
    });

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
    
    function startTimer() {
        updateTimer();
        timer = setInterval(updateTimer, 1000);
    }
    
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
        if (timeLeft > 0 && isExamStarted) {
            e.preventDefault();
            e.returnValue = 'Unsaved changes! Are you sure you want to end the exam?';
            return e.returnValue;
        }
    });
    
    updateAnsweredCount();
});
</script>
