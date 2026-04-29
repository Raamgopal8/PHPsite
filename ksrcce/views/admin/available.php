<?php 
$title = "Manage Departments";
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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-slate-900 font-bold">Manage Departments</span>
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
                            <span class="text-3xl">🏛️</span>
                        </div>
                        <div>
                            <h1 class="text-3xl font-black text-slate-900" style="font-family:'Outfit',sans-serif;letter-spacing:-0.02em;">
                                Manage Departments
                            </h1>
                            <p class="mt-1.5 text-sm text-slate-500 font-medium">Select a department to manage its configuration, syllabi, and exams.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- GATE Card -->
                <a href="/student/gate" class="admin-card group p-8 flex flex-col items-start transition-all hover:-translate-y-1 hover:shadow-xl relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-blue-50 rounded-full transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center mb-6 relative z-10 transition-transform group-hover:rotate-12">
                        <span class="text-2xl">⚙️</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 relative z-10">GATE</h3>
                    <p class="text-slate-500 text-sm mb-6 relative z-10 leading-relaxed">Manage Engineering</p>
                    <span class="inline-flex items-center text-sm font-bold text-blue-600 relative z-10 mt-auto">
                        Manage GATE
                        <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                </a>

                <!-- UPSC Card -->
                <a href="/student/upsc" class="admin-card group p-8 flex flex-col items-start transition-all hover:-translate-y-1 hover:shadow-xl relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-50 rounded-full transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center mb-6 relative z-10 transition-transform group-hover:rotate-12">
                        <span class="text-2xl">🏛️</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 relative z-10">UPSC</h3>
                    <p class="text-slate-500 text-sm mb-6 relative z-10 leading-relaxed">Manage Civil Services</p>
                    <span class="inline-flex items-center text-sm font-bold text-indigo-600 relative z-10 mt-auto">
                        Manage UPSC
                        <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                </a>

                <!-- TNPSC Card -->
                <a href="/student/Tnpsc" class="admin-card group p-8 flex flex-col items-start transition-all hover:-translate-y-1 hover:shadow-xl relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-green-50 rounded-full transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center mb-6 relative z-10 transition-transform group-hover:rotate-12">
                        <span class="text-2xl">📝</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 relative z-10">TNPSC</h3>
                    <p class="text-slate-500 text-sm mb-6 relative z-10 leading-relaxed">Manage State Services</p>
                    <span class="inline-flex items-center text-sm font-bold text-green-600 relative z-10 mt-auto">
                        Manage TNPSC
                        <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                </a>

                <!-- Banking Card -->
                <a href="/student/banking" class="admin-card group p-8 flex flex-col items-start transition-all hover:-translate-y-1 hover:shadow-xl relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-yellow-50 rounded-full transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center mb-6 relative z-10 transition-transform group-hover:rotate-12">
                        <span class="text-2xl">🏦</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2 relative z-10">Banking</h3>
                    <p class="text-slate-500 text-sm mb-6 relative z-10 leading-relaxed">Manage Bank Exams</p>
                    <span class="inline-flex items-center text-sm font-bold text-yellow-600 relative z-10 mt-auto">
                        Manage Banking
                        <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                </a>
            </div>

        </div>
    </main>
</div>