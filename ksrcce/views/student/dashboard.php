<?php $path = 'student/dashboard.php'; ?>

<style>
/* ── Student Dashboard Light Theme ── */

.sd-card {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    box-shadow: var(--shadow-sm);
}
.sd-card-hover {
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}
.sd-card-hover:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: #c7d2fe;
}
.sd-badge {
    display: inline-flex; align-items: center;
    padding: 4px 10px; border-radius: 99px;
    font-size: 0.7rem; font-weight: 700;
}
.sd-section-heading {
    font-family: 'Outfit', sans-serif;
    font-size: 1.125rem; font-weight: 900; color: var(--text-primary);
    letter-spacing: -0.01em;
}
.sd-domain-card {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 24px 16px;
    display: flex; flex-direction: column; align-items: center;
    text-align: center; text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative; overflow: hidden;
}
.sd-domain-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px -5px rgba(99, 102, 241, 0.15);
    border-color: #6366f1;
}
.exam-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 16px; border-radius: 16px; background: #f8fafc;
    border: 1px solid var(--border-color); transition: all 0.2s;
}
.exam-row:hover { background: #eef2ff; border-color: #c7d2fe; }
.light-scrollbar::-webkit-scrollbar { width: 4px; }
.light-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 2px; }
.sd-sidebar-link {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 12px; border-radius: 12px; text-decoration: none;
    border: 1px solid #f1f5f9; background: #f8fafc; transition: all 0.2s;
}
.sd-sidebar-link:hover { background: #eef2ff; border-color: #c7d2fe; }
.timer-box {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 18px; padding: 18px;
    transition: all 0.3s ease;
}
.timer-box:hover { border-color: #c7d2fe; box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.1); }
</style>

<div class="px-4 pt-6 pb-32 space-y-6">

    <!-- ── Hero Banner ── -->
    <div class="sd-card p-7 md:p-9 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-72 h-full pointer-events-none" style="background:linear-gradient(135deg,#eef2ff,#f5f3ff);clip-path:ellipse(100% 100% at 100% 50%);"></div>
        <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold mb-4"
                     style="background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d;">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Student Dashboard
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 mb-2" style="font-family:'Outfit',sans-serif;letter-spacing:-0.02em;">
                    Hey, <span style="background:linear-gradient(135deg,#6366f1,#8b5cf6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"><?= htmlspecialchars($_SESSION['user']['name']) ?>!</span> 👋
                </h1>
                <p class="text-slate-500 text-base">Your competitive exam journey continues. Let's crush it today.</p>
            </div>
            <!-- Quick Stats -->
            <div class="flex items-center gap-3 flex-shrink-0">
                <div class="text-center px-5 py-3 rounded-2xl" style="background:#eef2ff;border:1.5px solid #c7d2fe;">
                    <div class="text-2xl font-black text-indigo-700" style="font-family:'Outfit',sans-serif;"><?= count($exams) ?></div>
                    <div class="text-xs text-indigo-500 font-semibold mt-0.5">Exams</div>
                </div>
                <div class="text-center px-5 py-3 rounded-2xl" style="background:#f0fdf4;border:1.5px solid #bbf7d0;">
                    <div class="text-2xl font-black text-green-700" style="font-family:'Outfit',sans-serif;"><?= $stats['completed'] ?? 0 ?></div>
                    <div class="text-xs text-green-600 font-semibold mt-0.5">Done</div>
                </div>
                <div class="text-center px-5 py-3 rounded-2xl" style="background:#fefce8;border:1.5px solid #fde68a;">
                    <div class="text-2xl font-black text-yellow-700" style="font-family:'Outfit',sans-serif;"><?= isset($stats['avg_score']) ? round($stats['avg_score'],0).'%' : '-' ?></div>
                    <div class="text-xs text-yellow-600 font-semibold mt-0.5">Avg</div>
                </div>
            </div>
        </div>
        <?php if(!empty($_SESSION['flash']['success'])): ?>
            <div class="mt-5 p-4 rounded-2xl flex items-center gap-3" style="background:#f0fdf4;border:1px solid #bbf7d0;">
                <svg class="h-5 w-5 text-green-600 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                <span class="text-green-800 font-semibold text-sm"><?= htmlspecialchars($_SESSION['flash']['success']); unset($_SESSION['flash']['success']); ?></span>
            </div>
        <?php endif; ?>
    </div>

    <!-- ── Choose Your Domain ── -->
    <div>
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="sd-section-heading flex items-center gap-2">🎯 Choose Your Domain</h2>
                <p class="text-sm text-slate-500 mt-0.5">Select an exam category to explore resources</p>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php
            $domains = [
                ['href'=>'/student/gate',    'img'=>'/assets/gate.png',    'title'=>'GATE',    'sub'=>'Engineering',   'hover'=>'#dbeafe','border'=>'#3b82f6','tc'=>'#1d4ed8'],
                ['href'=>'/student/tnpsc',   'img'=>'/assets/tnpsc.png',   'title'=>'TNPSC',   'sub'=>'State Services', 'hover'=>'#dcfce7','border'=>'#22c55e','tc'=>'#15803d'],
                ['href'=>'/student/banking', 'img'=>'/assets/Bank.png',    'title'=>'Banking',  'sub'=>'IBPS · SBI · RBI','hover'=>'#e0e7ff','border'=>'#6366f1','tc'=>'#4338ca'],
                ['href'=>'/student/upsc',    'img'=>'/assets/upsc.jpeg',   'title'=>'UPSC',    'sub'=>'Civil Services',  'hover'=>'#ffedd5','border'=>'#f97316','tc'=>'#c2410c'],
            ];
            foreach($domains as $d): ?>
            <a href="<?= $d['href'] ?>" class="sd-domain-card group"
               onmouseover="this.style.borderColor='<?= $d['border'] ?>';this.style.background='<?= $d['hover'] ?>';"
               onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fff';">
                <div class="w-16 h-16 mb-4 mx-auto">
                    <img src="<?= $d['img'] ?>" alt="<?= $d['title'] ?>" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300 drop-shadow">
                </div>
                <h3 class="font-black text-slate-900 text-base mb-0.5" style="font-family:'Outfit',sans-serif;"><?= $d['title'] ?></h3>
                <p class="text-xs font-semibold" style="color:<?= $d['tc'] ?>;"><?= $d['sub'] ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ── Exam Countdowns ── -->
    <div class="sd-card p-7">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#fee2e2;">
                    <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <h2 class="sd-section-heading">Exam Countdowns</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Live countdown to your next exams</p>
                </div>
            </div>
            <span class="sd-badge" style="background:#fee2e2;color:#dc2626;border:1px solid #fecaca;">● Live</span>
        </div>
        <div id="exam-countdowns" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <div class="col-span-full text-center py-10 rounded-2xl" style="background:#f8fafc;border:1.5px dashed #e2e8f0;">
                <svg class="mx-auto h-10 w-10 text-slate-300 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <p class="mt-3 text-sm text-slate-500 font-medium">Loading countdowns...</p>
            </div>
        </div>
    </div>

    <!-- ── Main Content + Sidebar ── -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left Panel -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Available Exams -->
            <div class="sd-card p-7">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="sd-section-heading">Available Exams</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Take a mock test right now</p>
                    </div>
                    <span class="sd-badge" style="background:#eef2ff;color:#4f46e5;border:1px solid #c7d2fe;"><?= count($exams) ?> Available</span>
                </div>
                <div class="space-y-3">
                    <?php if (empty($exams)): ?>
                        <div class="text-center py-12 rounded-2xl" style="background:#f8fafc;border:1.5px dashed #e2e8f0;">
                            <svg class="h-11 w-11 mx-auto text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            <p class="mt-3 text-sm text-slate-500 font-medium">No exams available right now</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($exams as $e): ?>
                        <div class="exam-row group">
                            <div class="flex items-center gap-4">
                                <div class="h-11 w-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background:linear-gradient(135deg,#eef2ff,#e0e7ff);border:1.5px solid #c7d2fe;">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 text-sm"><?= htmlspecialchars($e['title']) ?></h3>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="sd-badge" style="background:#eef2ff;color:#6366f1;">📝 Mock Test</span>
                                        <span class="sd-badge" style="background:#f8fafc;color:#94a3b8;">⏱ 30 MIN</span>
                                    </div>
                                </div>
                            </div>
                            <a href="/student/take?id=<?= urlencode((string)($e['id'] ?? '')) ?>"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-white flex-shrink-0 hover:-translate-y-0.5 transition-all"
                               style="background:linear-gradient(135deg,#6366f1,#4f46e5);box-shadow:0 4px 12px rgba(99,102,241,0.3);">
                                Start
                                <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Hall of Fame -->
            <div class="sd-card p-7">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="sd-section-heading">🏆 Hall of Fame</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Top performers and achievers</p>
                    </div>
                    <a href="/achievers/gallery" class="text-xs font-bold text-yellow-600 hover:text-yellow-800 transition-colors flex items-center gap-1">View All <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
                </div>
                <div id="featured-achievements" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-full text-center py-10 rounded-2xl" style="background:#f8fafc;border:1.5px dashed #e2e8f0;">
                        <div class="text-3xl mb-2 animate-pulse">🏆</div>
                        <p class="text-sm text-slate-500 font-medium">Loading achievements...</p>
                    </div>
                </div>
            </div>

            <!-- Campus Events -->
            <div class="sd-card p-7">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="sd-section-heading">🎉 Campus Events</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Recent activities and highlights</p>
                    </div>
                    <a href="/events/gallery" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors flex items-center gap-1">View All <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
                </div>
                <div id="featured-events" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-full text-center py-10 rounded-2xl" style="background:#f8fafc;border:1.5px dashed #e2e8f0;">
                        <div class="text-3xl mb-2 animate-pulse">📅</div>
                        <p class="text-sm text-slate-500 font-medium">Loading events...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Latest Events -->
            <div class="sd-card p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-black text-slate-900" style="font-family:'Outfit',sans-serif;">Latest Events</h2>
                    <a href="/events/gallery" class="text-xs font-bold text-indigo-600 hover:text-indigo-800">View All →</a>
                </div>
                <div id="sidebar-events" class="space-y-2">
                    <p class="text-sm text-center text-slate-400 py-4">Loading events...</p>
                </div>
            </div>

            <!-- Official Quick Links -->
            <div class="sd-card p-5">
                <div class="mb-4">
                    <h2 class="text-base font-black text-slate-900" style="font-family:'Outfit',sans-serif;">🔗 Quick Links</h2>
                    <p class="text-xs text-slate-500 mt-1">Official exam portals</p>
                </div>
                <div class="space-y-2">
                    <?php
                    $officialLinks = [];
                    try {
                        $db = (new \App\Core\App())->db;
                        $stmt = $db->prepare("SELECT * FROM official_links ORDER BY created_at DESC");
                        $stmt->execute();
                        $officialLinks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (Exception $e) {}
                    ?>
                    <?php if (empty($officialLinks)): ?>
                        <div class="text-center py-5 text-slate-400 text-sm">No links configured yet</div>
                    <?php else: ?>
                        <?php foreach($officialLinks as $link): ?>
                        <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" rel="noopener noreferrer" class="sd-sidebar-link group">
                            <div class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center" style="background:#eef2ff;">
                                <svg class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-bold text-slate-800 truncate group-hover:text-indigo-600 transition-colors"><?= htmlspecialchars($link['title']) ?></h3>
                                <p class="text-xs text-slate-400 truncate">External Link</p>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Achievers -->
            <div class="sd-card p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-black text-slate-900" style="font-family:'Outfit',sans-serif;">⭐ Recent Achievers</h2>
                    <a href="/achievers/gallery" class="text-xs font-bold text-yellow-600 hover:text-yellow-800">All →</a>
                </div>
                <div id="recent-achievements" class="space-y-2">
                    <p class="text-sm text-center text-slate-400 py-4">Loading...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// ─── Exam Countdowns ──────────────────────────────────────────────────────
function loadExamCountdowns() {
    fetch('/api/exam-countdowns').then(r => r.json()).then(data => {
        const container = document.getElementById('exam-countdowns');
        if (data.countdowns && data.countdowns.length > 0) {
            container.innerHTML = data.countdowns.map(countdown => {
                const exam = countdown.exam;
                const isUrgent     = countdown.days <= 7;
                const isVeryUrgent = countdown.days <= 3;
                const accentColor  = isVeryUrgent ? '#dc2626' : isUrgent ? '#d97706' : '#4f46e5';
                const accentBg     = isVeryUrgent ? '#fee2e2' : isUrgent ? '#fef9c3' : '#eef2ff';
                const accentBorder = isVeryUrgent ? '#fecaca' : isUrgent ? '#fde68a' : '#c7d2fe';
                const urgencyLabel = isVeryUrgent ? '🔴 Very Urgent' : isUrgent ? '🟡 Urgent' : '🔵 Upcoming';
                return `
                    <div class="timer-box">
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="font-bold text-slate-900 text-sm leading-snug">${exam.exam_name}</h3>
                            <span style="display:inline-flex;align-items:center;padding:3px 10px;border-radius:999px;font-size:0.65rem;font-weight:700;background:${accentBg};color:${accentColor};border:1px solid ${accentBorder};white-space:nowrap;margin-left:8px;">${urgencyLabel}</span>
                        </div>
                        <div class="grid grid-cols-4 gap-2 mb-4">
                            <div class="countdown-days text-center">
                                <div class="text-xl font-black countdown-val" style="color:${accentColor};font-family:'Outfit',sans-serif;">${countdown.days}</div>
                                <div class="text-[10px] uppercase font-bold text-slate-400 mt-0.5">Days</div>
                            </div>
                            <div class="countdown-hours text-center">
                                <div class="text-xl font-black countdown-val" style="color:${accentColor};font-family:'Outfit',sans-serif;">${countdown.hours}</div>
                                <div class="text-[10px] uppercase font-bold text-slate-400 mt-0.5">Hrs</div>
                            </div>
                            <div class="countdown-mins text-center">
                                <div class="text-xl font-black countdown-val" style="color:${accentColor};font-family:'Outfit',sans-serif;">${countdown.minutes}</div>
                                <div class="text-[10px] uppercase font-bold text-slate-400 mt-0.5">Min</div>
                            </div>
                            <div class="countdown-secs text-center">
                                <div class="text-xl font-black countdown-val" style="color:${accentColor};font-family:'Outfit',sans-serif;">${countdown.seconds}</div>
                                <div class="text-[10px] uppercase font-bold text-slate-400 mt-0.5">Sec</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 text-xs text-slate-400">
                            <span>📅 ${new Date(exam.exam_date).toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'})}</span>
                            <span>🕐 ${new Date('1970-01-01T'+exam.exam_time).toLocaleTimeString('en-US',{hour:'2-digit',minute:'2-digit'})}</span>
                        </div>
                    </div>`;
            }).join('');
            setInterval(updateCountdowns, 1000);
        } else {
            container.innerHTML = `<div class="col-span-full text-center py-10 rounded-2xl" style="background:#f8fafc;border:1.5px dashed #e2e8f0;"><div class="text-3xl mb-2">⏰</div><p class="text-sm text-slate-500 font-medium">No upcoming exams scheduled.</p></div>`;
        }
    }).catch(e => console.error(e));
}

function updateCountdowns() {
    const cards = document.querySelectorAll('#exam-countdowns > div');
    cards.forEach(card => {
        const vals = card.querySelectorAll('.countdown-val');
        if (vals.length === 4) {
            let d=parseInt(vals[0].textContent),h=parseInt(vals[1].textContent),m=parseInt(vals[2].textContent),s=parseInt(vals[3].textContent);
            s--; if(s<0){s=59;m--;} if(m<0){m=59;h--;} if(h<0){h=23;d--;} if(d<0){location.reload();return;}
            vals[0].textContent=d; vals[1].textContent=h; vals[2].textContent=String(m).padStart(2,'0'); vals[3].textContent=String(s).padStart(2,'0');
        }
    });
}

// ─── Events ────────────────────────────────────────────────────────────────
function loadEvents() {
    fetch('/api/events').then(r=>r.json()).then(data=>{
        const container=document.getElementById('featured-events');
        const sidebarContainer=document.getElementById('sidebar-events');
        const events=(data.featured&&data.featured.length>0)?data.featured:(data.recent||[]);
        if(events.length>0){
            if(container) container.innerHTML=events.slice(0,4).map(e=>createFeaturedEventCard(e)).join('');
            if(sidebarContainer) sidebarContainer.innerHTML=events.slice(0,3).map(e=>createSidebarEventCard(e)).join('');
        } else {
            const empty=`<div class="col-span-full text-center py-10 rounded-2xl" style="background:#f8fafc;border:1.5px dashed #e2e8f0;"><p class="text-sm text-slate-500 font-medium">📅 No events yet.</p></div>`;
            if(container) container.innerHTML=empty;
            if(sidebarContainer) sidebarContainer.innerHTML=`<p class="text-sm text-center text-slate-400">No events yet.</p>`;
        }
    }).catch(e=>console.error(e));
}

function createFeaturedEventCard(event){
    return `
        <div class="group p-5 rounded-2xl border transition-all hover:-translate-y-1" style="background:#f8fafc;border-color:#e2e8f0;">
            <div class="flex items-center gap-4 mb-3">
                ${event.image_url?
                    `<div class="w-12 h-12 rounded-xl overflow-hidden flex-shrink-0"><img src="${event.image_url}" alt="${event.title}" class="w-full h-full object-cover"></div>`:
                    `<div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 text-xl font-bold text-white" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);">${event.title.charAt(0)}</div>`
                }
                <div class="min-w-0">
                    <h4 class="font-bold text-slate-900 truncate text-sm">${event.title}</h4>
                    <p class="text-xs text-slate-500 mt-0.5">${new Date(event.event_date).toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'})}</p>
                </div>
            </div>
            ${event.description?`<p class="text-xs text-slate-500 line-clamp-2">${event.description}</p>`:''}
        </div>`;
}

function createSidebarEventCard(event){
    return `
        <a href="/events/gallery" class="sd-sidebar-link group">
            <div class="flex-shrink-0 w-10 h-10 rounded-xl overflow-hidden">
                ${event.image_url?
                    `<img src="${event.image_url}" alt="${event.title}" class="w-full h-full object-cover">`:
                    `<div class="w-full h-full flex items-center justify-center text-white font-bold" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);">${event.title.charAt(0)}</div>`
                }
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-sm font-bold text-slate-800 truncate group-hover:text-indigo-600">${event.title}</h4>
                <span class="text-xs text-slate-400">📅 ${new Date(event.event_date).toLocaleDateString('en-US',{month:'short',day:'numeric'})}</span>
            </div>
        </a>`;
}

// ─── Achievements ──────────────────────────────────────────────────────────
function loadAchievements(){
    fetch('/api/achievements').then(r=>r.json()).then(data=>{
        const featured=document.getElementById('featured-achievements');
        const recent=document.getElementById('recent-achievements');
        if(data.featured&&data.featured.length>0){
            featured.innerHTML=data.featured.map(a=>createFeaturedAchievementCard(a)).join('');
        } else {
            featured.innerHTML=`<div class="col-span-full text-center py-10 rounded-2xl" style="background:#f8fafc;border:1.5px dashed #e2e8f0;"><p class="text-sm text-slate-500 font-medium">🏆 No featured achievers yet.</p></div>`;
        }
        if(recent&&data.recent&&data.recent.length>0){
            recent.innerHTML=data.recent.map(a=>createRecentAchievementCard(a)).join('');
        } else if(recent){
            recent.innerHTML=`<p class="text-sm text-center text-slate-400">No recent achievers.</p>`;
        }
    }).catch(e=>console.error(e));
}

function createFeaturedAchievementCard(a){
    return `
        <div class="group p-5 rounded-2xl border transition-all hover:-translate-y-1" style="background:#fefce8;border-color:#fde68a;">
            <div class="flex items-center gap-4 mb-3">
                ${a.image_url?
                    `<div class="w-12 h-12 rounded-xl overflow-hidden flex-shrink-0"><img src="${a.image_url}" alt="${a.student_name}" class="w-full h-full object-cover"></div>`:
                    `<div class="w-12 h-12 rounded-xl flex items-center justify-center text-lg font-black text-white" style="background:linear-gradient(135deg,#f59e0b,#d97706);">${a.student_name.charAt(0)}</div>`
                }
                <div class="min-w-0">
                    <h4 class="font-bold text-slate-900 text-sm">${a.student_name}</h4>
                    <p class="text-xs text-slate-500 mt-0.5 truncate">${a.exam_name}</p>
                </div>
            </div>
            <div class="flex gap-2 flex-wrap">
                <span style="display:inline-flex;padding:3px 10px;border-radius:999px;font-size:0.7rem;font-weight:700;background:#fef9c3;color:#92400e;border:1px solid #fde68a;">🏆 ${a.rank_or_score}</span>
                ${a.department?`<span style="display:inline-flex;padding:3px 10px;border-radius:999px;font-size:0.7rem;font-weight:700;background:#f8fafc;color:#64748b;">${a.department}</span>`:''}
            </div>
        </div>`;
}

function createRecentAchievementCard(a){
    return `
        <div class="sd-sidebar-link">
            ${a.image_url?
                `<div class="w-9 h-9 rounded-lg overflow-hidden flex-shrink-0"><img src="${a.image_url}" alt="${a.student_name}" class="w-full h-full object-cover"></div>`:
                `<div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 text-sm font-bold text-white" style="background:linear-gradient(135deg,#f59e0b,#d97706);">${a.student_name.charAt(0)}</div>`
            }
            <div class="flex-1 min-w-0">
                <h5 class="text-sm font-bold text-slate-800 truncate">${a.student_name}</h5>
                <p class="text-xs text-slate-400 truncate">${a.exam_name}</p>
            </div>
            <span style="display:inline-flex;padding:3px 10px;border-radius:999px;font-size:0.7rem;font-weight:700;background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;flex-shrink:0;">${a.rank_or_score}</span>
        </div>`;
}

document.addEventListener('DOMContentLoaded', () => {
    loadExamCountdowns();
    loadAchievements();
    loadEvents();
});
</script>
