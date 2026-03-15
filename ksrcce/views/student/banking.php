<?php $path = 'student/banking.php'; ?>

<?php
$dashboardUrl = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin' ? '/admin/dashboard' : '/student/dashboard';
$exams = [
    ['url'=>'/student/banking/ibps-po',    'name'=>'IBPS PO',    'desc'=>'Probationary Officer',       'icon'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4','color'=>'blue'],
    ['url'=>'/student/banking/ibps-clerk', 'name'=>'IBPS Clerk', 'desc'=>'Clerical Cadre',             'icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z','color'=>'indigo'],
    ['url'=>'/student/banking/sbi-po',     'name'=>'SBI PO',     'desc'=>'State Bank PO',              'icon'=>'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z','color'=>'sky'],
    ['url'=>'/student/banking/sbi-clerk',  'name'=>'SBI Clerk',  'desc'=>'Junior Associates',          'icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z','color'=>'teal'],
    ['url'=>'/student/banking/rrb',        'name'=>'IBPS RRB',   'desc'=>'Regional Rural Banks',       'icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z','color'=>'green'],
    ['url'=>'/student/banking/rbi',        'name'=>'RBI Grade B', 'desc'=>'Reserve Bank of India',     'icon'=>'M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z','color'=>'orange'],
];
$colorMap = [
    'blue'=>  ['rgba(59,130,246,0.12)','rgba(59,130,246,0.25)','#60a5fa'],
    'indigo'=>['rgba(99,102,241,0.12)','rgba(99,102,241,0.25)','#818cf8'],
    'sky'=>   ['rgba(14,165,233,0.12)', 'rgba(14,165,233,0.25)','#38bdf8'],
    'teal'=>  ['rgba(20,184,166,0.12)', 'rgba(20,184,166,0.25)','#2dd4bf'],
    'green'=> ['rgba(16,185,129,0.12)', 'rgba(16,185,129,0.25)','#34d399'],
    'orange'=>['rgba(249,115,22,0.12)', 'rgba(249,115,22,0.25)','#fb923c'],
];
?>

<style>
/* ── Banking Domain Light UI ── */

.banking-hero {
    background: linear-gradient(135deg, #1e1b4b, #312e81);
    border-radius: 32px;
    position: relative;
    overflow: hidden;
}
.banking-card {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.banking-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px -5px rgba(79, 70, 229, 0.12);
    border-color: #6366f1;
}
</style>

<div class="pt-6 pb-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 mb-8 text-xs font-bold uppercase tracking-widest text-slate-400">
            <a href="<?= $dashboardUrl ?>" class="hover:text-indigo-600 transition-colors">Dashboard</a>
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-600">Banking Preparation</span>
        </nav>

        <!-- Hero Section -->
        <div class="banking-hero p-10 md:p-16 mb-12 text-center shadow-2xl">
            <div class="absolute top-0 right-0 w-80 h-80 bg-blue-500/10 blur-[100px] -mr-40 -mt-40"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-indigo-500/10 blur-[100px] -ml-40 -mb-40"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest mb-6"
                     style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); color:#a5b4fc;">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                    Financial Sector Careers
                </div>
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6" style="font-family:'Outfit',sans-serif; letter-spacing:-0.03em;">
                    Achieve Your Dream <span class="bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">Banking Career</span>
                </h1>
                <p class="text-indigo-100 text-lg mb-10 max-w-2xl mx-auto leading-relaxed font-medium">
                    Premier resources for IBPS, SBI, RBI, and other professional banking examinations.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://www.ibps.in/" target="_blank" rel="noopener noreferrer" 
                       class="px-8 py-4 rounded-2xl bg-white text-indigo-900 font-bold text-sm shadow-lg hover:scale-105 active:scale-95 transition-all">
                        IBPS Portal
                    </a>
                    <a href="#exams" class="px-8 py-4 rounded-2xl bg-white/10 text-white font-bold text-sm border border-white/20 hover:bg-white/20 transition-all">
                        Browse Exams
                    </a>
                </div>
            </div>
        </div>

        <!-- Section Title -->
        <div class="mb-10">
            <h2 class="text-2xl font-black text-slate-900 mb-2" style="font-family:'Outfit',sans-serif;">Banking Streams</h2>
            <div class="h-1.5 w-20 bg-indigo-600 rounded-full"></div>
        </div>

        <!-- Exams Grid -->
        <div id="exams" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <?php 
            $examColors = [
                'blue'    => ['from-blue-500 to-blue-600', 'text-blue-600'],
                'indigo'  => ['from-indigo-500 to-indigo-600', 'text-indigo-600'],
                'sky'     => ['from-sky-500 to-sky-600', 'text-sky-600'],
                'teal'    => ['from-teal-500 to-teal-600', 'text-teal-600'],
                'green'   => ['from-emerald-500 to-emerald-600', 'text-emerald-600'],
                'orange'  => ['from-orange-500 to-orange-600', 'text-orange-600']
            ];
            foreach ($exams as $exam): 
                [$grad, $tc] = $examColors[$exam['color']] ?? $examColors['blue'];
            ?>
            <a href="<?= $exam['url'] ?>" class="banking-card group p-8 flex flex-col">
                <div class="w-14 h-14 rounded-2xl mb-6 flex items-center justify-center bg-gradient-to-br <?= $grad ?> text-white shadow-lg transition-transform group-hover:scale-110">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $exam['icon'] ?>"/></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-black text-slate-900 mb-2" style="font-family:'Outfit',sans-serif;"><?= $exam['name'] ?></h3>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed"><?= $exam['desc'] ?></p>
                </div>
                <div class="mt-8 flex items-center justify-between">
                    <span class="text-[10px] font-black uppercase tracking-widest <?= $tc ?>">Mock Exams</span>
                    <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Info Grid -->
        <div class="grid md:grid-cols-2 gap-8">
            <div class="banking-card p-8">
                <h3 class="text-xl font-black text-slate-900 mb-4" style="font-family:'Outfit',sans-serif;">Sector Overview</h3>
                <p class="text-slate-500 mb-6 leading-relaxed">The banking sector offers some of the most stable and rewarding career opportunities in modern India. Our platform ensures you're ready for every hurdle.</p>
                <div class="grid sm:grid-cols-2 gap-4">
                    <?php foreach(['IBPS Exam Standard','SBI PO Specialist','RBI Grade B Focus','Financial Awareness'] as $f): ?>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-700"><?= $f ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="banking-card p-8 bg-indigo-600 text-white border-none shadow-indigo-200">
                <h3 class="text-xl font-black mb-4" style="font-family:'Outfit',sans-serif;">Key Indicators</h3>
                <div class="space-y-6">
                    <?php foreach([['11+','Public Sector Banks'],['SBI','Largest Recruiter'],['IBPS','Main Exam Body'],['Yearly','Cycle']] as $stat): ?>
                    <div class="flex items-center justify-between border-b border-white/10 pb-4 last:border-0 last:pb-0">
                        <span class="text-sm font-medium text-indigo-100"><?= $stat[1] ?></span>
                        <span class="text-xl font-black" style="font-family:'Outfit',sans-serif;"><?= $stat[0] ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
