<?php $path = 'admin/syllabi/show.php'; ?>

<div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm max-w-4xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($syllabus['title']) ?></h2>
                <p class="text-gray-500 text-sm mt-1">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <?= htmlspecialchars($syllabus['subject']) ?>
                    </span>
                    <span class="ml-2 text-gray-400">
                        Created: <?= date('M d, Y', strtotime($syllabus['created_at'])) ?>
                    </span>
                </p>
            </div>
            <a href="/admin/syllabi" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                Back to List
            </a>
        </div>
    </div>

    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
        <h3 class="text-sm font-medium text-gray-700 mb-3">Syllabus Link</h3>
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-500 mb-2">URL:</p>
                    <a href="<?= htmlspecialchars($syllabus['url']) ?>" target="_blank" rel="noopener noreferrer" 
                       class="text-blue-600 hover:text-blue-800 break-all">
                        <?= htmlspecialchars($syllabus['url']) ?>
                    </a>
                </div>
                <a href="<?= htmlspecialchars($syllabus['url']) ?>" target="_blank" rel="noopener noreferrer"
                   class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Open Link
                </a>
            </div>
        </div>
    </div>
</div>
