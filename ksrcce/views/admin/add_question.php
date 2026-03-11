<?php require_once __DIR__ . '/../layout.php'; ?>

<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Add Question with Image</h1>
                    <p class="mt-2 text-gray-600">Create individual questions with figures/images for your exams</p>
                </div>
                <a href="/admin/exams" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Questions
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if(!empty($_SESSION['flash']['success'])): ?>
            <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200 flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span><?= htmlspecialchars($_SESSION['flash']['success']) ?></span>
            </div>
            <?php unset($_SESSION['flash']['success']); ?>
        <?php endif; ?>

        <?php if(!empty($_SESSION['flash']['error'])): ?>
            <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200 flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span><?= htmlspecialchars($_SESSION['flash']['error']) ?></span>
            </div>
            <?php unset($_SESSION['flash']['error']); ?>
        <?php endif; ?>

        <!-- Question Form -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <form id="questionForm" enctype="multipart/form-data" class="p-6 space-y-6">
                <!-- Exam Selection -->
                <div class="mb-6">
                    <label for="exam_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Select Exam <span class="text-red-500">*</span>
                    </label>
                    <select id="exam_id" name="exam_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Choose an exam...</option>
                    </select>
                </div>

                <!-- Question Text -->
                <div class="mb-6">
                    <label for="question_text" class="block text-sm font-medium text-gray-700 mb-2">
                        Question Text <span class="text-red-500">*</span>
                    </label>
                    <textarea id="question_text" name="question_text" rows="4" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your question here..."></textarea>
                </div>

                <!-- Question Image -->
                <div class="mb-6">
                    <label for="question_image" class="block text-sm font-medium text-gray-700 mb-2">
                        Question Image/Figure (Optional)
                    </label>
                    <div class="flex items-center space-x-4">
                        <input type="file" id="question_image" name="question_image" 
                            accept="image/*" 
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div id="imagePreview" class="hidden">
                            <img src="" alt="Question image" class="h-20 w-20 object-cover rounded-lg border">
                            <button type="button" onclick="removeImage()" class="ml-2 text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Supported formats: JPEG, PNG, WebP, GIF. Max size: 5MB</p>
                </div>

                <!-- Options -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Answer Options <span class="text-red-500">*</span>
                    </label>
                    <div id="optionsContainer" class="space-y-3">
                        <div class="option-item flex items-center space-x-3">
                            <span class="w-8 text-sm font-medium text-gray-600">A)</span>
                            <input type="text" name="option_0" required 
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter option A...">
                            <input type="radio" name="correct_answer" value="0" class="text-blue-600">
                        </div>
                        <div class="option-item flex items-center space-x-3">
                            <span class="w-8 text-sm font-medium text-gray-600">B)</span>
                            <input type="text" name="option_1" required 
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter option B...">
                            <input type="radio" name="correct_answer" value="1" class="text-blue-600">
                        </div>
                        <div class="option-item flex items-center space-x-3">
                            <span class="w-8 text-sm font-medium text-gray-600">C)</span>
                            <input type="text" name="option_2" required 
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter option C...">
                            <input type="radio" name="correct_answer" value="2" class="text-blue-600">
                        </div>
                        <div class="option-item flex items-center space-x-3">
                            <span class="w-8 text-sm font-medium text-gray-600">D)</span>
                            <input type="text" name="option_3" required 
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter option D...">
                            <input type="radio" name="correct_answer" value="3" class="text-blue-600">
                        </div>
                    </div>
                </div>

                <!-- Explanation -->
                <div class="mb-6">
                    <label for="explanation" class="block text-sm font-medium text-gray-700 mb-2">
                        Explanation (Optional)
                    </label>
                    <textarea id="explanation" name="explanation" rows="3" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Explain why this answer is correct..."></textarea>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="window.history.back()" 
                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit" 
                        class="px-6 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0 0h6m-6 0H6" />
                        </svg>
                        Save Question
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Load exams for dropdown
document.addEventListener('DOMContentLoaded', function() {
    loadExams();
});

function loadExams() {
    fetch('/api/exams')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('exam_id');
            select.innerHTML = '<option value="">Choose an exam...</option>';
            
            if (data.exams && data.exams.length > 0) {
                data.exams.forEach(exam => {
                    const option = document.createElement('option');
                    option.value = exam.id;
                    option.textContent = exam.title + ' (' + exam.category + ')';
                    select.appendChild(option);
                });
            }
        })
        .catch(error => {
            console.error('Error loading exams:', error);
        });
}

// Image preview functionality
document.getElementById('question_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});

function removeImage() {
    document.getElementById('question_image').value = '';
    document.getElementById('imagePreview').classList.add('hidden');
}

// Form submission
document.getElementById('questionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    
    // Collect options into array
    const options = [];
    for (let i = 0; i < 4; i++) {
        const option = formData.get('option_' + i);
        if (option) {
            options.push(option);
        }
    }
    
    // Set options as JSON
    formData.delete('option_0');
    formData.delete('option_1');
    formData.delete('option_2');
    formData.delete('option_3');
    formData.append('options', JSON.stringify(options));
    
    // Show loading
    const submitBtn = e.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12c0 5.373 5.373 0 0 0h4zm2 5.291A7.962 7.962 0 014 12c0 5.373 5.373 0 0 0h4z"></path></svg>Saving...';
    
    fetch('/api/questions/create', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            const successDiv = document.createElement('div');
            successDiv.className = 'mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200 flex items-start';
            successDiv.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>${data.message}</span>
            `;
            
            e.target.parentElement.insertBefore(successDiv, e.target);
            
            // Reset form
            e.target.reset();
            document.getElementById('imagePreview').classList.add('hidden');
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Remove success message after 3 seconds
            setTimeout(() => {
                successDiv.remove();
            }, 3000);
        } else {
            // Show error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'mb-6 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200 flex items-start';
            errorDiv.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span>${data.message}</span>
            `;
            
            e.target.parentElement.insertBefore(errorDiv, e.target);
            
            // Remove error message after 5 seconds
            setTimeout(() => {
                errorDiv.remove();
            }, 5000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving question. Please try again.');
    })
    .finally(() => {
        // Restore button
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
});
</script>

<?php require_once __DIR__ . '/../footer.php'; ?>
