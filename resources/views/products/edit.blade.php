@extends('layouts.app')
@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-2xl">
  <h1 class="text-xl font-semibold mb-4">商品 編集</h1>
  <form method="POST" action="{{ route('product.update', $product) }}" class="space-y-4">
    @csrf @method('PUT')
    @include('products.partials.form-fields', ['product'=>$product])
    <div class="flex gap-2">
      <button class="bg-amber-600 text-white px-4 py-2 rounded">更新</button>
      <a href="{{ route('product.index') }}" class="px-4 py-2 border rounded">戻る</a>
    </div>
  </form>
</div>
@endsection