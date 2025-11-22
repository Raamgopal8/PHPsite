<?php $path = 'admin/exams.php'; ?>

<div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">All Exams</h2>
            <p class="text-gray-500 text-sm mt-1">Manage all your exams here</p>
        </div>
        <div class="flex space-x-3">
            <a href="/admin/dashboard" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                Back to Dashboard
            </a>
            <a href="/admin/exams/create" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 shadow-sm">
                Create Exam
            </a>
        </div>
    </div>

    <?php if(empty($exams)): ?>
        <div class="text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <p class="mt-2 text-gray-500 font-medium">No exams found</p>
            <p class="text-sm text-gray-400 mt-1">Get started by creating your first exam</p>
        </div>

    <?php else: ?>

    <div class="space-y-4">

        <?php foreach ($exams as $exam): ?>

            <div class="flex items-center justify-between bg-white rounded-xl border p-5 hover:shadow-md transition-all duration-200">

                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        <?= htmlspecialchars($exam['title']) ?>
                    </h3>
                    <div class="flex items-center space-x-4 mt-2">
                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800">
                            <?= htmlspecialchars($exam['category'] ?? 'General') ?>
                        </span>
                        <span class="text-gray-500 text-xs flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <?= $exam['duration'] ?? 30 ?> mins
                        </span>
                    </div>
                </div>

                <div class="flex items-center space-x-3">

                    <?php
                        $status = $exam['status'] ?? 'active';
                        $badge = [
                            'active' => 'bg-green-100 text-green-700',
                            'upcoming' => 'bg-yellow-100 text-yellow-700',
                            'closed' => 'bg-red-100 text-red-700',
                        ][$status] ?? 'bg-gray-100 text-gray-700';
                    ?>

                    <span class="px-3 py-1 text-xs font-semibold rounded-full <?= $badge ?>">
                        <?= ucfirst($status) ?>
                    </span>

                    <div class="h-6 w-px bg-gray-200 mx-2"></div>

                    <a href="/admin/exams/edit?id=<?= urlencode($exam['id'] ?? '') ?>"
                       class="text-gray-600 hover:text-blue-600 text-sm font-medium transition-colors">
                        Edit
                    </a>

                    <a href="/admin/exams/delete?id=<?= urlencode($exam['id'] ?? '') ?>"
                       onclick="return confirm('Delete this exam?')"
                       class="text-gray-600 hover:text-red-600 text-sm font-medium transition-colors">
                        Delete
                    </a>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <?php endif; ?>

</div>
