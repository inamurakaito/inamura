@php
  $statuses = ['draft'=>'下書き','active'=>'販売中','archived'=>'アーカイブ'];
@endphp

<div>
  <label class="block text-sm text-gray-600">商品名</label>
  <input name="name" value="{{ old('name', $product->name ?? '') }}" class="border rounded px-3 py-2 w-full">
  @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
  <div>
    <label class="block text-sm text-gray-600">メーカー</label>
    <select name="company_id" class="border rounded px-3 py-2 w-full">
      <option value="">選択してください</option>
      @foreach ($companies as $c)
        <option value="{{ $c->id }}" @selected(old('company_id', $product->company_id ?? '') == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
    @error('company_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
  </div>

  <div>
    <label class="block text-sm text-gray-600">SKU</label>
    <input name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="border rounded px-3 py-2 w-full">
    @error('sku')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
  </div>

  <div>
    <label class="block text-sm text-gray-600">価格</label>
    <input type="number" min="0" name="price" value="{{ old('price', $product->price ?? 0) }}" class="border rounded px-3 py-2 w-full">
    @error('price')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
  </div>

  <div>
    <label class="block text-sm text-gray-600">在庫数</label>
    <input type="number" min="0" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="border rounded px-3 py-2 w-full">
    @error('stock')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
  </div>

  <div>
    <label class="block text-sm text-gray-600">状態</label>
    <select name="status" class="border rounded px-3 py-2 w-full">
      @foreach ($statuses as $k => $label)
        <option value="{{ $k }}" @selected(old('status', $product->status ?? 'active') === $k)>{{ $label }}</option>
      @endforeach
    </select>
    @error('status')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
  </div>
</div>

<div>
  <label class="block text-sm text-gray-600">コメント</label>
  <textarea name="description" rows="4" class="border rounded px-3 py-2 w-full">{{ old('description', $product->description ?? '') }}</textarea>
  @error('description')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
</div>