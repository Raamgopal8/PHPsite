<?php
$title = "$domain Dashboard";
?>
<style>
/* ── Admin Light Design System (Aligned with Admin Dashboard) ──────────────── */
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

.admin-shell { 
    background: var(--admin-bg) !important; 
    min-height: 100vh;
    display: flex;
}
.admin-shell * { -webkit-font-smoothing: antialiased; }

.admin-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}
</style>

<div class="admin-shell min-h-screen flex" style="margin-top:-4px;">
    <main class="flex-1 min-w-0" style="background:var(--admin-bg);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 text-xs font-medium text-slate-500">
                    <li class="inline-flex items-center">
                        <a href="/admin/dashboard" class="hover:text-indigo-600 transition-colors">Admin</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-slate-400">Categories</span>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-slate-900 font-bold"><?= htmlspecialchars($domain) ?></span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="admin-card p-7 md:p-8 relative overflow-hidden mb-8">
                <div class="absolute top-0 right-0 w-72 h-full pointer-events-none" style="background:linear-gradient(135deg,#eef2ff,#f5f3ff);clip-path:ellipse(100% 100% at 100% 50%);"></div>
                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-sm" style="background:#eef2ff; border: 1px solid #e0e7ff;">
                            <span class="text-3xl">🎯</span>
                        </div>
                        <div>
                            <h1 class="text-3xl font-black text-slate-900" style="font-family:'Outfit',sans-serif;letter-spacing:-0.02em;">
                                <?= htmlspecialchars($domain) ?> Dashboard
                            </h1>
                            <p class="mt-1.5 text-sm text-slate-500 font-medium">Control syllabi, study materials, and exams specifically for <?= htmlspecialchars($domain) ?>.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Syllabus Management Card -->
                <a href="/admin/syllabi?domain=<?= urlencode($domain) ?>" class="admin-card group p-8 flex flex-col items-start transition-all hover:-translate-y-1 hover:shadow-xl relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-blue-50 rounded-full transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center mb-6 relative z-10 transition-transform group-hover:rotate-12">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 relative z-10">Syllabus Management</h3>
                    <p class="text-slate-500 text-sm mb-6 relative z-10 leading-relaxed">Update, edit or remove syllabus modules for <?= htmlspecialchars($domain) ?>. Organize curriculum structure.</p>
                    <span class="inline-flex items-center text-sm font-bold text-blue-600 relative z-10">
                        Configure Syllabus
                        <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                </a>

                <!-- Material Management Card -->
                <a href="/admin/materials?domain=<?= urlencode($domain) ?>" class="admin-card group p-8 flex flex-col items-start transition-all hover:-translate-y-1 hover:shadow-xl relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-50 rounded-full transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center mb-6 relative z-10 transition-transform group-hover:rotate-12">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 relative z-10">Study Materials</h3>
                    <p class="text-slate-500 text-sm mb-6 relative z-10 leading-relaxed">Upload and manage PDFs, notes, and resources for <?= htmlspecialchars($domain) ?> students.</p>
                    <span class="inline-flex items-center text-sm font-bold text-indigo-600 relative z-10">
                        Manage Resources
                        <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                </a>

                <!-- Exam Management Card -->
                <a href="/admin/exams" class="admin-card group p-8 flex flex-col items-start transition-all hover:-translate-y-1 hover:shadow-xl relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-green-50 rounded-full transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center mb-6 relative z-10 transition-transform group-hover:rotate-12">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 relative z-10">Exam Management</h3>
                    <p class="text-slate-500 text-sm mb-6 relative z-10 leading-relaxed">Create and manage mock tests, quizzes, and exams for <?= htmlspecialchars($domain) ?>.</p>
                    <span class="inline-flex items-center text-sm font-bold text-green-600 relative z-10">
                        Manage Exams
                        <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                </a>
            </div>

        </div>
    </main>
</div>
