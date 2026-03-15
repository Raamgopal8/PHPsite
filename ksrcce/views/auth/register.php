<?php $path = 'auth/register.php'; ?>

<style>
/* ── Auth Page: Pure Light Theme ── */
body {
    background-image: url('/assets/background.jpg') !important;
    background-size: cover !important;
    background-position: center !important;
    background-attachment: fixed !important;
    background-color: var(--bg-primary) !important;
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

<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-lg">

        <!-- Branding -->
        <div class="text-center mb-7">
            <div class="inline-flex items-center justify-center gap-4 mb-5">
                <!-- Standardized Logo Containers -->
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-slate-100 w-16 h-16 flex items-center justify-center">
                    <img src="/assets/KSR College of Engineering.jpg" alt="KSR" class="max-h-full max-w-full object-contain">
                </div>
                <div class="h-8 w-px bg-slate-200"></div>
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-slate-100 w-16 h-16 flex items-center justify-center">
                    <img src="/assets/ccelogo.jpg" alt="CCE" class="max-h-full max-w-full object-contain">
                </div>
            </div>
            <h1 class="text-3xl font-black text-slate-900 mb-1" style="font-family:'Outfit',sans-serif;letter-spacing:-0.02em;">Create Your Account</h1>
            <p class="text-sm text-slate-500 font-medium">Join the KSR CCE community — it's free</p>
        </div>

        <!-- Card -->
        <div class="auth-card p-10">

            <!-- Step Indicator -->
            <div class="flex items-center justify-between mb-8 px-1">
                <?php foreach([['1','Identity'],['2','Academic'],['3','Security']] as $i => [$num,$label]): ?>
                <div class="flex flex-col items-center gap-2">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-bold transition-all duration-300"
                         style="background:<?= $i < 2 ? 'linear-gradient(135deg,#6366f1,#4f46e5)' : '#f1f5f9' ?>; 
                                color:<?= $i < 2 ? 'white' : '#64748b' ?>;
                                border: 2px solid <?= $i < 2 ? 'rgba(99,102,241,0.2)' : '#e2e8f0' ?>;">
                        <?= $num ?>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest <?= $i < 2 ? 'text-indigo-600' : 'text-slate-400' ?>"><?= $label ?></span>
                </div>
                <?php if($i < 2): ?>
                <div class="flex-1 h-0.5 mx-4 rounded-full" style="background:<?= $i === 0 ? 'linear-gradient(90deg,#6366f1,#e0e7ff)' : '#f1f5f9' ?>;"></div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Error Flash -->
            <?php if(!empty($_SESSION['flash']['error'])): ?>
                <div class="mb-6 p-4 rounded-xl flex items-start gap-3 bg-red-50 border border-red-100">
                    <svg class="h-5 w-5 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <p class="text-red-700 text-sm font-medium"><?= htmlspecialchars($_SESSION['flash']['error']); unset($_SESSION['flash']['error']); ?></p>
                </div>
            <?php endif; ?>

            <form action="/register" method="post" class="space-y-5" onsubmit="return validateEmailDomain()">

                <!-- Identity Section -->
                <div class="space-y-5">
                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2.5 ml-1">Full Name</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <input type="text" id="name" name="name" required class="light-input !pl-12" placeholder="e.g. Arjun Kumar">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2.5 ml-1">College Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <input type="email" id="email" name="email" required class="light-input !pl-12"
                                placeholder="you@ksrce.ac.in"
                                pattern="^[a-zA-Z0-9._%+-]+@(ksrce\.ac\.in|ksriet\.ac\.in)$"
                                title="Please use your ksrce.ac.in or ksriet.ac.in email address">
                        </div>
                        <div id="email-error" class="mt-2 text-xs text-red-600 hidden flex items-center gap-1 font-medium ml-1">
                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            Use your ksrce.ac.in or ksriet.ac.in email
                        </div>
                    </div>

                    <!-- College + Year -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="college" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2.5 ml-1">College</label>
                            <div class="relative">
                                <select id="college" name="college" required class="light-input appearance-none">
                                    <option value="" disabled selected>Select college</option>
                                    <option value="KSRCE">KSRCE</option>
                                    <option value="KSRIET">KSRIET</option>
                                </select>
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="year" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2.5 ml-1">Year</label>
                            <div class="relative">
                                <select id="year" name="year" required class="light-input appearance-none">
                                    <option value="" disabled selected>Select year</option>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Department -->
                    <div>
                        <label for="department" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2.5 ml-1">Department</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                            </div>
                            <input type="text" id="department" name="department" required class="light-input !pl-12" placeholder="e.g. Computer Science (CSE)">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2.5 ml-1">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input type="password" id="password" name="password" required class="light-input !pl-12 !pr-14" placeholder="Minimum 8 characters">
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-indigo-600 transition-colors">
                                <svg id="eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg id="eye-slash-icon" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                            </button>
                        </div>
                        <p class="mt-2 text-[10px] font-bold text-slate-400 uppercase tracking-tighter ml-1">Use 8+ characters with mixed types</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full mt-6 py-4 px-6 rounded-xl text-sm font-bold text-white transition-all hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-2"
                        style="background: linear-gradient(135deg, #6366f1, #4f46e5); box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);">
                    Create My Account
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>

            <!-- Divider -->
            <div class="my-8 flex items-center gap-4">
                <div class="flex-1 h-px bg-slate-100"></div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">ALREADY REGISTERED?</span>
                <div class="flex-1 h-px bg-slate-100"></div>
            </div>

            <a href="/login" class="block w-full py-3.5 rounded-xl text-sm font-bold text-center transition-all hover:bg-indigo-50 text-indigo-600 border border-indigo-100 bg-indigo-50/30">
                Sign In Instead →
            </a>
        </div>
    </div>
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
        passwordInput.type = 'text'; eyeIcon.classList.add('hidden'); eyeSlashIcon.classList.remove('hidden');
    } else {
        passwordInput.type = 'password'; eyeIcon.classList.remove('hidden'); eyeSlashIcon.classList.add('hidden');
    }
});
</script>
