<?php $path = 'admin/dashboard.php'; ?>

<style>
    .glass-sidebar {
        background: rgba(17, 24, 39, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-right: 1px solid rgba(255, 255, 255, 0.08);
    }
    .glass-content {
        background: rgba(17, 24, 39, 0.4); 
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .glass-card:hover {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }
    .nav-item {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .nav-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 3px;
        background: #3b82f6;
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }
    .nav-item:hover::before, .nav-item.active::before {
        transform: scaleY(1);
    }
    .nav-item:hover, .nav-item.active {
        background: rgba(59, 130, 246, 0.1);
        color: #60a5fa;
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.02);
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.2);
    }
</style>

<div class="min-h-screen bg-[url('/assets/background.jpg')] bg-fixed bg-cover bg-center">
    <div class="flex min-h-screen bg-gray-900/80 backdrop-blur-sm">
        
        <!-- Sidebar Navigation -->
        <aside class="hidden lg:flex flex-col w-64 glass-sidebar fixed inset-y-0 left-0 z-40 pt-28 pb-6 overflow-y-auto">
            <div class="px-6 mb-8">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/30">
                        <?= strtoupper(substr(htmlspecialchars($_SESSION['user']['name'] ?? 'A'), 0, 1)) ?>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-white"><?= htmlspecialchars($_SESSION['user']['name'] ?? 'Admin') ?></h3>
                        <p class="text-xs text-blue-400">Administrator</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-2">
                <a href="/admin/dashboard" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white rounded-xl">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Overview
                </a>
                <a href="/admin/exams" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:text-white">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Exams
                </a>
                <a href="/admin/exam-countdowns" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:text-white">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Countdowns
                </a>
                <a href="/admin/achievements" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:text-white">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    Achievements
                </a>

            </nav>
            

        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 lg:pl-64 flex flex-col min-w-0 overflow-x-hidden">
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
                
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-white tracking-tight">Dashboard Overview</h1>
                        <p class="mt-1 text-gray-400">Welcome back, get an overview of your platform.</p>
                    </div>
                </div>

                <?php if(!empty($_SESSION['flash']['success'])): ?>
                    <div class="mb-8 p-4 bg-green-500/10 text-green-400 rounded-xl border border-green-500/20 flex items-start backdrop-blur-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <div><?= htmlspecialchars($_SESSION['flash']['success']); unset($_SESSION['flash']['success']); ?></div>
                    </div>
                <?php endif; ?>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Exams -->
                    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-500/20 rounded-full blur-2xl group-hover:bg-blue-500/30 transition-all duration-500"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-gray-400 text-sm font-medium">Total Exams</h3>
                                <span class="p-2 bg-blue-500/10 rounded-lg text-blue-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-white"><?= count($exams) ?></span>
                                <span class="text-xs text-green-400 bg-green-500/10 px-2 py-1 rounded-full">+2 this week</span>
                            </div>
                        </div>
                    </div>

                    <!-- Questions -->
                    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-green-500/20 rounded-full blur-2xl group-hover:bg-green-500/30 transition-all duration-500"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-gray-400 text-sm font-medium">Questions</h3>
                                <span class="p-2 bg-green-500/10 rounded-lg text-green-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-white"><?= $totalQuestions ?? '0' ?></span>
                                <span class="text-xs text-gray-500">In bank</span>
                            </div>
                        </div>
                    </div>

                    <!-- Active Countdowns -->
                    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-purple-500/20 rounded-full blur-2xl group-hover:bg-purple-500/30 transition-all duration-500"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-gray-400 text-sm font-medium">Coming Up</h3>
                                <span class="p-2 bg-purple-500/10 rounded-lg text-purple-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-white"><?= count(array_filter($countdowns ?? [], function($c) { return $c['is_active']; })) ?></span>
                                <span class="text-xs text-purple-400">Exams soon</span>
                            </div>
                        </div>
                    </div>

                    <!-- Achievements -->
                    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-yellow-500/20 rounded-full blur-2xl group-hover:bg-yellow-500/30 transition-all duration-500"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-gray-400 text-sm font-medium">Achievers</h3>
                                <span class="p-2 bg-yellow-500/10 rounded-lg text-yellow-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-white"><?= count($achievers ?? []) ?></span>
                                <span class="text-xs text-gray-500">Students</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Exams Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                     <!-- Recent Exams -->
                     <div class="glass-card rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-white">Recent Exams</h2>
                            <a href="/admin/exams" class="text-xs text-blue-400 hover:text-blue-300 font-medium">View All &rarr;</a>
                        </div>
                        <div class="space-y-3 overflow-y-auto max-h-64 custom-scrollbar">
                            <?php if(empty($exams)): ?>
                                <p class="text-sm text-gray-400 text-center py-4">No exams created yet</p>
                            <?php else: ?>
                                <?php foreach(array_slice($exams, 0, 5) as $exam): ?>
                                    <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors group">
                                        <div class="min-w-0">
                                            <h4 class="text-sm font-medium text-white truncate"><?= htmlspecialchars($exam['title'] ?? 'Untitled Exam') ?></h4>
                                            <p class="text-xs text-gray-500"><?= htmlspecialchars($exam['category'] ?? 'General') ?> • <?= $exam['duration'] ?? 0 ?>m</p>
                                        </div>
                                        <a href="/admin/exams/edit?id=<?= $exam['id'] ?>" class="p-2 text-gray-400 hover:text-white transition-colors opacity-0 group-hover:opacity-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Recent Login Activity -->
                     <div class="glass-card rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-white">Student Logins</h2>
                            <span class="text-xs text-gray-500">Last 24 hours</span>
                        </div>
                        <div class="overflow-x-auto overflow-y-auto max-h-96 custom-scrollbar">
                            <table class="w-full relative">
                                <thead class="bg-gray-800/90 backdrop-blur sticky top-0 z-10">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-400">Student</th>
                                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-400">Time</th>
                                    </tr>
                                </thead>
                                <tbody id="recent-logins-body" class="divide-y divide-white/5">
                                <?php if(empty($recentLogins)): ?>
                                     <tr><td colspan="2" class="px-4 py-4 text-center text-xs text-gray-500">No activity found</td></tr>
                                <?php else: ?>
                                    <?php foreach($recentLogins as $login): ?>
                                        <tr class="hover:bg-white/5 transition-colors">
                                            <td class="px-4 py-2 border-b border-white/5">
                                                <div class="text-sm font-medium text-white"><?= htmlspecialchars($login['name']) ?></div>
                                                <div class="text-xs text-gray-500"><?= $login['ip_address'] ?? '' ?></div>
                                            </td>
                                            <td class="px-4 py-2 border-b border-white/5 text-xs text-gray-400">
                                                <?= date('M d, H:i', strtotime($login['login_time'])) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Two Column Layout (Countdowns & Achievements) -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Countdowns -->
                    <div class="glass-card rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-white">Active Exam Countdowns</h2>
                            <a href="/admin/exam-countdowns" class="text-xs text-blue-400 hover:text-blue-300 font-medium">View All &rarr;</a>
                        </div>
                        <div class="space-y-3 overflow-y-auto max-h-64 custom-scrollbar">
                            <?php if(empty($countdowns)): ?>
                                <p class="text-sm text-gray-400 text-center py-4">No active countdowns</p>
                            <?php else: ?>
                                <?php foreach(array_slice($countdowns, 0, 3) as $cd): ?>
                                    <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-lg bg-gray-800 flex flex-col items-center justify-center text-xs font-bold border border-white/10">
                                                <span class="text-blue-400"><?= date('M', strtotime($cd['exam_date'])) ?></span>
                                                <span class="text-white"><?= date('d', strtotime($cd['exam_date'])) ?></span>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-medium text-white"><?= htmlspecialchars($cd['exam_name'] ?? 'Untitled Exam') ?></h4>
                                                <p class="text-xs text-gray-500"><?= $cd['is_active'] ? 'Active' : 'Hidden' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Achievements -->
                    <div class="glass-card rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-white">Recent Achievements</h2>
                            <a href="/admin/achievements" class="text-xs text-green-400 hover:text-green-300 font-medium">View All &rarr;</a>
                        </div>
                        <div class="space-y-3 overflow-y-auto max-h-64 custom-scrollbar">
                            <?php if(empty($achievers)): ?>
                                <p class="text-sm text-gray-400 text-center py-4">No achievements yet</p>
                            <?php else: ?>
                                <?php foreach(array_slice($achievers ?? [], 0, 3) as $achiever): ?>
                                    <div class="flex items-center gap-4 p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-green-500/20 to-emerald-500/20 flex items-center justify-center text-green-400 font-bold border border-green-500/20">
                                            <?= substr($achiever['name'], 0, 1) ?>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="text-sm font-medium text-white truncate"><?= htmlspecialchars($achiever['name']) ?></h4>
                                            <p class="text-xs text-gray-400 truncate"><?= htmlspecialchars($achiever['rank_text'] ?? $achiever['description']) ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Domains Grid -->
                <h2 class="text-xl font-bold text-white mb-6 px-1">Domain Management</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <?php
                    $domains = [
                        ['name' => 'GATE', 'color' => 'blue', 'image' => '/assets/gate.png'],
                        ['name' => 'TNPSC', 'color' => 'green', 'image' => '/assets/tnpsc.png'],
                        ['name' => 'Banking', 'color' => 'indigo', 'image' => '/assets/Bank.png'],
                        ['name' => 'UPSC', 'color' => 'orange', 'image' => '/assets/upsc.jpeg']
                    ];
                    
                    foreach($domains as $d): 
                        $color = $d['color'];
                    ?>
                    <div class="glass-card rounded-2xl p-6 group hover:border-<?= $color ?>-500/30">
                        <div class="w-16 h-16 rounded-xl bg-<?= $color ?>-500/10 flex items-center justify-center mb-4 group-hover:bg-<?= $color ?>-500/20 transition-colors overflow-hidden">
                            <img src="<?= $d['image'] ?>" alt="<?= $d['name'] ?>" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                        </div>
                        <h3 class="text-lg font-bold text-white mb-4"><?= $d['name'] ?></h3>
                        <div class="space-y-2">
                             <a href="/admin/syllabi?category=<?= $d['name'] ?>" class="block w-full text-center py-2 rounded-lg bg-white/5 text-sm text-gray-300 hover:bg-white/10 hover:text-white transition-colors">Syllabus</a>
                             <a href="/admin/materials?category=<?= $d['name'] ?>" class="block w-full text-center py-2 rounded-lg bg-white/5 text-sm text-gray-300 hover:bg-white/10 hover:text-white transition-colors">Materials</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Recent Activities & Live Scores -->
                <div class="grid grid-cols-1 gap-8">
                    <!-- Live Scores -->
                    <div class="glass-card rounded-2xl overflow-hidden">
                        <div class="p-6 border-b border-white/5 flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-bold text-white">Live Student Scores</h2>
                                <p class="text-sm text-gray-400">Real-time submission updates</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span id="last-updated" class="text-xs text-gray-500 font-mono">Syncing...</span>
                                <button onclick="fetchResults()" class="p-2 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-colors">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-black/20">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Student</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Exam</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Score</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Time</th>
                                    </tr>
                                </thead>
                                <tbody id="results-table-body" class="divide-y divide-white/5">
                                    <?php if (!empty($recentResults)): ?>
                                        <?php foreach ($recentResults as $result): ?>
                                            <tr class="hover:bg-white/5 transition-colors">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-white"><?= htmlspecialchars($result['student_name']) ?></div>
                                                    <div class="text-xs text-gray-500"><?= htmlspecialchars($result['student_id']) ?></div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-300"><?= htmlspecialchars($result['exam_title']) ?></div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $result['percentage'] >= 70 ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' ?>">
                                                        <?= $result['score'] ?>/<?= $result['total_questions'] ?>
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                                    <?= ucfirst(str_replace('_', ' ', $result['status'])) ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <?= date('M d, H:i', $result['created_at']->toDateTime()->getTimestamp()) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">No results found yet.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Official Links Manager -->
                    <div class="glass-card rounded-2xl p-6">
                        <h2 class="text-lg font-bold text-white mb-6">Quick Links Manager</h2>
                        <form id="add-link-form" class="flex flex-col md:flex-row gap-4 mb-6">
                            <input type="text" name="title" placeholder="Title" class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-colors" required>
                            <select name="category" class="bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-blue-500">
                                <option value="GATE" class="bg-gray-900 text-white">GATE</option>
                                <option value="Banking" class="bg-gray-900 text-white">Banking</option>
                                <option value="UPSC" class="bg-gray-900 text-white">UPSC</option>
                                <option value="TNPSC" class="bg-gray-900 text-white">TNPSC</option>
                            </select>
                            <input type="url" name="url" placeholder="URL" class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-colors" required>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl transition-colors font-medium shadow-lg shadow-blue-500/20">Add</button>
                        </form>
                        <div id="link-message" class="text-sm text-center hidden mb-4"></div>
                        <div id="official-links-list" class="space-y-2 max-h-48 overflow-y-auto custom-scrollbar">
                            <?php if(empty($officialLinks)): ?>
                                <div class="text-center text-gray-500 text-sm py-4">No links added.</div>
                            <?php else: ?>
                                <?php foreach($officialLinks as $link): ?>
                                    <div class="flex items-center justify-between p-2 rounded-lg bg-white/5 border border-white/5 hover:bg-white/10 transition-colors">
                                        <div class="min-w-0 flex-1 mr-2">
                                            <h4 class="text-sm font-medium text-white truncate"><?= htmlspecialchars($link['title']) ?></h4>
                                            <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" class="text-xs text-blue-400 hover:text-blue-300 truncate block"><?= htmlspecialchars($link['url']) ?></a>
                                        </div>
                                        <span class="text-xs text-gray-500 bg-white/5 px-2 py-1 rounded"><?= htmlspecialchars($link['category'] ?? 'General') ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<script>
let eventSource;

function formatDate(dateString) {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleString(undefined, options);
}

function updateResultsTable(results) {
    const tbody = document.getElementById('results-table-body');
    if (!results || results.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">No results found.</td></tr>';
        return;
    }

    tbody.innerHTML = results.map(result => {
        const statusClass = result.percentage >= 70 ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400';
        const date = new Date(result.created_at);
        
        return `
            <tr class="hover:bg-white/5 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-white">${result.student_name}</div>
                    <div class="text-xs text-gray-500">${result.student_id}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-300">${result.exam_title}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusClass}">
                        ${result.score}/${result.total_questions}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                    ${result.status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${formatDate(date)}
                </td>
            </tr>
        `;
    }).join('');
}

async function fetchResults() {
    try {
        const btn = document.querySelector('button[onclick="fetchResults()"] svg');
        if(btn) btn.classList.add('animate-spin');
        
        const response = await fetch('/api/admin/results?limit=10');
        const data = await response.json();
        
        if (data.success) {
            updateResultsTable(data.data);
            document.getElementById('last-updated').textContent = `Syned: ${new Date().toLocaleTimeString()}`;
        }
    } catch (error) {
        console.error('Error fetching results:', error);
    } finally {
        const btn = document.querySelector('button[onclick="fetchResults()"] svg');
        if(btn) btn.classList.remove('animate-spin');
    }
}

function setupEventSource() {
    if (eventSource) eventSource.close();
    eventSource = new EventSource('/api/updates');
    eventSource.onmessage = function(event) {
        const data = JSON.parse(event.data);
        if (data.type === 'new_result') fetchResults();
    };
    eventSource.onerror = function() {
        console.error('EventSource failed.');
        eventSource.close();
        setTimeout(setupEventSource, 5000);
    };
}

document.addEventListener('DOMContentLoaded', function() {
    fetchResults();
    setupEventSource();
    setInterval(fetchResults, 30000);
});
</script>
