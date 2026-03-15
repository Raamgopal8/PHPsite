<?php $path = 'events_gallery.php'; ?>

<style>
/* ── Campus Events Light UI ── */
body {
    background-image: none !important;
    background: var(--bg-primary) !important;
}
.events-hero {
    background: linear-gradient(135deg, #312e81, #1e1b4b);
    border-radius: 32px;
    padding: 4rem 2rem;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 4rem;
}
.event-card {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 24px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.event-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
    border-color: #6366f1;
}
.date-badge {
    background: #e0e7ff;
    color: #4338ca;
    border: 1px solid #c7d2fe;
    padding: 6px 14px;
    border-radius: 99px;
    font-size: 0.75rem;
    font-weight: 800;
}
.year-divider {
    height: 2px;
    background: linear-gradient(90deg, #e2e8f0, transparent);
    flex: 1;
}
</style>

<div class="min-h-screen p-6 pt-12">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="events-hero shadow-2xl print:hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-500/10 blur-[100px] -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-500/10 blur-[100px] -ml-48 -mb-48"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest mb-6 bg-white/10 border border-white/20 text-indigo-300">
                    ✨ Life at Campus
                </div>
                <h1 class="text-4xl md:text-6xl font-black mb-6" style="font-family:'Outfit',sans-serif; letter-spacing:-0.03em;">
                    Campus <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">Events</span>
                </h1>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto font-medium leading-relaxed">
                    Relive the moments and explore the vibrant activities that make our campus come alive. Join us in celebrating our community.
                </p>
                
                <button onclick="window.print()" class="mt-10 px-8 py-3 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-sm transition-all flex items-center gap-2 mx-auto">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                    Print Events
                </button>
            </div>
        </div>

        <!-- Print Title -->
        <div class="hidden print:block text-center border-b-2 border-slate-200 pb-8 mb-12">
            <h1 class="text-4xl font-black text-slate-900">KSR COLLEGE EVENTS</h1>
            <p class="text-slate-500 mt-2 font-bold uppercase tracking-widest">Gallery Snapshot - <?= date('F d, Y') ?></p>
        </div>

        <?php if(empty($eventsByYear)): ?>
            <div class="text-center py-20 bg-white rounded-3xl border border-slate-200 shadow-sm">
                <div class="text-6xl mb-4">📅</div>
                <h3 class="text-xl font-black text-slate-900" style="font-family:'Outfit',sans-serif;">Stay Tuned for Updates</h3>
                <p class="text-slate-500 mt-2">No events recorded yet. Check back soon for exciting news!</p>
            </div>
        <?php else: ?>
            <?php foreach($eventsByYear as $year => $events): ?>
                <div class="mb-20">
                    <div class="flex items-center gap-6 mb-10">
                        <h2 class="text-3xl font-black text-slate-900" style="font-family:'Outfit',sans-serif;"><?= htmlspecialchars($year) ?> Events</h2>
                        <div class="year-divider"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        <?php foreach($events as $event): ?>
                            <div class="event-card flex flex-col group">
                                <div class="aspect-video relative overflow-hidden bg-slate-100">
                                    <?php if($event['image_url']): ?>
                                        <img src="<?= htmlspecialchars($event['image_url']) ?>" 
                                             alt="<?= htmlspecialchars($event['title']) ?>" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-50 to-slate-100 text-indigo-200">
                                            <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="absolute bottom-4 left-4 z-20">
                                        <div class="date-badge">
                                            📅 <?= date('M d, Y', strtotime($event['event_date'])) ?>
                                        </div>
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                                
                                <div class="p-6 flex-1 flex flex-col">
                                    <h3 class="text-xl font-black text-slate-900 mb-4 leading-tight group-hover:text-indigo-600 transition-colors" style="font-family:'Outfit',sans-serif;">
                                        <?= htmlspecialchars($event['title']) ?>
                                    </h3>
                                    
                                    <?php if($event['description']): ?>
                                        <div class="mt-auto bg-slate-50 rounded-2xl p-4 border border-slate-100">
                                            <p class="text-xs text-slate-500 italic leading-relaxed line-clamp-3">
                                                "<?= htmlspecialchars($event['description']) ?>"
                                            </p>
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
    header, footer, nav, .print\:hidden { display: none !important; }
    body { background: white !important; }
    .event-card { border: 1px solid #e2e8f0 !important; page-break-inside: avoid; }
    .date-badge { border: 1px solid #d1d5db !important; background: #f3f4f6 !important; color: black !important; }
}
</style>
