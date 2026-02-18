<?php $path = 'student/banking.php'; ?>

<div class="min-h-screen bg-transparent relative overflow-hidden pt-20">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-blue-900/20 blur-3xl"></div>
        <div class="absolute top-[20%] -right-[10%] w-[40%] h-[40%] rounded-full bg-indigo-900/20 blur-3xl"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[30%] h-[30%] rounded-full bg-sky-900/20 blur-3xl"></div>
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
            <a href="<?= $dashboardUrl ?>" class="inline-flex items-center px-4 py-2 rounded-xl bg-gray-800/60 backdrop-blur-md border border-white/10 text-gray-300 font-medium hover:text-blue-400 hover:bg-gray-800 hover:shadow-md transition-all duration-200 group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-900/30 border border-blue-500/30 text-blue-400 text-sm font-medium mb-4">
                <span class="flex h-2 w-2 rounded-full bg-blue-500 mr-2"></span>
                Banking Exam Preparation
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">
                Achieve Your Dream <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">Banking Career</span>
            </h1>
            <p class="text-lg text-gray-300 mb-8">
                Prepare for IBPS, SBI, RBI, and other banking exams with our comprehensive resources, mock tests, and study materials.
            </p>
            
            <div class="flex flex-wrap justify-center gap-4">
                <a href="https://www.ibps.in/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-6 py-3 rounded-xl bg-blue-600 text-white font-medium hover:bg-blue-700 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 duration-200">
                    Official Website
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
                <a href="#exams" class="inline-flex items-center px-6 py-3 rounded-xl bg-gray-800/60 text-white font-medium border border-white/10 hover:bg-gray-700/60 transition-colors shadow-sm hover:shadow-md">
                    Browse Exams
                </a>
            </div>
        </div>

        <!-- Exams Grid -->
        <div id="exams" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 mb-20">
            <?php
            $exams = [
                ['url' => '/student/banking/ibps-po', 'name' => 'IBPS PO', 'desc' => 'Probationary Officer', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => 'blue'],
                ['url' => '/student/banking/ibps-clerk', 'name' => 'IBPS Clerk', 'desc' => 'Clerical Cadre', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'indigo'],
                ['url' => '/student/banking/sbi-po', 'name' => 'SBI PO', 'desc' => 'State Bank Probationary Officer', 'icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z', 'color' => 'sky'],
                ['url' => '/student/banking/sbi-clerk', 'name' => 'SBI Clerk', 'desc' => 'Junior Associates', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'teal'],
                ['url' => '/student/banking/rrb', 'name' => 'IBPS RRB', 'desc' => 'Regional Rural Banks', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'green'],
                ['url' => '/student/banking/rbi', 'name' => 'RBI Grade B', 'desc' => 'Reserve Bank of India', 'icon' => 'M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z', 'color' => 'orange'],
            ];

            foreach ($exams as $exam):
                $bg_color = "bg-{$exam['color']}-900/30";
                $text_color = "text-{$exam['color']}-400";
            ?>
            <a href="<?= $exam['url'] ?>" class="group relative bg-gray-800/60 rounded-2xl p-6 shadow-sm border border-white/10 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full overflow-hidden hover:bg-gray-700/60">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-gray-800 to-gray-700 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110 opacity-50"></div>
                
                <div class="relative z-10 flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl <?= $bg_color ?> <?= $text_color ?> flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $exam['icon'] ?>"></path>
                        </svg>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-gray-700/50 flex items-center justify-center text-gray-400 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
                
                <div class="relative z-10 mt-auto">
                    <h3 class="text-lg font-bold text-white mb-1 group-hover:text-blue-400 transition-colors"><?= $exam['name'] ?></h3>
                    <p class="text-sm text-gray-400 font-medium"><?= $exam['desc'] ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>



        <!-- About Section -->
        <div class="bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 md:p-12 shadow-sm border border-white/10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-900/20 to-indigo-900/20 rounded-bl-full opacity-50"></div>
            
            <div class="relative z-10 grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4">About Banking Exams</h2>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Banking exams operate as the gateway to a prestigious career in the financial sector. Major recruiting bodies include IBPS, SBI, and RBI, conducting exams for various posts like PO, Clerk, and SO.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-300">Recruitment for Nationalized Banks & SBI</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-300">Online Computer Based Tests (CBT)</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-300">Prelims, Mains, and Interview Stages</span>
                        </li>
                    </ul>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-900/30 p-6 rounded-2xl text-center border border-blue-500/20">
                        <div class="text-3xl font-bold text-blue-400 mb-1">11+</div>
                        <div class="text-sm text-blue-300 font-medium">Public Sector Banks</div>
                    </div>
                    <div class="bg-indigo-900/30 p-6 rounded-2xl text-center border border-indigo-500/20">
                        <div class="text-3xl font-bold text-indigo-400 mb-1">SBI</div>
                        <div class="text-sm text-indigo-300 font-medium">Largest Recruiter</div>
                    </div>
                    <div class="bg-sky-900/30 p-6 rounded-2xl text-center border border-sky-500/20">
                        <div class="text-3xl font-bold text-sky-400 mb-1">IBPS</div>
                        <div class="text-sm text-sky-300 font-medium">Exam Body</div>
                    </div>
                    <div class="bg-teal-900/30 p-6 rounded-2xl text-center border border-teal-500/20">
                        <div class="text-3xl font-bold text-teal-400 mb-1">Every Year</div>
                        <div class="text-sm text-teal-300 font-medium">Notifications</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
