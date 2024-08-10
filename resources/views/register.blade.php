@extends ('layouts.layout')

@section('content')
<div class="h-screen bg-white mx-auto flex flex-row font-['Poppins'] ">
    <div class="flex w-full flex-col items-center justify-center">
        <div class="font-semibold items-center w-full px-40">
            <h1 class="text-black text-4xl font-semibold mt-10 text-center">Hello, Welcome!</h1>
            <h1 class="text-[#005792] text-3xl font-bold mt-10 text-center">Register</h1>
        
            <form action="{{ route('auth.store') }}" method="post" class="mt-16">
                @csrf
                <div>
                    <label for="" class=""></label>
                        <span class="flex font-semibold text-neutral-700 text-xl">Email</span>
                        <input type="text" name="email" placeholder="Enter your e-mail" class="px-4 py-5 w-full text-xl text-start placeholder-gray-500 my-2 bg-neutral-100 rounded-md border-gray-400" required>
                </div>
                <div class="mt-5">
                    <label for="" class=""></label>
                        <span class="flex font-semibold text-neutral-700 text-xl">Username</span>
                        <input type="text" name="username" placeholder="Enter your username" class="px-4 py-5 w-full text-xl text-start placeholder-gray-500 my-2 bg-neutral-100 rounded-md border-gray-400" required>
                </div>
                <div class="mt-5">
                    <label for="" class=""></label>
                        <span class="flex font-semibold text-neutral-700 text-xl">Name</span>
                        <input type="text" name="name" placeholder="Enter your name" class="px-4 py-5 w-full text-xl text-start placeholder-gray-500 my-2 bg-neutral-100 rounded-md border-gray-400" required>
                </div>
                <div class="mt-5">
                    <label for="" class=""></label>
                        <span class="flex font-semibold text-neutral-700 text-xl">Password</span>
                        <input type="password" name="password" placeholder="Enter your password" class="px-4 py-5 w-full text-xl justify text-start placeholder-gray-500 my-2 bg-neutral-100 rounded-md border-gray-400" required>
                </div>
                <div class="mt-5">
                    <label for="" class=""></label>
                        <span class="flex font-semibold text-neutral-700 text-xl">Confirm Password</span>
                        <input type="password" name="confirm_password" placeholder="Enter your password back" class="px-4 py-5 w-full text-xl justify text-start placeholder-gray-500 my-2 bg-neutral-100 rounded-md border-gray-400" required>
                </div>
                <div class="mt-20">
                    <button type="submit" class="bg-[#005792] hover:bg-[#005792] text-white text-2xl font-semibold w-full py-4 rounded-lg ">Register</button>
                </div>
                <div class="mt-10">
                    <p class="text-xl text-center">Sudah memiliki akun?
                        <a href="/login" class="text-[#005792] font-semibold underline">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <div class="flex h-full bg-[#005792] w-full rounded-l-xl">
        <img src="/images/login.png" alt="">
    </div>
</div>
@endsection
