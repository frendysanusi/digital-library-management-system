@extends ('layouts.layout')

@section('content')
    @include('navbar')
    <div class="min-h-screen px-20 mb-20">
        <div class="flex flex-row items-center justify-between pt-40 pb-20">
            <h1 class="text-6xl font-bold">Daftar Buku</h1>
            <div class="flex flex-row gap-x-6 items-center h-20">
                <form action="{{ route('books.index') }}" method="GET" id="filterCategory" class="mt-6 h-full">
                    <div class="form-group bg-[#9bd7ff] text-3xl font-semibold px-4 py-4 rounded-lg">
                        <select class="form-control bg-[#9bd7ff] rounded-lg" name="category_selected" id="category-option" onchange="submitForm()">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option class="bg-white" value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option class="bg-white" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <button type="button" onclick="toggleModal('addBookModal')" class="bg-[#005792] text-white text-3xl font-semibold px-4 py-4 rounded-lg h-full">+ Tambah Buku</button>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-x-14 gap-y-20">
            @foreach ($books as $book)
                <div class="h-[46rem]">
                    <div class="h-[32rem] w-full">
                        @php
                            $coverImagePath = '/storage/' . $book->cover_image;
                            $blankImagePath = '/images/blank-image.jpg';
                        @endphp

                        <Image src="{{ $book->cover_image && Storage::disk('public')->exists($book->cover_image) ? asset($coverImagePath) : asset($blankImagePath) }}" alt="{{ $book->title }}" class="w-full h-full object-cover"/>
                    </div>
                    <div class="flex flex-col h-[8rem] mt-5">
                        <p class="text-4xl font-bold mb-3">{{ $book->title }}</p>
                        <p class="text-2xl">{{ $book->category->name }}</p>
                    </div>
                    <div class="flex flex-row justify-around mt-3 h-[6rem]">
                        <div class="w-5/12">
                            <button type="button" onclick="toggleModal('editBookModal{{ $book->id }}')" class="bg-green-700 hover:bg-green-900 text-white text-2xl font-semibold py-4 rounded-lg w-full">Edit</button>
                        </div>
                        <form action="{{ route('books.destroy', $book) }}" method="post" class="w-5/12">
                            @csrf
                            @method('delete')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-2xl font-semibold w-full py-4 rounded-lg">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('books.create')
    @foreach ($books as $book)
        @include('books.edit', ['book' => $book])
    @endforeach
@endsection

<script>
    function submitForm() {
        document.getElementById('filterCategory').submit();
    }
</script>