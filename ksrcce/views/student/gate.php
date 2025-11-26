<?php $path = 'student/gate.php'; ?>

<div class="min-h-screen bg-[#f8fafc] relative overflow-hidden pt-20">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-blue-100/50 blur-3xl"></div>
        <div class="absolute top-[20%] -right-[10%] w-[40%] h-[40%] rounded-full bg-indigo-100/50 blur-3xl"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[30%] h-[30%] rounded-full bg-sky-100/50 blur-3xl"></div>
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
            <a href="<?= $dashboardUrl ?>" class="inline-flex items-center px-4 py-2 rounded-xl bg-white/80 backdrop-blur-md border border-slate-200 text-slate-600 font-medium hover:text-blue-600 hover:bg-white hover:shadow-md transition-all duration-200 group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-blue-600 text-sm font-medium mb-4">
                <span class="flex h-2 w-2 rounded-full bg-blue-600 mr-2"></span>
                GATE Exam Preparation
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-slate-900 tracking-tight mb-4">
                Master Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Engineering Journey</span>
            </h1>
            <p class="text-lg text-slate-600 mb-8">
                Access comprehensive study materials, syllabus, and resources for your GATE preparation across all major engineering disciplines.
            </p>
            
            <div class="flex flex-wrap justify-center gap-4">
                <a href="https://gate2026.iitg.ac.in/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-6 py-3 rounded-xl bg-slate-900 text-white font-medium hover:bg-slate-800 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 duration-200">
                    Official Website
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
                <a href="#departments" class="inline-flex items-center px-6 py-3 rounded-xl bg-white text-slate-700 font-medium border border-slate-200 hover:bg-slate-50 transition-colors shadow-sm hover:shadow-md">
                    Browse Departments
                </a>
            </div>
        </div>

        <!-- Departments Grid -->
        <div id="departments" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-20">
            <?php
            $departments = [
                ['code' => 'cse', 'name' => 'Computer Science', 'desc' => 'CS & IT Engineering', 'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'blue'],
                ['code' => 'ece', 'name' => 'Electronics', 'desc' => 'EC Engineering', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'color' => 'indigo'],
                ['code' => 'mech', 'name' => 'Mechanical', 'desc' => 'ME Engineering', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 'color' => 'slate'],
                ['code' => 'civil', 'name' => 'Civil Engineering', 'desc' => 'CE Engineering', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => 'orange'],
                ['code' => 'ee', 'name' => 'Electrical', 'desc' => 'EE Engineering', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'color' => 'yellow'],
                ['code' => 'ae', 'name' => 'Aeronautical', 'desc' => 'AE Engineering', 'icon' => 'M12 19l9 2-9-18-9 18 9-2zm0 0v-8', 'color' => 'sky'],
                ['code' => 'aids', 'name' => 'AI & Data Science', 'desc' => 'AIDS Engineering', 'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'violet'],
                ['code' => 'bme', 'name' => 'Biomedical', 'desc' => 'BME Engineering', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'color' => 'rose'],
                ['code' => 'csd', 'name' => 'CS & Design', 'desc' => 'CSD Engineering', 'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01', 'color' => 'teal'],
                ['code' => 'cs', 'name' => 'Cyber Security', 'desc' => 'CS Engineering', 'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z', 'color' => 'emerald'],
                ['code' => 'iot', 'name' => 'Internet of Things', 'desc' => 'IoT Engineering', 'icon' => 'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0', 'color' => 'amber'],
                ['code' => 'it', 'name' => 'Information Tech', 'desc' => 'IT Engineering', 'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'cyan'],
                ['code' => 'sfe', 'name' => 'Safety & Fire', 'desc' => 'SFE Engineering', 'icon' => 'M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z', 'color' => 'red'],
                ['code' => 'mba', 'name' => 'MBA', 'desc' => 'Management', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'purple'],
                ['code' => 'mca', 'name' => 'MCA', 'desc' => 'Computer Applications', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4', 'color' => 'pink'],
            ];

            foreach ($departments as $dept):
                $bg_color = "bg-{$dept['color']}-50";
                $text_color = "text-{$dept['color']}-600";
            ?>
            <a href="/student/gate/<?= $dept['code'] ?>" class="group relative bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-slate-50 to-slate-100 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                
                <div class="relative z-10 flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl <?= $bg_color ?> <?= $text_color ?> flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $dept['icon'] ?>"></path>
                        </svg>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
                
                <div class="relative z-10 mt-auto">
                    <h3 class="text-lg font-bold text-slate-900 mb-1 group-hover:text-blue-600 transition-colors"><?= $dept['name'] ?></h3>
                    <p class="text-sm text-slate-500 font-medium"><?= $dept['desc'] ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- About Section -->
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-slate-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-bl-full opacity-50"></div>
            
            <div class="relative z-10 grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">About GATE Exam</h2>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        The Graduate Aptitude Test in Engineering (GATE) is a prestigious all-India examination that tests the comprehensive understanding of various undergraduate subjects in engineering and science.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-slate-700">Gateway to PSUs and Higher Education</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-slate-700">Valid for 3 years from results</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-slate-700">Conducted by IISc and 7 IITs</span>
                        </li>
                    </ul>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 p-6 rounded-2xl text-center">
                        <div class="text-3xl font-bold text-blue-600 mb-1">29+</div>
                        <div class="text-sm text-blue-800 font-medium">Subjects</div>
                    </div>
                    <div class="bg-indigo-50 p-6 rounded-2xl text-center">
                        <div class="text-3xl font-bold text-indigo-600 mb-1">3 Yr</div>
                        <div class="text-sm text-indigo-800 font-medium">Score Validity</div>
                    </div>
                    <div class="bg-sky-50 p-6 rounded-2xl text-center">
                        <div class="text-3xl font-bold text-sky-600 mb-1">100</div>
                        <div class="text-sm text-sky-800 font-medium">Total Marks</div>
                    </div>
                    <div class="bg-violet-50 p-6 rounded-2xl text-center">
                        <div class="text-3xl font-bold text-violet-600 mb-1">Feb</div>
                        <div class="text-sm text-violet-800 font-medium">Exam Month</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>