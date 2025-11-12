<?php $path = 'admin/exams.php'; ?>

<div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-gray-900">Recent Exams</h2>
        <a href="/admin/exams" class="text-sm font-medium text-blue-600 hover:text-blue-500">View All</a>
    </div>

    <?php if(empty($recentExams)): ?>
        <p class="text-gray-500 text-sm">No exams created yet.</p>

    <?php else: ?>

    <div class="space-y-4">

        <?php foreach ($recentExams as $exam): ?>

            <div class="flex items-center justify-between bg-white rounded-xl border p-4 hover:shadow transition">

                <div>
                    <h3 class="text-md font-semibold text-gray-900">
                        <?= htmlspecialchars($exam['title']) ?>
                    </h3>
                    <p class="text-gray-500 text-xs mt-1">
                        <?= htmlspecialchars($exam['description'] ?? 'No description') ?>
                    </p>
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

                    <span class="px-2 py-1 text-xs font-semibold rounded <?= $badge ?>">
                        <?= ucfirst($status) ?>
                    </span>

                    <a href="/admin/exams/edit?id=<?= $exam['_id'] ?>"
                       class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                        Edit
                    </a>

                    <a href="/admin/exams/delete?id=<?= $exam['_id'] ?>"
                       onclick="return confirm('Delete this exam?')"
                       class="text-red-600 hover:text-red-500 text-sm font-medium">
                        Delete
                    </a>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <?php endif; ?>

</div>
