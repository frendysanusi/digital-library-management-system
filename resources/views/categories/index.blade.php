@extends ('layouts.layout')

@section('content')
    @include('navbar')
    <div class="min-h-screen px-20 mb-20">
        <div class="flex flex-row items-center justify-between pt-40 pb-20">
            <h1 class="text-6xl font-bold">Daftar Kategori Buku</h1>
            @if (Auth::user()->role === 'admin')
                <button type="button" onclick="toggleModal('addCategoryModal')" class="bg-[#005792] text-white text-3xl font-semibold px-4 py-4 rounded-lg h-full">+ Tambah Kategori</button>
            @endif
        </div>
        @if (count($bookCategories) > 0)
            <div class="flex flex-col gap-y-14">
                @foreach ($bookCategories as $bookCategory)
                    <div class="border border-black rounded-2xl">
                        <div class="flex flex-row justify-between p-6">
                            <div class="flex items-center justify-center">
                                <p class="text-4xl font-bold">{{ $bookCategory->name }}</p>
                            </div>
                            @if (Auth::user()->role === 'admin')
                                <div class="flex flex-row items-center justify-between w-1/6">
                                    <div class="w-5/12">
                                        <button type="button" onclick="toggleModal('editCategoryModal{{ $bookCategory->id }}')" class="bg-green-700 hover:bg-green-900 text-white text-2xl font-semibold py-4 rounded-lg w-full">Edit</button>
                                    </div>
                                    <form action="{{ route('categories.destroy', $bookCategory) }}" method="POST" class="w-5/12">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-2xl font-semibold w-full py-4 rounded-lg">Hapus</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @foreach ($bookCategories as $bookCategory)
            @include ('categories.edit', ['bookCategory' => $bookCategory])
        @endforeach
    
    @else
        <div class="h-[30rem] flex items-center justify-center">
            <p class="text-4xl">Tidak ada kategori</p>
        </div>
    @endif

    @include ('categories.create')
@endsection
