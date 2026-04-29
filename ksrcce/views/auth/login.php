<?php $path = 'auth/login.php'; ?>

<style>
/* ── Auth Page: Pure Light Theme ── */
body {
    background-image: url('/assets/background.jpg') !important;
    background-size: 100% 100% !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
    background-attachment: fixed !important;
    background-color: var(--bg-primary) !important;
    overflow: hidden !important;
    height: 100vh !important;
}
header, footer { display: none !important; }
main { padding-top: 0 !important; margin-top: 0 !important; }
body > main > div { padding-top: 0 !important; }

/* Auth Card refinement - light glassmorphism */
.auth-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.4);
    border-radius: 24px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
}
</style>

<div class="h-screen flex items-center justify-center px-4 py-6 overflow-hidden">
    <div class="w-full max-w-md">

        <!-- Branding -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center gap-4 mb-6">
                <!-- Standardized Logo Containers -->
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-slate-100 w-16 h-16 flex items-center justify-center">
                    <img src="/assets/KSR College of Engineering.jpg" alt="KSR" class="max-h-full max-w-full object-contain">
                </div>
                <div class="h-8 w-px bg-slate-200"></div>
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-slate-100 w-18 h-16 flex items-center justify-center">
                    <img src="/assets/ccelogo.jpg" alt="CCE" class="max-h-full max-w-full object-contain">
                </div>
            </div>
            <h1 class="text-3xl font-black text-slate-900 mb-2" style="font-family:'Outfit',sans-serif;letter-spacing:-0.03em;">Welcome Back</h1>
            <p class="text-slate-500 text-sm font-medium">Sign in to your CCE student account</p>
        </div>

        <!-- Card -->
        <div class="auth-card p-10">

            <!-- Error Flash -->
            <?php if(!empty($_SESSION['flash']['error'])): ?>
                <div class="mb-6 p-4 rounded-xl flex items-start gap-3 bg-red-50 border border-red-100">
                    <svg class="h-5 w-5 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <p class="text-red-700 text-sm font-medium leading-snug"><?= htmlspecialchars($_SESSION['flash']['error']); unset($_SESSION['flash']['error']); ?></p>
                </div>
            <?php endif; ?>

            <form action="/login" method="post" class="space-y-6" onsubmit="return validateEmailDomain()" id="login-form">
                
                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2.5 ml-1">Email Address</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" /></svg>
                        </div>
                        <input type="email" id="email" name="email" required 
                               class="light-input !pl-12" 
                               placeholder="you@ksrce.ac.in" autocomplete="username">
                    </div>
                    <div id="email-error" class="mt-2 text-xs text-red-600 hidden flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        Use your ksrce.ac.in or ksriet.ac.in email
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2.5 ml-1">
                        <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Password</label>
                        <a href="/forgot-password" class="text-xs font-bold text-indigo-600 hover:underline">Forgot Password?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input type="password" id="password" name="password" required 
                               class="light-input !pl-12 !pr-14" 
                               placeholder="••••••••" autocomplete="current-password">
                        <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-indigo-600 transition-colors">
                            <svg id="eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            <svg id="eye-slash-icon" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submit-btn" class="w-full py-4 px-6 rounded-xl text-sm font-bold text-white transition-all hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-2"
                        style="background: linear-gradient(135deg, #6366f1, #4f46e5); box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);">
                    <span id="btn-text">Sign In</span>
                    <svg id="btn-arrow" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    <svg id="btn-spinner" class="hidden h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center pt-8 border-t border-slate-100">
                <p class="text-slate-500 text-sm">
                    Don't have an account? 
                    <a href="/register" class="text-indigo-600 font-bold hover:underline">Create one free →</a>
                </p>
            </div>
            <div class="mt-4 text-center text-xs text-slate-500">
                <p>Developed by <span class="text-blue-600 font-semibold">RAAMGOPAL S</span> — Dept of Computer Science and Engineering (2022–2026)</p>
            </div>
        </div>

        <!-- Trust indicators -->
        <div class="mt-10 flex items-center justify-center gap-5 text-xs text-slate-400 font-medium">
            <span class="flex items-center gap-1"><span class="w-1 h-1 rounded-full bg-slate-300"></span> Secure Portal</span>
            <span class="flex items-center gap-1"><span class="w-1 h-1 rounded-full bg-slate-300"></span> Free Access</span>
            <span class="flex items-center gap-1"><span class="w-1 h-1 rounded-full bg-slate-300"></span> Smart Practice</span>
        </div>
    </div>
</div>

<script>
function validateEmailDomain() {
    const email = document.getElementById('email').value;
    const emailError = document.getElementById('email-error');
    const isValid = /^[a-zA-Z0-9._%+-]+@(ksrce\.ac\.in|ksriet\.ac\.in)$/.test(email);
    if (!isValid) { emailError.classList.remove('hidden'); return false; }
    emailError.classList.add('hidden');
    document.getElementById('btn-text').textContent = 'Signing In...';
    document.getElementById('btn-arrow').classList.add('hidden');
    document.getElementById('btn-spinner').classList.remove('hidden');
    return true;
}

document.getElementById('email').addEventListener('input', function() {
    document.getElementById('email-error').classList.add('hidden');
});

const togglePassword = document.getElementById('toggle-password');
const passwordInput  = document.getElementById('password');
const eyeIcon        = document.getElementById('eye-icon');
const eyeSlashIcon   = document.getElementById('eye-slash-icon');

togglePassword.addEventListener('click', function() {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.add('hidden');
        eyeSlashIcon.classList.remove('hidden');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('hidden');
        eyeSlashIcon.classList.add('hidden');
    }
});
</script>
