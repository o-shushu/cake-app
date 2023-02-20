@extends('layouts.app')
@section('content')
    <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl ">
        <h1 class="text-center font-bold text-xl">新規登録</h1>
        <form action="" method="post">
        @csrf
            <div>
                <label for="name" class="font-bold">Name</label>
                <input type="text" name="name" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="email" class="font-bold">Email</label>
                <input type="text" name="email" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="password" class="font-bold">Password</label>
                <input type="text" name="password" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="tel" class="font-bold">Tel</label>
                <input type="text" name="tel" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="residence" class="font-bold">Residence</label>
                <input type="text" name="residence" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <label for="type" class="font-bold">Type</label>
                <input type="text" name="type" class="border border-gray-400 p-2 w-full">
            </div>

            <div>
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                Submit
                </button>
            </div>
        </form>
    </main>
@endsection