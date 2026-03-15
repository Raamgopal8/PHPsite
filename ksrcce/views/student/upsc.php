<?php $path = 'student/upsc.php'; ?>

<?php
$dashboardUrl = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin' ? '/admin/dashboard' : '/student/dashboard';
$exams = [
    ['url'=>'/student/upsc/cse',         'name'=>'Civil Services (CSE) 2026',      'desc'=>'For IAS, IPS, IFS & Central Services Group A/B. Prelims May, Mains Aug 2026.',            'icon'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4','color'=>'orange'],
    ['url'=>'/student/upsc/ifos',         'name'=>'Indian Forest Service (IFoS)',   'desc'=>'Along with CSE Prelims for forest service officers across India.',                       'icon'=>'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z','color'=>'green'],
    ['url'=>'/student/upsc/ese',          'name'=>'Engineering Services (ESE) 2026','desc'=>'Technical services for Engineers — Civil, Mechanical, Electrical, Electronics.',         'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z','color'=>'blue'],
    ['url'=>'/student/upsc/cds',          'name'=>'Combined Defence Services (CDS)','desc'=>'For Army, Navy, Air Force officer training. Held twice yearly.',                         'icon'=>'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z','color'=>'teal'],
    ['url'=>'/student/upsc/nda',          'name'=>'NDA & NA Examination 2026',      'desc'=>'For 12th-pass students entering Armed Forces — Army, Navy, Air Force.',                  'icon'=>'M12 19l9 2-9-18-9 18 9-2zm0 0v-8','color'=>'indigo'],
    ['url'=>'/student/upsc/cms',          'name'=>'Combined Medical Services (CMS)', 'desc'=>'For medical officers in central government organizations.',                              'icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z','color'=>'red'],
    ['url'=>'/student/upsc/capf',         'name'=>'CAPF (AC) 2026',                 'desc'=>'For Assistant Commandants in BSF, CRPF, CISF, ITBP, and SSB.',                          'icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','color'=>'emerald'],
    ['url'=>'/student/upsc/geoscientist', 'name'=>'Geo-Scientist Exam 2026',        'desc'=>'For Geologists, Geophysicists, and Chemists in GSI and CGWB.',                          'icon'=>'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z','color'=>'amber'],
];
$colorMap = [
    'orange'=>['rgba(249,115,22,0.12)', 'rgba(249,115,22,0.25)', '#fb923c'],
    'green'=> ['rgba(16,185,129,0.12)', 'rgba(16,185,129,0.25)', '#34d399'],
    'blue'=>  ['rgba(59,130,246,0.12)', 'rgba(59,130,246,0.25)', '#60a5fa'],
    'teal'=>  ['rgba(20,184,166,0.12)', 'rgba(20,184,166,0.25)', '#2dd4bf'],
    'indigo'=>['rgba(99,102,241,0.12)', 'rgba(99,102,241,0.25)', '#818cf8'],
    'red'=>   ['rgba(239,68,68,0.12)',  'rgba(239,68,68,0.25)',  '#f87171'],
    'emerald'=>['rgba(16,185,129,0.12)','rgba(16,185,129,0.25)','#34d399'],
    'amber'=> ['rgba(245,158,11,0.12)', 'rgba(245,158,11,0.25)','#fbbf24'],
];
?>

<style>
/* ── UPSC Domain Light UI ── */

.upsc-hero {
    background: linear-gradient(135deg, #7c2d12, #451a03);
    border-radius: 32px;
    position: relative;
    overflow: hidden;
}
.upsc-card {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.upsc-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px -5px rgba(234, 88, 12, 0.12);
    border-color: #f97316;
}
</style>

<div class="pt-6 pb-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 mb-8 text-xs font-bold uppercase tracking-widest text-slate-400">
            <a href="<?= $dashboardUrl ?>" class="hover:text-orange-600 transition-colors">Dashboard</a>
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-600">UPSC Preparation</span>
        </nav>

        <!-- Hero Section -->
        <div class="upsc-hero p-10 md:p-16 mb-12 text-center shadow-2xl">
            <div class="absolute top-0 right-0 w-80 h-80 bg-orange-500/10 blur-[100px] -mr-40 -mt-40"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-amber-500/10 blur-[100px] -ml-40 -mb-40"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest mb-6"
                     style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); color:#fed7aa;">
                    <span class="w-1.5 h-1.5 rounded-full bg-orange-400 animate-pulse"></span>
                    Nation Building
                </div>
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6" style="font-family:'Outfit',sans-serif; letter-spacing:-0.03em;">
                    Lead the Nation with <span class="bg-gradient-to-r from-orange-400 to-amber-400 bg-clip-text text-transparent">Distinction</span>
                </h1>
                <p class="text-orange-100 text-lg mb-10 max-w-2xl mx-auto leading-relaxed font-medium">
                    Premier preparation resources for IAS, IPS, ESE, and other prestigious UPSC examinations.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://upsc.gov.in/" target="_blank" rel="noopener noreferrer" 
                       class="px-8 py-4 rounded-2xl bg-white text-orange-900 font-bold text-sm shadow-lg hover:scale-105 active:scale-95 transition-all">
                        Official UPSC Portal
                    </a>
                    <a href="#exams" class="px-8 py-4 rounded-2xl bg-white/10 text-white font-bold text-sm border border-white/20 hover:bg-white/20 transition-all">
                        Browse Exams
                    </a>
                </div>
            </div>
        </div>

        <!-- Section Title -->
        <div class="mb-10">
            <h2 class="text-2xl font-black text-slate-900 mb-2" style="font-family:'Outfit',sans-serif;">Examination Tracks</h2>
            <div class="h-1.5 w-20 bg-orange-600 rounded-full"></div>
        </div>

        <!-- Exams Grid -->
        <div id="exams" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-16">
            <?php 
            $examColors = [
                'orange'  => ['from-orange-500 to-orange-600', 'text-orange-600'],
                'green'   => ['from-emerald-500 to-emerald-600', 'text-emerald-600'],
                'blue'    => ['from-blue-500 to-blue-600', 'text-blue-600'],
                'teal'    => ['from-teal-500 to-teal-600', 'text-teal-600'],
                'indigo'  => ['from-indigo-500 to-indigo-600', 'text-indigo-600'],
                'red'     => ['from-rose-500 to-rose-600', 'text-rose-600'],
                'emerald' => ['from-emerald-500 to-emerald-600', 'text-emerald-600'],
                'amber'   => ['from-amber-400 to-amber-500', 'text-amber-700']
            ];
            foreach ($exams as $exam): 
                [$grad, $tc] = $examColors[$exam['color']] ?? $examColors['orange'];
            ?>
            <a href="<?= $exam['url'] ?>" class="upsc-card group p-6 flex flex-col">
                <div class="w-14 h-14 rounded-2xl mb-6 flex items-center justify-center bg-gradient-to-br <?= $grad ?> text-white shadow-lg transition-transform group-hover:scale-110">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $exam['icon'] ?>"/></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-base font-black text-slate-900 mb-2 leading-snug" style="font-family:'Outfit',sans-serif;"><?= $exam['name'] ?></h3>
                    <p class="text-xs text-slate-500 font-medium leading-relaxed"><?= $exam['desc'] ?></p>
                </div>
                <div class="mt-8 flex items-center justify-between">
                    <span class="text-[10px] font-black uppercase tracking-widest <?= $tc ?>">Module Access</span>
                    <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-orange-600 group-hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Info Grid -->
        <div class="grid md:grid-cols-2 gap-8">
            <div class="upsc-card p-8">
                <h3 class="text-xl font-black text-slate-900 mb-4" style="font-family:'Outfit',sans-serif;">Why UPSC?</h3>
                <p class="text-slate-500 mb-6 leading-relaxed">Preparation for UPSC is not just about clearing an exam; it's a transformational journey. We provide the mentorship and structure needed to navigate its complexity.</p>
                <div class="grid sm:grid-cols-2 gap-4">
                    <?php foreach(['3-Stage Selection','IAS/IPS/IFS Tracks','Nationwide Reach','Administrative Focus'] as $f): ?>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-orange-100 flex items-center justify-center text-orange-600">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-700"><?= $f ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="upsc-card p-8 bg-orange-600 text-white border-none shadow-orange-200">
                <h3 class="text-xl font-black mb-4" style="font-family:'Outfit',sans-serif;">Exam Insights</h3>
                <div class="space-y-6">
                    <?php foreach([['3','Stages'],['24+','Services'],['1M+','Aspirants'],['Annual','Cycle']] as $stat): ?>
                    <div class="flex items-center justify-between border-b border-white/10 pb-4 last:border-0 last:pb-0">
                        <span class="text-sm font-medium text-orange-100"><?= $stat[1] ?></span>
                        <span class="text-xl font-black" style="font-family:'Outfit',sans-serif;"><?= $stat[0] ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
