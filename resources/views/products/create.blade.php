@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
  <h1 class="text-xl font-semibold mb-4">商品 新規登録</h1>

  {{-- バリデーション表示（任意） --}}
  @if ($errors->any())
    <div class="mb-4 text-red-600">
      <ul class="list-disc list-inside">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('product.store') }}" class="space-y-4">
    @csrf

    <div>
      <label class="block text-sm text-gray-600">商品名</label>
      <input name="name" class="border rounded px-3 py-2 w-full" required>
    </div>

    <div>
<label class="block text-sm text-gray-600">メーカー</label>
<select name="company_id" class="border rounded px-3 py-2 w-full" required>
    @foreach($companies as $c)
        <option value="{{ $c->id }}" @selected(old('company_id')==$c->id)>
            {{ $c->name }}
        </option>
    @endforeach
</select>
    </div>

    <div>
      <label class="block text-sm text-gray-600">SKU</label>
      <input name="sku" class="border rounded px-3 py-2 w-full">
    </div>

    <div class="flex gap-4">
      <div class="flex-1">
        <label class="block text-sm text-gray-600">価格</label>
        <input type="number" name="price" value="0" class="border rounded px-3 py-2 w-full" required>
      </div>
      <div class="flex-1">
        <label class="block text-sm text-gray-600">在庫数</label>
        <input type="number" name="stock" value="0" class="border rounded px-3 py-2 w-full" required>
      </div>
    </div>

    <div>
      <label class="block text-sm text-gray-600">状態</label>
      <select name="status" class="border rounded px-3 py-2 w-full">
        <option value="active">販売中</option>
        <option value="draft">下書き</option>
        <option value="archived">アーカイブ</option>
      </select>
    </div>

    <div>
      <label class="block text-sm text-gray-600">コメント</label>
      <textarea name="comment" rows="4" class="border rounded px-3 py-2 w-full"></textarea>
    </div>
<div class="mt-6 flex justify-end gap-3">
    {{-- 戻るボタン（スカイブルー） --}}
    <a href="{{ route('product.index') }}"
       class="inline-flex items-center px-5 py-2 rounded
              bg-sky-500 hover:bg-sky-600 font-semibold">
        戻る
    </a>

    {{-- 登録ボタン（オレンジ） --}}
    <button type="submit"
       class="inline-flex items-center px-5 py-2 rounded
              bg-orange-500 hover:bg-orange-600 font-semibold">
        登録
    </button>
  </form>
</div>
@endsection