<?php $path = 'auth/reset-password.php'; ?>

<style>
/* ── Auth Page: Pure Light Theme ── */
body {
    background-image: url('/assets/background.jpg') !important;
    background-size: 100% 100% !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
    background-attachment: fixed !important;
    background-color: var(--bg-primary) !important;
}
header, footer { display: none !important; }
main { padding-top: 0 !important; margin-top: 0 !important; }
body > main > div { padding-top: 0 !important; max-width: none !important; padding-left: 0 !important; padding-right: 0 !important; }

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
    <div class="w-full max-w-md">

        <!-- Branding -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center gap-4 mb-6">
                <!-- Standardized Logo Containers -->
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-slate-100 w-16 h-16 flex items-center justify-center">
                    <img src="/assets/KSR College of Engineering.jpg" alt="KSR" class="max-h-full max-w-full object-contain">
                </div>
                <div class="h-8 w-px bg-slate-200"></div>
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-slate-100 w-16 h-16 flex items-center justify-center">
                    <img src="/assets/ccelogo.jpg" alt="CCE" class="max-h-full max-w-full object-contain">
                </div>
            </div>
            <h1 class="text-3xl font-black text-slate-900 mb-2" style="font-family:'Outfit',sans-serif;letter-spacing:-0.03em;">Reset Password</h1>
            <p class="text-slate-500 text-sm font-medium">Create a new secure password</p>
        </div>

        <!-- Card -->
        <div class="auth-card p-10">
            <!-- Error Flash -->
            <?php if(!empty($_SESSION['flash']['error'])): ?>
                <div class="mb-6 p-4 rounded-xl flex items-start gap-3 bg-red-50 border border-red-100 animate-fade-in">
                    <svg class="h-5 w-5 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <p class="text-red-700 text-sm font-medium leading-snug"><?= htmlspecialchars($_SESSION['flash']['error']); unset($_SESSION['flash']['error']); ?></p>
                </div>
            <?php endif; ?>

            <form action="/reset-password" method="post" class="space-y-6" id="reset-password-form">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token ?? '') ?>">
                
                <!-- New Password -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2.5 ml-1">New Password</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input type="password" id="password" name="password" required 
                               class="light-input !pl-12" 
                               placeholder="••••••••" autocomplete="new-password">
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2.5 ml-1">Confirm Password</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" required 
                               class="light-input !pl-12" 
                               placeholder="••••••••" autocomplete="new-password">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submit-btn" class="w-full py-4 px-6 rounded-xl text-sm font-bold text-white transition-all hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-2"
                        style="background: linear-gradient(135deg, #6366f1, #4f46e5); box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);">
                    <span id="btn-text">Update Password</span>
                    <svg id="btn-arrow" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>
        </div>
    </div>
</div>
