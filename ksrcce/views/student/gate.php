<?php $path = 'student/gate.php'; ?>

<?php
$dashboardUrl = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin' ? '/admin/dashboard' : '/student/dashboard';
$accentColor = '#60a5fa'; $accentBg = 'rgba(59,130,246,0.1)'; $accentBorder = 'rgba(59,130,246,0.2)';
$departments = [
    ['code'=>'cse',  'name'=>'Computer Science', 'desc'=>'CS & IT Engineering',       'icon'=>'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z','color'=>'blue'],
    ['code'=>'ece',  'name'=>'Electronics',       'desc'=>'EC Engineering',            'icon'=>'M13 10V3L4 14h7v7l9-11h-7z','color'=>'indigo'],
    ['code'=>'mech', 'name'=>'Mechanical',        'desc'=>'ME Engineering',            'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z','color'=>'slate'],
    ['code'=>'civil','name'=>'Civil Engineering', 'desc'=>'CE Engineering',            'icon'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4','color'=>'orange'],
    ['code'=>'ee',   'name'=>'Electrical',        'desc'=>'EE Engineering',            'icon'=>'M13 10V3L4 14h7v7l9-11h-7z','color'=>'yellow'],
    ['code'=>'ae',   'name'=>'Aeronautical',      'desc'=>'AE Engineering',            'icon'=>'M12 19l9 2-9-18-9 18 9-2zm0 0v-8','color'=>'sky'],
    ['code'=>'aids', 'name'=>'AI & Data Science', 'desc'=>'AIDS Engineering',          'icon'=>'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z','color'=>'violet'],
    ['code'=>'bme',  'name'=>'Biomedical',        'desc'=>'BME Engineering',           'icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z','color'=>'rose'],
    ['code'=>'csd',  'name'=>'CS & Design',       'desc'=>'CSD Engineering',           'icon'=>'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01','color'=>'teal'],
    ['code'=>'cs',   'name'=>'Cyber Security',    'desc'=>'CS Engineering',            'icon'=>'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z','color'=>'emerald'],
    ['code'=>'iot',  'name'=>'Internet of Things','desc'=>'IoT Engineering',           'icon'=>'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0','color'=>'amber'],
    ['code'=>'it',   'name'=>'Information Tech',  'desc'=>'IT Engineering',            'icon'=>'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z','color'=>'cyan'],
    ['code'=>'sfe',  'name'=>'Safety & Fire',     'desc'=>'SFE Engineering',           'icon'=>'M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z','color'=>'red'],
    ['code'=>'mba',  'name'=>'MBA',               'desc'=>'Management',                'icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z','color'=>'purple'],
    ['code'=>'mca',  'name'=>'MCA',               'desc'=>'Computer Applications',     'icon'=>'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4','color'=>'pink'],
];
?>

<style>
/* ── GATE Domain Light UI ── */

.gate-hero {
    background: linear-gradient(135deg, #1e293b, #0f172a);
    border-radius: 32px;
    position: relative;
    overflow: hidden;
}
.gate-card {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.gate-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px -5px rgba(99, 102, 241, 0.12);
    border-color: #6366f1;
}
.dept-icon-box {
    transition: all 0.3s ease;
}
.gate-card:hover .dept-icon-box {
    transform: scale(1.1) rotate(5deg);
}
</style>

<div class="pt-6 pb-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 mb-8 text-xs font-bold uppercase tracking-widest text-slate-400">
            <a href="<?= $dashboardUrl ?>" class="hover:text-indigo-600 transition-colors">Dashboard</a>
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-600">GATE Preparation</span>
        </nav>

        <!-- Hero Section -->
        <div class="gate-hero p-10 md:p-16 mb-12 text-center shadow-2xl">
            <div class="absolute top-0 right-0 w-80 h-80 bg-blue-500/10 blur-[100px] -mr-40 -mt-40"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-indigo-500/10 blur-[100px] -ml-40 -mb-40"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest mb-6"
                     style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); color:#93c5fd;">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                    Engineering Excellence
                </div>
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6" style="font-family:'Outfit',sans-serif; letter-spacing:-0.03em;">
                    Master Your <span class="bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">Engineering Journey</span>
                </h1>
                <p class="text-slate-300 text-lg mb-10 max-w-2xl mx-auto leading-relaxed font-medium">
                    Comprehensive resources, expert-curated syllabus, and structured study paths for GATE aspirants.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://gate2026.iitg.ac.in/" target="_blank" rel="noopener noreferrer" 
                       class="px-8 py-4 rounded-2xl bg-white text-slate-900 font-bold text-sm shadow-lg hover:scale-105 active:scale-95 transition-all">
                        Official Portal
                    </a>
                    <a href="#departments" class="px-8 py-4 rounded-2xl bg-white/10 text-white font-bold text-sm border border-white/20 hover:bg-white/20 transition-all">
                        Browse Subjects
                    </a>
                </div>
            </div>
        </div>

        <!-- Section Title -->
        <div class="mb-10">
            <h2 class="text-2xl font-black text-slate-900 mb-2" style="font-family:'Outfit',sans-serif;">Engineering Disciplines</h2>
            <div class="h-1.5 w-20 bg-indigo-600 rounded-full"></div>
        </div>

        <!-- Departments Grid -->
        <div id="departments" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-16">
            <?php foreach ($departments as $dept): 
                $colorClasses = [
                    'blue'    => 'from-blue-500 to-blue-600 text-blue-600 bg-blue-50 border-blue-100',
                    'indigo'  => 'from-indigo-500 to-indigo-600 text-indigo-600 bg-indigo-50 border-indigo-100',
                    'slate'   => 'from-slate-600 to-slate-700 text-slate-700 bg-slate-50 border-slate-100',
                    'orange'  => 'from-orange-500 to-orange-600 text-orange-600 bg-orange-50 border-orange-100',
                    'yellow'  => 'from-yellow-400 to-yellow-500 text-yellow-700 bg-yellow-50 border-yellow-100',
                    'sky'     => 'from-sky-500 to-sky-600 text-sky-600 bg-sky-50 border-sky-100',
                    'violet'  => 'from-violet-500 to-violet-600 text-violet-600 bg-violet-50 border-violet-100',
                    'rose'    => 'from-rose-500 to-rose-600 text-rose-600 bg-rose-50 border-rose-100',
                    'teal'    => 'from-teal-500 to-teal-600 text-teal-600 bg-teal-50 border-teal-100',
                    'emerald' => 'from-emerald-500 to-emerald-600 text-emerald-600 bg-emerald-50 border-emerald-100',
                    'amber'   => 'from-amber-500 to-amber-600 text-amber-700 bg-amber-50 border-amber-100',
                    'cyan'    => 'from-cyan-500 to-cyan-600 text-cyan-600 bg-cyan-50 border-cyan-100',
                    'red'     => 'from-red-500 to-red-600 text-red-600 bg-red-50 border-red-100',
                    'purple'  => 'from-purple-500 to-purple-600 text-purple-600 bg-purple-50 border-purple-100',
                    'pink'    => 'from-pink-500 to-pink-600 text-pink-600 bg-pink-50 border-pink-100',
                ];
                $cls = $colorClasses[$dept['color']] ?? $colorClasses['blue'];
                [$grad, $text, $bg, $border] = explode(' ', $cls);
            ?>
            <a href="/student/gate/<?= $dept['code'] ?>" class="gate-card group p-6 flex flex-col">
                <div class="dept-icon-box w-14 h-14 rounded-2xl mb-6 flex items-center justify-center bg-gradient-to-br <?= $grad ?> text-white shadow-lg">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $dept['icon'] ?>"/></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-black text-slate-900 mb-1" style="font-family:'Outfit',sans-serif;"><?= $dept['name'] ?></h3>
                    <p class="text-sm text-slate-500 font-medium leading-snug"><?= $dept['desc'] ?></p>
                </div>
                <div class="mt-6 flex items-center justify-between">
                    <span class="text-[10px] font-black uppercase tracking-widest <?= $text ?>">View Materials</span>
                    <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Info Grid -->
        <div class="grid md:grid-cols-3 gap-6">
            <div class="gate-card p-8 md:col-span-2">
                <h3 class="text-xl font-black text-slate-900 mb-4" style="font-family:'Outfit',sans-serif;">Why Prepare with CCE?</h3>
                <p class="text-slate-500 mb-6 leading-relaxed">Our GATE curriculum is meticulously mapped to the latest examination patterns, ensuring you focus on what matters most for your specific discipline.</p>
                <div class="grid sm:grid-cols-2 gap-4">
                    <?php foreach(['Structured Skill Paths','discipline-Specific Nodes','Mock Examination Portal','Historical Question Analysis'] as $feature): ?>
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-700"><?= $feature ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="gate-card p-8 bg-indigo-600 text-white border-none shadow-indigo-200">
                <h3 class="text-xl font-black mb-4" style="font-family:'Outfit',sans-serif;">Quick Stats</h3>
                <div class="space-y-6">
                    <?php foreach([['29+','Subjects'],['3 Years','Validity'],['100','Total Marks'],['Feb','Exam Month']] as $stat): ?>
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