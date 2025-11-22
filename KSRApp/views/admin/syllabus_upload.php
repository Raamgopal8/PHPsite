<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-6">Upload Syllabus</h2>
        
        <?php if (isset($_SESSION['flash']['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($_SESSION['flash']['success']) ?>
                <?php unset($_SESSION['flash']['success']) ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['flash']['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($_SESSION['flash']['error']) ?>
                <?php unset($_SESSION['flash']['error']) ?>
            </div>
        <?php endif; ?>

        <div class="mb-6">
            <form action="/admin/syllabus/upload" method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="exam_id" value="<?= htmlspecialchars($examId) ?>">
                
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="syllabus_file">
                        Syllabus File (TXT)
                    </label>
                    <input type="file" name="syllabus_file" id="syllabus_file" 
                           accept=".txt" 
                           class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-gray-600 text-sm mt-1">Upload a text file containing the syllabus</p>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Upload Syllabus
                    </button>
                    
                    <?php if (!empty($syllabus)): ?>
                        <a href="/admin/syllabus/view/<?= htmlspecialchars($examId) ?>" 
                           target="_blank"
                           class="text-blue-500 hover:text-blue-700">
                            View Current Syllabus
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-2">Syllabus Format</h3>
            <div class="bg-gray-100 p-4 rounded-md">
                <pre class="whitespace-pre-wrap">1. Topic One
   - Subtopic 1.1
   - Subtopic 1.2

2. Topic Two
   - Subtopic 2.1
   - Subtopic 2.2

3. Topic Three
   - Subtopic 3.1
   - Subtopic 3.2</pre>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>