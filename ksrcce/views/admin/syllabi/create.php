<div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-sm max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Add Syllabus Link</h2>
        <p class="text-gray-500 text-sm mt-1">Add a link to syllabus content</p>
    </div>

    <form action="/admin/syllabi" method="POST" class="space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" id="title" name="title" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="e.g., GATE Computer Science Syllabus 2024">
        </div>

        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
            <input type="text" id="subject" name="subject" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="e.g., Computer Science, Mathematics, Physics">
        </div>

        <div>
            <label for="url" class="block text-sm font-medium text-gray-700 mb-2">Syllabus URL</label>
            <input type="url" id="url" name="url" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="https://example.com/syllabus.pdf">
            <p class="mt-1 text-sm text-gray-500">Enter the full URL to the syllabus document</p>
        </div>

        <div class="flex justify-end space-x-3 pt-4">
            <a href="/admin/syllabi" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 shadow-sm">
                Add Link
            </button>
        </div>
    </form>
</div>
