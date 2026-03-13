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
        
        <!-- Sidebar for Desktop -->
        <aside class="lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col glass-sidebar print:hidden">
            <div class="flex flex-col flex-grow bg-gray-900/40 pt-5 pb-4 overflow-y-auto custom-scrollbar">
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
                <a href="/admin/events" class="nav-item <?= str_contains($_SERVER['REQUEST_URI'], '/admin/events') ? 'active' : 'text-gray-300' ?> flex items-center px-4 py-3 text-sm font-medium rounded-xl hover:text-white">
                    <svg class="h-5 w-5 mr-3 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Events
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
                                <div class="flex items-center gap-2">
                                    <h3 class="text-gray-400 text-sm font-medium">Achievers</h3>
                                    <a href="/admin/achievements" class="ml-2 bg-yellow-500/20 hover:bg-yellow-500 text-yellow-400 hover:text-white px-2 py-0.5 rounded text-[10px] font-bold transition-colors uppercase tracking-wider">Add</a>
                                </div>
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

                    <!-- Events -->
                    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-500/20 rounded-full blur-2xl group-hover:bg-indigo-500/30 transition-all duration-500"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-gray-400 text-sm font-medium">Events</h3>
                                    <a href="/admin/events" class="ml-2 bg-indigo-500/20 hover:bg-indigo-500 text-indigo-400 hover:text-white px-2 py-0.5 rounded text-[10px] font-bold transition-colors uppercase tracking-wider">Add</a>
                                </div>
                                <span class="p-2 bg-indigo-500/10 rounded-lg text-indigo-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-white"><?= count($eventsList ?? []) ?></span>
                                <span class="text-xs text-gray-500">Moments</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Unified Domain Management -->
                <div class="glass-card rounded-2xl p-8 mb-8 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-transparent to-indigo-500/5 opacity-50"></div>
                    
                    <div class="relative flex flex-col md:flex-row items-center justify-between gap-8">
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-white mb-2">Competitive Exams Management</h2>
                            <p class="text-gray-400 text-sm mb-6">Centralized control for GATE, TNPSC, Banking, and UPSC syllabus and materials.</p>
                            
                            <div class="flex flex-wrap gap-4 mb-2">
                                <?php
                                $domains = [
                                    ['name' => 'GATE', 'image' => '/assets/gate.png', 'url' => '/student/gate'],
                                    ['name' => 'TNPSC', 'image' => '/assets/tnpsc.png', 'url' => '/student/tnpsc'],
                                    ['name' => 'Banking', 'image' => '/assets/Bank.png', 'url' => '/student/banking'],
                                    ['name' => 'UPSC', 'image' => '/assets/upsc.jpeg', 'url' => '/student/upsc']
                                ];
                                foreach($domains as $d): ?>
                                    <a href="<?= $d['url'] ?>" class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white/5 border border-white/10 group/item hover:bg-white/10 hover:border-blue-500/30 transition-all">
                                        <div class="w-6 h-6 rounded-md overflow-hidden bg-white/10">
                                            <img src="<?= $d['image'] ?>" alt="<?= $d['name'] ?>" class="w-full h-full object-cover">
                                        </div>
                                        <span class="text-xs font-bold text-gray-300 group-hover/item:text-white"><?= $d['name'] ?></span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                            <a href="/admin/syllabi" class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold transition-all shadow-lg shadow-blue-500/25 group/btn">
                                <svg class="w-5 h-5 mr-2 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Syllabus Management
                            </a>
                            <a href="/admin/materials" class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition-all shadow-lg shadow-indigo-500/25 group/btn2">
                                <svg class="w-5 h-5 mr-2 group-hover/btn2:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Materials Management
                            </a>
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
                            <div class="flex gap-4 items-center">
                                <span class="text-xs text-gray-500">Last 24 hours</span>
                                <a href="/admin/logins/print" target="_blank" class="text-xs bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-full transition-colors font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    Print All
                                </a>
                            </div>
                        </div>
                        <div class="overflow-x-auto overflow-y-auto max-h-96 custom-scrollbar">
                            <table class="w-full relative">
                                <thead class="bg-gray-800/90 backdrop-blur sticky top-0 z-10">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-400">Student</th>
                                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-400">Details</th>
                                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-400">Time</th>
                                    </tr>
                                </thead>
                                <tbody id="recent-logins-body" class="divide-y divide-white/5">
                                <?php if(empty($recentLogins)): ?>
                                     <tr><td colspan="3" class="px-4 py-4 text-center text-xs text-gray-500">No activity found</td></tr>
                                <?php else: ?>
                                    <?php foreach($recentLogins as $login): ?>
                                        <tr class="hover:bg-white/5 transition-colors">
                                            <td class="px-4 py-2 border-b border-white/5">
                                                <div class="text-sm font-medium text-white"><?= htmlspecialchars($login['name']) ?></div>
                                                <div class="text-xs text-gray-500"><?= $login['ip_address'] ?? '' ?></div>
                                            </td>
                                            <td class="px-4 py-2 border-b border-white/5">
                                                <div class="text-xs text-gray-300">
                                                    <?= htmlspecialchars($login['year'] ? "Year {$login['year']}" : '') ?> 
                                                    <?= htmlspecialchars($login['department'] ?? '') ?>
                                                </div>
                                                <div class="text-xs text-gray-500"><?= htmlspecialchars($login['college'] ?? '') ?></div>
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

                <!-- Gallery Widgets Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Achievers Gallery (Hall of Fame) -->
                    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group flex flex-col items-center justify-center text-center">
                        <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/10 to-orange-500/10 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                        <div class="w-16 h-16 rounded-full bg-yellow-500/20 text-yellow-400 flex items-center justify-center mb-4 border border-yellow-500/30">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 .895 3 2s-1.343 2-3 2-3-.895-3-2 1.343-2 3-2zm0 0v-4m0 16a9 9 0 110-18 9 9 0 010 18z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12.5a5.5 5.5 0 01-8 0" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white mb-2 relative z-10">Hall of Fame</h2>
                        <p class="text-sm text-gray-400 mb-6 relative z-10">Explore our top achievers across all batch years.</p>
                        <a href="/achievers/gallery" class="relative z-10 px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-full transition-colors shadow-lg shadow-yellow-500/20">View Achievers Gallery</a>
                    </div>

                    <!-- Campus Events Gallery -->
                    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group flex flex-col items-center justify-center text-center">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-purple-500/10 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                        <div class="w-16 h-16 rounded-full bg-indigo-500/20 text-indigo-400 flex items-center justify-center mb-4 border border-indigo-500/30">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white mb-2 relative z-10">Campus Events</h2>
                        <p class="text-sm text-gray-400 mb-6 relative z-10">Relive the moments and explore our campus activities.</p>
                        <a href="/events/gallery" class="relative z-10 px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-full transition-colors shadow-lg shadow-indigo-500/20">View Events Gallery</a>
                    </div>
                </div>

                <!-- Exam Countdowns (Moved to full width or separate section) -->
                <div class="glass-card rounded-2xl p-6 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-bold text-white">Active Exam Countdowns</h2>
                        <a href="/admin/exam-countdowns" class="text-xs text-blue-400 hover:text-blue-300 font-medium">View All &rarr;</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 overflow-y-auto max-h-64 custom-scrollbar">
                        <?php if(empty($countdowns)): ?>
                            <p class="text-sm text-gray-400 text-center py-4 col-span-full">No active countdowns</p>
                        <?php else: ?>
                            <?php foreach(array_slice($countdowns, 0, 6) as $cd): ?>
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
                                <a href="/admin/scores/print" target="_blank" class="text-xs bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-full transition-colors font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2-2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    Print All
                                </a>
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
                                                     <?= ($result['percentage'] ?? 0) >= 70 ? 'Passed' : 'Failed' ?>
                                                 </td>
                                                 <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                     <?= date('M d, H:i', strtotime($result['created_at'] ?? 'now')) ?>
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
                        <form id="add-link-form" action="/admin/official-links/store" method="POST" class="flex flex-col md:flex-row gap-4 mb-6">
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
