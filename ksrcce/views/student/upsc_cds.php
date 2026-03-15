<?php $path = 'student/upsc_cds.php'; ?>

<style>
/* ── Exam Sub-Page Light UI ── */

.exam-hero {
    background: linear-gradient(135deg, #4338ca, #3730a3);
    border-radius: 24px;
    padding: 3rem 2rem;
    color: white;
    margin-bottom: 2rem;
}
.light-exam-card {
    background: var(--surface-card);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 1.5rem;
    height: 100%;
    transition: all 0.3s ease;
}
.light-exam-card:hover {
    box-shadow: var(--shadow-md);
    border-color: #818cf8;
}
.item-row {
    background: #f8fafc;
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 0.75rem;
    border: 1px solid #e2e8f0;
    transition: all 0.2s ease;
}
.item-row:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
}
</style>

<div class="p-4 pt-24 pb-32">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="exam-hero shadow-xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 blur-3xl -mr-32 -mt-32 rounded-full"></div>
            <div class="relative z-10 flex items-center">
                
                <div>
                    <h1 class="text-3xl md:text-4xl font-black" style="font-family:'Outfit',sans-serif;">Combined Defence Services (CDS)</h1>
                    <p class="mt-2 text-indigo-100 font-medium">Entrance to IMA, INA, AFA, and OTA</p>
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Study Materials -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Syllabus -->
                <div class="light-exam-card">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h2 class="text-xl font-black text-slate-900" style="font-family:'Outfit',sans-serif;">Exam Syllabus</h2>
                    </div>
                    
                    <div class="space-y-1">
                        <?php
                        try {
                            $db = (new \App\Core\App())->db;
                            $stmt = $db->prepare("SELECT * FROM syllabi WHERE subject LIKE ? OR subject LIKE ? ORDER BY created_at DESC");
                            $stmt->execute(['%CDS%', '%UPSC%']);
                            $syllabi = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            if (!empty($syllabi)):
                                foreach ($syllabi as $syllabus):
                        ?>
                            <div class="item-row flex items-center justify-between">
                                <div class="flex-1">
                                    <h3 class="font-bold text-slate-800 text-sm"><?= htmlspecialchars($syllabus['title']) ?></h3>
                                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mt-0.5"><?= htmlspecialchars($syllabus['subject']) ?></p>
                                </div>
                                <a href="<?= htmlspecialchars($syllabus['url']) ?>" target="_blank" rel="noopener noreferrer"
                                   class="ml-4 px-4 py-1.5 bg-white border border-slate-200 text-xs font-bold rounded-lg text-indigo-600 hover:bg-indigo-50 hover:border-indigo-200 transition-all shadow-sm">
                                    View PDF
                                </a>
                            </div>
                        <?php
                                endforeach;
                            else:
                        ?>
                             <div class="py-10 text-center">
                                <p class="text-sm text-slate-400 font-medium">Syllabus details will be updated here shortly.</p>
                            </div>
                        <?php
                            endif;
                        } catch (Exception $e) {
                        ?>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- Materials -->
                <div class="light-exam-card">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <h2 class="text-xl font-black text-slate-900" style="font-family:'Outfit',sans-serif;">Learning Materials</h2>
                    </div>

                    <div class="space-y-1">
                        <?php
                        try {
                            $db = (new \App\Core\App())->db;
                            $stmt = $db->prepare("SELECT * FROM materials WHERE category LIKE ? OR category LIKE ? ORDER BY created_at DESC");
                            $stmt->execute(['%CDS%', '%UPSC%']);
                            $materials = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            if (!empty($materials)):
                                foreach ($materials as $material):
                        ?>
                            <div class="item-row flex items-center justify-between">
                                <div class="flex-1">
                                    <h3 class="font-bold text-slate-800 text-sm"><?= htmlspecialchars($material['title']) ?></h3>
                                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mt-0.5"><?= htmlspecialchars($material['category']) ?></p>
                                </div>
                                <a href="<?= htmlspecialchars($material['url']) ?>" target="_blank" rel="noopener noreferrer"
                                   class="ml-4 px-4 py-1.5 bg-emerald-600 text-white text-xs font-bold rounded-lg hover:bg-emerald-700 transition-all shadow-md shadow-emerald-100">
                                    Download
                                </a>
                            </div>
                        <?php
                                endforeach;
                            else:
                        ?>
                            <div class="py-10 text-center">
                                <p class="text-sm text-slate-400 font-medium">No materials available yet.</p>
                            </div>
                        <?php
                            endif;
                        } catch (Exception $e) {
                        ?>
                            <div class="p-4 bg-rose-50 rounded-xl border border-rose-100 text-rose-600 font-bold text-sm">
                                System error: Failed to fetch materials.
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- Previous Year Papers -->
                <div class="light-exam-card">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600">
                             <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h2 class="text-xl font-black text-slate-900" style="font-family:'Outfit',sans-serif;">Previous Year Papers</h2>
                    </div>
                    <div class="space-y-3">
                        <a href="https://upsc.gov.in/examinations/previous-question-papers" target="_blank" 
                           class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200 rounded-xl hover:border-indigo-300 hover:bg-indigo-50 transition-all group">
                            <span class="font-bold text-slate-700 text-sm">CDS Previous Years Papers</span>
                            <svg class="h-4 w-4 text-slate-400 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <div class="light-exam-card">
                    <h2 class="text-lg font-black text-slate-900 mb-4" style="font-family:'Outfit',sans-serif;">Quick Access</h2>
                    <div class="space-y-4">
                        <a href="https://upsc.gov.in/" target="_blank" rel="noopener noreferrer" 
                           class="flex items-center justify-between p-3 bg-indigo-50 text-indigo-700 rounded-xl font-bold text-xs hover:bg-indigo-100 transition-colors">
                            <span>UPSC Official Website</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>