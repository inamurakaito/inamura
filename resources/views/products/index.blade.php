@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
  <h1 class="text-xl font-semibold mb-4">商品一覧</h1>

{{-- 検索フォーム + 右端に新規登録（ボタンは form の外） --}}
<div class="flex flex-wrap items-end gap-3 mb-4 w-full">
  <form method="GET" action="{{ route('product.index') }}" class="flex flex-wrap items-end gap-3">
    <div>
      <label class="block text-sm text-gray-600">検索キーワード</label>
      <input name="q" value="{{ request('q') }}" class="border rounded px-3 py-2 w-56" placeholder="商品名 or SKU">
    </div>
    <div>
      <label class="block text-sm text-gray-600">メーカー名</label>
      <select name="company_id" class="border rounded px-3 py-2 min-w-40">
        <option value="">すべて</option>
        @foreach($companies as $c)
          <option value="{{ $c->id }}" @selected(request('company_id')==$c->id)>{{ $c->name }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="h-10 px-5 rounded bg-gray-200 hover:bg-gray-300">検索</button>
  </form>

  {{-- ★ここは必ず form の外。狭い画面では下に回る／広い画面では右端へ寄る --}}
<a href="{{ route('product.create') }}"
   style="background:#f59e0b;color:#fff" class="inline-flex items-center h-10 px-5 rounded mt-2 sm:mt-0 sm:ml-auto">
  新規登録
</a>
</div>

  <div class="overflow-x-auto">
    <table class="w-full text-sm border border-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-2 border">ID</th>
          <th class="p-2 border">商品画像</th>
          <th class="p-2 border">商品名</th>
          <th class="p-2 border">価格</th>
          <th class="p-2 border">在庫数</th>
          <th class="p-2 border">メーカー名</th>
          <th class="p-2 border">操作</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $p)
        <tr class="odd:bg-white even:bg-gray-50">
          <td class="p-2 border text-center">{{ $p->id }}</td>
          <td class="p-2 border">
            <div class="w-12 h-12 bg-gray-200 grid place-items-center rounded text-[10px] text-gray-500">NO IMG</div>
          </td>
          <td class="p-2 border"><a href="{{ route('product.show',$p) }}" class="text-blue-700 underline">{{ $p->name }}</a></td>
          <td class="p-2 border text-right tabular-nums">{{ number_format($p->price) }}円</td>
          <td class="p-2 border text-right tabular-nums">{{ $p->stock }}</td>
          <td class="p-2 border">{{ $p->company?->name }}</td>
         <td class="p-2 border whitespace-nowrap">
  <div class="flex gap-2"> {{-- 横並び & ボタン間に余白 --}}
    {{-- 詳細ボタン（スカイブルー） --}}
    <a href="{{ route('product.show',$p) }}"
       class="inline-block px-3 py-1 rounded bg-sky-500 hover:bg-sky-600">
       詳細
    </a>

    {{-- 削除ボタン（赤） --}}
    <form action="{{ route('product.destroy',$p) }}" method="POST" 
          onsubmit="return confirm('削除しますか？');">
      @csrf @method('DELETE')
      <button class="px-3 py-1 rounded bg-red-600 hover:bg-red-700">
        削除
      </button>
    </form>
  </div>
</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4 flex justify-center">{{ $products->links() }}</div>
</div>
@endsection