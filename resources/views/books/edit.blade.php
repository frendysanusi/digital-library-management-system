<div id="editBookModal{{ $book->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto bg-neutral-800/70">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-3xl font-semibold">Edit Buku</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700 text-4xl" onclick="toggleModal('editBookModal{{ $book->id }}')">&times;</button>
            </div>
            <div class="p-6">
                <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="title{{ $book->id }}" class="block text-lg font-medium text-gray-700">Judul Buku</label>
                        <input type="text" id="title{{ $book->id }}" name="title" value="{{ $book->title }}" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="category{{ $book->id }}" class="block text-lg font-medium text-gray-700">Kategori</label>
                        <select id="category{{ $book->id }}" name="category_id" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="description{{ $book->id }}" class="block text-lg font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description{{ $book->id }}" name="description" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" rows="4" required>{{ $book->description }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="stock{{ $book->id }}" class="block text-lg font-medium text-gray-700">Jumlah</label>
                        <input type="number" id="stock{{ $book->id }}" name="stock" value="{{ $book->stock }}" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="book_file{{ $book->id }}" class="block text-lg font-medium text-gray-700">File Buku (PDF)</label>
                        <input type="file" id="book_file{{ $book->id }}" name="book_file" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" accept=".pdf">
                    </div>
                    <div class="mb-4">
                        <label for="cover_image{{ $book->id }}" class="block text-lg font-medium text-gray-700">Cover Buku (JPEG/JPG/PNG)</label>
                        <input type="file" id="cover_image{{ $book->id }}" name="cover_image" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" accept=".jpg,.jpeg,.png">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-lg mr-2" onclick="toggleModal('editBookModal{{ $book->id }}')">Batal</button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">Edit Buku</button>
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
