<?php $path = 'student/aids.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 pt-24">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center">
                <a href="/student/gate" class="mr-4 text-blue-600 hover:text-blue-800">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Artificial Intelligence & Data Science</h1>
                    <p class="mt-1 text-gray-600">GATE Exam Preparation Materials</p>
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Study Materials -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Syllabus -->
                <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Syllabus</h2>
                    <div class="space-y-4">
                        <?php
                        // Fetch syllabi from database
                        try {
                            $db = (new \App\Core\App())->db;
                            $stmt = $db->prepare("SELECT * FROM syllabi WHERE subject LIKE ? OR subject LIKE ? ORDER BY created_at DESC");
                            $stmt->execute(['%Artificial Intelligence%', '%AIDS%']);
                            $syllabi = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            if (!empty($syllabi)):
                                foreach ($syllabi as $syllabus):
                        ?>
                            <div class="p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h3 class="font-medium text-blue-800"><?= htmlspecialchars($syllabus['title']) ?></h3>
                                        <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($syllabus['subject']) ?></p>
                                    </div>
                                    <a href="<?= htmlspecialchars($syllabus['url']) ?>" target="_blank" rel="noopener noreferrer"
                                       class="ml-4 inline-flex items-center px-3 py-1.5 border border-blue-300 text-sm font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        View
                                    </a>
                                </div>
                            </div>
                        <?php
                                endforeach;
                            else:
                        ?>
                            <div class="p-4 bg-blue-50 rounded-lg">
                                <h3 class="font-medium text-blue-800">No Syllabus Found</h3>
                                <p class="text-sm text-gray-600 mt-1">Syllabus for this department will be updated soon.</p>
                            </div>
                        <?php
                            endif;
                        } catch (Exception $e) {
                            // Fallback to static content if database query fails
                        ?>
                            <div class="p-4 bg-blue-50 rounded-lg">
                                <h3 class="font-medium text-blue-800">Error Loading Syllabus</h3>
                                <p class="text-sm text-gray-600 mt-1">Please try again later.</p>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- Practice Papers -->
                <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Prepare for GATE</h2>
                    <div class="space-y-3">
                        <a href="https://docs.google.com/spreadsheets/d/19G5PYelZ0mTleHDiqo16bG8y8cLdvtW-U8doomIn8W4/edit?gid=0#gid=0" class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <span>GATE QUESTION</span>
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-6">
                <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h2>
                    <div class="space-y-3">
                        <a href="https://gate.nptel.ac.in/exam.html" target="_blank" rel="noopener noreferrer" class="flex items-center text-blue-600 hover:text-blue-800">
                            <span>GATE Official Mock Test</span>
                            <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                        
                        <a href="https://docs.google.com/spreadsheets/d/1VHsGC_9hTVVWdStKcsHbQxFjGvrlMbR7/edit?gid=1013892846#gid=1013892846" class="flex items-center text-blue-600 hover:text-blue-800">
                            <span>Books Available in Library</span>
                            <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
