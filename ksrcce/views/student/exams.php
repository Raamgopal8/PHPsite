<?php $path = 'student/exams.php'; ?>

<div class="min-h-screen bg-transparent p-4 pt-24">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">All Exams</h1>
                    <p class="mt-2 text-gray-300">View and take available exams</p>
                </div>
                <a href="/student/dashboard" class="text-blue-400 hover:text-blue-300 font-medium">Back to Dashboard</a>
            </div>
        </div>

        <!-- Exams List -->
        <div class="bg-gray-800/60 backdrop-blur-md rounded-2xl p-6 border border-white/10 shadow-sm">
            <?php if (empty($exams)): ?>
                <div class="text-center py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="mt-2 text-sm text-gray-400">No exams available at the moment</p>
                </div>
            <?php else: ?>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <?php foreach($exams as $e): ?>
                        <div class="bg-gray-800/60 rounded-xl border border-white/10 p-6 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-start justify-between mb-4">
                                <div class="p-3 rounded-lg bg-blue-900/20 text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-900/30 text-green-400">
                                    Active
                                </span>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-2"><?= htmlspecialchars($e['title']) ?></h3>
                            <p class="text-sm text-gray-400 mb-4">Category: <?= htmlspecialchars($e['category'] ?? 'General') ?></p>
                            
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-white/10">
                                <span class="text-sm text-gray-400">
                                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <?= $e['duration'] ?? 30 ?> mins
                                </span>
                                <a href="/student/take?id=<?= urlencode((string)$e['id']) ?>" class="inline-flex items-center px-4 py-2 border border-blue-500/30 text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 shadow-lg">
                                    Start Exam
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
