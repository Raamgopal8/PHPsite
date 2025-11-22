<?php $path = 'auth/login.php'; ?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center space-x-2">
                <div class="h-10 w-10 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 01.287.22l4 4a1 1 0 11-1.414 1.414l-3.736-3.737-6.9 4.5a1 1 0 11-1.1-1.684l7-4.5a1 1 0 011.1 0l4.5 2.5a1 1 0 11-1 1.732l-3.5-1.945-5.5 3.5a1 1 0 01-1.5-.866V6.3a1 1 0 01.6-.9l7-3a1 1 0 01.1-.32z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">ExamPortal</span>
            </a>
            <h1 class="mt-4 text-2xl font-bold text-gray-800">Welcome back</h1>
            <p class="mt-1 text-sm text-gray-600">Sign in to your account to continue</p>
        </div>

        <!-- Flash Messages -->
        <?php if(!empty($_SESSION['flash']['error'])): ?>
            <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200 flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <div><?= htmlspecialchars($_SESSION['flash']['error']); unset($_SESSION['flash']['error']); ?></div>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg p-8 border border-white/20">
            <form action="/login" method="post" class="space-y-6" onsubmit="return validateEmailDomain()">
                <script>
                    function validateEmailDomain() {
                        const email = document.getElementById('email').value;
                        const emailError = document.getElementById('email-error');
                        const isValid = /^[a-zA-Z0-9._%+-]+@(ksrce\.ac\.in|ksriet\.ac\.in)$/.test(email);
                        
                        if (!isValid) {
                            emailError.classList.remove('hidden');
                            return false;
                        }
                        emailError.classList.add('hidden');
                        return true;
                    }
                    
                    // Also validate on input change to give immediate feedback
                    document.getElementById('email').addEventListener('input', function() {
                        const emailError = document.getElementById('email-error');
                        emailError.classList.add('hidden');
                    });
                </script>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" required 
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg bg-white/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200"
                            placeholder="you@ksrce.ac.in" autocomplete="username"
                            pattern="^[a-zA-Z0-9._%+-]+@(ksrce\.ac\.in|ksriet\.ac\.in)$"
                            title="Please use your ksrce.ac.in or ksriet.ac.in email address">
                        <div id="email-error" class="mt-1 text-sm text-red-600 hidden">Please use your ksrce.ac.in or ksriet.ac.in email address</div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="text-sm">
                            <a href="/forgot-password" class="font-medium text-blue-600 hover:text-blue-500">Forgot password?</a>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" required 
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg bg-white/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200"
                            placeholder="••••••••" autocomplete="current-password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                        Sign in
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white/80 text-gray-500">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div>
                        <a href="/auth/google" class="w-full inline-flex justify-center py-2.5 px-4 border border-gray-300 rounded-full shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z" />
                            </svg>
                        </a>
                    </div>
                    <div>
                        <a href="/auth/github" class="w-full inline-flex justify-center py-2.5 px-4 border border-gray-300 rounded-full shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <p class="mt-6 text-center text-sm text-gray-600">
            Don't have an account?
            <a href="/register" class="font-medium text-blue-600 hover:text-blue-500">Sign up</a>
        </p>
    </div>
</div>
