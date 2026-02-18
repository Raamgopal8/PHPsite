<?php $path = 'student/dashboard.php'; ?>

<div class="min-h-screen p-6 pt-12">
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- Page Header -->
        <div class="bg-gray-900/60 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/10">
            <h1 class="text-3xl font-bold text-white tracking-tight">Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?>!</h1>
            <p class="mt-2 text-gray-400">Ready to continue your learning journey?</p>
            
            <?php if(!empty($_SESSION['flash']['success'])): ?>
                <div class="mt-6 p-4 bg-green-900/30 backdrop-blur border border-green-800/50 text-green-400 rounded-xl flex items-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium"><?= htmlspecialchars($_SESSION['flash']['success']); unset($_SESSION['flash']['success']); ?></span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Exams -->
            <div class="group bg-gray-800/60 backdrop-blur-xl rounded-2xl p-6 border border-white/10 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 hover:bg-gray-800/80">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Total Exams</p>
                        <p class="text-3xl font-bold text-white mt-2"><?= count($exams) ?></p>
                    </div>
                    <div class="p-4 rounded-xl bg-blue-900/30 text-blue-400 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completed Exams -->
            <div class="group bg-gray-800/60 backdrop-blur-xl rounded-2xl p-6 border border-white/10 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 hover:bg-gray-800/80">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Completed</p>
                        <p class="text-3xl font-bold text-white mt-2">0</p>
                    </div>
                    <div class="p-4 rounded-xl bg-green-900/30 text-green-400 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Average Score -->
            <div class="group bg-gray-800/60 backdrop-blur-xl rounded-2xl p-6 border border-white/10 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 hover:bg-gray-800/80">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Avg. Score</p>
                        <p class="text-3xl font-bold text-white mt-2">-</p>
                    </div>
                    <div class="p-4 rounded-xl bg-yellow-900/30 text-yellow-400 group-hover:bg-yellow-600 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Upcoming Deadlines -->
            <div class="group bg-gray-800/60 backdrop-blur-xl rounded-2xl p-6 border border-white/10 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 hover:bg-gray-800/80">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Upcoming</p>
                        <p class="text-3xl font-bold text-white mt-2"><?= count($exams) ?></p>
                    </div>
                    <div class="p-4 rounded-xl bg-purple-900/30 text-purple-400 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exam Countdowns -->
        <div class="bg-gray-900/60 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/10">
            <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                <span class="bg-red-900/30 p-2 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                Exam Countdowns
            </h2>
            <div id="exam-countdowns" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Countdowns will be loaded here via JavaScript -->
                <div class="col-span-full text-center py-12 rounded-2xl bg-gray-800/30 border border-dashed border-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-600 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-2 text-sm text-gray-500">Loading countdowns...</p>
                </div>
            </div>
        </div>

        <!-- Domain Selection -->
        <div class="bg-gray-900/60 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/10">
             <h2 class="text-xl font-bold text-white mb-6">Choose Your Domain</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
              
                <a href="/student/gate" class="group flex items-center p-4 rounded-2xl bg-gray-800/60 border border-white/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:bg-gray-700/60 hover:border-blue-500/50">
                    <div class="w-16 h-16 mr-4 flex-shrink-0">
                        <img src="/assets/gate.png" alt="GATE Exam" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="flex-1">
                         <span class="text-lg font-bold text-gray-200 group-hover:text-blue-400 transition-colors">GATE</span>
                    </div>
                </a>
              
                <a href="/student/tnpsc" class="group flex items-center p-4 rounded-2xl bg-gray-800/60 border border-white/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:bg-gray-700/60 hover:border-green-500/50">
                    <div class="w-16 h-16 mr-4 flex-shrink-0">
                        <img src="/assets/tnpsc.png" alt="TNPSC Exam" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="flex-1">
                        <span class="text-lg font-bold text-gray-200 group-hover:text-green-400 transition-colors">TNPSC</span>
                    </div>
                </a>

                <a href="/student/banking" class="group flex items-center p-2 rounded-2xl bg-gray-800/60 border border-white/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:bg-gray-700/60 hover:border-indigo-500/50">
                    <div class="w-16 h-16 mr-4 flex-shrink-0">
                        <img src="/assets/Bank.png" alt="Banking Exam" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="flex-1">
                        <span class="text-lg font-bold text-gray-200 group-hover:text-indigo-400 transition-colors">Banking</span>
                    </div>
                </a>

                <a href="/student/upsc" class="group flex items-center p-4 rounded-2xl bg-gray-800/60 border border-white/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:bg-gray-700/60 hover:border-orange-500/50">
                    <div class="w-16 h-16 mr-4 flex-shrink-0">
                        <img src="/assets/upsc.jpeg" alt="UPSC Exam" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="flex-1">
                        <span class="text-lg font-bold text-gray-200 group-hover:text-orange-400 transition-colors">UPSC</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Upcoming Exams -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-gray-900/60 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/10">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-xl font-bold text-white">Available Exams</h2>
                            <p class="text-sm text-gray-400">Exams you can take right now</p>
                        </div>
                        <a href="#" class="text-sm font-medium text-blue-400 hover:text-blue-300 hover:underline">View All</a>
                    </div>

                    <div class="space-y-4">
                        <?php if (empty($exams)): ?>
                            <div class="text-center py-12 rounded-2xl bg-gray-800/30 border border-dashed border-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">No available exams</p>
                            </div>
                        <?php else: ?>
                            <?php foreach($exams as $e): ?>
                                <div class="group flex items-center justify-between p-4 bg-gray-800/40 hover:bg-gray-700/60 rounded-2xl border border-white/10 hover:border-white/20 hover:shadow-lg transition-all duration-300">
                                    <div class="flex items-center space-x-4">
                                        <div class="h-12 w-12 rounded-xl bg-blue-900/30 text-blue-400 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-white group-hover:text-blue-400 transition-colors"><?= htmlspecialchars($e['title']) ?></h3>
                                            <p class="text-xs text-gray-400 font-medium bg-gray-700/50 inline-block px-2 py-0.5 rounded-md mt-1">30 MINS</p>
                                        </div>
                                    </div>
                                    <a href="/student/take?id=<?= urlencode((string)($e['id'] ?? '')) ?>" class="inline-flex items-center px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-900/30 hover:shadow-blue-900/50 transition-all active:scale-95">
                                        Start Exam
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Featured Achievements -->
                <div class="bg-gray-900/60 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/10">
                     <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-xl font-bold text-white">Hall of Fame</h2>
                            <p class="text-sm text-gray-400">Top performers and achievers</p>
                        </div>
                    </div>
                    <div id="featured-achievements" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Featured achievements will be loaded here -->
                        <div class="col-span-full text-center py-12 rounded-2xl bg-gray-800/30 border border-dashed border-gray-700">
                             <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-600 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Loading achievements...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                 <!-- Official Links -->
                <div class="bg-gray-900/60 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/10">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-xl font-bold text-white">Official Links</h2>
                            <p class="text-sm text-gray-400">Quick access</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php
                        $officialLinks = [];
                        try {
                            $db = (new \App\Core\App())->db;
                            $stmt = $db->prepare("SELECT * FROM official_links ORDER BY created_at DESC");
                            $stmt->execute();
                            $officialLinks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (Exception $e) {}
                        ?>
                        <?php if (empty($officialLinks)): ?>
                            <div class="text-center py-8 text-gray-500">
                                <p class="text-sm">No links available</p>
                            </div>
                        <?php else: ?>
                            <?php foreach($officialLinks as $link): ?>
                                <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" rel="noopener noreferrer" class="group flex items-center p-3 bg-gray-800/40 hover:bg-gray-700/60 rounded-2xl border border-white/10 hover:border-white/20 transition-all duration-300 shadow-sm hover:shadow-md">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-xl bg-blue-900/30 text-blue-400 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 flex-1 min-w-0">
                                        <h3 class="text-sm font-bold text-gray-200 truncate group-hover:text-blue-400 transition-colors"><?= htmlspecialchars($link['title']) ?></h3>
                                        <p class="text-xs text-blue-400 truncate">Visit Link</p>
                                    </div>
                                    <div class="ml-2">
                                         <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>



                <!-- Recent Achievements -->
                <div class="bg-gray-900/60 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/10">
                     <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-xl font-bold text-white">Recent</h2>
                            <p class="text-sm text-gray-400">Latest achievements</p>
                        </div>
                    </div>
                    <div id="recent-achievements" class="space-y-4">
                        <!-- Recent achievements will be loaded here -->
                        <div class="text-center py-8 text-gray-500">
                            <p class="text-sm">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
// Load exam countdowns
function loadExamCountdowns() {
    fetch('/api/exam-countdowns')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('exam-countdowns');
            
            if (data.countdowns && data.countdowns.length > 0) {
                container.innerHTML = data.countdowns.map(countdown => {
                    const exam = countdown.exam;
                    const isUrgent = countdown.days <= 7;
                    const isVeryUrgent = countdown.days <= 3;
                    
                    return `
                        <div class="group bg-gray-800/60 backdrop-blur-lg rounded-2xl p-6 border border-white/10 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden hover:bg-gray-700/80">
                            ${isVeryUrgent ? '<div class="absolute top-0 right-0 w-16 h-16 bg-red-500/10 rounded-bl-full -mr-8 -mt-8"></div>' : ''}
                            
                            <div class="flex items-center justify-between mb-6 relative">
                                <h3 class="font-bold text-white group-hover:text-blue-400 transition-colors">${exam.exam_name}</h3>
                                <span class="px-3 py-1 text-xs font-bold rounded-full ${
                                    isVeryUrgent ? 'bg-red-900/30 text-red-400' : 
                                    isUrgent ? 'bg-yellow-900/30 text-yellow-400' : 
                                    'bg-blue-900/30 text-blue-400'
                                }">
                                    ${isVeryUrgent ? 'Very Urgent' : isUrgent ? 'Urgent' : 'Upcoming'}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-4 gap-2 text-center mb-6">
                                <div class="bg-gray-700/50 rounded-xl p-2">
                                    <div class="text-xl font-bold ${isVeryUrgent ? 'text-red-400' : isUrgent ? 'text-yellow-400' : 'text-white'}">${countdown.days}</div>
                                    <div class="text-[10px] uppercase font-bold text-gray-500">Days</div>
                                </div>
                                <div class="bg-gray-700/50 rounded-xl p-2">
                                    <div class="text-xl font-bold ${isVeryUrgent ? 'text-red-400' : isUrgent ? 'text-yellow-400' : 'text-white'}">${countdown.hours}</div>
                                    <div class="text-[10px] uppercase font-bold text-gray-500">Hrs</div>
                                </div>
                                <div class="bg-gray-700/50 rounded-xl p-2">
                                    <div class="text-xl font-bold ${isVeryUrgent ? 'text-red-400' : isUrgent ? 'text-yellow-400' : 'text-white'}">${countdown.minutes}</div>
                                    <div class="text-[10px] uppercase font-bold text-gray-500">Mins</div>
                                </div>
                                <div class="bg-gray-700/50 rounded-xl p-2">
                                    <div class="text-xl font-bold ${isVeryUrgent ? 'text-red-400' : isUrgent ? 'text-yellow-400' : 'text-white'}">${countdown.seconds}</div>
                                    <div class="text-[10px] uppercase font-bold text-gray-500">Secs</div>
                                </div>
                            </div>
                            
                            <div class="space-y-2 text-sm text-gray-500">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    ${new Date(exam.exam_date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    ${new Date('1970-01-01T' + exam.exam_time).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })}
                                </div>
                            </div>
                        </div>
                    `;
                }).join('');
                
                setInterval(updateCountdowns, 1000);
            } else {
                container.innerHTML = `
                    <div class="col-span-full text-center py-12 rounded-2xl bg-gray-800/30 border border-dashed border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">No upcoming exams scheduled.</p>
                    </div>
                `;
            }
        })
        .catch(error => { console.error(error); });
}

function updateCountdowns() {
    const countdownElements = document.querySelectorAll('#exam-countdowns .grid');
    countdownElements.forEach(element => {
        const timeElements = element.querySelectorAll('.text-xl');
        if (timeElements.length === 4) {
             let days = parseInt(timeElements[0].textContent);
            let hours = parseInt(timeElements[1].textContent);
            let minutes = parseInt(timeElements[2].textContent);
            let seconds = parseInt(timeElements[3].textContent);
            
            seconds--;
            if (seconds < 0) {
                seconds = 59; minutes--;
                if (minutes < 0) {
                    minutes = 59; hours--;
                    if (hours < 0) {
                        hours = 23; days--;
                        if (days < 0) { location.reload(); return; }
                    }
                }
            }
            timeElements[0].textContent = days;
            timeElements[1].textContent = hours;
            timeElements[2].textContent = minutes;
            timeElements[3].textContent = seconds;
        }
    });
}

// Load achievements when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadExamCountdowns();
    loadAchievements();
});

function loadAchievements() {
    fetch('/api/achievements')
        .then(response => response.json())
        .then(data => {
            // Load featured achievements
            const featuredContainer = document.getElementById('featured-achievements');
            if (data.featured && data.featured.length > 0) {
                featuredContainer.innerHTML = data.featured.map(achievement => createFeaturedAchievementCard(achievement)).join('');
            } else {
                featuredContainer.innerHTML = `
                    <div class="col-span-full text-center py-12 rounded-2xl bg-gray-800/30 border border-dashed border-gray-700">
                         <p class="text-sm text-gray-500">No featured achievements yet.</p>
                    </div>
                `;
            }

            // Load recent achievements
            const recentContainer = document.getElementById('recent-achievements');
            if (data.recent && data.recent.length > 0) {
                recentContainer.innerHTML = data.recent.map(achievement => createRecentAchievementCard(achievement)).join('');
            } else {
                recentContainer.innerHTML = `
                     <div class="text-center py-8 text-gray-500">
                        <p class="text-sm">No recent achievements.</p>
                    </div>
                `;
            }
        })
        .catch(error => { console.error(error); });
}

function createFeaturedAchievementCard(achievement) {
    return `
        <div class="group bg-gray-800/60 backdrop-blur-lg rounded-2xl p-6 border border-white/10 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden hover:bg-gray-700/80">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l2.8-2.034a1 1 0 011.118 0l2.8 2.034c.783.57 1.838-.197 1.538-1.81l-1.07-3.292a1 1 0 00.364-1.118L18.46 4.72c.783-.57.383-1.81-.588-1.81h-3.462a1 1 0 01-.95-.69L10.95 2.927z" />
                </svg>
            </div>

            <div class="flex items-center mb-6 relative">
                 ${achievement.image_url ? `
                    <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-sm mr-4 flex-shrink-0">
                        <img src="${achievement.image_url}" alt="${achievement.student_name}" class="w-full h-full object-cover">
                    </div>
                ` : `
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-2xl flex items-center justify-center mr-4 shadow-sm flex-shrink-0">
                        <span class="text-2xl font-bold text-white">${achievement.student_name.charAt(0)}</span>
                    </div>
                `}
                <div>
                    <h4 class="text-lg font-bold text-white group-hover:text-yellow-400 transition-colors">${achievement.student_name}</h4>
                    <p class="text-sm font-medium text-gray-400">${achievement.exam_name}</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-2 mb-4">
                 <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-900/30 text-yellow-500">
                    🏆 ${achievement.rank_or_score}
                </span>
                ${achievement.department ? `
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-700/50 text-gray-300">
                        ${achievement.department}
                    </span>
                ` : ''}
            </div>
            
            ${achievement.achievement_description ? `
                <p class="text-sm text-gray-400 mb-4 line-clamp-2">${achievement.achievement_description}</p>
            ` : ''}
            
            <div class="flex items-center justify-between pt-4 border-t border-gray-700/50 text-xs text-gray-500 font-medium">
                <span>${achievement.batch_year ? `Batch ${achievement.batch_year}` : ''}</span>
                <span>${new Date(achievement.created_at).toLocaleDateString()}</span>
            </div>
        </div>
    `;
}

function createRecentAchievementCard(achievement) {
    return `
        <div class="group flex items-center p-3 bg-gray-800/40 hover:bg-gray-700/60 rounded-2xl border border-white/10 hover:border-white/20 hover:shadow-lg transition-all duration-300">
              ${achievement.image_url ? `
                 <div class="w-10 h-10 rounded-xl overflow-hidden shadow-sm mr-3 flex-shrink-0">
                    <img src="${achievement.image_url}" alt="${achievement.student_name}" class="w-full h-full object-cover">
                </div>
            ` : `
                <div class="w-10 h-10 bg-blue-900/40 rounded-xl flex items-center justify-center mr-3 shadow-sm flex-shrink-0">
                    <span class="text-sm font-bold text-blue-400">${achievement.student_name.charAt(0)}</span>
                </div>
            `}
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between mb-0.5">
                     <h5 class="text-sm font-bold text-gray-200 truncate group-hover:text-blue-400 transition-colors">${achievement.student_name}</h5>
                     <span class="text-xs font-bold text-green-400 bg-green-900/30 px-1.5 py-0.5 rounded-lg">${achievement.rank_or_score}</span>
                </div>
                <p class="text-xs text-gray-500 truncate">${achievement.exam_name}</p>
            </div>
        </div>
    `;
}
</script>
