@extends('layouts.app')
@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-xl">
  <h1 class="text-xl font-semibold mb-4">商品 詳細</h1>
  <dl class="divide-y">
    <div class="py-2 flex"><dt class="w-32 text-gray-500">ID</dt><dd>{{ $product->id }}</dd></div>
    <div class="py-2 flex"><dt class="w-32 text-gray-500">商品名</dt><dd>{{ $product->name }}</dd></div>
    <div class="py-2 flex"><dt class="w-32 text-gray-500">SKU</dt><dd>{{ $product->sku }}</dd></div>
    <div class="py-2 flex"><dt class="w-32 text-gray-500">価格</dt><dd>{{ number_format($product->price) }}円</dd></div>
    <div class="py-2 flex"><dt class="w-32 text-gray-500">在庫</dt><dd>{{ $product->stock }}</dd></div>
    <div class="py-2 flex"><dt class="w-32 text-gray-500">メーカー</dt><dd>{{ $product->company?->name }}</dd></div>
    <div class="py-2 flex"><dt class="w-32 text-gray-500">状態</dt><dd>{{ ['draft'=>'下書き','active'=>'販売中','archived'=>'アーカイブ'][$product->status] }}</dd></div>
    <div class="py-2"><dt class="text-gray-500">コメント</dt><dd class="whitespace-pre-wrap">{{ $product->description }}</dd></div>
  </dl>
  <div class="mt-4 flex gap-2">
    <a href="{{ route('product.edit',$product) }}" class="bg-amber-500 text-white px-4 py-2 rounded">編集</a>
    <a href="{{ route('product.index') }}" class="px-4 py-2 border rounded">戻る</a>
  </div>
</div>
@endsection