<header class="bg-[#F5F5F5] h-28 w-full fixed shadow-lg">
    <nav class="flex justify-between items-center h-full">
        <div class="flex flex-row justify-between w-full font-semibold text-3xl px-10">
            <ul class="flex flex-row items-center gap-20">
                <li>
                    <a class="hover:opacity-70" href="/books">Katalog Buku</a>
                </li>
                <li>
                    <a class="hover:opacity-70" href="/categories">Kategori</a>            
                </li>
            </ul>
            <form action="{{ route('auth.logout') }}" method="post">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-2xl font-semibold w-full px-12 py-4 rounded-lg">LOGOUT</button>
            </form>
        </div>
    </nav>
</header>