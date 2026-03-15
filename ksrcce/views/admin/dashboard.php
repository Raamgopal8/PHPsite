<?php $path = 'admin/dashboard.php'; ?>

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
                    <div class="flex items-center gap-3">
                        <a href="/admin/exams/create" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white transition-all hover:-translate-y-0.5"
                           style="background:linear-gradient(135deg,#6366f1,#4f46e5);box-shadow:0 4px 14px rgba(99,102,241,0.35);">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            New Exam
                        </a>
                    </div>
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

            <!-- ── Domain Management Banner ── -->
            <div class="admin-card p-7 mb-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-full pointer-events-none" style="background:linear-gradient(135deg,#eef2ff,#f5f3ff);clip-path:ellipse(100% 100% at 100% 50%);"></div>
                <div class="relative flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold mb-3" style="background:#eef2ff;color:#4f46e5;border:1px solid #c7d2fe;">
                            ⚙️ Manage Competitive Content
                        </div>
                        <h2 class="text-2xl font-black text-slate-900 mb-1" style="font-family:'Outfit',sans-serif;">Centralized Control</h2>
                        <p class="text-sm text-slate-500 mb-4">Manage GATE, TNPSC, Banking, and UPSC syllabus and materials.</p>
                        <div class="flex flex-wrap gap-2">
                            <?php
                            $domains = [
                                ['name'=>'GATE','image'=>'/assets/gate.png','url'=>'/student/gate','color'=>'#dbeafe','tc'=>'#1d4ed8'],
                                ['name'=>'TNPSC','image'=>'/assets/tnpsc.png','url'=>'/student/tnpsc','color'=>'#dcfce7','tc'=>'#15803d'],
                                ['name'=>'Banking','image'=>'/assets/Bank.png','url'=>'/student/banking','color'=>'#e0e7ff','tc'=>'#4338ca'],
                                ['name'=>'UPSC','image'=>'/assets/upsc.jpeg','url'=>'/student/upsc','color'=>'#ffedd5','tc'=>'#c2410c'],
                            ];
                            foreach($domains as $d): ?>
                            <a href="<?= $d['url'] ?>" class="flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-bold transition-all hover:-translate-y-0.5"
                               style="background:<?= $d['color'] ?>;color:<?= $d['tc'] ?>;border:1px solid <?= $d['tc'] ?>22;">
                                <div class="w-5 h-5 rounded overflow-hidden flex-shrink-0">
                                    <img src="<?= $d['image'] ?>" alt="<?= $d['name'] ?>" class="w-full h-full object-cover">
                                </div>
                                <?= $d['name'] ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 flex-shrink-0">
                        <a href="/admin/syllabi" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white transition-all hover:-translate-y-0.5"
                           style="background:linear-gradient(135deg,#3b82f6,#2563eb);box-shadow:0 4px 14px rgba(59,130,246,0.3);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Syllabus
                        </a>
                        <a href="/admin/materials" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white transition-all hover:-translate-y-0.5"
                           style="background:linear-gradient(135deg,#6366f1,#4f46e5);box-shadow:0 4px 14px rgba(99,102,241,0.3);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            Materials
                        </a>
                    </div>
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
                                    <th class="text-left">Time</th>
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
                <form id="add-link-form" action="/admin/official-links/store" method="POST" class="flex flex-col md:flex-row gap-3 mb-5">
                    <input type="text" name="title" placeholder="Title" required
                           class="flex-1 px-4 py-2.5 rounded-xl text-sm text-slate-900 font-medium transition-all"
                           style="background:#f8fafc;border:1px solid #e2e8f0;" onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='#e2e8f0'">
                    <select name="category" class="px-4 py-2.5 rounded-xl text-sm font-medium text-slate-700" style="background:#f8fafc;border:1px solid #e2e8f0;">
                        <option value="GATE">GATE</option>
                        <option value="Banking">Banking</option>
                        <option value="UPSC">UPSC</option>
                        <option value="TNPSC">TNPSC</option>
                    </select>
                    <input type="url" name="url" placeholder="https://..." required
                           class="flex-1 px-4 py-2.5 rounded-xl text-sm text-slate-900 font-medium transition-all"
                           style="background:#f8fafc;border:1px solid #e2e8f0;" onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='#e2e8f0'">
                    <button type="submit" class="px-6 py-2.5 rounded-xl text-sm font-bold text-white transition-all hover:-translate-y-0.5"
                            style="background:linear-gradient(135deg,#6366f1,#4f46e5);box-shadow:0 4px 12px rgba(99,102,241,0.3);">Add Link</button>
                </form>
                <div id="link-message" class="text-sm text-center hidden mb-4"></div>
                <div id="official-links-list" class="space-y-2 max-h-48 overflow-y-auto light-scrollbar">
                    <?php if(empty($officialLinks)): ?>
                        <div class="text-center text-slate-400 text-sm py-4">No links added yet.</div>
                    <?php else: ?>
                        <?php foreach($officialLinks as $link): ?>
                        <div class="flex items-center justify-between p-3 rounded-xl" style="background:#f8fafc;border:1px solid #e2e8f0;">
                            <div class="min-w-0 flex-1 mr-3">
                                <h4 class="text-sm font-bold text-slate-900 truncate"><?= htmlspecialchars($link['title']) ?></h4>
                                <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" class="text-xs text-indigo-600 hover:underline truncate block"><?= htmlspecialchars($link['url']) ?></a>
                            </div>
                            <span class="text-xs font-bold px-2 py-1 rounded-lg flex-shrink-0" style="background:#eef2ff;color:#4338ca;"><?= htmlspecialchars($link['category'] ?? 'General') ?></span>
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
    setupEventSource();
    setInterval(fetchResults, 30000);
});
</script>
