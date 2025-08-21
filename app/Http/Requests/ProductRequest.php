<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool { return true; }

public function rules(): array
{
    return [
        'name'       => ['required','string','max:255'],
        'company_id' => ['required','integer','exists:companies,id'], // ★これ
        'sku'        => ['nullable','string','max:50'],
        'price'      => ['required','integer','min:0'],
        'stock'      => ['required','integer','min:0'],
        'status'     => ['required','in:active,draft,archived'],
        'comment'    => ['nullable','string'],
    ];
}
}
