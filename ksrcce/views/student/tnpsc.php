<?php $path = 'student/tnspc.php'; ?>

<?php
$dashboardUrl = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin' ? '/admin/dashboard' : '/student/dashboard';
$groups = [
    ['url'=>'/student/tnpsc/group1','name'=>'Group 1','desc'=>'Gazetted Officers','icon'=>'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10','color'=>'green'],
    ['url'=>'/student/tnpsc/group2','name'=>'Group 2','desc'=>'Non-Gazetted Officers','icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2','color'=>'blue'],
    ['url'=>'/student/tnpsc/group4','name'=>'Group 4','desc'=>'Clerical Level Posts','icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','color'=>'purple'],
];
?>

<style>
/* ── TNPSC Domain Light UI ── */

.tnpsc-hero {
    background: linear-gradient(135deg, #064e3b, #065f46);
    border-radius: 32px;
    position: relative;
    overflow: hidden;
}
.tnpsc-card {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.tnpsc-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px -5px rgba(16, 185, 129, 0.12);
    border-color: #10b981;
}
</style>

<div class="pt-6 pb-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 mb-8 text-xs font-bold uppercase tracking-widest text-slate-400">
            <a href="<?= $dashboardUrl ?>" class="hover:text-emerald-600 transition-colors">Dashboard</a>
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-600">TNPSC Preparation</span>
        </nav>

        <!-- Hero Section -->
        <div class="tnpsc-hero p-10 md:p-16 mb-12 text-center shadow-2xl">
            <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500/10 blur-[100px] -mr-40 -mt-40"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-teal-500/10 blur-[100px] -ml-40 -mb-40"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest mb-6"
                     style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); color:#6ee7b7;">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Serve the State
                </div>
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6" style="font-family:'Outfit',sans-serif; letter-spacing:-0.03em;">
                    Serve the State with <span class="bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">Excellence</span>
                </h1>
                <p class="text-emerald-100 text-lg mb-10 max-w-2xl mx-auto leading-relaxed font-medium">
                    Access comprehensive study materials and practice tests for Group 1, 2, and 4 examinations conducted by TNPSC.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://www.tnpsc.gov.in/" target="_blank" rel="noopener noreferrer" 
                       class="px-8 py-4 rounded-2xl bg-white text-emerald-900 font-bold text-sm shadow-lg hover:scale-105 active:scale-95 transition-all">
                        Official TNPSC Portal
                    </a>
                    <a href="#groups" class="px-8 py-4 rounded-2xl bg-white/10 text-white font-bold text-sm border border-white/20 hover:bg-white/20 transition-all">
                        Browse Groups
                    </a>
                </div>
            </div>
        </div>

        <!-- Section Title -->
        <div class="mb-10">
            <h2 class="text-2xl font-black text-slate-900 mb-2" style="font-family:'Outfit',sans-serif;">Exam Groups</h2>
            <div class="h-1.5 w-20 bg-emerald-600 rounded-full"></div>
        </div>

        <!-- Groups Grid -->
        <div id="groups" class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <?php 
            $gmColors = [
                'green'  => ['from-emerald-500 to-emerald-600', 'text-emerald-600'],
                'blue'   => ['from-blue-500 to-blue-600', 'text-blue-600'],
                'purple' => ['from-purple-500 to-purple-600', 'text-purple-600']
            ];
            foreach ($groups as $g): 
                [$grad, $tc] = $gmColors[$g['color']] ?? $gmColors['green'];
            ?>
            <a href="<?= $g['url'] ?>" class="tnpsc-card group p-8 flex flex-col">
                <div class="w-14 h-14 rounded-2xl mb-6 flex items-center justify-center bg-gradient-to-br <?= $grad ?> text-white shadow-lg transition-transform group-hover:scale-110">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $g['icon'] ?>"/></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-black text-slate-900 mb-2" style="font-family:'Outfit',sans-serif;"><?= $g['name'] ?></h3>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed"><?= $g['desc'] ?></p>
                </div>
                <div class="mt-8 flex items-center justify-between">
                    <span class="text-[10px] font-black uppercase tracking-widest <?= $tc ?>">View Resources</span>
                    <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Info Grid -->
        <div class="grid md:grid-cols-2 gap-8">
            <div class="tnpsc-card p-8">
                <h3 class="text-xl font-black text-slate-900 mb-4" style="font-family:'Outfit',sans-serif;">Mission Statement</h3>
                <p class="text-slate-500 mb-6 leading-relaxed">Embrace your role in the state's governance. Our resources are tailored to the unique bilingual requirements and regional focus of TNPSC examinations.</p>
                <div class="space-y-3">
                    <?php foreach(['Tamil Language Mastery','State-Specific GS','Regional Administration Focus','Previous Year Paper Solves'] as $p): ?>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-700"><?= $p ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tnpsc-card p-8 bg-emerald-600 text-white border-none shadow-emerald-200">
                <h3 class="text-xl font-black mb-4" style="font-family:'Outfit',sans-serif;">Exam Highlights</h3>
                <div class="space-y-6">
                    <?php foreach([['3','Major Groups'],['Govt','State Jobs'],['300+','Annual Vacancies'],['TN','State Focus']] as $highlight): ?>
                    <div class="flex items-center justify-between border-b border-white/10 pb-4 last:border-0 last:pb-0">
                        <span class="text-sm font-medium text-emerald-100"><?= $highlight[1] ?></span>
                        <span class="text-xl font-black" style="font-family:'Outfit',sans-serif;"><?= $highlight[0] ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>