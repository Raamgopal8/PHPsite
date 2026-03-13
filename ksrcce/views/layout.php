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
    <style type="text/tailwindcss">
        body { 
            @apply font-sans bg-gray-900 text-white leading-relaxed;
            background-image: url('/assets/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

        input, textarea, select {
            @apply text-black;
        }
        
        /* Glassmorphism Navigation */
        .glass-nav {
            @apply bg-gray-900/70 backdrop-blur-xl border border-white/10 shadow-2xl;
        }
        
        .nav-link {
            @apply px-4 py-2 rounded-full text-sm font-semibold transition-all duration-300 ease-in-out text-gray-300 hover:bg-white/10 hover:text-blue-400;
        }
        
        .nav-link.active {
            @apply bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-lg hover:shadow-blue-900/50;
        }
        
        .user-avatar {
            @apply h-9 w-9 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-md transition-all duration-300 hover:shadow-lg hover:scale-105;
        }
        
        .register-btn {
            @apply bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-5 py-2 rounded-full text-sm font-bold shadow-lg hover:shadow-blue-500/30 hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 transform hover:-translate-y-0.5;
        }
        
        .mobile-menu-btn {
            @apply inline-flex items-center justify-center p-2 rounded-full text-gray-400 hover:bg-white/10 focus:outline-none transition-all duration-200;
        }

        @media print {
            header, footer, .print-hide {
                display: none !important;
            }
            body {
                background: white !important;
                color: black !important;
            }
            .h-36 {
                display: none !important;
            }
        }
    </style>

</head>
<body class="min-h-screen flex flex-col">


<header class="fixed top-4 left-1/2 -translate-x-1/2 w-[95%] max-w-6xl z-50 rounded-2xl">
    <nav class="glass-nav rounded-2xl p-2.5 mx-4">
        <div class="flex items-center justify-between h-24 px-4">
            <!-- Logo -->
            <a href="https://www.ksrce.ac.in/" class="flex items-center space-x-3 flex-shrink-0">
                <img src="/assets/KSR College of Engineering.jpg" alt="KSR College of Engineering" class="h-20 w-auto object-contain rounded-lg">
                <div class="h-16 w-px bg-gradient-to-b from-transparent via-gray-600 to-transparent hidden sm:block"></div>
                <img src="/assets/ccelogo.jpg" alt="CCE Department" class="h-20 w-auto object-contain rounded-lg hidden sm:block">
            </a>

            <!-- Centered College Name -->
            <div class="hidden md:flex flex-col items-center justify-center text-center px-4 flex-grow">
                <h1 class="text-xl lg:text-3xl font-black text-white tracking-widest uppercase truncate leading-tight">
                    KSR COLLEGE OF ENGINEERING
                </h1>
                <p class="text-sm lg:text-lg font-bold text-gray-300 tracking-[0.2em] uppercase opacity-90">
                    Tiruchengode
                </p>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1 flex-shrink-0">
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
                <a href="<?= $dashboard_link ?>" class="nav-link <?= $is_dashboard_active ? 'active' : '' ?>">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home
                    </span>
                </a>
                <?php if(isset($_SESSION['user'])): ?>
                    <a href="/logout" class="nav-link text-red-400 hover:text-red-300">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Sign out
                        </span>
                    </a>
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
<div class="h-36 print:hidden"></div>

<main class="flex-grow">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <?php
        // include requested view
        $viewPath = __DIR__ . '/' . $path;
        // Add .php extension if not already present
        if (!preg_match('/\.php$/', $viewPath)) {
            $viewPath .= '.php';
        }
        if (file_exists($viewPath)) include $viewPath;
        else echo "<div class='bg-gray-800 shadow rounded-lg p-6 border border-white/10'><h2 class='text-xl font-semibold text-white'>View not found</h2><p class='text-gray-400 mt-2'>{$viewPath}</p></div>";
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
                     <a href="mailto:headcce@ksrce.ac.in" class="text-gray-400 hover:text-blue-400 transition-colors">headcce@ksrce.ac.in</a>
                     <a href="tel:+918610280789" class="text-gray-400 hover:text-blue-400 transition-colors">+91 8610280789</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
            <div>
                &copy; Developed by RAAMGOPAL S Department Of Computer Science and Engineering (2022-2026). 
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
