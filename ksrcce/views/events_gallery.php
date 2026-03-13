<?php $path = 'events_gallery.php'; ?>
<div class="min-h-screen p-6 pt-12">
    <div class="max-w-7xl mx-auto space-y-12">
        <!-- Header -->
        <div class="bg-gray-900/60 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/10 text-center relative overflow-hidden group print:hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 via-purple-500/10 to-pink-500/10"></div>
            
            <!-- Print Button -->
            <button onclick="window.print()" class="absolute top-6 right-6 p-3 bg-white/10 hover:bg-white/20 rounded-xl border border-white/10 transition-all duration-300 group/print z-20 flex items-center gap-2" title="Print this page">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400 group-hover/print:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span class="text-xs font-bold text-white opacity-0 group-hover/print:opacity-100 transition-opacity">PRINT</span>
            </button>

            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500 mb-4 relative z-10">Campus Events</h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto relative z-10">Relive the moments and explore the vibrant activities that make our campus come alive.</p>
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
            <h1 class="text-3xl font-bold text-black border-t-2 border-gray-100 pt-4">CAMPUS EVENTS GALLERY</h1>
            <p class="text-sm text-gray-500 mt-2 italic">Event history as of <?= date('F d, Y') ?></p>
        </div>

        <?php if(empty($eventsByYear)): ?>
            <div class="text-center py-16 bg-gray-900/60 backdrop-blur-xl rounded-3xl border border-white/10 shadow-lg">
                <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-xl font-medium text-gray-400">No events recorded yet</h3>
            </div>
        <?php else: ?>
            <?php foreach($eventsByYear as $year => $events): ?>
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <h2 class="text-3xl font-bold text-white"><?= htmlspecialchars($year) ?> Events</h2>
                        <div class="h-px bg-gradient-to-r from-gray-700 to-transparent flex-1"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php foreach($events as $event): ?>
                            <div class="bg-gray-800/60 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden hover:border-indigo-500/50 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-1 transition-all duration-300 group flex flex-col">
                                <?php if($event['image_url']): ?>
                                    <div class="h-56 w-full relative overflow-hidden bg-gray-900 flex-shrink-0">
                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent z-10"></div>
                                        <img src="<?= htmlspecialchars($event['image_url']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        <div class="absolute bottom-4 left-4 right-4 z-20 flex justify-between items-end">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-indigo-500 text-white shadow-lg select-none">
                                                📅 <?= date('M d', strtotime($event['event_date'])) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="h-56 w-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center relative flex-shrink-0">
                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent z-10"></div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-600 relative z-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div class="absolute bottom-4 left-4 right-4 z-20 flex justify-between items-end">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-indigo-500 text-white shadow-lg select-none">
                                                📅 <?= date('M d', strtotime($event['event_date'])) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="p-6 flex-1 flex flex-col">
                                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-indigo-400 transition-colors line-clamp-2" title="<?= htmlspecialchars($event['title']) ?>">
                                        <?= htmlspecialchars($event['title']) ?>
                                        <?php if($event['description'] || $event['event_date']): ?>
                                        <div class="mt-auto bg-gray-900/50 rounded-xl p-4 border border-white/5 space-y-3">
                                            <div class="flex flex-col gap-1">
                                                <span class="text-xs uppercase font-bold tracking-wider text-gray-500">Event Date</span>
                                                <span class="text-sm font-medium text-indigo-400"><?= date('F d, Y', strtotime($event['event_date'])) ?></span>
                                            </div>
                                            <?php if($event['description']): ?>
                                                <div class="pt-3 border-t border-gray-700/50">
                                                    <p class="text-xs text-gray-400 line-clamp-3 italic" title="<?= htmlspecialchars($event['description']) ?>">
                                                        "<?= htmlspecialchars($event['description']) ?>"
                                                    </p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
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

        .text-indigo-400, .text-purple-500, .text-pink-500 {
            color: black !important;
            font-weight: bold !important;
        }

        .bg-indigo-500 {
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
