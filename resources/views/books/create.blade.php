<div id="addBookModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-neutral-800/70">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-3xl font-semibold">Tambah Buku</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700 text-4xl" onclick="toggleModal('addBookModal')">&times;</button>
            </div>
            <div class="p-6">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-lg font-medium text-gray-700">Judul Buku</label>
                        <input type="text" id="title" name="title" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="category" class="block text-lg font-medium text-gray-700">Kategori</label>
                        <select id="category{{ $book->id }}" name="category_id" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                            <option value="" disabled selected>Pilih Kategori</option>    
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-lg font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" rows="4" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="stock" class="block text-lg font-medium text-gray-700">Jumlah</label>
                        <input type="number" id="stock" name="stock" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="book_file" class="block text-lg font-medium text-gray-700">File Buku (PDF)</label>
                        <input type="file" id="book_file" name="book_file" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" accept=".pdf">
                    </div>
                    <div class="mb-4">
                        <label for="cover_image" class="block text-lg font-medium text-gray-700">Cover Buku (JPEG/JPG/PNG)</label>
                        <input type="file" id="cover_image" name="cover_image" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" accept=".jpg,.jpeg,.png">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-lg mr-2" onclick="toggleModal('addBookModal')">Batal</button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">Tambah Buku</button>
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
