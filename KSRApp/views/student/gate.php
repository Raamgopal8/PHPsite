<?php $path = 'student/gate.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 pt-24">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center">
                <a href="<?= ($_SESSION['user']['role'] === 'admin') ? '/admin/dashboard' : '/student/dashboard' ?>" class="mr-4 text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">GATE Exam Preparation</h1>
                    <h2 class="text-lg font-semibold text-blue-600 mt-1"> Visit <a href="https://gate2026.iitg.ac.in/" target="_blank" rel="noopener noreferrer">GATE 2026 Official</a> for more details</h2>
                    <p class="mt-1 text-gray-600">Select your department to access relevant study materials and practice tests</p>
                </div>
            </div>
        </div>

        <!-- Departments Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Computer Science and Information Technology (CS) -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Computer Science</h3>
                        <p class="mt-1 text-sm text-gray-600">CS & IT Engineering</p>
                        <div class="mt-4">
                            <a href="/student/gate/cse" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                View 
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Electronics and Communication (EC) -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Electronics</h3>
                        <p class="mt-1 text-sm text-gray-600">EC Engineering</p>
                        <div class="mt-4">
                            <a href="/student/gate/ece" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                View 
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mechanical Engineering (ME) -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-yellow-100 text-yellow-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Mechanical</h3>
                        <p class="mt-1 text-sm text-gray-600">ME Engineering</p>
                        <div class="mt-4">
                            <a href="/student/gate/mech" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                View 
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Civil Engineering (CE) -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-red-100 text-red-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Civil Engineering</h3>
                        <p class="mt-1 text-sm text-gray-600">CE Engineering</p>
                        <div class="mt-4">
                            <a href="/student/gate/civil" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                View 
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Electrical Engineering (EE) -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Electrical</h3>
                        <p class="mt-1 text-sm text-gray-600">EE Engineering</p>
                        <div class="mt-4">
                            <a href="/student/gate/ee" class="text-sm font-medium text-blue-600 hover:text-blue-800">
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
            <h2 class="text-xl font-semibold text-gray-900 mb-4">About GATE Exam</h2>
            <div class="prose max-w-none text-gray-600">
                <p class="mb-4">The Graduate Aptitude Test in Engineering (GATE) is an examination conducted in India that primarily tests the comprehensive understanding of various undergraduate subjects in engineering and science.</p>
                <p class="mb-4">Key features of GATE:</p>
                <ul class="list-disc pl-5 space-y-2">
                    <li>Conducted jointly by the Indian Institute of Science and seven IITs</li>
                    <li>Used for admissions to postgraduate programs in IITs, NITs, IIITs, and other institutions</li>
                    <li>Used by many Public Sector Undertakings (PSUs) for recruitment</li>
                    <li>Score valid for three years from the date of announcement of results</li>
                </ul>
            </div>
        </div>
    </div>
</div>