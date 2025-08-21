<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * 一覧 + 検索/フィルタ/並び替え
     */
    public function index(Request $request): View
    {
        $q         = $request->string('q')->toString();
        $companyId = $request->input('company_id');           // メーカー
        $status    = $request->input('status');               // draft/active/archived
        $sort      = $request->input('sort');                 // price_asc/price_desc/stock_desc

        $products = Product::query()
            ->with('company')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('name', 'like', "%{$q}%")
                      ->orWhere('sku', 'like', "%{$q}%");
                });
            })
            ->when($companyId, fn ($q2) => $q2->where('company_id', $companyId))
            ->when($status,    fn ($q2) => $q2->where('status', $status))
            ->when($sort === 'price_asc',  fn ($q2) => $q2->orderBy('price', 'asc'))
            ->when($sort === 'price_desc', fn ($q2) => $q2->orderBy('price', 'desc'))
            ->when($sort === 'stock_desc', fn ($q2) => $q2->orderBy('stock', 'desc'))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $companies = Company::orderBy('name')->get(['id', 'name']);

        return view('products.index', compact('products', 'companies', 'q', 'companyId', 'status', 'sort'));
    }

    /**
     * 新規作成フォーム
     */
    public function create(): View
    {
        $statuses  = ['draft' => '下書き', 'active' => '販売中', 'archived' => 'アーカイブ'];
        $companies = Company::orderBy('name')->get(['id', 'name']);

        return view('products.create', compact('statuses', 'companies'));
    }

    /**
     * 登録処理
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        Product::create($request->validated());
        return to_route('product.index')->with('success', '商品を登録しました。');
    }

    /**
     * 詳細
     */
    public function show(Product $product): View
    {
        $product->load('company');
        return view('products.show', compact('product'));
    }

    /**
     * 編集フォーム
     */
    public function edit(Product $product): View
    {
        $statuses  = ['draft' => '下書き', 'active' => '販売中', 'archived' => 'アーカイブ'];
        $companies = Company::orderBy('name')->get(['id', 'name']);

        return view('products.edit', compact('product', 'statuses', 'companies'));
    }

    /**
     * 更新処理
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());
        return to_route('product.index')->with('success', '商品を更新しました。');
    }

    /**
     * 削除（ソフトデリート）
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return back()->with('success', '商品を削除しました。');
    }
}
