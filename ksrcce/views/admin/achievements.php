<?php $path = 'admin/achievements.php'; ?>

<style>
    .glass-sidebar {
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
    }
    .glass-content {
        background: #f8fafc;
    }
    .glass-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }
    .glass-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
        background: #ffffff;
        border: 1px solid #e5e7eb;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .form-input {
        background: #f9fafb;
        border: 1px solid #d1d5db;
        color: #111827;
    }
    .form-input:focus {
        background: #ffffff;
        border-color: #3b82f6;
        ring: 2px solid #3b82f6;
    }
</style>

<div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm transition-all duration-300">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Student Achievements</h1>
            <p class="mt-1 text-slate-500">Manage student achievements and showcase success stories</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="/admin/dashboard" class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                Back to Dashboard
            </a>
            <button onclick="openAddModal()" class="px-4 py-3 bg-green-600 text-white text-sm font-medium rounded-xl hover:bg-green-700 transition-colors shadow-lg shadow-green-500/25 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Add New Achievement
            </button>
        </div>
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
                <div class="glass-card rounded-2xl overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Student</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Exam</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Rank/Score</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Featured</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100" id="achievements-table">
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
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-slate-900"><?= htmlspecialchars($achievement['student_name']) ?></div>
                                                <?php if ($achievement['batch_year']): ?>
                                                    <div class="text-sm text-gray-500">Batch: <?= htmlspecialchars($achievement['batch_year']) ?></div>
                                                <?php endif; ?>
                                                <?php if ($achievement['department']): ?>
                                                    <div class="text-sm text-gray-500"><?= htmlspecialchars($achievement['department']) ?></div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-slate-700"><?= htmlspecialchars($achievement['exam_name']) ?></div>
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
                                                    <img src="<?= htmlspecialchars($achievement['image_url']) ?>" alt="Achievement" class="h-12 w-12 rounded-lg object-cover border border-slate-200 shadow-sm">
                                                <?php else: ?>
                                                    <div class="h-12 w-12 bg-slate-100 rounded-lg flex items-center justify-center border border-slate-200">
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

<!-- Add/Edit Modal -->
<div id="achievementModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="glass-modal m-4 p-6 w-full max-w-md rounded-2xl shadow-2xl relative max-h-[90vh] overflow-y-auto custom-scrollbar">
        <h3 class="text-xl font-bold text-slate-900 mb-6" id="modalTitle">Add Achievement</h3>
        <form id="achievementForm" enctype="multipart/form-data">
            <input type="hidden" id="achievementId" name="id">
            
            <div class="space-y-4">
                <div>
                    <label for="studentName" class="block text-sm font-medium text-slate-700 mb-1">Student Name *</label>
                    <input type="text" id="studentName" name="student_name" required
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="examName" class="block text-sm font-medium text-slate-700 mb-1">Exam Name *</label>
                    <input type="text" id="examName" name="exam_name" required
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="rankOrScore" class="block text-sm font-medium text-slate-700 mb-1">Rank/Score *</label>
                    <input type="text" id="rankOrScore" name="rank_or_score" required
                        placeholder="e.g., 1st Rank, 95.6%"
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="batchYear" class="block text-sm font-medium text-slate-700 mb-1">Batch Year</label>
                    <input type="text" id="batchYear" name="batch_year"
                        placeholder="e.g., 2024-2025"
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="department" class="block text-sm font-medium text-slate-700 mb-1">Department</label>
                    <input type="text" id="department" name="department"
                        placeholder="e.g., Computer Science Engineering"
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                    <textarea id="description" name="achievement_description" rows="3"
                        placeholder="Brief description of the achievement..."
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors"></textarea>
                </div>

                <div>
                    <label for="achievementImage" class="block text-sm font-medium text-slate-700 mb-1">Achievement Image</label>
                    <input type="file" id="achievementImage" name="achievement_image" accept="image/*"
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                    <p class="mt-1 text-xs text-gray-500">Supported formats: JPEG, PNG, WebP. Max size: 5MB</p>
                </div>

                <div class="flex items-center space-x-6">
                    <label class="flex items-center">
                        <input type="checkbox" id="isFeatured" name="is_featured"
                            class="mr-2 rounded border-slate-300 bg-white text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-slate-700">Featured</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" id="isActive" name="is_active" checked
                            class="mr-2 rounded border-slate-300 bg-white text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-slate-700">Active</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-8">
                <button type="button" onclick="closeModal()" 
                    class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-colors font-medium">
                    Cancel
                </button>
                <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors shadow-lg shadow-blue-500/25 font-medium">
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
    fetch(`/api/achievements/${id}`)
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
