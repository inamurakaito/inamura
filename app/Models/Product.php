<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function company()
{
    return $this->belongsTo(\App\Models\Company::class);
}

    protected $fillable = ['name','company_id','sku','price','stock','status','description'];

    public function scopeSearch($q, ?string $term)
    {
        if ($term !== null && $term !== '') {
            $q->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('sku', 'like', "%{$term}%");
            });
        }
    }

    public function scopeSort($q, ?string $sort)
    {
        return match ($sort) {
            'price_asc'  => $q->orderBy('price', 'asc'),
            'price_desc' => $q->orderBy('price', 'desc'),
            'stock_desc' => $q->orderBy('stock', 'desc'),
            default      => $q->orderBy('id', 'desc'),
        };
    }
}
