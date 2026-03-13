<?php $path = 'achievers_gallery.php'; ?>
<div class="min-h-screen p-6 pt-12">
    <div class="max-w-7xl mx-auto space-y-12">
        <!-- Header -->
        <div class="bg-gray-900/60 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/10 text-center relative overflow-hidden group print:hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-yellow-500/10 via-purple-500/10 to-blue-500/10"></div>
            
            <!-- Print Button -->
            <button onclick="window.print()" class="absolute top-6 right-6 p-3 bg-white/10 hover:bg-white/20 rounded-xl border border-white/10 transition-all duration-300 group/print z-20 flex items-center gap-2" title="Print this page">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 group-hover/print:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span class="text-xs font-bold text-white opacity-0 group-hover/print:opacity-100 transition-opacity">PRINT</span>
            </button>

            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500 mb-4 relative z-10">Hall of Fame</h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto relative z-10">Celebrating the outstanding achievements of our top performers across all years. These students have set the benchmark for excellence.</p>
        </div>

        <!-- Print-only Title -->
        <div class="hidden print:block text-center border-b-2 border-gray-800 pb-6 mb-8">
            <div class="flex items-center justify-center gap-6 mb-4">
                <img src="/assets/KSR College of Engineering.jpg" alt="Logo" class="h-20 w-20 object-contain">
                <div class="text-left">
                    <div class="text-2xl font-bold text-gray-900 uppercase tracking-widest mb-1">KSR COLLEGE OF ENGINEERING</div>
                    <div class="text-lg font-medium text-gray-600 uppercase">Tiruchengode</div>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-black border-t-2 border-gray-100 pt-4">HALL OF FAME</h1>
            <p class="text-sm text-gray-500 mt-2 italic">Official achievement records as of <?= date('F d, Y') ?></p>
        </div>

        <?php if(empty($achieversByYear)): ?>
            <div class="text-center py-16 bg-gray-900/60 backdrop-blur-xl rounded-3xl border border-white/10 shadow-lg">
                <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="text-xl font-medium text-gray-400">No achievements recorded yet</h3>
            </div>
        <?php else: ?>
            <?php foreach($achieversByYear as $year => $achievers): ?>
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <h2 class="text-3xl font-bold text-white">Batch of <?= htmlspecialchars($year) ?></h2>
                        <div class="h-px bg-gradient-to-r from-gray-700 to-transparent flex-1"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php foreach($achievers as $achiever): ?>
                            <div class="bg-gray-800/60 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden hover:border-yellow-500/50 hover:shadow-2xl hover:shadow-yellow-500/10 hover:-translate-y-1 transition-all duration-300 group flex flex-col">
                                <?php if($achiever['image_url']): ?>
                                    <div class="h-56 w-full relative overflow-hidden bg-gray-900 flex-shrink-0">
                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent z-10"></div>
                                        <img src="<?= htmlspecialchars($achiever['image_url']) ?>" alt="<?= htmlspecialchars($achiever['student_name']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        <div class="absolute bottom-4 left-4 right-4 z-20 flex justify-between items-end">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-500 text-gray-900 shadow-lg select-none">
                                                🏆 <?= htmlspecialchars($achiever['rank_or_score']) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="h-56 w-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center relative flex-shrink-0">
                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent z-10"></div>
                                        <span class="text-7xl font-bold text-gray-600 select-none"><?= substr($achiever['student_name'], 0, 1) ?></span>
                                        <div class="absolute bottom-4 left-4 right-4 z-20 flex justify-between items-end">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-500 text-gray-900 shadow-lg select-none">
                                                🏆 <?= htmlspecialchars($achiever['rank_or_score']) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="p-6 flex-1 flex flex-col">
                                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-yellow-400 transition-colors line-clamp-1" title="<?= htmlspecialchars($achiever['student_name']) ?>">
                                        <?= htmlspecialchars($achiever['student_name']) ?>
                                    </h3>
                                    
                                    <?php if($achiever['department']): ?>
                                        <p class="text-sm text-gray-400 mb-4"><?= htmlspecialchars($achiever['department']) ?></p>
                                    <?php endif; ?>

                                    <div class="mt-auto bg-gray-900/50 rounded-xl p-4 border border-white/5 space-y-3">
                                        <div class="flex flex-col gap-1">
                                            <span class="text-xs uppercase font-bold tracking-wider text-gray-500">Exam</span>
                                            <span class="text-sm font-medium text-blue-400"><?= htmlspecialchars($achiever['exam_name']) ?></span>
                                        </div>
                                        <?php if($achiever['achievement_description']): ?>
                                            <div class="pt-3 border-t border-gray-700/50">
                                                <p class="text-xs text-gray-400 line-clamp-3 italic" title="<?= htmlspecialchars($achiever['achievement_description']) ?>">
                                                    "<?= htmlspecialchars($achiever['achievement_description']) ?>"
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<style>
    @media print {
        header, footer, .fixed, .bg-fixed, .print\:hidden {
            display: none !important;
        }
        
        body {
            background: white !important;
            color: black !important;
            padding: 0 !important;
        }

        .min-h-screen {
            min-height: auto !important;
            padding: 0 !important;
        }

        .max-w-7xl {
            max-width: 100% !important;
        }

        .gap-6 {
            gap: 1.5rem !important;
        }

        .grid {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .bg-gray-800\/60, .bg-gray-900\/60, .bg-gray-900\/50, .bg-gray-900 {
            background-color: white !important;
            border-color: #e5e7eb !important;
            box-shadow: none !important;
            backdrop-filter: none !important;
        }

        .text-white, .text-gray-300, .text-gray-400 {
            color: #1f2937 !important;
        }

        .text-yellow-400, .text-orange-500, .text-blue-400 {
            color: black !important;
            font-weight: bold !important;
        }

        .bg-yellow-500 {
            background-color: #f3f4f6 !important;
            border: 1px solid #d1d5db !important;
            color: black !important;
        }

        .rounded-2xl, .rounded-3xl, .rounded-xl {
            border-radius: 0.5rem !important;
        }

        .shadow-2xl, .shadow-lg, .shadow-md {
            box-shadow: none !important;
        }

        .border-white\/10, .border-white\/5 {
            border-color: #e5e7eb !important;
        }

        .h-56 {
            height: 180px !important;
        }

        .p-6 {
            padding: 1rem !important;
        }

        .space-y-12 {
            margin-top: 0 !important;
        }

        /* Ensure images print well */
        img {
            max-width: 100% !important;
            page-break-inside: avoid !important;
            filter: grayscale(100%);
        }

        /* Hide the year background line and adjust typography */
        .h-px {
            background: #e5e7eb !important;
        }

        h2.text-3xl {
            font-size: 1.5rem !important;
            color: black !important;
            margin-bottom: 0.5rem !important;
        }

        h3.text-xl {
            font-size: 1.1rem !important;
            margin-bottom: 0.25rem !important;
        }
        
        .line-clamp-1, .line-clamp-2, .line-clamp-3 {
            -webkit-line-clamp: unset !important;
            display: block !important;
        }
    }
</style>
