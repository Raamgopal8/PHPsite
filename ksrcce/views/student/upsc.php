<?php $path = 'student/upsc.php'; ?>

<div class="min-h-screen bg-transparent relative overflow-hidden pt-20">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-orange-900/20 blur-3xl"></div>
        <div class="absolute top-[20%] -right-[10%] w-[40%] h-[40%] rounded-full bg-amber-900/20 blur-3xl"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[30%] h-[30%] rounded-full bg-yellow-900/20 blur-3xl"></div>
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
            <a href="<?= $dashboardUrl ?>" class="inline-flex items-center px-4 py-2 rounded-xl bg-gray-800/60 backdrop-blur-md border border-white/10 text-gray-300 font-medium hover:text-orange-400 hover:bg-gray-800 hover:shadow-md transition-all duration-200 group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center px-3 py-1 rounded-full bg-orange-900/30 border border-orange-500/30 text-orange-400 text-sm font-medium mb-4">
                <span class="flex h-2 w-2 rounded-full bg-orange-500 mr-2"></span>
                UPSC Exam Preparation
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">
                Lead the Nation with <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-400">Distinction</span>
            </h1>
            <p class="text-lg text-gray-300 mb-8">
                Comprehensive preparation for Civil Services Examination (CSE) including Prelims, Mains, and Interview guidance.
            </p>
            
            <div class="flex flex-wrap justify-center gap-4">
                <a href="https://upsc.gov.in/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-6 py-3 rounded-xl bg-orange-600 text-white font-medium hover:bg-orange-700 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 duration-200">
                    Official Website
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
                <a href="#stages" class="inline-flex items-center px-6 py-3 rounded-xl bg-gray-800/60 text-white font-medium border border-white/10 hover:bg-gray-700/60 transition-colors shadow-sm hover:shadow-md">
                    Browse Stages
                </a>
            </div>
        </div>

        <!-- Exams Grid -->
        <div id="exams" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-20">
            <?php
            $exams = [
                [
                    'url' => '/student/upsc/cse', 
                    'name' => 'Civil Services (CSE) 2026', 
                    'desc' => 'For IAS, IPS, IFS, and Central Services Group A/B. Prelims: May 24, 2026; Mains: Aug 21, 2026.', 
                    'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 
                    'color' => 'orange'
                ],
                [
                    'url' => '/student/upsc/ifos', 
                    'name' => 'Indian Forest Service (IFoS) 2026', 
                    'desc' => 'Conducted along with CSE Prelims for forest service officers.', 
                    'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 
                    'color' => 'green'
                ],
                [
                    'url' => '/student/upsc/ese', 
                    'name' => 'Engineering Services (IES/ESE) 2026', 
                    'desc' => 'Technical services for Engineers (Civil, Mechanical, Electrical, Electronics).', 
                    'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 
                    'color' => 'blue'
                ],
                [
                    'url' => '/student/upsc/cds', 
                    'name' => 'Combined Defence Services (CDS) 2026', 
                    'desc' => 'For Army, Navy, Air Force officer training (Held twice yearly).', 
                    'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 
                    'color' => 'teal'
                ],
                [
                    'url' => '/student/upsc/nda', 
                    'name' => 'NDA & NA Examination 2026', 
                    'desc' => 'For 12th-pass students entering Armed Forces (Army, Navy, Air Force).', 
                    'icon' => 'M12 19l9 2-9-18-9 18 9-2zm0 0v-8', 
                    'color' => 'indigo'
                ],
                [
                    'url' => '/student/upsc/cms', 
                    'name' => 'Combined Medical Services (CMS) 2026', 
                    'desc' => 'For medical officers in central organizations.', 
                    'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 
                    'color' => 'red'
                ],
                [
                    'url' => '/student/upsc/capf', 
                    'name' => 'Central Armed Police Forces (CAPF) 2026', 
                    'desc' => 'For Assistant Commandants in BSF, CRPF, CISF, ITBP.', 
                    'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 
                    'color' => 'emerald'
                ],
                [
                    'url' => '/student/upsc/geoscientist', 
                    'name' => 'Combined Geo-Scientist Exam 2026', 
                    'desc' => 'For Geologists, Geophysicists, and Chemists in GSI and CGWB.', 
                    'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 
                    'color' => 'amber'
                ],
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
                    <div class="w-8 h-8 rounded-full bg-gray-700/50 flex items-center justify-center text-gray-400 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
                
                <div class="relative z-10 mt-auto">
                    <h3 class="text-lg font-bold text-white mb-1 group-hover:text-orange-400 transition-colors"><?= $exam['name'] ?></h3>
                    <p class="text-sm text-gray-400 font-medium"><?= $exam['desc'] ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- About Section -->
        <div class="bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 md:p-12 shadow-sm border border-white/10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-orange-900/20 to-amber-900/20 rounded-bl-full opacity-50"></div>
            
            <div class="relative z-10 grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4">About UPSC CSE</h2>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        The Civil Services Examination (CSE) is a nationwide competitive examination in India conducted by the Union Public Service Commission (UPSC) for recruitment to various Civil Services of the Government of India.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-orange-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-300">Premier Civil Services Recruitment</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-orange-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-300">IAS, IPS, IFS, and Central Services</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-orange-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-300">Three-stage Selection Process</span>
                        </li>
                    </ul>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-orange-900/30 p-6 rounded-2xl text-center border border-orange-500/20">
                        <div class="text-3xl font-bold text-orange-400 mb-1">3</div>
                        <div class="text-sm text-orange-300 font-medium">Exam Stages</div>
                    </div>
                    <div class="bg-amber-900/30 p-6 rounded-2xl text-center border border-amber-500/20">
                        <div class="text-3xl font-bold text-amber-400 mb-1">24+</div>
                        <div class="text-sm text-amber-300 font-medium">Services</div>
                    </div>
                    <div class="bg-yellow-900/30 p-6 rounded-2xl text-center border border-yellow-500/20">
                        <div class="text-3xl font-bold text-yellow-400 mb-1">1M+</div>
                        <div class="text-sm text-yellow-300 font-medium">Aspirants</div>
                    </div>
                    <div class="bg-red-900/30 p-6 rounded-2xl text-center border border-red-500/20">
                        <div class="text-3xl font-bold text-red-400 mb-1">Yearly</div>
                        <div class="text-sm text-red-300 font-medium">Cycle</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
