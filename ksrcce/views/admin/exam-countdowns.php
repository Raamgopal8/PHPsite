<?php $path = 'admin/exam-countdowns.php'; ?>

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
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Exam Countdowns</h1>
            <p class="mt-1 text-slate-500">Manage exam countdown timers for students</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="/admin/dashboard" class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                Back to Dashboard
            </a>
            <button onclick="openAddModal()" class="px-4 py-3 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-lg shadow-blue-500/25 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Add New Countdown
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

                <!-- Countdowns Table -->
                <div class="glass-card rounded-2xl overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Exam Name</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date & Time</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Target Audience</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100" id="countdowns-table">
                                <?php if (empty($countdowns)): ?>
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-gray-400">No exam countdowns found.</p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($countdowns as $countdown): ?>
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-slate-900"><?= htmlspecialchars($countdown['exam_name']) ?></div>
                                                <?php if ($countdown['description']): ?>
                                                    <div class="text-sm text-gray-500"><?= htmlspecialchars(substr($countdown['description'], 0, 50)) ?>...</div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-300"><?= date('M d, Y', strtotime($countdown['exam_date'])) ?></div>
                                                <div class="text-sm text-gray-500"><?= date('h:i A', strtotime($countdown['exam_time'])) ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    <?= $countdown['target_audience'] === 'all' ? 'bg-blue-500/10 text-blue-400' : 
                                                       ($countdown['target_audience'] === 'students' ? 'bg-green-500/10 text-green-400' : 
                                                       'bg-purple-500/10 text-purple-400') ?>">
                                                    <?= ucfirst($countdown['target_audience']) ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    <?= $countdown['is_active'] ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' ?>">
                                                    <?= $countdown['is_active'] ? 'Active' : 'Inactive' ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editCountdown(<?= $countdown['id'] ?>)" class="text-blue-400 hover:text-blue-300 mr-3 transition-colors">Edit</button>
                                                <button onclick="toggleCountdown(<?= $countdown['id'] ?>)" class="text-yellow-400 hover:text-yellow-300 mr-3 transition-colors">
                                                    <?= $countdown['is_active'] ? 'Deactivate' : 'Activate' ?>
                                                </button>
                                                <button onclick="deleteCountdown(<?= $countdown['id'] ?>)" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>

<!-- Add/Edit Modal -->
<div id="countdownModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="glass-modal m-4 p-6 w-full max-w-md rounded-2xl shadow-2xl relative">
        <h3 class="text-xl font-bold text-slate-900 mb-6" id="modalTitle">Add Exam Countdown</h3>
        
        <form id="countdownForm">
            <input type="hidden" id="countdownId" name="id">
            
            <div class="space-y-4">
                <div>
                    <label for="examName" class="block text-sm font-medium text-slate-700 mb-1">Exam Name</label>
                    <input type="text" id="examName" name="exam_name" required
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="examDate" class="block text-sm font-medium text-slate-700 mb-1">Exam Date</label>
                    <input type="date" id="examDate" name="exam_date" required
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="examTime" class="block text-sm font-medium text-slate-700 mb-1">Exam Time</label>
                    <input type="time" id="examTime" name="exam_time" value="09:00"
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors"></textarea>
                </div>

                <div>
                    <label for="targetAudience" class="block text-sm font-medium text-slate-700 mb-1">Target Audience</label>
                    <select id="targetAudience" name="target_audience"
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                        <option value="all" class="bg-white text-slate-900">All Users</option>
                        <option value="students" class="bg-white text-slate-900">Students Only</option>
                        <option value="admins" class="bg-white text-slate-900">Admins Only</option>
                    </select>
                </div>

                <div>
                    <label class="flex items-center">
                        <input type="checkbox" id="isActive" name="is_active" checked
                            class="mr-2 rounded border-gray-300 bg-white text-blue-600 focus:ring-blue-500">
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
    document.getElementById('modalTitle').textContent = 'Add Exam Countdown';
    document.getElementById('countdownForm').reset();
    document.getElementById('countdownId').value = '';
    document.getElementById('countdownModal').classList.remove('hidden');
}

function editCountdown(id) {
    fetch(`/api/exam-countdowns/${id}`)
        .then(response => response.json())
        .then(data => {
            const countdown = data.countdown.exam;
            document.getElementById('modalTitle').textContent = 'Edit Exam Countdown';
            document.getElementById('countdownId').value = countdown.id;
            document.getElementById('examName').value = countdown.exam_name;
            document.getElementById('examDate').value = countdown.exam_date;
            document.getElementById('examTime').value = countdown.exam_time;
            document.getElementById('description').value = countdown.description || '';
            document.getElementById('targetAudience').value = countdown.target_audience;
            document.getElementById('isActive').checked = countdown.is_active;
            document.getElementById('countdownModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error fetching countdown data');
        });
}

function closeModal() {
    document.getElementById('countdownModal').classList.add('hidden');
}

function toggleCountdown(id) {
    if (confirm('Are you sure you want to toggle this countdown status?')) {
        fetch('/api/exam-countdowns/toggle', {
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
                alert('Error toggling countdown');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error toggling countdown');
        });
    }
}

function deleteCountdown(id) {
    if (confirm('Are you sure you want to delete this countdown? This action cannot be undone.')) {
        fetch('/api/exam-countdowns/delete', {
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
                alert('Error deleting countdown');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting countdown');
        });
    }
}

document.getElementById('countdownForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
    data.is_active = document.getElementById('isActive').checked;
    
    const isEdit = data.id;
    const url = isEdit ? '/api/exam-countdowns/update' : '/api/exam-countdowns/create';
    
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeModal();
            location.reload();
        } else {
            alert('Error saving countdown');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving countdown');
    });
});
</script>
