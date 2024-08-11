<div id="showBookModal{{ $book->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto bg-neutral-800/70">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-3xl font-semibold">Detail Buku</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700 text-4xl" onclick="toggleModal('showBookModal{{ $book->id }}')">&times;</button>
            </div>
            <div class="p-6">
                <form action="{{ route('books.show', $book) }}" method="GET" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="title{{ $book->id }}" class="block text-lg font-medium text-gray-700">Judul Buku</label>
                        <input type="text" id="title{{ $book->id }}" name="title" value="{{ $book->title }}" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" disabled>
                    </div>
                    <div class="mb-4">
                        <label for="category{{ $book->id }}" class="block text-lg font-medium text-gray-700">Kategori</label>
                        <select id="category{{ $book->id }}" name="category_id" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" disabled>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="description{{ $book->id }}" class="block text-lg font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description{{ $book->id }}" name="description" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" rows="4" disabled>{{ $book->description }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="stock{{ $book->id }}" class="block text-lg font-medium text-gray-700">Jumlah</label>
                        <input type="number" id="stock{{ $book->id }}" name="stock" value="{{ $book->stock }}" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" disabled>
                    </div>
                    <div class="mb-4">
                        <label for="book_file{{ $book->id }}" class="block text-lg font-medium text-gray-700 mb-4">File Buku (PDF)</label>
                        @if ($book->book_file)
                            <a href="{{ asset('storage/' . $book->book_file) }}" download="{{ $book->title }}.pdf" class="p-2 border border-gray-300 rounded-lg w-full">
                                Download File Buku
                            </a>
                        @else
                            <span class="p-2 border border-gray-300 rounded-lg w-full">
                                Tidak ada file buku
                            </span>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label for="cover_image{{ $book->id }}" class="block text-lg font-medium text-gray-700 mb-4">Cover Buku (JPEG/JPG/PNG)</label>
                        @if ($book->cover_image)
                            <a href="{{ asset('storage/' . $book->cover_image) }}" download="{{ $book->title }}.jpg" class="p-2 border border-gray-300 rounded-lg w-full">
                                Download Cover Buku
                            </a>
                        @else
                            <span class="p-2 border border-gray-300 rounded-lg w-full">
                                Tidak ada cover buku
                            </span>
                        @endif
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-lg mr-2" onclick="toggleModal('showBookModal{{ $book->id }}')">Batal</button>
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
