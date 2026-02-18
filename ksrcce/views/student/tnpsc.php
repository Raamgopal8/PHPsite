<?php $path = 'student/tnspc.php'; ?>

<div class="min-h-screen bg-transparent relative overflow-hidden pt-20">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-green-900/20 blur-3xl"></div>
        <div class="absolute top-[20%] -right-[10%] w-[40%] h-[40%] rounded-full bg-teal-900/20 blur-3xl"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[30%] h-[30%] rounded-full bg-emerald-900/20 blur-3xl"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Back Button -->
        <div class="absolute top-0 left-4 sm:left-8">
            <?php
            $dashboardUrl = '/student/dashboard';
            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin') {
                $dashboardUrl = '/admin/dashboard';
            }
            ?>
            <a href="<?= $dashboardUrl ?>" class="inline-flex items-center px-4 py-2 rounded-xl bg-gray-800/60 backdrop-blur-md border border-white/10 text-gray-300 font-medium hover:text-green-400 hover:bg-gray-800 hover:shadow-md transition-all duration-200 group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center px-3 py-1 rounded-full bg-green-900/30 border border-green-500/30 text-green-400 text-sm font-medium mb-4">
                <span class="flex h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                TNPSC Exam Preparation
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">
                Serve the State with <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-teal-400">Excellence</span>
            </h1>
            <p class="text-lg text-gray-300 mb-8">
                Access comprehensive study materials and practice tests for Group 1, 2, and 4 examinations conducted by Tamil Nadu Public Service Commission.
            </p>
            
            <div class="flex flex-wrap justify-center gap-4">
                <a href="https://www.tnpsc.gov.in/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-6 py-3 rounded-xl bg-green-600 text-white font-medium hover:bg-green-700 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 duration-200">
                    Official Website
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
                <a href="#groups" class="inline-flex items-center px-6 py-3 rounded-xl bg-gray-800/60 text-white font-medium border border-white/10 hover:bg-gray-700/60 transition-colors shadow-sm hover:shadow-md">
                    Browse Groups
                </a>
            </div>
        </div>

        <!-- Groups Grid -->
        <div id="groups" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-20">
            <?php
            $groups = [
                ['url' => '/student/tnpsc/group1', 'name' => 'Group 1', 'desc' => 'Preliminary Exam', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'color' => 'green'],
                ['url' => '/student/tnpsc/group2', 'name' => 'Group 2', 'desc' => 'Main Exam', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'color' => 'blue'],
                ['url' => '/student/tnpsc/group4', 'name' => 'Group 4', 'desc' => 'Combined Exam', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'color' => 'purple'],
            ];

            foreach ($groups as $group):
                $bg_color = "bg-{$group['color']}-900/30";
                $text_color = "text-{$group['color']}-400";
            ?>
            <a href="<?= $group['url'] ?>" class="group relative bg-gray-800/60 rounded-2xl p-6 shadow-sm border border-white/10 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full overflow-hidden hover:bg-gray-700/60">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-gray-800 to-gray-700 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110 opacity-50"></div>
                
                <div class="relative z-10 flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl <?= $bg_color ?> <?= $text_color ?> flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $group['icon'] ?>"></path>
                        </svg>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-gray-700/50 flex items-center justify-center text-gray-400 group-hover:bg-green-600 group-hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
                
                <div class="relative z-10 mt-auto">
                    <h3 class="text-lg font-bold text-white mb-1 group-hover:text-green-400 transition-colors"><?= $group['name'] ?></h3>
                    <p class="text-sm text-gray-400 font-medium"><?= $group['desc'] ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- About Section -->
        <div class="bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 md:p-12 shadow-sm border border-white/10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-green-900/20 to-teal-900/20 rounded-bl-full opacity-50"></div>
            
            <div class="relative z-10 grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4">About TNPSC Exam</h2>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        The Tamil Nadu Public Service Commission (TNPSC) conducts various recruitment exams for different government posts in Tamil Nadu. It is the premier recruiting agency for the government of Tamil Nadu.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-300">Recruitment for Group 1, 2, and 4 posts</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-300">Detailed syllabus and pattern for each group</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-300">Regular notifications and annual planner</span>
                        </li>
                    </ul>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-green-900/30 p-6 rounded-2xl text-center border border-green-500/20">
                        <div class="text-3xl font-bold text-green-400 mb-1">3</div>
                        <div class="text-sm text-green-300 font-medium">Major Groups</div>
                    </div>
                    <div class="bg-teal-900/30 p-6 rounded-2xl text-center border border-teal-500/20">
                        <div class="text-3xl font-bold text-teal-400 mb-1">Govt</div>
                        <div class="text-sm text-teal-300 font-medium">State Jobs</div>
                    </div>
                    <div class="bg-emerald-900/30 p-6 rounded-2xl text-center border border-emerald-500/20">
                        <div class="text-3xl font-bold text-emerald-400 mb-1">300+</div>
                        <div class="text-sm text-emerald-300 font-medium">Total Vacancies</div>
                    </div>
                    <div class="bg-lime-900/30 p-6 rounded-2xl text-center border border-lime-500/20">
                        <div class="text-3xl font-bold text-lime-400 mb-1">TN</div>
                        <div class="text-sm text-lime-300 font-medium">State Level</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>