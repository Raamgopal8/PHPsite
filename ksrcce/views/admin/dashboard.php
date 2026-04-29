<?php 
$path = 'admin/dashboard.php';

// Helper function for icon display
function getIconForType($iconType) {
    $icons = [
        'link' => '🔗',
        'book' => '📚',
        'video' => '📹',
        'download' => '⬇️',
        'external' => '🌐',
        'document' => '📄'
    ];
    return $icons[$iconType] ?? '🔗';
}
?>

<style>
/* ── Admin Light Design System (Aligned with Student) ──────────────── */
:root {
    --admin-bg:       #f0f4ff;
    --admin-surface:  #ffffff;
    --admin-border:   #e2e8f0;
    --admin-text:     #0f172a;
    --admin-muted:    #64748b;
    --admin-accent:   #4f46e5;
    --shadow-sm:      0 1px 3px rgba(15,23,42,0.06);
    --shadow-md:      0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

/* Force Light Theme */
.admin-shell { 
    background: var(--admin-bg) !important; 
    min-height: 100vh;
    display: flex;
}
.admin-shell * { -webkit-font-smoothing: antialiased; }

/* Sidebar */
.admin-sidebar {
    background: #1e293b;
    border-right: 1px solid rgba(255,255,255,0.05);
    box-shadow: 4px 0 24px rgba(15,23,42,0.18);
}
.admin-sidebar-item {
    display: flex; align-items: center;
    gap: 10px; padding: 10px 14px;
    border-radius: 12px; font-size: 0.82rem; font-weight: 600;
    color: #94a3b8; text-decoration: none;
    transition: all 0.2s ease; position: relative; overflow: hidden;
}
.admin-sidebar-item::before {
    content: ''; position: absolute;
    left: 0; top: 0; height: 100%; width: 3px;
    background: #6366f1; transform: scaleY(0);
    transition: transform 0.2s; border-radius: 0 2px 2px 0;
}
.admin-sidebar-item:hover { background: rgba(99,102,241,0.1); color: #e2e8f0; }
.admin-sidebar-item:hover::before { transform: scaleY(1); }
.admin-sidebar-item.active { background: rgba(99,102,241,0.15); color: #ffffff; }
.admin-sidebar-item.active::before { transform: scaleY(1); }

/* Stat Cards (Aligned with Student sd-card) */
.admin-stat-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: 20px; padding: 22px;
    box-shadow: var(--shadow-sm);
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative; overflow: hidden;
}
.admin-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: #c7d2fe;
}

/* Content Cards (Aligned with Student sd-card) */
.admin-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}

/* Table */
.admin-table thead th {
    background: #f8fafc; color: #64748b; font-size: 0.72rem;
    font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em;
    padding: 12px 20px; border-bottom: 1px solid #e2e8f0;
}
.admin-table tbody td {
    padding: 12px 20px; border-bottom: 1px solid #f1f5f9;
    font-size: 0.82rem; color: #1e293b;
}
.admin-table tbody tr:hover { background: #f8faff; }
.admin-table tbody tr:last-child td { border-bottom: none; }

/* Scrollbars */
.admin-sidebar::-webkit-scrollbar { width: 4px; }
.admin-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }

.light-scrollbar::-webkit-scrollbar { width: 4px; }
.light-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
.light-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 2px; }
.light-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

@media print {
    .admin-sidebar { display: none !important; }
    .admin-shell { background: white !important; }
}
</style>

<div class="admin-shell min-h-screen flex" style="margin-top:-4px;">


    <!-- ── Main Content ─────────────────────────────────────────── -->
    <main class="flex-1 min-w-0" style="background:var(--admin-bg);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Header (Aligned with Student Hero) -->
            <div class="admin-card p-7 md:p-8 relative overflow-hidden mb-8">
                <div class="absolute top-0 right-0 w-72 h-full pointer-events-none" style="background:linear-gradient(135deg,#eef2ff,#f5f3ff);clip-path:ellipse(100% 100% at 100% 50%);"></div>
                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold mb-4"
                             style="background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d;">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            Admin Control Center
                        </div>
                        <h1 class="text-3xl font-black text-slate-900" style="font-family:'Outfit',sans-serif;letter-spacing:-0.02em;">
                            Dashboard Overview
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">Welcome back, <span class="font-bold text-indigo-600"><?= htmlspecialchars($_SESSION['user']['name'] ?? 'Admin') ?></span> · <?= date('l, d M Y') ?></p>
                    </div>
                    <a href="/admin/available" class="bg-blue-500 text-white px-4 py-2 rounded-xl font-bold hover:bg-blue-600">Manage Departments</a>
                </div>
            </div>

            <!-- Flash -->
            <?php if(!empty($_SESSION['flash']['success'])): ?>
                <div class="mb-6 p-4 rounded-2xl flex items-center gap-3 text-sm font-semibold text-green-700"
                     style="background:#f0fdf4;border:1px solid #bbf7d0;">
                    <svg class="h-5 w-5 text-green-500 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                    <?= htmlspecialchars($_SESSION['flash']['success']); unset($_SESSION['flash']['success']); ?>
                </div>
            <?php endif; ?>

            <!-- ── Stats Grid ── -->
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">

                <!-- Total Exams -->
                <div class="admin-stat-card">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#eff6ff;">
                            <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                    </div>
                    <div class="text-3xl font-black text-slate-900 mb-0.5" style="font-family:'Outfit',sans-serif;"><?= count($exams) ?></div>
                    <div class="text-xs font-semibold text-slate-500">Total Exams</div>
                </div>

                <!-- Questions -->
                <div class="admin-stat-card">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#f0fdf4;">
                            <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                    </div>
                    <div class="text-3xl font-black text-slate-900 mb-0.5" style="font-family:'Outfit',sans-serif;"><?= $totalQuestions ?? 0 ?></div>
                    <div class="text-xs font-semibold text-slate-500">Questions</div>
                </div>

                <!-- Countdowns -->
                <div class="admin-stat-card">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#faf5ff;">
                            <svg class="h-5 w-5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                    </div>
                    <div class="text-3xl font-black text-slate-900 mb-0.5" style="font-family:'Outfit',sans-serif;"><?= count(array_filter($countdowns ?? [], function($c) { return $c['is_active']; })) ?></div>
                    <div class="text-xs font-semibold text-slate-500">Coming Up</div>
                </div>

                <!-- Achievers -->
                <div class="admin-stat-card">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#fefce8;">
                            <svg class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                        </div>
                        <a href="/admin/achievements" class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:#fef9c3;color:#a16207;">+ Add</a>
                    </div>
                    <div class="text-3xl font-black text-slate-900 mb-0.5" style="font-family:'Outfit',sans-serif;"><?= count($achievers ?? []) ?></div>
                    <div class="text-xs font-semibold text-slate-500">Achievers</div>
                </div>

                <!-- Events -->
                <div class="admin-stat-card">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#eef2ff;">
                            <svg class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <a href="/admin/events" class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:#e0e7ff;color:#4338ca;">+ Add</a>
                    </div>
                    <div class="text-3xl font-black text-slate-900 mb-0.5" style="font-family:'Outfit',sans-serif;"><?= count($eventsList ?? []) ?></div>
                    <div class="text-xs font-semibold text-slate-500">Events</div>
                </div>
            </div>

            <!-- ── Competitive Content Management Grid ── -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-black text-slate-900" style="font-family:'Outfit',sans-serif;">Competitive Content Management</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <?php
                    $adminDomains = [
                        ['name'=>'GATE','image'=>'/assets/gate.png','url'=>'/admin/category/GATE','color'=>'#eff6ff','iconColor'=>'#2563eb','desc'=>'Engineering Graduate Aptitude'],
                        ['name'=>'TNPSC','image'=>'/assets/tnpsc.png','url'=>'/admin/category/TNPSC','color'=>'#f0fdf4','iconColor'=>'#16a34a','desc'=>'Tamil Nadu Public Service'],
                        ['name'=>'Banking','image'=>'/assets/Bank.png','url'=>'/admin/category/Banking','color'=>'#eef2ff','iconColor'=>'#4f46e5','desc'=>'IBPS, SBI & RBI Exams'],
                        ['name'=>'UPSC','image'=>'/assets/upsc.jpeg','url'=>'/admin/category/UPSC','color'=>'#fff7ed','iconColor'=>'#ea580c','desc'=>'Civil Services & NDA']
                    ];
                    foreach($adminDomains as $d): ?>
                    <a href="<?= $d['url'] ?>" class="admin-card p-5 flex flex-col items-center text-center group transition-all hover:-translate-y-1 hover:shadow-md">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110" style="background:<?= $d['color'] ?>;">
                            <img src="<?= $d['image'] ?>" alt="<?= $d['name'] ?>" class="w-10 h-10 object-contain">
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition-colors"><?= $d['name'] ?></h3>
                        <p class="text-xs text-slate-400 mt-1"><?= $d['desc'] ?></p>
                        <div class="mt-4 flex items-center text-[10px] font-bold text-indigo-600 uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-all">
                            Manage Content →
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ── Recent Exams + Student Logins ── -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                <!-- Recent Exams -->
                <div class="admin-card">
                    <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid #f1f5f9;">
                        <h2 class="text-base font-black text-slate-900" style="font-family:'Outfit',sans-serif;">Recent Exams</h2>
                        <a href="/admin/exams" class="text-xs font-bold text-indigo-600 hover:text-indigo-800">View All →</a>
                    </div>
                    <div class="p-2 space-y-1 overflow-y-auto max-h-64 light-scrollbar">
                        <?php if(empty($exams)): ?>
                            <p class="text-sm text-slate-400 text-center py-8">No exams created yet</p>
                        <?php else: ?>
                            <?php foreach(array_slice($exams, 0, 5) as $exam): ?>
                            <div class="flex items-center justify-between px-4 py-3 rounded-xl group hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#eff6ff;">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-sm font-semibold text-slate-900 truncate"><?= htmlspecialchars($exam['title'] ?? 'Untitled Exam') ?></h4>
                                        <p class="text-xs text-slate-400"><?= htmlspecialchars($exam['category'] ?? 'General') ?> · <?= $exam['duration'] ?? 0 ?>m</p>
                                    </div>
                                </div>
                                <a href="/admin/exams/edit?id=<?= $exam['id'] ?>" class="p-1.5 rounded-lg text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 transition-colors opacity-0 group-hover:opacity-100">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                </a>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Student Logins -->
                <div class="admin-card">
                    <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid #f1f5f9;">
                        <div>
                            <h2 class="text-base font-black text-slate-900" style="font-family:'Outfit',sans-serif;">Student Logins</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Last 24 hours</p>
                        </div>
                        <a href="/admin/logins/print" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-white transition-all"
                           style="background:#6366f1;">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            Print
                        </a>
                    </div>
                    <div class="overflow-x-auto overflow-y-auto max-h-64 light-scrollbar">
                        <table class="admin-table w-full">
                            <thead>
                                <tr>
                                    <th class="text-left">Student</th>
                                    <th class="text-left">Details</th>
                                    <th class="text-left">Login</th>
                                    <th class="text-left">Logout/Status</th>
                                </tr>
                            </thead>
                            <tbody id="recent-logins-body">
                                <?php if(empty($recentLogins)): ?>
                                    <tr><td colspan="3" class="text-center py-8 text-slate-400 text-xs">No activity found</td></tr>
                                <?php else: ?>
                                    <?php foreach($recentLogins as $login): ?>
                                    <tr>
                                        <td>
                                            <div class="font-semibold text-slate-900"><?= htmlspecialchars($login['name']) ?></div>
                                            <div class="text-slate-400 text-xs"><?= $login['ip_address'] ?? '' ?></div>
                                        </td>
                                        <td>
                                            <div class="text-slate-700"><?= htmlspecialchars($login['year'] ? "Year {$login['year']}" : '') ?> <?= htmlspecialchars($login['department'] ?? '') ?></div>
                                            <div class="text-slate-400 text-xs"><?= htmlspecialchars($login['college'] ?? '') ?></div>
                                        </td>
                                        <td class="text-slate-500 whitespace-nowrap"><?= date('M d, H:i', strtotime($login['login_time'])) ?></td>
                                        <td class="whitespace-nowrap">
                                            <?php if ($login['logout_time']): ?>
                                                <span class="text-slate-500"><?= date('M d, H:i', strtotime($login['logout_time'])) ?></span>
                                            <?php else: ?>
                                                <?php 
                                                $lastActivity = $login['last_activity'] ? strtotime($login['last_activity']) : strtotime($login['login_time']);
                                                $isOnline = (time() - $lastActivity) < 300;
                                                ?>
                                                <span class="<?= $isOnline ? 'text-green-600 font-bold' : 'text-slate-400' ?>">
                                                    <?= $isOnline ? 'Online' : 'Offline' ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ── Gallery Widgets ── -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                <!-- Hall of Fame -->
                <div class="admin-card p-8 flex flex-col items-center text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1" style="background:linear-gradient(90deg,#f59e0b,#eab308);"></div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-4 shadow-md" style="background:linear-gradient(135deg,#fef3c7,#fde68a);">
                        <svg class="h-7 w-7 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                    </div>
                    <h2 class="text-xl font-black text-slate-900 mb-2" style="font-family:'Outfit',sans-serif;">Hall of Fame</h2>
                    <p class="text-sm text-slate-500 mb-5">Explore top achievers across all batch years.</p>
                    <a href="/achievers/gallery" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold text-white transition-all hover:-translate-y-0.5"
                       style="background:linear-gradient(135deg,#f59e0b,#d97706);box-shadow:0 4px 14px rgba(245,158,11,0.35);">
                        View Achievers Gallery →
                    </a>
                </div>

                <!-- Campus Events -->
                <div class="admin-card p-8 flex flex-col items-center text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1" style="background:linear-gradient(90deg,#6366f1,#8b5cf6);"></div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-4 shadow-md" style="background:linear-gradient(135deg,#e0e7ff,#c7d2fe);">
                        <svg class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h2 class="text-xl font-black text-slate-900 mb-2" style="font-family:'Outfit',sans-serif;">Campus Events</h2>
                    <p class="text-sm text-slate-500 mb-5">Relive the moments and explore campus activities.</p>
                    <a href="/events/gallery" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold text-white transition-all hover:-translate-y-0.5"
                       style="background:linear-gradient(135deg,#6366f1,#4f46e5);box-shadow:0 4px 14px rgba(99,102,241,0.35);">
                        View Events Gallery →
                    </a>
                </div>
            </div>

            <!-- ── Exam Countdowns ── -->
            <div class="admin-card p-6 mb-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-base font-black text-slate-900" style="font-family:'Outfit',sans-serif;">Active Exam Countdowns</h2>
                    <a href="/admin/exam-countdowns" class="text-xs font-bold text-indigo-600 hover:text-indigo-800">Manage →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php if(empty($countdowns)): ?>
                        <p class="col-span-full text-sm text-slate-400 text-center py-6">No active countdowns</p>
                    <?php else: ?>
                        <?php foreach(array_slice($countdowns, 0, 6) as $cd): ?>
                        <div class="flex items-center gap-4 p-4 rounded-xl transition-all hover:-translate-y-0.5"
                             style="background:#f8fafc;border:1px solid #e2e8f0;">
                            <div class="h-12 w-12 rounded-xl flex flex-col items-center justify-center flex-shrink-0 text-xs font-black shadow-sm"
                                 style="background:linear-gradient(135deg,#6366f1,#4f46e5);color:white;">
                                <span class="text-[10px] opacity-80"><?= date('M', strtotime($cd['exam_date'])) ?></span>
                                <span class="text-base leading-none"><?= date('d', strtotime($cd['exam_date'])) ?></span>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-sm font-bold text-slate-900 truncate"><?= htmlspecialchars($cd['exam_name'] ?? 'Untitled Exam') ?></h4>
                                <span class="inline-flex items-center gap-1 text-xs font-semibold <?= $cd['is_active'] ? 'text-green-600' : 'text-slate-400' ?>">
                                    <span class="w-1.5 h-1.5 rounded-full <?= $cd['is_active'] ? 'bg-green-500' : 'bg-slate-400' ?>"></span>
                                    <?= $cd['is_active'] ? 'Active' : 'Hidden' ?>
                                </span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ── Live Student Scores ── -->
            <div class="admin-card mb-6">
                <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid #f1f5f9;">
                    <div>
                        <h2 class="text-base font-black text-slate-900" style="font-family:'Outfit',sans-serif;">Live Student Scores</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Real-time submission updates</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="/admin/scores/print" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background:#6366f1;">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            Print
                        </a>
                        <span id="last-updated" class="text-xs text-slate-400 font-mono">Syncing...</span>
                        <button onclick="fetchResults()" class="p-2 rounded-lg text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="admin-table w-full">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Exam</th>
                                <th>Score</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody id="results-table-body">
                            <?php if (!empty($recentResults)): ?>
                                <?php foreach ($recentResults as $result): ?>
                                <tr>
                                    <td>
                                        <div class="font-semibold text-slate-900"><?= htmlspecialchars($result['student_name']) ?></div>
                                        <div class="text-slate-400 text-xs"><?= htmlspecialchars($result['student_id']) ?></div>
                                    </td>
                                    <td class="text-slate-700"><?= htmlspecialchars($result['exam_title']) ?></td>
                                    <td>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold <?= $result['percentage'] >= 70 ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' ?>">
                                            <?= $result['score'] ?>/<?= $result['total_questions'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="inline-flex items-center gap-1 text-xs font-semibold <?= ($result['percentage'] ?? 0) >= 70 ? 'text-green-600' : 'text-red-600' ?>">
                                            <?= ($result['percentage'] ?? 0) >= 70 ? '✓ Passed' : '✗ Failed' ?>
                                        </span>
                                    </td>
                                    <td class="text-slate-500 whitespace-nowrap"><?= date('M d, H:i', strtotime($result['created_at'] ?? 'now')) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="py-8 text-center text-sm text-slate-400">No results found yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ── Quick Links Manager ── -->
            <div class="admin-card p-6">
                <h2 class="text-base font-black text-slate-900 mb-5" style="font-family:'Outfit',sans-serif;">Quick Links Manager</h2>
                
                <!-- Add Quick Link Form -->
                <form id="add-quicklink-form" class="flex flex-col md:flex-row gap-3 mb-5">
                    <input type="text" name="title" placeholder="Link Title" required
                           class="flex-1 px-4 py-2.5 rounded-xl text-sm text-slate-900 font-medium transition-all"
                           style="background:#f8fafc;border:1px solid #e2e8f0;" onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='#e2e8f0'">
                    <select name="icon" class="px-4 py-2.5 rounded-xl text-sm font-medium text-slate-700" style="background:#f8fafc;border:1px solid #e2e8f0;">
                        <option value="link">🔗 Link</option>
                        <option value="book">📚 Book</option>
                        <option value="video">📹 Video</option>
                        <option value="download">⬇️ Download</option>
                        <option value="external">🌐 External</option>
                        <option value="document">📄 Document</option>
                    </select>
                    <input type="url" name="url" placeholder="https://..." required
                           class="flex-1 px-4 py-2.5 rounded-xl text-sm text-slate-900 font-medium transition-all"
                           style="background:#f8fafc;border:1px solid #e2e8f0;" onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='#e2e8f0'">
                    <button type="submit" class="px-6 py-2.5 rounded-xl text-sm font-bold text-white transition-all hover:-translate-y-0.5"
                            style="background:linear-gradient(135deg,#6366f1,#4f46e5);box-shadow:0 4px 12px rgba(99,102,241,0.3);">Add Link</button>
                </form>
                
                <div id="quicklink-message" class="text-sm text-center hidden mb-4"></div>
                
                <!-- Quick Links List (Sortable) -->
                <div id="quick-links-list" class="space-y-2 max-h-64 overflow-y-auto light-scrollbar">
                    <?php if(empty($quickLinks)): ?>
                        <div class="text-center text-slate-400 text-sm py-4">No quick links added yet.</div>
                    <?php else: ?>
                        <?php foreach($quickLinks as $link): ?>
                        <div class="quick-link-item" data-id="<?= $link['id'] ?>" style="cursor: move;">
                            <div class="flex items-center justify-between p-3 rounded-xl transition-all" style="background:#f8fafc;border:1px solid #e2e8f0;">
                                <div class="flex items-center flex-1 mr-3">
                                    <div class="drag-handle mr-3 text-slate-400 cursor-move">⋮⋮</div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2">
                                            <span class="quick-link-icon"><?= getIconForType($link['icon'] ?? 'link') ?></span>
                                            <h4 class="quick-link-title text-sm font-bold text-slate-900"><?= htmlspecialchars($link['title']) ?></h4>
                                            <?php if(!$link['is_active']): ?>
                                                <span class="text-xs text-slate-400">(Inactive)</span>
                                            <?php endif; ?>
                                        </div>
                                        <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" class="quick-link-url text-xs text-indigo-600 hover:underline truncate block mt-1"><?= htmlspecialchars($link['url']) ?></a>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button onclick="toggleQuickLink(<?= $link['id'] ?>)" class="p-1.5 rounded-lg transition-all text-xs font-medium <?= $link['is_active'] ? 'text-green-600 bg-green-100' : 'text-slate-400 bg-slate-100' ?>" title="<?= $link['is_active'] ? 'Deactivate' : 'Activate' ?>">
                                        <?= $link['is_active'] ? '👁️' : '👁️‍🗨️' ?>
                                    </button>
                                    <button onclick="editQuickLink(<?= $link['id'] ?>)" class="p-1.5 rounded-lg bg-blue-100 text-blue-600 transition-all text-xs font-medium" title="Edit">✏️</button>
                                    <button onclick="deleteQuickLink(<?= $link['id'] ?>)" class="p-1.5 rounded-lg bg-red-100 text-red-600 transition-all text-xs font-medium" title="Delete">🗑️</button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </main>
</div>

<script>
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleString(undefined, options);
}

function updateResultsTable(results) {
    const tbody = document.getElementById('results-table-body');
    if (!results || results.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="py-8 text-center text-sm" style="color:#94a3b8;">No results found.</td></tr>';
        return;
    }
    tbody.innerHTML = results.map(result => {
        const passed = result.percentage >= 70;
        const statusClass = passed ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100';
        return `
            <tr style="border-bottom:1px solid #f1f5f9;">
                <td style="padding:12px 20px;">
                    <div style="font-weight:600;font-size:.82rem;color:#1e293b;">${result.student_name}</div>
                    <div style="font-size:.7rem;color:#94a3b8;">${result.student_id}</div>
                </td>
                <td style="padding:12px 20px;font-size:.82rem;color:#475569;">${result.exam_title}</td>
                <td style="padding:12px 20px;">
                    <span style="padding:2px 10px;border-radius:999px;font-size:.72rem;font-weight:700;${passed?'background:#dcfce7;color:#15803d':'background:#fee2e2;color:#b91c1c'}">
                        ${result.score}/${result.total_questions}
                    </span>
                </td>
                <td style="padding:12px 20px;font-size:.82rem;${passed?'color:#16a34a;font-weight:600':'color:#dc2626;font-weight:600'}">
                    ${passed ? '✓ Passed' : '✗ Failed'}
                </td>
                <td style="padding:12px 20px;font-size:.72rem;color:#94a3b8;white-space:nowrap;">
                    ${formatDate(new Date(result.created_at))}
                </td>
            </tr>`;
    }).join('');
}

async function fetchLogins() {
    try {
        const response = await fetch('/api/admin/logins');
        const logs = await response.json();
        const tbody = document.getElementById('recent-logins-body');
        
        if (!logs || logs.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center py-8 text-slate-400 text-xs">No activity found</td></tr>';
            return;
        }
        
        tbody.innerHTML = logs.map(log => `
            <tr style="border-bottom:1px solid #f1f5f9;">
                <td style="padding:12px 20px;">
                    <div style="font-weight:600;font-size:.82rem;color:#1e293b;">${log.name}</div>
                    <div style="font-size:.7rem;color:#94a3b8;">${log.ip_address || ''}</div>
                </td>
                <td style="padding:12px 20px;font-size:.82rem;color:#475569;">
                    <div>${log.year ? "Year " + log.year : ''} ${log.department || ''}</div>
                    <div style="font-size:.7rem;color:#94a3b8;">${log.college || ''}</div>
                </td>
                <td style="padding:12px 20px;font-size:.72rem;color:#94a3b8;white-space:nowrap;">
                    ${log.formatted_time}
                </td>
                <td style="padding:12px 20px;font-size:.82rem;white-space:nowrap;" class="${log.status_class || ''}">
                    ${log.formatted_logout || ''}
                </td>
            </tr>
        `).join('');
    } catch (error) {
        console.error('Error fetching logins:', error);
    }
}

async function fetchResults() {
    try {
        const btn = document.querySelector('button[onclick="fetchResults()"] svg');
        if(btn) btn.classList.add('animate-spin');
        const response = await fetch('/api/admin/results?limit=10');
        const data = await response.json();
        if (data.success) {
            updateResultsTable(data.data);
            document.getElementById('last-updated').textContent = `Synced: ${new Date().toLocaleTimeString()}`;
        }
    } catch (error) {
        console.error('Error fetching results:', error);
    } finally {
        const btn = document.querySelector('button[onclick="fetchResults()"] svg');
        if(btn) btn.classList.remove('animate-spin');
    }
}

// Quick Links Management
function getIconForType(iconType) {
    const icons = {
        'link': '🔗',
        'book': '📚',
        'video': '📹',
        'download': '⬇️',
        'external': '🌐',
        'document': '📄'
    };
    return icons[iconType] || '🔗';
}

function showQuickLinkMessage(message, type = 'success') {
    const messageEl = document.getElementById('quicklink-message');
    messageEl.textContent = message;
    messageEl.className = `text-sm text-center mb-4 ${type === 'success' ? 'text-green-600' : 'text-red-600'}`;
    messageEl.classList.remove('hidden');
    setTimeout(() => messageEl.classList.add('hidden'), 3000);
}

async function addQuickLink(formData) {
    try {
        const response = await fetch('/admin/quick-links/store', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        
        if (result.success) {
            showQuickLinkMessage(result.message, 'success');
            document.getElementById('add-quicklink-form').reset();
            loadQuickLinks();
        } else {
            showQuickLinkMessage(result.message, 'error');
        }
    } catch (error) {
        showQuickLinkMessage('Failed to add quick link', 'error');
    }
}

async function updateQuickLink(id, formData) {
    try {
        const response = await fetch(`/admin/quick-links/update/${id}`, {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        
        if (result.success) {
            showQuickLinkMessage(result.message, 'success');
            loadQuickLinks();
        } else {
            showQuickLinkMessage(result.message, 'error');
        }
    } catch (error) {
        showQuickLinkMessage('Failed to update quick link', 'error');
    }
}

async function deleteQuickLink(id) {
    if (!confirm('Are you sure you want to delete this quick link?')) return;
    
    try {
        const response = await fetch(`/admin/quick-links/delete/${id}`, {
            method: 'POST'
        });
        const result = await response.json();
        
        if (result.success) {
            showQuickLinkMessage(result.message, 'success');
            loadQuickLinks();
        } else {
            showQuickLinkMessage(result.message, 'error');
        }
    } catch (error) {
        showQuickLinkMessage('Failed to delete quick link', 'error');
    }
}

async function toggleQuickLink(id) {
    try {
        const response = await fetch(`/admin/quick-links/toggle/${id}`, {
            method: 'POST'
        });
        const result = await response.json();
        
        if (result.success) {
            showQuickLinkMessage(result.message, 'success');
            loadQuickLinks();
        } else {
            showQuickLinkMessage(result.message, 'error');
        }
    } catch (error) {
        showQuickLinkMessage('Failed to toggle quick link status', 'error');
    }
}

function editQuickLink(id) {
    const item = document.querySelector(`.quick-link-item[data-id="${id}"]`);
    const titleEl = item.querySelector('.quick-link-title');
    const urlEl = item.querySelector('.quick-link-url');
    const iconEl = item.querySelector('.quick-link-icon');
    
    const currentTitle = titleEl.textContent;
    const currentUrl = urlEl.href;
    const currentIcon = iconEl.textContent;
    
    // Create edit form
    const editForm = document.createElement('div');
    editForm.className = 'edit-form p-3 rounded-xl bg-blue-50 border-2 border-blue-200';
    editForm.innerHTML = `
        <div class="space-y-3">
            <input type="text" id="edit-title-${id}" value="${currentTitle}" class="w-full px-3 py-2 rounded-lg text-sm border border-blue-300" placeholder="Title">
            <select id="edit-icon-${id}" class="w-full px-3 py-2 rounded-lg text-sm border border-blue-300">
                <option value="link" ${currentIcon === '🔗' ? 'selected' : ''}>🔗 Link</option>
                <option value="book" ${currentIcon === '📚' ? 'selected' : ''}>📚 Book</option>
                <option value="video" ${currentIcon === '📹' ? 'selected' : ''}>📹 Video</option>
                <option value="download" ${currentIcon === '⬇️' ? 'selected' : ''}>⬇️ Download</option>
                <option value="external" ${currentIcon === '🌐' ? 'selected' : ''}>🌐 External</option>
                <option value="document" ${currentIcon === '📄' ? 'selected' : ''}>📄 Document</option>
            </select>
            <input type="url" id="edit-url-${id}" value="${currentUrl}" class="w-full px-3 py-2 rounded-lg text-sm border border-blue-300" placeholder="https://...">
            <div class="flex gap-2">
                <button onclick="saveQuickLinkEdit(${id})" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">Save</button>
                <button onclick="cancelQuickLinkEdit(${id})" class="px-4 py-2 bg-slate-600 text-white rounded-lg text-sm font-medium hover:bg-slate-700">Cancel</button>
            </div>
        </div>
    `;
    
    // Replace the content with edit form
    const contentDiv = item.querySelector('.flex.items-center.justify-between');
    contentDiv.style.display = 'none';
    contentDiv.parentNode.appendChild(editForm);
}

function saveQuickLinkEdit(id) {
    const title = document.getElementById(`edit-title-${id}`).value;
    const url = document.getElementById(`edit-url-${id}`).value;
    const icon = document.getElementById(`edit-icon-${id}`).value;
    
    if (!title || !url) {
        alert('Title and URL are required');
        return;
    }
    
    const formData = new FormData();
    formData.append('title', title);
    formData.append('url', url);
    formData.append('icon', icon);
    
    updateQuickLink(id, formData);
}

function cancelQuickLinkEdit(id) {
    const item = document.querySelector(`.quick-link-item[data-id="${id}"]`);
    const editForm = item.querySelector('.edit-form');
    const contentDiv = item.querySelector('.flex.items-center.justify-between');
    
    if (editForm) editForm.remove();
    contentDiv.style.display = 'flex';
}

async function loadQuickLinks() {
    try {
        const response = await fetch('/admin/quick-links/all');
        const result = await response.json();
        
        if (result.success) {
            updateQuickLinksList(result.data);
        }
    } catch (error) {
        console.error('Error loading quick links:', error);
    }
}

function updateQuickLinksList(links) {
    const listEl = document.getElementById('quick-links-list');
    
    if (links.length === 0) {
        listEl.innerHTML = '<div class="text-center text-slate-400 text-sm py-4">No quick links added yet.</div>';
        return;
    }
    
    listEl.innerHTML = links.map(link => `
        <div class="quick-link-item" data-id="${link.id}" style="cursor: move;">
            <div class="flex items-center justify-between p-3 rounded-xl transition-all" style="background:#f8fafc;border:1px solid #e2e8f0;">
                <div class="flex items-center flex-1 mr-3">
                    <div class="drag-handle mr-3 text-slate-400 cursor-move">⋮⋮</div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2">
                            <span class="quick-link-icon">${getIconForType(link.icon ?? 'link')}</span>
                            <h4 class="quick-link-title text-sm font-bold text-slate-900">${link.title}</h4>
                            ${!link.is_active ? '<span class="text-xs text-slate-400">(Inactive)</span>' : ''}
                        </div>
                        <a href="${link.url}" target="_blank" class="quick-link-url text-xs text-indigo-600 hover:underline truncate block mt-1">${link.url}</a>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="toggleQuickLink(${link.id})" class="p-1.5 rounded-lg transition-all text-xs font-medium ${link.is_active ? 'text-green-600 bg-green-100' : 'text-slate-400 bg-slate-100'}" title="${link.is_active ? 'Deactivate' : 'Activate'}">
                        ${link.is_active ? '👁️' : '👁️‍🗨️'}
                    </button>
                    <button onclick="editQuickLink(${link.id})" class="p-1.5 rounded-lg bg-blue-100 text-blue-600 transition-all text-xs font-medium" title="Edit">✏️</button>
                    <button onclick="deleteQuickLink(${link.id})" class="p-1.5 rounded-lg bg-red-100 text-red-600 transition-all text-xs font-medium" title="Delete">🗑️</button>
                </div>
            </div>
        </div>
    `).join('');
    
    initializeSortable();
}

function initializeSortable() {
    const listEl = document.getElementById('quick-links-list');
    let draggedItem = null;
    
    listEl.addEventListener('dragstart', (e) => {
        if (e.target.classList.contains('quick-link-item')) {
            draggedItem = e.target;
            e.target.style.opacity = '0.5';
        }
    });
    
    listEl.addEventListener('dragend', (e) => {
        if (e.target.classList.contains('quick-link-item')) {
            e.target.style.opacity = '';
        }
    });
    
    listEl.addEventListener('dragover', (e) => {
        e.preventDefault();
        const afterElement = getDragAfterElement(listEl, e.clientY);
        if (afterElement == null) {
            listEl.appendChild(draggedItem);
        } else {
            listEl.insertBefore(draggedItem, afterElement);
        }
    });
    
    listEl.addEventListener('drop', async (e) => {
        e.preventDefault();
        const linkIds = Array.from(listEl.querySelectorAll('.quick-link-item')).map(item => item.dataset.id);
        await reorderQuickLinks(linkIds);
    });
}

function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.quick-link-item:not(.dragging)')];
    
    return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        
        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child };
        } else {
            return closest;
        }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
}

async function reorderQuickLinks(linkIds) {
    try {
        const formData = new FormData();
        formData.append('link_ids', JSON.stringify(linkIds));
        
        const response = await fetch('/admin/quick-links/reorder', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        if (result.success) {
            showQuickLinkMessage('Quick links reordered successfully', 'success');
        }
    } catch (error) {
        showQuickLinkMessage('Failed to reorder quick links', 'error');
    }
}

// Initialize form submission
document.addEventListener('DOMContentLoaded', function() {
    const addForm = document.getElementById('add-quicklink-form');
    if (addForm) {
        addForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            addQuickLink(formData);
        });
    }
    
    // Make quick link items draggable
    document.querySelectorAll('.quick-link-item').forEach(item => {
        item.draggable = true;
    });
    
    initializeSortable();
});

function setupEventSource() {
    if (typeof eventSource !== 'undefined' && eventSource) eventSource.close();
    eventSource = new EventSource('/api/updates');
    eventSource.onmessage = function(event) {
        const data = JSON.parse(event.data);
        if (data.type === 'new_result') fetchResults();
    };
    eventSource.onerror = function() {
        eventSource.close();
        setTimeout(setupEventSource, 5000);
    };
}

document.addEventListener('DOMContentLoaded', function() {
    fetchResults();
    fetchLogins();
    setupEventSource();
    setInterval(() => {
        fetchResults();
        fetchLogins();
    }, 30000);
});
</script>
