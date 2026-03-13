<?php $path = 'admin/events.php'; ?>

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
                <a href="/admin/achievements" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-xl hover:text-white">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    Achievements
                </a>
                <a href="/admin/events" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white rounded-xl">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Events
                </a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 lg:pl-64 flex flex-col min-w-0 overflow-x-hidden">
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
                
                <!-- Header -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-white tracking-tight">Events Gallery Management</h1>
                        <p class="mt-1 text-gray-400">Manage campus events and showcase moments</p>
                    </div>
                    <button onclick="openAddModal()" class="px-4 py-3 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-500/25 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Add New Event
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

                <!-- Events Table -->
                <div class="glass-card rounded-2xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-white/5">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Event Title</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Featured</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5" id="events-table">
                                <?php if (empty($events)): ?>
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-gray-400">No events found.</p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($events as $event): ?>
                                        <tr class="hover:bg-white/5 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-white"><?= htmlspecialchars($event['title']) ?></div>
                                                <?php if ($event['description']): ?>
                                                    <div class="text-sm text-gray-500"><?= htmlspecialchars(substr($event['description'], 0, 50)) ?>...</div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-300"><?= date('M d, Y', strtotime($event['event_date'])) ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php if ($event['image_url']): ?>
                                                    <img src="<?= htmlspecialchars($event['image_url']) ?>" alt="Event" class="h-12 w-12 rounded-lg object-cover border border-white/10">
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
                                                    <?= $event['is_featured'] ? 'bg-indigo-500/10 text-indigo-400' : 'bg-gray-500/10 text-gray-400' ?>">
                                                    <?= $event['is_featured'] ? 'Featured' : 'Regular' ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    <?= $event['is_active'] ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' ?>">
                                                    <?= $event['is_active'] ? 'Active' : 'Inactive' ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editEvent(<?= $event['id'] ?>)" class="text-blue-400 hover:text-blue-300 mr-3 transition-colors">Edit</button>
                                                <button onclick="toggleFeatured(<?= $event['id'] ?>)" class="text-indigo-400 hover:text-indigo-300 mr-3 transition-colors">
                                                    <?= $event['is_featured'] ? 'Unfeature' : 'Feature' ?>
                                                </button>
                                                <button onclick="toggleStatus(<?= $event['id'] ?>)" class="text-purple-400 hover:text-purple-300 mr-3 transition-colors">
                                                    <?= $event['is_active'] ? 'Deactivate' : 'Activate' ?>
                                                </button>
                                                <button onclick="deleteEvent(<?= $event['id'] ?>)" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
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
                                   <?= $i == $currentPage ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/25' : 'bg-white/5 text-gray-300 hover:bg-white/10 hover:text-white' ?>">
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
<div id="eventModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="glass-modal m-4 p-6 w-full max-w-md rounded-2xl shadow-2xl relative max-h-[90vh] overflow-y-auto custom-scrollbar">
        <h3 class="text-xl font-bold text-white mb-6" id="modalTitle">Add Event</h3>
        <form id="eventForm" enctype="multipart/form-data">
            <input type="hidden" id="eventId" name="id">
            
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Event Title *</label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="eventDate" class="block text-sm font-medium text-gray-300 mb-1">Event Date *</label>
                    <input type="date" id="eventDate" name="event_date" required
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                    <textarea id="description" name="description" rows="4"
                        placeholder="Detailed description of the event..."
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors"></textarea>
                </div>

                <div>
                    <label for="eventImage" class="block text-sm font-medium text-gray-300 mb-1">Event Image</label>
                    <input type="file" id="eventImage" name="event_image" accept="image/*"
                        class="w-full px-4 py-2 rounded-xl form-input focus:outline-none transition-colors">
                    <p class="mt-1 text-xs text-gray-500">Supported formats: JPEG, PNG, WebP. Max size: 5MB</p>
                </div>

                <div class="flex items-center space-x-6">
                    <label class="flex items-center">
                        <input type="checkbox" id="isFeatured" name="is_featured"
                            class="mr-2 rounded border-gray-600 bg-gray-700 text-indigo-500 focus:ring-indigo-500">
                        <span class="text-sm text-gray-300">Featured</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" id="isActive" name="is_active" checked
                            class="mr-2 rounded border-gray-600 bg-gray-700 text-indigo-500 focus:ring-indigo-500">
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
                    class="px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-500/25">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Add Event';
    document.getElementById('eventForm').reset();
    document.getElementById('eventId').value = '';
    
    // Set default date to today
    document.getElementById('eventDate').valueAsDate = new Date();
    
    document.getElementById('eventModal').classList.remove('hidden');
}

function editEvent(id) {
    // We would ideally fetch the full event data here via an API
    // Since we don't have a single-event API endpoint yet, we'll implement it
    fetch(`/api/events/${id}`)
        .then(response => response.json())
        .then(data => {
            const event = data.event;
            document.getElementById('modalTitle').textContent = 'Edit Event';
            document.getElementById('eventId').value = event.id;
            document.getElementById('title').value = event.title;
            // Format date correctly for input type="date"
            document.getElementById('eventDate').value = event.event_date.split(' ')[0];
            document.getElementById('description').value = event.description || '';
            document.getElementById('isFeatured').checked = event.is_featured;
            document.getElementById('isActive').checked = event.is_active;
            document.getElementById('eventModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error fetching event data');
        });
}

function closeModal() {
    document.getElementById('eventModal').classList.add('hidden');
}

function toggleFeatured(id) {
    if (confirm('Are you sure you want to toggle the featured status?')) {
        fetch('/api/events/featured', {
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
    if (confirm('Are you sure you want to toggle this event status?')) {
        fetch('/api/events/toggle', {
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
                alert('Error toggling event status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error toggling event status');
        });
    }
}

function deleteEvent(id) {
    if (confirm('Are you sure you want to delete this event? This action cannot be undone.')) {
        fetch('/api/events/delete', {
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
                alert('Error deleting event');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting event');
        });
    }
}

// Handle form submission
document.getElementById('eventForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const isEdit = formData.get('id');
    const url = isEdit ? '/admin/events/update' : '/admin/events/create';
    
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
        alert('Error saving event');
    });
});
</script>
