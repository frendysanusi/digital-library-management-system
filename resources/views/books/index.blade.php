@extends ('layouts.layout')

@section('content')
    @include('navbar')
    <div class="min-h-screen px-20 mb-20">
        <div class="flex flex-row items-center justify-between pt-40 pb-20">
            <h1 class="text-6xl font-bold">Daftar Buku</h1>
            <button type="button" onclick="toggleModal('addBookModal')" class="bg-[#005792] hover:bg-[#005792] text-white text-3xl font-semibold px-4 py-4 rounded-lg ">+ Tambah Buku</button>
        </div>
        <div class="grid grid-cols-6 gap-x-14 gap-y-20">
            @foreach ($books as $book)
                <div>
                    <div class="h-[32rem] w-full">
                        <Image src="/images/dummy.png" alt="" class="w-full h-full object-cover" />
                    </div>
                    <div class="flex flex-col h-[8rem] mt-5">
                        <p class="text-4xl font-bold mb-3">{{ $book->title }}</p>
                        <p class="text-2xl">{{ $book->category }}</p>
                    </div>
                    <div class="flex flex-row justify-around mt-3">
                        <button type="button" onclick="toggleModal('editBookModal')" class="bg-green-700 hover:bg-green-900 text-white text-2xl font-semibold py-4 rounded-lg w-5/12">Edit</button>
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
    @include('books.edit')
@endsection