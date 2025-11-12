<?php $path = 'admin/exams_create.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 md:p-8">
    <div class="max-w-3xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Create New Exam</h1>
            <p class="mt-2 text-gray-600">Set up a new exam with all the necessary details</p>
            
            <?php if(!empty($_SESSION['flash']['error'])): ?>
                <div class="mt-4 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200 flex items-start max-w-2xl mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <div><?= htmlspecialchars($_SESSION['flash']['error']); unset($_SESSION['flash']['error']); ?></div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Form Container -->
        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 md:p-8 border border-white/20 shadow-sm">
            <form action="/admin/exams/create" method="post" class="space-y-6">
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
                            value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
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
                            value="<?= htmlspecialchars($_POST['category'] ?? '') ?>">
                    </div>
                </div>

                <!-- Duration -->
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
                            <input type="number" id="duration" name="duration" min="1" value="60" required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                value="<?= htmlspecialchars($_POST['duration'] ?? '60') ?>">
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
                                value="<?= htmlspecialchars($_POST['passing_score'] ?? '70') ?>">
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
                            placeholder="Enter a brief description of the exam"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
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
                            placeholder="Enter any special instructions for the exam"><?= htmlspecialchars($_POST['instructions'] ?? '') ?></textarea>
                        <div class="mt-1 text-xs text-gray-500 flex justify-between">
                            <span>Max 1000 characters</span>
                            <span id="instructions-count">0/1000</span>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="pt-4 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                    <button type="submit" 
                        class="w-full sm:w-auto flex justify-center items-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Create Exam
                    </button>
                    <a href="/admin/dashboard" 
                        class="w-full sm:w-auto flex justify-center items-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Character counter script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Description character counter
        const description = document.getElementById('description');
        const descriptionCount = document.getElementById('description-count');
        
        if (description && descriptionCount) {
            description.addEventListener('input', function() {
                const remaining = 500 - this.value.length;
                descriptionCount.textContent = this.value.length + '/500';
                
                if (remaining < 0) {
                    this.value = this.value.substring(0, 500);
                    descriptionCount.textContent = '500/500';
                }
            });
            
            // Initialize counter on page load
            description.dispatchEvent(new Event('input'));
        }
        
        // Instructions character counter
        const instructions = document.getElementById('instructions');
        const instructionsCount = document.getElementById('instructions-count');
        
        if (instructions && instructionsCount) {
            instructions.addEventListener('input', function() {
                const remaining = 1000 - this.value.length;
                instructionsCount.textContent = this.value.length + '/1000';
                
                if (remaining < 0) {
                    this.value = this.value.substring(0, 1000);
                    instructionsCount.textContent = '1000/1000';
                }
            });
            
            // Initialize counter on page load
            instructions.dispatchEvent(new Event('input'));
        }
    });
</script>
