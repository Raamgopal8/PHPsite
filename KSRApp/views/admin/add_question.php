<?php $path = 'admin/add_question.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 pt-6">
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Add New Question</h1>
                    <p class="mt-1 text-gray-600">Create a new question for the exam</p>
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

        <!-- Question Form -->
        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">
            <form action="/admin/questions/add" method="post" class="space-y-6">
                <!-- Exam Selection -->
                <div class="space-y-1">
                    <label for="exam_id" class="block text-sm font-medium text-gray-700">Select Exam</label>
                    <select id="exam_id" name="exam_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg">
                        <?php foreach($exams as $exam): ?>
                            <option value="<?= htmlspecialchars($exam['_id']) ?>">
                                <?= htmlspecialchars($exam['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Question Text -->
                <div class="space-y-1">
                    <label for="text" class="block text-sm font-medium text-gray-700">Question Text</label>
                    <div class="mt-1">
                        <textarea id="text" name="text" rows="3" required 
                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border border-gray-300 rounded-lg p-3"
                            placeholder="Enter the question text here..."></textarea>
                    </div>
                </div>

                <!-- Options -->
                <div class="space-y-4">
                    <h3 class="text-sm font-medium text-gray-700">Options</h3>
                    <?php for($i = 1; $i <= 4; $i++): ?>
                        <div class="flex items-start space-x-3">
                            <div class="flex items-center h-5">
                                <input id="answer-<?= $i-1 ?>" name="answer" type="radio" value="<?= $i-1 ?>" 
                                    class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" 
                                    <?= $i === 1 ? 'required' : '' ?> <?= $i === 1 ? 'checked' : '' ?>>
                            </div>
                            <div class="flex-1">
                                <label for="opt<?= $i ?>" class="sr-only">Option <?= $i ?></label>
                                <input type="text" name="opt<?= $i ?>" id="opt<?= $i ?>" required
                                    class="block w-full shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-lg p-2"
                                    placeholder="Option <?= $i ?>">
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>

                <!-- Explanation -->
                <div class="space-y-1">
                    <label for="explanation" class="block text-sm font-medium text-gray-700">Explanation (Optional)</label>
                    <div class="mt-1">
                        <textarea id="explanation" name="explanation" rows="3"
                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border border-gray-300 rounded-lg p-3"
                            placeholder="Add an explanation for the correct answer..."></textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">This will be shown to students after they complete the exam.</p>
                </div>

                <!-- Form Actions -->
                <div class="pt-5">
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="window.history.back()" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </button>
                        <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Add Question
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add some interactivity -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-focus the first input
    document.querySelector('input, textarea, select').focus();
    
    // Add character counter for textareas
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        const maxLength = textarea.getAttribute('maxlength') || 1000;
        const charCount = document.createElement('div');
        charCount.className = 'text-right text-xs text-gray-500 mt-1';
        charCount.textContent = `0/${maxLength} characters`;
        textarea.parentNode.insertBefore(charCount, textarea.nextSibling);
        
        textarea.addEventListener('input', function() {
            const currentLength = this.value.length;
            charCount.textContent = `${currentLength}/${maxLength} characters`;
            
            if (currentLength > maxLength * 0.9) {
                charCount.classList.add('text-red-500');
                charCount.classList.remove('text-gray-500');
            } else {
                charCount.classList.remove('text-red-500');
                charCount.classList.add('text-gray-500');
            }
        });
    });
});
</script>
