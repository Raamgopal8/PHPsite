<?php
// layout wraps each view; extracted variables: $view, $data from Controller->view
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?? '' ?>">
    <title>CCE Portal – KSR College of Engineering</title>
    <link rel="icon" type="image/jpeg" href="/assets/KSR College of Engineering.jpg">
    <link rel="apple-touch-icon" href="/assets/KSR College of Engineering.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style type="text/tailwindcss">
        html, body {
            height: auto !important;
            min-height: 0 !important;
            margin: 0;
            padding: 0;
            overflow: visible !important;
        }
        body {
            @apply leading-relaxed;
            font-family: 'Inter', 'Outfit', sans-serif;
            background-image: none !important;
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }

        input, textarea, select { @apply text-black; }

        /* ── Navbar ── */
        .glass-nav {
            background: rgba(6, 10, 22, 0.82);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            border: 1px solid rgba(255,255,255,0.07);
            box-shadow: 0 4px 40px rgba(0,0,0,0.55), inset 0 1px 0 rgba(255,255,255,0.04);
        }

        .nav-link {
            @apply relative px-4 py-2 rounded-full text-sm font-semibold transition-all duration-300 ease-in-out text-gray-400;
            letter-spacing: 0.01em;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 4px; left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 16px; height: 2px;
            background: #60a5fa;
            border-radius: 2px;
            transition: transform 0.25s ease;
        }
        .nav-link:hover::after { transform: translateX(-50%) scaleX(1); }
        .nav-link:hover { @apply text-blue-400; }

        .nav-link.active {
            @apply text-white;
            background: linear-gradient(135deg, rgba(59,130,246,0.22), rgba(99,102,241,0.22));
            border: 1px solid rgba(99,102,241,0.25);
        }
        .nav-link.active::after {
            transform: translateX(-50%) scaleX(1);
        }

        .register-btn {
            @apply relative overflow-hidden text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-lg transition-all duration-300 transform hover:-translate-y-0.5;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            box-shadow: 0 4px 15px rgba(99,102,241,0.35);
        }
        .register-btn:hover {
            box-shadow: 0 6px 25px rgba(99,102,241,0.55);
        }
        .register-btn::after {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
            transform: skewX(-15deg);
        }
        .register-btn:hover::after {
            left: 150%;
            transition: 0.5s ease;
        }

        .user-avatar {
            @apply h-9 w-9 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md transition-all duration-300 hover:scale-110;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
        }

        .mobile-menu-btn {
            @apply inline-flex items-center justify-center p-2 rounded-full text-gray-400 hover:text-white transition-all duration-200;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
        }
        .mobile-menu-btn:hover { background: rgba(255,255,255,0.10); }

        /* ── Online dot ── */
        .online-dot {
            width: 8px; height: 8px;
            background: #34d399;
            border-radius: 50%;
            box-shadow: 0 0 6px rgba(52,211,153,0.7);
            display: inline-block;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.2); }
        }

        /* ── Footer ── */
        .footer-link {
            @apply text-gray-400 hover:text-blue-400 transition-colors duration-200 text-sm;
        }

        /* ── Global Light UI Design System ── */
        :root {
            --bg-primary:    #f0f4ff;
            --surface-card:  #ffffff;
            --text-primary:  #0f172a;
            --text-secondary: #64748b;
            --border-color:  #e2e8f0;
            --accent-indigo: #6366f1;
            --accent-blue:   #3b82f6;
            --accent-green:  #10b981;
            --accent-orange: #f59e0b;
        }

        /* body overrides moved to top */

        .light-card {
            background: var(--surface-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(15,23,42,0.06);
            padding: 1.5rem;
        }

        .light-heading {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.01em;
        }

        .light-input {
            width: 100%; padding: 10px 14px;
            border-radius: 10px; font-size: 0.875rem;
            color: var(--text-primary); background: #f8fafc;
            border: 1px solid var(--border-color);
            transition: all 0.2s;
        }
        .light-input:focus {
            border-color: var(--accent-indigo);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
            background: #ffffff; outline: none;
        }

        .light-badge {
            display: inline-flex; align-items: center;
            padding: 2px 8px; border-radius: 999px;
            font-size: 0.7rem; font-weight: 700;
        }

        @media print {
            header, footer, .print-hide { display: none !important; }
            body { background: white !important; color: black !important; }
            .h-36 { display: none !important; }
        }
    </style>
</head>
<body>

<div class="flex flex-col min-h-screen w-full relative">
    <!-- ══════════════════════ NAVBAR ══════════════════════ -->
    <header class="fixed top-0 left-0 right-0 w-full z-50">
        <nav class="glass-nav px-6 py-2">
            <div class="flex items-center justify-between h-16">

                <!-- Logo -->
                <a href="https://www.ksrce.ac.in/" class="flex items-center space-x-3 flex-shrink-0 group" target="_blank" rel="noopener">
                    <div class="relative">
                        <img src="/assets/KSR College of Engineering.jpg"
                             alt="KSR College of Engineering"
                             class="h-12 w-auto object-contain rounded-xl transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 rounded-xl ring-2 ring-blue-500/0 group-hover:ring-blue-500/30 transition-all duration-300"></div>
                    </div>
                    <div class="h-10 w-px bg-gradient-to-b from-transparent via-white/15 to-transparent hidden sm:block"></div>
                    <img src="/assets/ccelogo.jpg" alt="CCE Department"
                         class="h-12 w-auto object-contain rounded-xl hidden sm:block transition-transform duration-300 group-hover:scale-105">
                </a>

                <!-- College Name (center) -->
                <div class="hidden lg:flex flex-col items-center justify-center text-center flex-1 px-4 min-w-0">
                    <h1 class="text-lg xl:text-2xl font-black text-white tracking-widest uppercase truncate leading-tight"
                        style="font-family:'Outfit',sans-serif; letter-spacing:0.18em;">
                        KSR COLLEGE OF ENGINEERING
                    </h1>
                    <p class="text-[10px] xl:text-xs font-semibold text-blue-400/80 tracking-[0.3em] uppercase mt-0.5">
                        Centre for Competitive Examinations · Tiruchengode
                    </p>
                </div>

                <!-- Right: Nav links -->
                <div class="flex items-center space-x-2 flex-shrink-0">
                    <div class="hidden md:flex items-center space-x-1">
                        <?php
                        $dashboard_link = '/';
                        $is_dashboard_active = basename($_SERVER['REQUEST_URI']) === '';

                        if (isset($_SESSION['user'])) {
                            if ($_SESSION['user']['role'] === 'admin') {
                                $dashboard_link = '/admin/dashboard';
                                $is_dashboard_active = str_contains($_SERVER['REQUEST_URI'], '/admin/dashboard');
                            } else {
                                $dashboard_link = '/student/dashboard';
                                $is_dashboard_active = str_contains($_SERVER['REQUEST_URI'], '/student/dashboard');
                            }
                        }
                        ?>
                        <a href="<?= $dashboard_link ?>" class="nav-link <?= $is_dashboard_active ? 'active' : '' ?>">
                            <span class="flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Home
                            </span>
                        </a>

                        <?php if(isset($_SESSION['user'])): ?>
                            <!-- Online status + user info -->
                            <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/8 mr-1">
                                <span class="online-dot"></span>
                                <span class="text-xs font-semibold text-gray-300 hidden lg:block truncate max-w-[100px]">
                                    <?= htmlspecialchars($_SESSION['user']['name']) ?>
                                </span>
                            </div>
                            <a href="/logout" class="nav-link text-red-400/80 hover:text-red-400">
                                <span class="flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Sign Out
                                </span>
                            </a>
                        <?php else: ?>
                            <a href="/login" class="nav-link <?= $_SERVER['REQUEST_URI'] === '/login' ? 'active' : '' ?>">
                                <span class="flex items-center gap-1.5 whitespace-nowrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    Login
                                </span>
                            </a>
                            <a href="/register" class="register-btn flex items-center gap-1.5 whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                Get Started
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Mobile menu button -->
                    <button type="button" class="mobile-menu-btn md:hidden" aria-expanded="false" aria-controls="mobile-menu">
                        <span class="sr-only">Open main menu</span>
                        <svg id="menu-icon" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="close-icon" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="pt-2 pb-4 px-2 space-y-1 border-t border-white/6 mt-2">
                    <?php if(isset($_SESSION['user'])): ?>
                        <div class="px-4 py-3 flex items-center gap-3 mb-2">
                            <div class="user-avatar text-sm">
                                <?= mb_strtoupper(mb_substr($_SESSION['user']['name'], 0, 1)) ?>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-white"><?= htmlspecialchars($_SESSION['user']['name']) ?></div>
                                <div class="flex items-center gap-1">
                                    <span class="online-dot" style="width:6px;height:6px;"></span>
                                    <span class="text-xs text-green-400">Online</span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <a href="/" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:bg-white/8 hover:text-white transition-all">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Home
                    </a>

                    <?php if(isset($_SESSION['user'])): ?>
                        <?php if($_SESSION['user']['role']==='admin'): ?>
                            <a href="/admin/dashboard" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:bg-white/8 hover:text-white transition-all">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                Admin Dashboard
                            </a>
                        <?php else: ?>
                            <a href="/student/dashboard" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:bg-white/8 hover:text-white transition-all">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                My Dashboard
                            </a>
                        <?php endif; ?>
                        <a href="/logout" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-semibold text-red-400 hover:bg-red-900/20 transition-all mt-1">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Sign Out
                        </a>
                    <?php else: ?>
                        <a href="/login" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:bg-white/8 hover:text-white transition-all">
                            Login
                        </a>
                        <a href="/register" class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold text-white transition-all"
                           style="background:linear-gradient(135deg,#3b82f6,#6366f1);">
                            Get Started
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <!-- Header spacing -->
    <div class="h-24 print:hidden"></div>

    <main class="flex-grow w-full relative">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <?php
            $viewPath = __DIR__ . '/' . $path;
            if (!preg_match('/\.php$/', $viewPath)) { $viewPath .= '.php'; }
            if (file_exists($viewPath)) include $viewPath;
            else echo "<div class='glass-card p-6'><h2 class='text-xl font-semibold text-white'>View not found</h2><p class='text-gray-400 mt-2'>{$viewPath}</p></div>";
            ?>
        </div>
    </main>

    <!-- ══════════════════════ FOOTER ══════════════════════ -->
    <?php if (strpos($_SERVER['REQUEST_URI'], '/student/') !== 0): ?>
    <footer class="relative print:hidden mt-auto" style="background:rgba(4,8,20,0.92);backdrop-filter:blur(20px);border-top:1px solid rgba(255,255,255,0.06);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Top section -->
            <div class="py-12 grid grid-cols-1 md:grid-cols-3 gap-10">

                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="/assets/KSR College of Engineering.jpg" alt="KSR" class="h-12 w-auto object-contain rounded-xl">
                        <div>
                            <p class="text-sm font-black text-white tracking-wide" style="font-family:'Outfit',sans-serif;">KSR CCE Portal</p>
                            <p class="text-xs text-blue-400 font-medium">Competitive Exam Excellence</p>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Empowering students to achieve their goals in GATE, UPSC, TNPSC, Banking and more through structured preparation.
                    </p>
                    <div class="mt-5 flex items-center gap-2">
                        <span class="online-dot" style="width:7px;height:7px;"></span>
                        <span class="text-xs text-green-400 font-semibold">Portal Active</span>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="https://www.ksrce.ac.in/" target="_blank" class="footer-link flex items-center gap-2 group">
                            <svg class="h-3.5 w-3.5 text-blue-500 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            Official Website
                        </a></li>
                        <li><a href="/login" class="footer-link flex items-center gap-2 group">
                            <svg class="h-3.5 w-3.5 text-blue-500 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14"/></svg>
                            Student Login
                        </a></li>
                        <li><a href="/register" class="footer-link flex items-center gap-2 group">
                            <svg class="h-3.5 w-3.5 text-blue-500 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            Register
                        </a></li>
                      
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Contact Us</h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="mailto:headcce@ksrce.ac.in" class="footer-link flex items-start gap-2 group">
                                <svg class="h-4 w-4 text-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                headcce@ksrce.ac.in
                            </a>
                        </li>
                        <li>
                            <a href="tel:+918610280789" class="footer-link flex items-center gap-2 group">
                                <svg class="h-4 w-4 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                +91 86102 80789
                            </a>
                        </li>
                        <li class="flex items-start gap-2 text-gray-500 text-sm">
                            <svg class="h-4 w-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Tiruchengode, Tamil Nadu
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Divider -->
            <div class="divider-gradient"></div>

            <!-- Bottom -->
            <div class="py-6 flex flex-col md:flex-row items-center justify-between gap-4">
               
                <div class="flex items-center gap-6">
                    <a href="/privacy-policy" class="text-xs text-gray-600 hover:text-gray-400 transition-colors">Privacy Policy</a>
                    <a href="/terms-of-service" class="text-xs text-gray-600 hover:text-gray-400 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    <?php endif; ?>
</div>

<!-- Mobile menu JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.querySelector('[aria-controls="mobile-menu"]');
    const menu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    if (btn) {
        btn.addEventListener('click', function() {
            const isHidden = menu.classList.contains('hidden');
            menu.classList.toggle('hidden');
            if (menuIcon) menuIcon.classList.toggle('hidden', !isHidden);
            if (closeIcon) closeIcon.classList.toggle('hidden', isHidden);
            btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
        });
    }

    <?php if(isset($_SESSION['user'])): ?>
    const sendHeartbeat = () => {
        fetch('/api/heartbeat')
            .then(r => r.json())
            .catch(() => {});
    };
    sendHeartbeat();
    setInterval(sendHeartbeat, 120000);
    <?php endif; ?>

    // ── Definitive Footer Overlap Fix ──
    const fixLayout = () => {
        const body = document.body;
        const html = document.documentElement;
        if (body) {
            body.style.height = 'auto';
            body.style.minHeight = '100vh';
            body.style.overflowY = 'visible';
            body.style.overflowX = 'hidden';
            // Remove any potential scroll-lock classes
            body.classList.remove('antigravity-scroll-lock');
        }
        if (html) {
            html.style.height = 'auto';
            html.style.overflowY = 'visible';
        }
    };
    window.addEventListener('load', fixLayout);
    window.addEventListener('resize', fixLayout);
    // Observe DOM changes to recalculate if needed
    const observer = new MutationObserver(fixLayout);
    observer.observe(document.body, { childList: true, subtree: true });
    fixLayout();
});
</script>
</body>
</html>
