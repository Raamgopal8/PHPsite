<?php $path = 'achievers_gallery.php'; ?>

<style>
/* ── Hall of Fame Light UI ── */
body {
    background-image: none !important;
    background: var(--bg-primary) !important;
}
.fame-hero {
    background: linear-gradient(135deg, #1e293b, #0f172a);
    border-radius: 32px;
    padding: 4rem 2rem;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 4rem;
}
.fame-card {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 24px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.fame-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
    border-color: #fbbf24;
}
.rank-badge {
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fcd34d;
    padding: 6px 14px;
    border-radius: 99px;
    font-size: 0.75rem;
    font-weight: 800;
    box-shadow: 0 4px 12px rgba(251, 191, 36, 0.2);
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
        <div class="fame-hero shadow-2xl print:hidden">
            <div class="absolute top-0 left-0 w-96 h-96 bg-indigo-500/10 blur-[100px] -ml-48 -mt-48"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-amber-500/10 blur-[100px] -mr-48 -mb-48"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest mb-6 bg-white/10 border border-white/20 text-amber-300">
                    🏆 Excellence & Dedication
                </div>
                <h1 class="text-4xl md:text-6xl font-black mb-6" style="font-family:'Outfit',sans-serif; letter-spacing:-0.03em;">
                    Hall of <span class="bg-gradient-to-r from-amber-400 to-orange-500 bg-clip-text text-transparent">Fame</span>
                </h1>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto font-medium leading-relaxed">
                    Celebrating the outstanding achievements of our top performers. These scholars have set the benchmark for excellence.
                </p>
                
                <button onclick="window.print()" class="mt-10 px-8 py-3 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-sm transition-all flex items-center gap-2 mx-auto">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                    Print Gallery
                </button>
            </div>
        </div>

        <!-- Print Title -->
        <div class="hidden print:block text-center border-b-2 border-slate-200 pb-8 mb-12">
            <h1 class="text-4xl font-black text-slate-900">KSR CCE HALL OF FAME</h1>
            <p class="text-slate-500 mt-2 font-bold uppercase tracking-widest"><?= date('F d, Y') ?></p>
        </div>

        <?php if(empty($achieversByYear)): ?>
            <div class="text-center py-20 bg-white rounded-3xl border border-slate-200 shadow-sm">
                <div class="text-6xl mb-4">⭐</div>
                <h3 class="text-xl font-black text-slate-900" style="font-family:'Outfit',sans-serif;">Future Achievers Welcome</h3>
                <p class="text-slate-500 mt-2">No achievements recorded yet. Your name could be here!</p>
            </div>
        <?php else: ?>
            <?php foreach($achieversByYear as $year => $achievers): ?>
                <div class="mb-20">
                    <div class="flex items-center gap-6 mb-10">
                        <h2 class="text-3xl font-black text-slate-900" style="font-family:'Outfit',sans-serif;">Batch of <?= htmlspecialchars($year) ?></h2>
                        <div class="year-divider"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        <?php foreach($achievers as $achiever): ?>
                            <div class="fame-card flex flex-col group">
                                <div class="aspect-[4/5] relative overflow-hidden bg-slate-100">
                                    <?php if($achiever['image_url']): ?>
                                        <img src="<?= htmlspecialchars($achiever['image_url']) ?>" 
                                             alt="<?= htmlspecialchars($achiever['student_name']) ?>" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-50 to-slate-100 text-6xl font-black text-indigo-200">
                                            <?= substr($achiever['student_name'], 0, 1) ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="absolute top-4 right-4 z-20">
                                        <div class="rank-badge">
                                            🏆 <?= htmlspecialchars($achiever['rank_or_score']) ?>
                                        </div>
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                                
                                <div class="p-6 flex-1 flex flex-col">
                                    <h3 class="text-xl font-black text-slate-900 mb-1 leading-tight group-hover:text-indigo-600 transition-colors" style="font-family:'Outfit',sans-serif;">
                                        <?= htmlspecialchars($achiever['student_name']) ?>
                                    </h3>
                                    
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">
                                        <?= htmlspecialchars($achiever['department'] ?? 'General') ?>
                                    </p>

                                    <div class="mt-auto bg-slate-50 rounded-2xl p-4 border border-slate-100">
                                        <div class="flex flex-col gap-1">
                                            <span class="text-[10px] uppercase font-black tracking-widest text-slate-400">Competitive Exam</span>
                                            <span class="text-sm font-black text-indigo-700"><?= htmlspecialchars($achiever['exam_name']) ?></span>
                                        </div>
                                        <?php if($achiever['achievement_description']): ?>
                                            <p class="mt-3 text-xs text-slate-500 italic leading-relaxed line-clamp-2">
                                                "<?= htmlspecialchars($achiever['achievement_description']) ?>"
                                            </p>
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
    header, footer, nav, .print\:hidden { display: none !important; }
    body { background: white !important; }
    .fame-card { border: 1px solid #e2e8f0 !important; page-break-inside: avoid; }
    .rank-badge { border: 1px solid #d1d5db !important; background: #f3f4f6 !important; color: black !important; }
}
</style>
