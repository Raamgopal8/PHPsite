<?php $path = 'student/exams.php'; ?>

<style>
/* ── Exams List Light UI ── */

.exams-hero {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    border-radius: 24px;
    padding: 3rem 2rem;
    color: white;
    margin-bottom: 2rem;
}
.light-exam-card {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.light-exam-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px -5px rgba(99, 102, 241, 0.15);
    border-color: #c7d2fe;
}
.active-badge {
    background: #f0fdf4;
    color: #15803d;
    border: 1px solid #bbf7d0;
    padding: 4px 12px;
    border-radius: 99px;
    font-size: 0.7rem;
    font-weight: 700;
}
</style>

<div class="p-4 pt-24 pb-32">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="exams-hero shadow-xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 blur-3xl -mr-32 -mt-32 rounded-full"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black" style="font-family:'Outfit',sans-serif; letter-spacing:-0.02em;">All Exams</h1>
                    <p class="mt-2 text-indigo-100 font-medium">View and take active mock tests</p>
                </div>
                <a href="/student/dashboard" class="px-5 py-2.5 rounded-xl bg-white/10 text-white font-bold text-sm border border-white/20 hover:bg-white/20 transition-all font-bold">
                    Dashboard
                </a>
            </div>
        </div>

        <!-- Exams List -->
        <div class="space-y-6">
            <?php if (empty($exams)): ?>
                <div class="py-20 text-center bg-white border border-slate-200 rounded-3xl">
                    <div class="w-16 h-16 mx-auto mb-4 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <p class="text-slate-400 font-black text-sm uppercase tracking-widest">No active exams found</p>
                </div>
            <?php else: ?>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <?php foreach($exams as $e): ?>
                        <div class="light-exam-card">
                            <div class="flex items-start justify-between mb-5">
                                <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 border border-indigo-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="active-badge">Active</span>
                            </div>
                            
                            <h3 class="text-lg font-black text-slate-900 mb-2 truncate" style="font-family:'Outfit',sans-serif;"><?= htmlspecialchars($e['title']) ?></h3>
                            <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-6 bg-slate-50 inline-block px-2 py-1 rounded-md">
                                Category: <?= htmlspecialchars($e['category'] ?? 'General') ?>
                            </div>
                            
                            <div class="mt-auto pt-5 border-t border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-1.5 text-slate-500">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs font-bold"><?= $e['duration'] ?? 30 ?> MIN</span>
                                </div>
                                
                                <a href="/student/take?id=<?= urlencode((string)$e['id']) ?>" 
                                   class="px-5 py-2 rounded-xl bg-indigo-600 text-white text-xs font-black shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all flex items-center gap-2 group">
                                    Start Exam
                                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
