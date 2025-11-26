<div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Add Material Link</h2>
        <p class="text-gray-500 text-sm mt-1">Add a link to study material</p>
    </div>

    <form action="/admin/materials" method="POST" class="space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" id="title" name="title" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                   placeholder="e.g., Data Structures Notes">
        </div>

        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
            <input type="text" id="category" name="category" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                   placeholder="e.g., Computer Science, Mathematics, Physics">
        </div>

        <div>
            <label for="url" class="block text-sm font-medium text-gray-700 mb-2">Material URL</label>
            <input type="url" id="url" name="url" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                   placeholder="https://example.com/material.pdf">
            <p class="mt-1 text-sm text-gray-500">Enter the full URL to the study material</p>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
            <textarea id="description" name="description" rows="3"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                      placeholder="Brief description of the material..."></textarea>
        </div>

        <div class="flex justify-end space-x-3 pt-4">
            <a href="/admin/materials" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 shadow-sm">
                Add Material
            </button>
        </div>
    </form>
</div>
