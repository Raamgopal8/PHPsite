<?php $path = 'student/aids.php'; ?>

<div class="min-h-screen bg-transparent p-4 pt-24">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center">
                <a href="/student/gate" class="mr-4 text-blue-400 hover:text-blue-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-white">Artificial Intelligence & Data Science</h1>
                    <p class="mt-1 text-gray-300">GATE Exam Preparation Materials</p>
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Study Materials -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Syllabus -->
                <div class="bg-gray-800/60 backdrop-blur-md rounded-2xl p-6 border border-white/10 shadow-sm">
                    <h2 class="text-xl font-semibold text-white mb-4">Syllabus</h2>
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
                            <div class="p-4 bg-blue-900/20 rounded-lg hover:bg-blue-900/30 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h3 class="font-medium text-blue-300"><?= htmlspecialchars($syllabus['title']) ?></h3>
                                        <p class="text-sm text-gray-300 mt-1"><?= htmlspecialchars($syllabus['subject']) ?></p>
                                    </div>
                                    <a href="<?= htmlspecialchars($syllabus['url']) ?>" target="_blank" rel="noopener noreferrer"
                                       class="ml-4 inline-flex items-center px-3 py-1.5 border border-blue-500/30 text-sm font-medium rounded-md text-blue-300 bg-white hover:bg-blue-900/20">
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
                            <div class="p-4 bg-blue-900/20 rounded-lg">
                                <h3 class="font-medium text-blue-300">No Syllabus Found</h3>
                                <p class="text-sm text-gray-300 mt-1">Syllabus for this department will be updated soon.</p>
                            </div>
                        <?php
                            endif;
                        } catch (Exception $e) {
                            // Fallback to static content if database query fails
                        ?>
                            <div class="p-4 bg-blue-900/20 rounded-lg">
                                <h3 class="font-medium text-blue-300">Error Loading Syllabus</h3>
                                <p class="text-sm text-gray-300 mt-1">Please try again later.</p>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- Materials -->
                <div class="bg-gray-800/60 backdrop-blur-md rounded-2xl p-6 border border-white/10 shadow-sm">
                    <h2 class="text-xl font-semibold text-white mb-4">Learning Materials</h2>
                    <div class="space-y-4">
                        <?php
                        // Fetch AIDS materials from database
                        try {
                            $db = (new \App\Core\App())->db;
                            $stmt = $db->prepare("SELECT * FROM materials WHERE category LIKE ? OR category LIKE ? ORDER BY created_at DESC");
                            $stmt->execute(['%Artificial Intelligence%', '%AIDS%']);
                            $materials = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            if (!empty($materials)):
                                foreach ($materials as $material):
                        ?>
                            <div class="p-4 bg-green-900/20 rounded-lg hover:bg-green-900/30 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h3 class="font-medium text-green-300"><?= htmlspecialchars($material['title']) ?></h3>
                                        <p class="text-sm text-gray-300 mt-1"><?= htmlspecialchars($material['category']) ?></p>
                                    </div>
                                    <a href="<?= htmlspecialchars($material['url']) ?>" target="_blank" rel="noopener noreferrer"
                                       class="ml-4 inline-flex items-center px-3 py-1.5 border border-green-500/30 text-sm font-medium rounded-md text-green-300 bg-white hover:bg-green-900/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            </div>
                        <?php
                                endforeach;
                            else:
                        ?>
                            <div class="p-4 bg-gray-800/50 rounded-lg text-center text-gray-400">
                                No materials available yet.
                            </div>
                        <?php
                            endif;
                        } catch (Exception $e) {
                        ?>
                            <div class="p-4 bg-red-900/20 rounded-lg text-red-400">
                                Error loading materials.
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>


                <!-- Practice Papers -->
                <div class="bg-gray-800/60 backdrop-blur-md rounded-2xl p-6 border border-white/10 shadow-sm">
                    <h2 class="text-xl font-semibold text-white mb-4">Prepare for GATE</h2>
                    <div class="space-y-3">
                        <a href="https://docs.google.com/spreadsheets/d/19G5PYelZ0mTleHDiqo16bG8y8cLdvtW-U8doomIn8W4/edit?gid=0#gid=0" class="flex items-center justify-between p-3 hover:bg-gray-700/50 rounded-lg transition-colors">
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
                <div class="bg-gray-800/60 backdrop-blur-md rounded-2xl p-6 border border-white/10 shadow-sm">
                    <h2 class="text-lg font-semibold text-white mb-4">Quick Links</h2>
                    <div class="space-y-3">
                        <a href="https://gate.nptel.ac.in/exam.html" target="_blank" rel="noopener noreferrer" class="flex items-center text-blue-400 hover:text-blue-300">
                            <span>GATE Official Mock Test</span>
                            <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                        
                        <a href="https://docs.google.com/spreadsheets/d/1VHsGC_9hTVVWdStKcsHbQxFjGvrlMbR7/edit?gid=1013892846#gid=1013892846" class="flex items-center text-blue-400 hover:text-blue-300">
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
