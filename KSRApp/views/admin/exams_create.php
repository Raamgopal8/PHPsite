<?php $path = 'admin/exams_create.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 md:p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900"><?= isset($exam) ? 'Edit Exam' : 'Create New Exam' ?></h1>
                    <p class="mt-1 text-gray-600">Set up your exam and add questions in one place</p>
                </div>
                <a href="/admin/dashboard" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>
            
            <?php if(!empty($_SESSION['flash']['success'])): ?>
                <div class="mt-4 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200 flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <div><?= htmlspecialchars($_SESSION['flash']['success']); unset($_SESSION['flash']['success']); ?></div>
                </div>
            <?php endif; ?>
            
            <?php if(!empty($_SESSION['flash']['error'])): ?>
                <div class="mt-4 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200 flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <div><?= htmlspecialchars($_SESSION['flash']['error']); unset($_SESSION['flash']['error']); ?></div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Form Container -->
        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">
            <form action="<?= isset($exam) ? '/admin/exams/update/' . htmlspecialchars($exam['id']) : '/admin/exams/create' ?>" method="post" enctype="multipart/form-data" class="space-y-6">
                <!-- Exam Details Section -->
                <div class="space-y-6 p-4 bg-gray-50 rounded-lg">
                    <h2 class="text-lg font-medium text-gray-900">Exam Details</h2>
                    
                    <!-- Exam Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Exam Title <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <input type="text" id="title" name="title" required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="Enter exam title"
                                value="<?= htmlspecialchars($exam['title'] ?? '') ?>">
                        </div>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <input type="text" id="category" name="category" required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="e.g., Mathematics, Science, History"
                                value="<?= htmlspecialchars($exam['category'] ?? '') ?>">
                        </div>
                    </div>

                    <!-- Duration and Passing Score -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">
                                Duration (minutes) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="number" id="duration" name="duration" min="1" required
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    value="<?= htmlspecialchars($exam['duration'] ?? '60') ?>">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Enter the duration in minutes (e.g., 60 for 1 hour)</p>
                        </div>
                        
                        <div>
                            <label for="passing_score" class="block text-sm font-medium text-gray-700 mb-1">
                                Passing Score (%)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <input type="number" id="passing_score" name="passing_score" min="1" max="100"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    placeholder="e.g., 70"
                                    value="<?= htmlspecialchars($exam['passing_score'] ?? '70') ?>">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Minimum percentage required to pass (1-100)</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description (Optional)
                        </label>
                        <div class="relative">
                            <textarea id="description" name="description" rows="3"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="Enter a brief description of the exam"><?= htmlspecialchars($exam['description'] ?? '') ?></textarea>
                            <div class="mt-1 text-xs text-gray-500 flex justify-between">
                                <span>Max 500 characters</span>
                                <span id="description-count">0/500</span>
                            </div>
                        </div>
                    </div>

                    <!-- Instructions -->
                    <div>
                        <label for="instructions" class="block text-sm font-medium text-gray-700 mb-1">
                            Instructions (Optional)
                        </label>
                        <div class="relative">
                            <textarea id="instructions" name="instructions" rows="3"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="Enter any special instructions for the exam"><?= htmlspecialchars($exam['instructions'] ?? '') ?></textarea>
                            <div class="mt-1 text-xs text-gray-500 flex justify-between">
                                <span>Max 1000 characters</span>
                                <span id="instructions-count">0/1000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Questions Section -->
                <div class="mt-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-medium text-gray-900">Questions</h2>
                        <div class="space-x-2">
                            <div class="relative inline-block text-left" id="add-question-container">
                                <button type="button" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150" 
                                    id="add-question-menu" 
                                    aria-expanded="false" 
                                    aria-haspopup="true"
                                    onclick="toggleQuestionMenu()">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Add Question
                                    <svg class="-mr-1 ml-2 h-5 w-5 transition-transform duration-200 transform" id="dropdown-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10 transition-all duration-200 transform opacity-0 scale-95" 
                                    id="question-dropdown" 
                                    role="menu" 
                                    aria-orientation="vertical" 
                                    aria-labelledby="add-question-menu">
                                    <div class="py-1" role="none">
                                        <button type="button" 
                                            onclick="addQuestion()" 
                                            class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-blue-50 transition-colors duration-150" 
                                            role="menuitem">
                                            <svg class="inline-block h-5 w-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                            </svg>
                                            Add Single Question
                                        </button>
                                        <label for="question-file" class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-blue-50 transition-colors duration-150 cursor-pointer" role="menuitem">
                                            <svg class="inline-block h-5 w-5 mr-2 text-blue-500" xmlns="http://www.w3".org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            Import from File
                                            <input id="question-file" type="file" accept=".txt" class="sr-only" onchange="handleFileUpload(this)">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="questions-container" class="space-y-4">
                        <!-- Questions will be added here dynamically -->
                        <?php if (!empty($exam['questions'])): ?>
                            <?php foreach ($exam['questions'] as $index => $question): ?>
                                <div class="question-card bg-white p-4 rounded-lg border border-gray-200">
                                    <div class="flex justify-between items-center mb-3">
                                        <h3 class="text-md font-medium">Question #<span class="question-number"><?= $index + 1 ?></span></h3>
                                        <button type="button" onclick="removeQuestion(this)" class="text-red-600 hover:text-red-800 text-sm">
                                            Remove
                                        </button>
                                    </div>
                                    <input type="hidden" name="questions[<?= $index ?>][id]" value="<?= $question['id'] ?? '' ?>">
                                    <div class="mb-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Question Text</label>
                                        <input type="text" name="questions[<?= $index ?>][text]" required
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                            value="<?= htmlspecialchars($question['text'] ?? '') ?>">
                                    </div>
                                    <div class="space-y-2">
                                        <?php for ($i = 0; $i < 4; $i++): ?>
                                            <div class="flex items-center">
                                                <input type="radio" name="questions[<?= $index ?>][correct_answer]" 
                                                       value="<?= $i ?>" 
                                                       <?= (isset($question['correct_answer']) && $question['correct_answer'] == $i) ? 'checked' : '' ?>
                                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                                <input type="text" name="questions[<?= $index ?>][options][]" required
                                                       class="ml-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                       placeholder="Option <?= chr(65 + $i) ?>"
                                                       value="<?= htmlspecialchars($question['options'][$i] ?? '') ?>">
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="mt-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Explanation (Optional)</label>
                                        <textarea name="questions[<?= $index ?>][explanation]"
                                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                  rows="2"><?= htmlspecialchars($question['explanation'] ?? '') ?></textarea>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="pt-6 mt-8 border-t border-gray-200">
                    <div class="flex justify-end space-x-3">
                        <a href="/admin/dashboard" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Save Exam
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Add Question Menu Styles */
#add-question-container {
    position: relative;
    z-index: 10;
}

#question-dropdown {
    transform-origin: top right;
    will-change: transform, opacity;
}

#question-dropdown.show {
    display: block;
    opacity: 1;
    transform: scale(1);
}

#question-dropdown.hide {
    display: block;
    opacity: 0;
    transform: scale(0.95);
}

#dropdown-arrow.rotate-180 {
    transform: rotate(180deg);
}

/* Alert styles */
.alert {
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
}

.alert-success {
    color: #0f5132;
    background-color: #d1e7dd;
    border-color: #badbcc;
}

.alert-warning {
    color: #664d03;
    background-color: #fff3cd;
    border-color: #ffecb5;
}

.alert-danger {
    color: #842029;
    background-color: #f8d7da;
    border-color: #f5c2c7;
}

.btn-close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
    background: transparent;
    border: 0;
    padding: 0;
    cursor: pointer;
}

.btn-close:hover {
    color: #000;
    text-decoration: none;
    opacity: .75;
}
</style>

<script>
// Ensure all functions are in the global scope
window.parsedQuestions = [];

// Toggle question dropdown menu
window.toggleQuestionMenu = function() {
    const dropdown = document.getElementById('question-dropdown');
    const arrow = document.getElementById('dropdown-arrow');
    
    if (dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
        dropdown.classList.add('hide');
        arrow.classList.remove('rotate-180');
        
        // Remove the hide class after the transition ends
        setTimeout(() => {
            if (dropdown.classList.contains('hide')) {
                dropdown.classList.add('hidden');
                dropdown.classList.remove('hide');
            }
        }, 200);
    } else {
        dropdown.classList.remove('hidden', 'hide');
        dropdown.classList.add('show');
        arrow.classList.add('rotate-180');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('question-dropdown');
    const button = document.getElementById('add-question-menu');
    const container = document.getElementById('add-question-container');
    
    if (!container.contains(event.target) && !dropdown.classList.contains('hidden')) {
        toggleQuestionMenu();
    }
});

// Handle file upload
window.handleFileUpload = function(input) {
    const file = input.files[0];
    const reader = new FileReader();
    reader.onload = function(e) {
        const content = e.target.result;
        parseQuestions(content);
    };
    reader.readAsText(file);
}

// Parse questions from text content
window.parseQuestions = function(content) {
    const questions = content.split('\n\n');
    const parsedQuestions = [];
    
    questions.forEach(question => {
        const lines = question.split('\n');
        const text = lines[0];
        const options = lines.slice(1, 5);
        const correctAnswer = lines[5].trim().replace(/^Answer: /, '');
        const explanation = lines.slice(6).join('\n');
        
        parsedQuestions.push({
            text,
            options,
            correctAnswer: parseInt(correctAnswer) - 1,
            explanation,
        });
    });
    
    parsedQuestions.forEach(question => {
        addQuestionFromText(question.text, question.options, question.correctAnswer);
    });
}

// Add a new question with the given text and options
window.addQuestionFromText = function(text = '', options = [], correctAnswer = 0) {
    const container = document.getElementById('questions-container');
    const questionIndex = document.querySelectorAll('.question-card').length;
    
    const questionHtml = `
        <div class="question-card bg-white p-4 rounded-lg border border-gray-200 mt-4">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-md font-medium">Question #<span class="question-number">${questionIndex + 1}</span></h3>
                <button type="button" onclick="removeQuestion(this)" class="text-red-600 hover:text-red-800 text-sm">
                    Remove
                </button>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Question Text</label>
                <input type="text" name="questions[${questionIndex}][text]" required
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                       value="${text}">
            </div>
            <div class="space-y-2">
                ${Array.from({length: 4}, (_, i) => `
                    <div class="flex items-center">
                        <input type="radio" name="questions[${questionIndex}][correct_answer]" 
                               value="${i}" ${i === correctAnswer ? 'checked' : ''}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <input type="text" name="questions[${questionIndex}][options][]" required
                               class="ml-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                               placeholder="Option ${String.fromCharCode(65 + i)}"
                               value="${options[i] || ''}">
                    </div>
                `).join('')}
            </div>
            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Explanation (Optional)</label>
                <textarea name="questions[${questionIndex}][explanation]"
                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                          rows="2"></textarea>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', questionHtml);
    updateQuestionNumbers();
}

// Show preview modal with parsed questions
window.showPreviewModal = function(questions) {
    // TO DO: implement preview modal
}

// Update question numbers when questions are added or removed
window.updateQuestionNumbers = function() {
    document.querySelectorAll('.question-card').forEach((card, index) => {
        const numberSpan = card.querySelector('.question-number');
        if (numberSpan) {
            numberSpan.textContent = index + 1;
        }
        
        // Update the name attributes of the inputs
        const inputs = card.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                input.setAttribute('name', name.replace(/questions\[\d+\]/, `questions[${index}]`));
            }
        });
    });
}

// Remove a question
window.removeQuestion = function(button) {
    const container = document.getElementById('questions-container');
    const questionCards = container.querySelectorAll('.question-card');
    
    if (questionCards.length <= 1) {
        showError('An exam must have at least one question');
        return;
    }
    
    if (confirm('Are you sure you want to remove this question?')) {
        button.closest('.question-card').remove();
        updateQuestionNumbers();
    }
}

// Add a new empty question
window.addQuestion = function() {
    addQuestionFromText();
}

// Show success message
window.showSuccess = function(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'bg-green-50 border-l-4 border-green-400 p-4 mb-4';
    alertDiv.innerHTML = `
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">${message}</p>
            </div>
        </div>
    `;
    
    const container = document.querySelector('.container.mx-auto.px-4.py-8');
    if (container) {
        container.insertBefore(alertDiv, container.firstChild);
        setTimeout(() => alertDiv.remove(), 5000);
    }
}

// Show error message
window.showError = function(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'bg-red-50 border-l-4 border-red-400 p-4 mb-4';
    alertDiv.innerHTML = `
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700">${message}</p>
            </div>
        </div>
    `;
    
    const container = document.querySelector('.container.mx-auto.px-4.py-8');
    if (container) {
        container.insertBefore(alertDiv, container.firstChild);
        setTimeout(() => alertDiv.remove(), 5000);
    }
}

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('upload-dropdown');
        const uploadMenu = document.getElementById('upload-menu');
        
        if (dropdown && !dropdown.contains(e.target) && uploadMenu && !uploadMenu.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
});
</script>