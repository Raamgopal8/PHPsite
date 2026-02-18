<?php $path = 'student/cse.php'; ?>

<div class="min-h-screen bg-transparent p-4 pt-24">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center">
                <a href="/student/banking" class="mr-4 text-blue-400 hover:text-blue-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-white">RBI Grade B</h1>
                    <p class="mt-1 text-gray-300">Banking Exam Preparation</p>
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
                        <!-- Add more syllabus items -->
                    </div>
                </div>

                <!-- Materials -->
                <div class="bg-gray-800/60 backdrop-blur-md rounded-2xl p-6 border border-white/10 shadow-sm">
                    <h2 class="text-xl font-semibold text-white mb-4">Learning Materials</h2>
                    <div class="space-y-4">
                        <?php
                        // Fetch RBI materials from database
                        try {
                            $db = (new \App\Core\App())->db;
                            $stmt = $db->prepare("SELECT * FROM materials WHERE category LIKE ? OR category LIKE ? ORDER BY created_at DESC");
                            $stmt->execute(['%RBI%', '%Banking%']);
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


                <!-- Previous Year Papers -->
                <div class="bg-gray-800/60 backdrop-blur-md rounded-2xl p-6 border border-white/10 shadow-sm">
                    <h2 class="text-xl font-semibold text-white mb-4">Previous Year Papers</h2>
                    <div class="space-y-3">
                        <a href="https://docs.google.com/spreadsheets/d/1TJ90bDyU9lNbREutEi18Er-pKDYPkdPbymL3CBJfOO0/edit?usp=sharing" class="flex items-center justify-between p-3 hover:bg-gray-700/50 rounded-lg transition-colors">
                            <span>RBI Previous Years</span>
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <!-- Add more papers -->
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-6">
                <div class="bg-gray-800/60 backdrop-blur-md rounded-2xl p-6 border border-white/10 shadow-sm">
                    <h2 class="text-lg font-semibold text-white mb-4">Quick Links</h2>
                    <div class="space-y-3">
                        <a href="https://www.rbi.org.in/" target="_blank" rel="noopener noreferrer" class="flex items-center text-blue-400 hover:text-blue-300">
                            <span>RBI Official</span>
                            <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                        
                        

                        <!-- Add more quick links -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>