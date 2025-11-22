<?php $path = 'student/tnspc.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-green-50 to-teal-100 p-4 pt-24">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center">
                <a href="<?= ($_SESSION['user']['role'] === 'admin') ? '/admin/dashboard' : '/student/dashboard' ?>" class="mr-4 text-green-600 hover:text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">TNSPC Exam Preparation</h1>
                    <p class="mt-1 text-gray-600">Select your category to access relevant study materials and practice tests</p>
                </div>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Group 1 -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Group 1</h3>
                        <p class="mt-1 text-sm text-gray-600">Preliminary Exam</p>
                        <div class="mt-4">
                            <a href="/student/tnpsc/group1" class="text-sm font-medium text-green-600 hover:text-green-800">
                                View 
                            <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Group 2 -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Group 2</h3>
                        <p class="mt-1 text-sm text-gray-600">Main Exam</p>
                        <div class="mt-4">
                            <a href="/student/tnpsc/group2" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                View 
                              <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Group 4 -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Group 4</h3>
                        <p class="mt-1 text-sm text-gray-600">Combined Exam</p>
                        <div class="mt-4">
                            <a href="/student/tnpsc/group4" class="text-sm font-medium text-purple-600 hover:text-purple-800">
                                View 
                             <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="mt-12 bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">About TNSPC Exam</h2>
            <div class="prose max-w-none text-gray-600">
                <p class="mb-4">The Tamil Nadu Public Service Commission (TNPSC) conducts various recruitment exams for different government posts in Tamil Nadu.</p>
                <p class="mb-4">Key features of TNSPC:</p>
                <ul class="list-disc pl-5 space-y-2">
                    <li>Conducted by Tamil Nadu Public Service Commission</li>
                    <li>Recruitment for various Group 1, 2, and 4 posts</li>
                    <li>Includes preliminary and main examinations</li>
                    <li>Selection based on written test and interview</li>
                </ul>
            </div>
        </div>
    </div>
</div>