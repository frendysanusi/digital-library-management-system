<div id="addCategoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-neutral-800/70">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-3xl font-semibold">Tambah Kategori</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700 text-4xl" onclick="toggleModal('addCategoryModal')">&times;</button>
            </div>
            <div class="p-6">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-lg font-medium text-gray-700">Nama Kategori</label>
                        <input type="text" id="name" name="name" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-lg mr-2" onclick="toggleModal('addCategoryModal')">Batal</button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">Tambah Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
    }
</script>
