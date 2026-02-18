<?php $path = 'admin/achievements.php'; ?>

<style>
    .glass-sidebar {
        background: rgba(17, 24, 39, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-right: 1px solid rgba(255, 255, 255, 0.08);
    }
    .glass-content {
        background: rgba(17, 24, 39, 0.4); 
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .glass-card:hover {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }
    .nav-item {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .nav-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 3px;
        background: #3b82f6;
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }
    .nav-item:hover::before, .nav-item.active::before {
        transform: scaleY(1);
    }
    .nav-item:hover, .nav-item.active {
        background: rgba(59, 130, 246, 0.1);
        color: #60a5fa;
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.02);
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.2);
    }
    
    /* Modal Styles */
    .glass-modal {
        background: rgba(17, 24, 39, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .form-input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
    }
    .form-input:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: #3b82f6;
    }
</style>

<div class="min-h-screen bg-[url('/assets/background.jpg')] bg-fixed bg-cover bg-center">
    <div class="flex min-h-screen bg-gray-900/80 backdrop-blur-sm">
        
        <!-- Sidebar Navigation -->
        <aside class="hidden lg:flex flex-col w-64 glass-sidebar fixed inset-y-0 left-0 z-40 pt-28 pb-6 overflow-y-auto">
            <div class="px-6 mb-8">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/30">
                        <?= strtoupper(substr(htmlspecialchars($_SESSION['user']['name'] ?? 'A'), 0, 1)) ?>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-white"><?= htmlspecialchars($_SESSION['user']['name'] ?? 'Admin') ?></h3>
                        <p class="text-xs text-blue-400">Administrator</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-2">
                <a href="/admin/dashboard" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:text-white">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Overview
                </a>
                <a href="/admin/exams" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:text-white">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Exams
                </a>
                <a href="/admin/exam-countdowns" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:text-white">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Countdowns
                </a>
                <a href="/admin/achievements" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white rounded-xl">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    Achievements
                </a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 lg:pl-64 flex flex-col min-w-0 overflow-x-hidden">
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
                
                <!-- Header -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-white tracking-tight">Student Achievements</h1>
                        <p class="mt-1 text-gray-400">Manage student achievements and showcase success stories</p>
                    </div>
                    <button onclick="openAddModal()" class="px-4 py-3 bg-green-600 text-white text-sm font-medium rounded-xl hover:bg-green-700 transition-colors shadow-lg shadow-green-500/25 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Add New Achievement
                    </button>
                </div>

                <!-- Flash Messages -->
                <?php if(!empty($_SESSION['flash']['success'])): ?>
                    <div class="mb-8 p-4 bg-green-500/10 text-green-400 rounded-xl border border-green-500/20 flex items-start backdrop-blur-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <div><?= htmlspecialchars($_SESSION['flash']['success']); unset($_SESSION['flash']['success']); ?></div>
                    </div>
                <?php endif; ?>

                <?php if(!empty($_SESSION['flash']['error'])): ?>
                    <div class="mb-8 p-4 bg-red-500/10 text-red-400 rounded-xl border border-red-500/20 flex items-start backdrop-blur-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <div><?= htmlspecialchars($_SESSION['flash']['error']); unset($_SESSION['flash']['error']); ?></div>
                    </div>
                <?php endif; ?>

                <!-- Achievements Table -->
                <div class="glass-card rounded-2xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-white/5">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Student</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Exam</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Rank/Score</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Featured</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5" id="achievements-table">
                                <?php if (empty($achievements)): ?>
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-gray-400">No achievements found.</p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($achievements as $achievement): ?>
                                        <tr class="hover:bg-white/5 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-white"><?= htmlspecialchars($achievement['student_name']) ?></div>
                                                <?php if ($achievement['batch_year']): ?>
                                                    <div class="text-sm text-gray-500">Batch: <?= htmlspecialchars($achievement['batch_year']) ?></div>
                                                <?php endif; ?>
                                                <?php if ($achievement['department']): ?>
                                                    <div class="text-sm text-gray-500"><?= htmlspecialchars($achievement['department']) ?></div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-300"><?= htmlspecialchars($achievement['exam_name']) ?></div>
                                                <?php if ($achievement['achievement_description']): ?>
                                                    <div class="text-sm text-gray-500"><?= htmlspecialchars(substr($achievement['achievement_description'], 0, 50)) ?>...</div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-sm font-medium bg-blue-500/10 text-blue-400 rounded-full">
                                                    <?= htmlspecialchars($achievement['rank_or_score']) ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php if ($achievement['image_url']): ?>
                                                    <img src="<?= htmlspecialchars($achievement['image_url']) ?>" alt="Achievement" class="h-12 w-12 rounded-lg object-cover border border-white/10">
                                                <?php else: ?>
                                                    <div class="h-12 w-12 bg-white/5 rounded-lg flex items-center justify-center border border-white/10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    <?= $achievement['is_featured'] ? 'bg-yellow-500/10 text-yellow-400' : 'bg-gray-500/10 text-gray-400' ?>">
                                                    <?= $achievement['is_featured'] ? 'Featured' : 'Regular' ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    <?= $achievement['is_active'] ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' ?>">
                                                    <?= $achievement['is_active'] ? 'Active' : 'Inactive' ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editAchievement(<?= $achievement['id'] ?>)" class="text-blue-400 hover:text-blue-300 mr-3 transition-colors">Edit</button>
                                                <button onclick="toggleFeatured(<?= $achievement['id'] ?>)" class="text-yellow-400 hover:text-yellow-300 mr-3 transition-colors">
                                                    <?= $achievement['is_featured'] ? 'Unfeature' : 'Feature' ?>
                                                </button>
                                                <button onclick="toggleStatus(<?= $achievement['id'] ?>)" class="text-purple-400 hover:text-purple-300 mr-3 transition-colors">
                                                    <?= $achievement['is_active'] ? 'Deactivate' : 'Activate' ?>
                                                </button>
                                                <button onclick="deleteAchievement(<?= $achievement['id'] ?>)" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                    <div class="mt-6 flex justify-center">
                        <nav class="flex space-x-2">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="?page=<?= $i ?>" 
                                   class="px-3 py-2 rounded-lg text-sm font-medium transition-colors
                                   <?= $i == $currentPage ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/25' : 'bg-white/5 text-gray-300 hover:bg-white/10 hover:text-white' ?>">
                                    <?= $i ?>
                                </a>
                            <?php endfor; ?>
                        </nav>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<!-- Add/Edit Modal -->
<div id="achievementModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="glass-modal m-4 p-6 w-full max-w-md rounded-2xl shadow-2xl relative max-h-[90vh] overflow-y-auto custom-scrollbar">
        <h3 class="text-xl font-bold text-white mb-6" id="modalTitle">Add Achievement</h3>
        <form id="achievementForm" enctype="multipart/form-data">
            <input type="hidden" id="achievementId" name="id">
            
            <div class="space-y-4">
                <div>
                    <label for="studentName" class="block text-sm font-medium text-gray-300 mb-1">Student Name *</label>
                    <input type="text" id="studentName" name="student_name" required
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="examName" class="block text-sm font-medium text-gray-300 mb-1">Exam Name *</label>
                    <input type="text" id="examName" name="exam_name" required
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="rankOrScore" class="block text-sm font-medium text-gray-300 mb-1">Rank/Score *</label>
                    <input type="text" id="rankOrScore" name="rank_or_score" required
                        placeholder="e.g., 1st Rank, 95.6%"
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="batchYear" class="block text-sm font-medium text-gray-300 mb-1">Batch Year</label>
                    <input type="text" id="batchYear" name="batch_year"
                        placeholder="e.g., 2024-2025"
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="department" class="block text-sm font-medium text-gray-300 mb-1">Department</label>
                    <input type="text" id="department" name="department"
                        placeholder="e.g., Computer Science Engineering"
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                    <textarea id="description" name="achievement_description" rows="3"
                        placeholder="Brief description of the achievement..."
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors"></textarea>
                </div>

                <div>
                    <label for="achievementImage" class="block text-sm font-medium text-gray-300 mb-1">Achievement Image</label>
                    <input type="file" id="achievementImage" name="achievement_image" accept="image/*"
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                    <p class="mt-1 text-xs text-gray-500">Supported formats: JPEG, PNG, WebP. Max size: 5MB</p>
                </div>

                <div class="flex items-center space-x-6">
                    <label class="flex items-center">
                        <input type="checkbox" id="isFeatured" name="is_featured"
                            class="mr-2 rounded border-gray-600 bg-gray-700 text-green-500 focus:ring-green-500">
                        <span class="text-sm text-gray-300">Featured</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" id="isActive" name="is_active" checked
                            class="mr-2 rounded border-gray-600 bg-gray-700 text-green-500 focus:ring-green-500">
                        <span class="text-sm text-gray-300">Active</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-8">
                <button type="button" onclick="closeModal()" 
                    class="px-4 py-2 bg-white/5 text-gray-300 rounded-xl hover:bg-white/10 transition-colors">
                    Cancel
                </button>
                <button type="submit" 
                    class="px-4 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-colors shadow-lg shadow-green-500/25">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Add Achievement';
    document.getElementById('achievementForm').reset();
    document.getElementById('achievementId').value = '';
    document.getElementById('achievementModal').classList.remove('hidden');
}

function editAchievement(id) {
    // Fetch achievement data and populate form
    fetch(`/admin/achievements/${id}`)
        .then(response => response.json())
        .then(data => {
            const achievement = data.achievement;
            document.getElementById('modalTitle').textContent = 'Edit Achievement';
            document.getElementById('achievementId').value = achievement.id;
            document.getElementById('studentName').value = achievement.student_name;
            document.getElementById('examName').value = achievement.exam_name;
            document.getElementById('rankOrScore').value = achievement.rank_or_score;
            document.getElementById('batchYear').value = achievement.batch_year || '';
            document.getElementById('department').value = achievement.department || '';
            document.getElementById('description').value = achievement.achievement_description || '';
            document.getElementById('isFeatured').checked = achievement.is_featured;
            document.getElementById('isActive').checked = achievement.is_active;
            document.getElementById('achievementModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error fetching achievement data');
        });
}

function closeModal() {
    document.getElementById('achievementModal').classList.add('hidden');
}

function toggleFeatured(id) {
    if (confirm('Are you sure you want to toggle the featured status?')) {
        fetch('/api/achievements/featured', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error toggling featured status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error toggling featured status');
        });
    }
}

function toggleStatus(id) {
    if (confirm('Are you sure you want to toggle this achievement status?')) {
        fetch('/api/achievements/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error toggling achievement status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error toggling achievement status');
        });
    }
}

function deleteAchievement(id) {
    if (confirm('Are you sure you want to delete this achievement? This action cannot be undone.')) {
        fetch('/api/achievements/delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting achievement');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting achievement');
        });
    }
}

// Handle form submission
document.getElementById('achievementForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const isEdit = formData.get('id');
    const url = isEdit ? '/admin/achievements/update' : '/admin/achievements/create';
    
    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.redirected) {
            window.location.href = response.url;
        } else {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving achievement');
    });
});
</script>
