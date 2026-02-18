<?php
// layout wraps each view; extracted variables: $view, $data from Controller->view
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?? '' ?>">
    <title>CCE Portal</title>
    <link rel="icon" type="image/jpeg" href="/assets/KSR College of Engineering.jpg">
    <link rel="apple-touch-icon" href="/assets/KSR College of Engineering.jpg">
    <link rel="stylesheet" href="/assets/css/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background-image: url('/assets/background.jpg');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            @apply bg-gray-900 text-white;
        }
        .nav-link {
            @apply px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200;
        }
        .nav-link:hover {
            @apply bg-gray-800 text-white;
        }
        .nav-link.active {
            @apply bg-blue-600 text-white hover:bg-blue-700;
        }
    </style>

</head>
<body class="min-h-screen flex flex-col">
<style>
    /* Glassmorphism effect */
    .glass-nav {
        background: rgba(17, 24, 39, 0.7);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
    }
    
    .glass-nav .nav-link {
        @apply px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 ease-in-out;
    }
    
    .glass-nav .nav-link:hover {
        @apply bg-white/10 text-blue-400 shadow-sm;
    }
    
    .glass-nav .nav-link.active {
        @apply bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-md hover:shadow-lg;
    }
    
    .user-avatar {
        @apply h-9 w-9 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-medium text-sm shadow-md transition-all duration-300 hover:shadow-lg hover:scale-105;
    }
    
    .register-btn {
        @apply bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium shadow-md hover:shadow-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 transform hover:-translate-y-0.5;
    }
    
    .mobile-menu-btn {
        @apply inline-flex items-center justify-center p-2 rounded-full text-gray-400 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600 transition-all duration-200;
    }
</style>

<header class="fixed top-4 left-1/2 -translate-x-1/2 w-[95%] max-w-6xl z-50 rounded-2xl">
    <nav class="glass-nav rounded-2xl p-2.5 mx-4">
        <div class="flex items-center justify-between h-24 px-4">
            <!-- Logo -->
            <a href="https://www.ksrce.ac.in/" class="flex items-center space-x-3">
                <img src="/assets/KSR College of Engineering.jpg" alt="KSR College of Engineering" class="h-20 w-auto object-contain rounded-lg">
                <div class="h-16 w-px bg-gradient-to-b from-transparent via-gray-600 to-transparent"></div>
                <img src="/assets/ccelogo.jpg" alt="CCE Department" class="h-20 w-auto object-contain rounded-lg">
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
                <?php
                $dashboard_link = '/';
                $is_dashboard_active = basename($_SERVER['REQUEST_URI']) === '';

                if (isset($_SESSION['user'])) {
                    if ($_SESSION['user']['role'] === 'admin') {
                        $dashboard_link = '/admin/dashboard';
                        $is_dashboard_active = str_contains($_SERVER['REQUEST_URI'], '/admin/dashboard');
                    } else {
                        // Assuming non-admin users are students
                        $dashboard_link = '/student/dashboard';
                        $is_dashboard_active = str_contains($_SERVER['REQUEST_URI'], '/student/dashboard');
                    }
                }
                ?>
                <a href="<?= $dashboard_link ?>" class="nav-link <?= $is_dashboard_active ? 'active' : 'text-gray-300' ?>">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home
                    </span>
                </a>
                <?php if(isset($_SESSION['user'])): ?>
                    <?php if($_SESSION['user']['role']==='admin'): ?>
                        <a href="/admin/dashboard" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/admin/') ? 'active' : 'text-gray-300' ?>">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Admin
                            </span>
                        </a>
                    <?php else: ?>
                        <a href="/student/dashboard" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/student/') ? 'active' : 'text-gray-300' ?>">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                                My Dashboard
                            </span>
                        </a>
                    <?php endif; ?>
                    
                    <div class="ml-2 relative group">
                        <button class="flex items-center space-x-2 focus:outline-none">
                            <div class="user-avatar">
                                <?= strtoupper(substr(htmlspecialchars($_SESSION['user']['name']), 0, 1)) ?>
                            </div>
                            <span class="text-sm font-medium text-gray-300 group-hover:text-blue-400 transition-colors">
                                <?= htmlspecialchars($_SESSION['user']['name']) ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block ml-1 -mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-gray-900/95 backdrop-blur-md rounded-xl shadow-xl py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform translate-y-1 group-hover:translate-y-0 border border-white/10">
                            <!-- <a href="/profile" class="block px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800 hover:text-blue-400">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profile
                                </span>
                            </a>
                            <a href="" class="block px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800 hover:text-blue-400">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Settings
                                </span>
                            </a> -->
                            
                            <div class="border-t border-gray-700/50 my-1"></div> 
                            <a href="/logout" class="block px-4 py-2.5 text-sm text-red-400 hover:bg-gray-800">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Sign out
                                </span>
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/login" class="nav-link <?= $_SERVER['REQUEST_URI'] === '/login' ? 'active' : 'text-gray-300' ?>">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Login
                        </span>
                    </a>
                    <a href="/register" class="register-btn flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Get Started
                    </a>
                <?php endif; ?>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" class="mobile-menu-btn" aria-expanded="false" aria-controls="mobile-menu">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-gray-900/95 backdrop-blur-md rounded-xl m-2 border border-white/10">
                <?php if(isset($_SESSION['user'])): ?>
                    <div class="px-3 py-2 text-base font-medium text-gray-400 border-b border-gray-700/50 mb-1">
                        Signed in as <span class="text-white block"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                    </div>
                <?php endif; ?>
                <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-800 hover:text-blue-400">Home</a>
                <?php if(isset($_SESSION['user'])): ?>
                    <?php if($_SESSION['user']['role']==='admin'): ?>
                        <a href="/admin/dashboard" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-800 hover:text-blue-400">Admin Dashboard</a>
                    <?php else: ?>
                        <a href="/student/dashboard" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-800 hover:text-blue-400">My Dashboard</a>
                    <?php endif; ?>
                    <a href="/profile" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-800 hover:text-blue-400">Profile</a>
                    <a href="/settings" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-800 hover:text-blue-400">Settings</a>
                    <a href="/logout" class="block px-3 py-2 rounded-md text-base font-medium text-red-500 hover:bg-gray-800">Sign out</a>
                <?php else: ?>
                    <a href="/login" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-800 hover:text-blue-400">Login</a>
                    <a href="/register" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<!-- Add padding to account for fixed header -->
<div class="h-36"></div>

<main class="flex-grow">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <?php
        // include requested view
        $path = __DIR__ . '/' . $path; // Controller->view passes $path
        if (file_exists($path)) include $path;
        else echo "<div class='bg-gray-800 shadow rounded-lg p-6 border border-white/10'><h2 class='text-xl font-semibold text-white'>View not found</h2><p class='text-gray-400 mt-2'>{$path}</p></div>";
        ?>
    </div>
</main>


<footer class="bg-gray-900/90 backdrop-blur-md border-t border-white/10 mt-12 rounded-t-[3rem] shadow-[0_-10px_40px_-15px_rgba(0,0,0,0.5)]">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 border-b border-gray-800 pb-8">
            <div class="text-center md:text-left">
                <h3 class="text-lg font-bold text-white mb-2">KSR College of Engineering</h3>
                <p class="text-gray-400 text-sm">Empowering students through excellence in technical education.</p>
            </div>
            <div class="text-center">
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Quick Links</h4>
                <div class="flex flex-col space-y-2">
                    <a href="https://www.ksrce.ac.in/" target="_blank" class="text-gray-400 hover:text-blue-400 transition-colors">Official Website</a>
                    
                </div>
            </div>
            <div class="text-center md:text-right">
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Contact Us</h4>
                <div class="flex flex-col space-y-2">
                     <a href="mailto:ccehead@ksrce.ac.in" class="text-gray-400 hover:text-blue-400 transition-colors">ccehead@ksrce.ac.in</a>
                     <a href="tel:+918610280789" class="text-gray-400 hover:text-blue-400 transition-colors">+91 8610280789</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
            <div>
                &copy; <?= date('Y') ?> KSRCE. All rights reserved.
            </div>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="/privacy-policy" class="hover:text-gray-300">Privacy Policy</a>
                <a href="/terms-of-service" class="hover:text-gray-300">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<!-- Mobile menu -->
<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.querySelector('[aria-controls="mobile-menu"]');
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                if (menu) {
                    menu.classList.toggle('hidden');
                }
            });
        }
        
        <?php if(isset($_SESSION['user'])): ?>
        // Heartbeat to keep status "Online"
        const sendHeartbeat = () => {
             fetch('/api/heartbeat')
                .then(response => response.json())
                .catch(err => console.log('Heartbeat skipped'));
        };
        
        // Send immediately on load
        sendHeartbeat();
        
        // Then every 2 minutes
        setInterval(sendHeartbeat, 120000); 
        <?php endif; ?>
    });
</script>
</body>
</html>
