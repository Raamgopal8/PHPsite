<?php $path = 'admin/password-view-details.php'; ?>

<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-medium text-gray-900">Password Details</h2>
                    <button onclick="window.close()" class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">User ID</label>
                        <div class="mt-1">
                            <span class="text-gray-900 font-mono bg-gray-100 px-3 py-2 rounded">
                                <?= htmlspecialchars($user_id); ?>
                            </span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1">
                            <div class="flex items-center">
                                <code class="flex-1 text-sm bg-gray-100 px-3 py-2 rounded font-mono">
                                    <?= htmlspecialchars($password); ?>
                                </code>
                                <button onclick="copyToClipboard('<?= htmlspecialchars($password); ?>')" class="ml-3 text-gray-400 hover:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 8l4 4m0 0l-4-4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password Type</label>
                        <div class="mt-1">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                <?= strpos($type, 'Secure') !== false ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                <?= htmlspecialchars($type); ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 2.722 0 0 1.957 1.36 2.722 1.36 0 0-1.957-1.36-2.722-1.36zm0 9.012c-.765 1.36-2.722 1.36-2.722 0 0-1.957-1.36-2.722-1.36-2.722 0 0 1.957 1.36 2.722 1.36 0 0 1.957-1.36 2.722-1.36zM10 2.5a7.5 7.5 0 100 15 7.5 7.5 0 000-15zm-3.5 7.5a.5.5 0 01-.5.5v-9a.5.5 0 01.5-.5h9a.5.5 0 01.5.5v9a.5.5 0 01-.5.5z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Security Notice</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>BCRYPT passwords cannot be decrypted (they're one-way hashes)</li>
                                        <li>Only MD5 or plain text passwords can be shown</li>
                                        <li>This tool is for administrative recovery purposes only</li>
                                        <li>Access is logged and monitored</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success feedback
        const button = event.target.closest('button');
        const originalHTML = button.innerHTML;
        button.innerHTML = '✓ Copied';
        button.classList.add('text-green-600');
        
        setTimeout(function() {
            button.innerHTML = originalHTML;
            button.classList.remove('text-green-600');
        }, 2000);
    }).catch(function(err) {
        console.error('Failed to copy: ', err);
    });
}
</script>
