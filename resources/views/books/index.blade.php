@extends ('layouts.layout')

@section('content')
    @include('navbar')
    <div class="min-h-screen px-20 mb-20">
        <div class="flex flex-row items-center justify-between pt-40 pb-20">
            <h1 class="text-6xl font-bold">Daftar Buku</h1>
            <div class="flex flex-row gap-x-6 items-center h-20">
                <form action="{{ route('books.index') }}" method="GET" id="filterCategory">
                    <div class="form-group bg-[#9bd7ff] text-3xl font-semibold px-4 py-5 rounded-lg">
                        <select class="form-control bg-[#9bd7ff] rounded-lg" name="category_selected" id="category-option" onchange="submitForm()">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option class="bg-white" value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option class="bg-white" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <form action="{{ route('books.export') }}" method="GET">
                    <button type="submit" class="bg-green-700 hover:bg-green-900 text-white text-3xl font-semibold px-10 py-5 rounded-lg h-full">Export</button>
                </form>
                <button type="button" onclick="toggleModal('addBookModal')" class="bg-[#005792] text-white text-3xl font-semibold px-4 py-4 rounded-lg h-full">+ Tambah Buku</button>
            </div>
        </div>
        @if (count($books) > 0)
            <div class="grid grid-cols-5 gap-x-14 gap-y-20">
                @foreach ($books as $book)
                    <div class="h-[50rem] group transition-transform duration-300 transform hover:scale-110 shadow-md hover:shadow-lg">
                        <div onclick="toggleModal('showBookModal{{ $book->id }}')">
                            <div class="h-[36rem] w-full">
                                @php
                                    $coverImagePath = '/storage/' . $book->cover_image;
                                    $blankImagePath = '/images/blank-image.jpg';
                                @endphp
        
                                <Image src="{{ $book->cover_image && Storage::disk('public')->exists($book->cover_image) ? asset($coverImagePath) : asset($blankImagePath) }}" alt="{{ $book->title }}" class="w-full h-full object-cover"/>
                            </div>
                            <div class="flex flex-col h-[8rem] mt-5">
                                <p class="text-4xl font-bold mb-3 line-clamp-2">{{ $book->title }}</p>
                                <p class="text-2xl">{{ $book->category->name }}</p>
                            </div>
                        </div>
                        <!-- <div class="">
                            <button type="button" onclick="toggleModal('showBookModal{{ $book->id }}')" class="bg-blue-600 hover:bg-blue-900 text-white text-2xl font-semibold py-4 rounded-lg w-full">Detail</button>
                        </div> -->
                        <div class="flex flex-row justify-between mt-3 h-[6rem]">
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
            
            @foreach ($books as $book)
                @include('books.edit', ['book' => $book])
            @endforeach

            @foreach ($books as $book)
                @include('books.show', ['book' => $book])
            @endforeach

        @else
            <div class="h-[30rem] flex items-center justify-center">
                <p class="text-4xl">Tidak ada buku</p>
            </div>
        @endif

        @include('books.create')
    </div>
    
    <script>
        function submitForm() {
            document.getElementById('filterCategory').submit();
        }
    </script>
@endsection
