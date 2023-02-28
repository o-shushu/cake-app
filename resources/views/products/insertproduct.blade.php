@extends('layouts.app')
@section('content')
<content>
<!-- 商品一覧 -->
            <div class="w-2/3 m-auto pt-20">
                <h2 class="pb-10">商品新規</h2>
                <form method="POST" action="{{ route('upload.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image">
                    <button>アップロード</button>
                </form>
            </div>


    </content>
    
    <footer class="bg-yellow-300 ">

    </footer>
@endsection