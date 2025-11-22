<?php $path = 'admin/dashboard.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 pt-6">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
                    <p class="mt-1 text-gray-600">Manage exams, questions, and view analytics</p>
                </div>
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                    <a href="/admin/exams/create" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create Exams
                    </a>

                </div>
            </div>

            <?php if(!empty($_SESSION['flash']['success'])): ?>
                <div class="mt-4 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200 flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <div><?= htmlspecialchars($_SESSION['flash']['success']); unset($_SESSION['flash']['success']); ?></div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Exams -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Exams</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= count($exams) ?></p>
                    </div>
                </div>
            </div>

            <!-- Total Questions -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Questions</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= $totalQuestions ?? '0' ?></p>
                    </div>
                </div>
            </div>

            <!-- Active Students -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-yellow-100 text-yellow-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Active Students</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= $activeStudents ?? '0' ?></p>
                    </div>
                </div>
            </div>

            <!-- Total Submissions -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-100 text-purple-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Submissions</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= $totalSubmissions ?? '0' ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Domain Selection -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Choose Your Domain</h2>
            <div class="flex flex-wrap gap-3">
              
                <a href="/student/gate" class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-medium hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    GATE
                </a>
              
                <a href="/student/tnpsc" class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-medium hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    TNPSC
                </a>
               
              </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Exams List -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Recent Exams</h2>
                    <a href="/admin/exams" class="text-sm font-medium text-blue-600 hover:text-blue-500">View All</a>
                </div>
                <div class="space-y-4">
                    <?php if (empty($exams)): ?>
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">No exams found</p>
                        </div>
                    <?php else: ?>
                        <?php foreach(array_slice($exams, 0, 5) as $exam): ?>
                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-100 hover:shadow-sm transition-shadow duration-200">
                                <div>
                                    <h3 class="font-medium text-gray-900"><?= htmlspecialchars($exam['title']) ?></h3>
                                    <p class="text-sm text-gray-500">Category: <?= htmlspecialchars($exam['category'] ?? 'General') ?></p>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm text-gray-500"><?= $exam['duration'] ?? 30 ?> min</span>
                                    <div class="flex items-center space-x-3 mt-2">
                                        <a href="/admin/exams/view/<?= urlencode($exam['id'] ?? '') ?>" class="text-sm font-medium text-blue-600 hover:text-blue-500">View</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Syllabus Management -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Syllabus Management</h2>
                    <a href="/admin/syllabi" class="text-sm font-medium text-blue-600 hover:text-blue-500">View All</a>
                </div>
                <div class="space-y-4">
                    <?php 
                    $recentSyllabi = [];
                    try {
                        $db = $this->db ?? (new \App\Core\App())->db;
                        $stmt = $db->prepare("SELECT * FROM syllabi ORDER BY created_at DESC LIMIT 5");
                        $stmt->execute();
                        $recentSyllabi = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (Exception $e) {
                        // Silently fail if table doesn't exist yet
                    }
                    ?>
                    <?php if (empty($recentSyllabi)): ?>
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">No syllabus links added</p>
                            <a href="/admin/syllabi/create" class="mt-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Add Syllabus Link
                            </a>
                        </div>
                    <?php else: ?>
                        <?php foreach($recentSyllabi as $syllabus): ?>
                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-100 hover:shadow-sm transition-shadow duration-200">
                                <div>
                                    <h3 class="font-medium text-gray-900"><?= htmlspecialchars($syllabus['title']) ?></h3>
                                    <p class="text-sm text-gray-500">Subject: <?= htmlspecialchars($syllabus['subject']) ?></p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs text-gray-400"><?= date('M d', strtotime($syllabus['created_at'])) ?></span>
                                    <div class="flex items-center space-x-3 mt-2">
                                        <a href="/admin/syllabi/<?= $syllabus['id'] ?>" class="text-sm font-medium text-blue-600 hover:text-blue-500">View</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="pt-2">
                            <a href="/admin/syllabi/create" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Add New Link
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Materials Management -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Materials Management</h2>
                    <a href="/admin/materials" class="text-sm font-medium text-blue-600 hover:text-blue-500">View All</a>
                </div>
                <div class="space-y-4">
                    <?php 
                    $recentMaterials = [];
                    try {
                        $db = $this->db ?? (new \App\Core\App())->db;
                        $stmt = $db->prepare("SELECT * FROM materials ORDER BY created_at DESC LIMIT 5");
                        $stmt->execute();
                        $recentMaterials = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (Exception $e) {
                        // Silently fail if table doesn't exist yet
                    }
                    ?>
                    <?php if (empty($recentMaterials)): ?>
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">No material links added</p>
                            <a href="/admin/materials/create" class="mt-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                Add Material Link
                            </a>
                        </div>
                    <?php else: ?>
                        <?php foreach($recentMaterials as $material): ?>
                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-100 hover:shadow-sm transition-shadow duration-200">
                                <div>
                                    <h3 class="font-medium text-gray-900"><?= htmlspecialchars($material['title']) ?></h3>
                                    <p class="text-sm text-gray-500">Category: <?= htmlspecialchars($material['category']) ?></p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs text-gray-400"><?= date('M d', strtotime($material['created_at'])) ?></span>
                                    <div class="flex items-center space-x-3 mt-2">
                                        <a href="/admin/materials/<?= $material['id'] ?>" class="text-sm font-medium text-green-600 hover:text-green-500">View</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="pt-2">
                            <a href="/admin/materials/create" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Add New Material
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Student Login Activity -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Recent Student Logins</h2>
                </div>
                <div class="space-y-4">
                    <?php 
                    $recentLogins = [];
                    try {
                        $db = $this->db ?? (new \App\Core\App())->db;
                        $stmt = $db->prepare("
                            SELECT l.*, u.name, u.email 
                            FROM login_logs l 
                            JOIN users u ON l.user_id = u.id 
                            ORDER BY l.login_time DESC 
                            LIMIT 5
                        ");
                        $stmt->execute();
                        $recentLogins = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (Exception $e) {
                        // Silently fail if table doesn't exist yet
                    }
                    ?>
                    <?php if (empty($recentLogins)): ?>
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">No recent login activity</p>
                        </div>
                    <?php else: ?>
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Login Time</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logout Time</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                                    </tr>
                                </thead>
                                <tbody id="recent-logins-body" class="bg-white divide-y divide-gray-200">
                                    <?php foreach($recentLogins as $login): ?>
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($login['name']) ?></div>
                                                <div class="text-xs text-gray-500"><?= htmlspecialchars($login['email']) ?></div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                <?= date('M d, H:i', strtotime($login['login_time'])) ?>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                <?= $login['logout_time'] ? date('M d, H:i', strtotime($login['logout_time'])) : '<span class="text-green-600 text-xs font-medium bg-green-100 px-2 py-0.5 rounded-full">Active</span>' ?>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                <?= htmlspecialchars($login['ip_address'] ?? 'N/A') ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Top Achievers -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Top Achievers</h2>
                    <a href="/admin/results" class="text-sm font-medium text-blue-600 hover:text-blue-500">View All</a>
                </div>
                <div class="space-y-4">
                    <?php if (empty($achievers)): ?>
                        <div class="text-center py-8">
                            <p class="mt-2 text-sm text-gray-500">No achievers yet</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($achievers as $achiever): ?>
                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-100">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 font-bold">
                                        <?= substr($achiever['user_name'], 0, 1) ?>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900"><?= htmlspecialchars($achiever['user_name']) ?></h3>
                                        <p class="text-sm text-gray-500"><?= htmlspecialchars($achiever['exam_title']) ?></p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <?= $achiever['score'] ?>%
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
<script>
function updateRecentLogins() {
    fetch('/admin/api/recent-logins')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('recent-logins-body');
            if (!tbody) return;
            
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="px-4 py-3 text-center text-sm text-gray-500">No recent login activity</td></tr>';
                return;
            }

            tbody.innerHTML = data.map(login => `
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${escapeHtml(login.name)}</div>
                        <div class="text-xs text-gray-500">${escapeHtml(login.email)}</div>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                        ${login.formatted_time}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                        ${login.formatted_logout !== 'Active' ? login.formatted_logout : '<span class="text-green-600 text-xs font-medium bg-green-100 px-2 py-0.5 rounded-full">Active</span>'}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                        ${escapeHtml(login.ip_address || 'N/A')}
                    </td>
                </tr>
            `).join('');
        })
        .catch(error => console.error('Error fetching logins:', error));
}

function escapeHtml(text) {
    if (!text) return '';
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

// Update every 60 seconds
setInterval(updateRecentLogins, 60000);
</script>
<!-- Real-time Student Scores Section -->
       <div class="mt-8">
    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Real-time Student Scores</h2>
                <p class="text-sm text-gray-500">Live updates of student exam submissions</p>
            </div>
            <div class="flex items-center space-x-2">
                <span id="last-updated" class="text-xs text-gray-500">Updating...</span>
                <button onclick="fetchResults()" class="p-1 text-gray-400 hover:text-gray-600 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody id="results-table-body" class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($recentResults)): ?>
                        <?php foreach ($recentResults as $result): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($result['student_name']) ?></div>
                                    <div class="text-sm text-gray-500"><?= htmlspecialchars($result['student_id']) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?= htmlspecialchars($result['exam_title']) ?></div>
                                    <div class="text-sm text-gray-500"><?= htmlspecialchars($result['exam_id']) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?= $result['percentage'] >= 70 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                        <?= $result['score'] ?>/<?= $result['total_questions'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= ucfirst(str_replace('_', ' ', $result['status'])) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= date('M d, Y H:i', $result['created_at']->toDateTime()->getTimestamp()) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                No results found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>       

<!-- Real-time updates script -->
<script>
let eventSource;

// Format date for display
function formatDate(dateString) {
    const options = { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return new Date(dateString).toLocaleString(undefined, options);
}

// Update the results table
function updateResultsTable(results) {
    const tbody = document.getElementById('results-table-body');
    if (!results || results.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                    No results found.
                </td>
            </tr>`;
        return;
    }

    tbody.innerHTML = results.map(result => {
        const statusClass = result.percentage >= 70 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
        const date = new Date(result.created_at);
        
        return `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${result.student_name}</div>
                    <div class="text-sm text-gray-500">${result.student_id}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${result.exam_title}</div>
                    <div class="text-sm text-gray-500">${result.exam_id}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                        ${result.score}/${result.total_questions}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${result.status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${formatDate(date)}
                </td>
            </tr>
        `;
    }).join('');
}

// Fetch latest results
async function fetchResults() {
    try {
        const response = await fetch('/api/admin/results?limit=10');
        const data = await response.json();
        
        if (data.success) {
            updateResultsTable(data.data);
            document.getElementById('last-updated').textContent = `Last updated: ${new Date().toLocaleTimeString()}`;
        }
    } catch (error) {
        console.error('Error fetching results:', error);
    }
}

// Set up Server-Sent Events for real-time updates
function setupEventSource() {
    if (eventSource) {
        eventSource.close();
    }

    eventSource = new EventSource('/api/updates');

    eventSource.onmessage = function(event) {
        const data = JSON.parse(event.data);
        if (data.type === 'new_result') {
            fetchResults(); // Refresh the table when a new result is received
        }
    };

    eventSource.onerror = function() {
        console.error('EventSource failed.');
        eventSource.close();
        // Attempt to reconnect after 5 seconds
        setTimeout(setupEventSource, 5000);
    };
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Initial fetch
    fetchResults();
    
    // Set up real-time updates
    setupEventSource();
    
    // Refresh every 30 seconds as a fallback
    setInterval(fetchResults, 30000);
});
</script>
