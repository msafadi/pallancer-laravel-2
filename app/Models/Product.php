<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $perPage = 10;

    protected $fillable = [
        'name', 'category_id', 'description', 'price', 'sale_price', 'quantity',
        'image', 'status', 'slug', 'store_id',
    ];

    //protected $guarded = [];

    /*protected $with = [
        'category', 'store'
    ];*/

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id',
        );
    }

    public static function validateRules()
    {
        return [
            'name' => 'required|string|max:255|min:3',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image',
            'price' => 'numeric|min:0',
            'sale_price' => ['numeric', 'min:0', function($attr, $value, $fail) {
                    $price = request()->input('price');
                    if ($value >= $price) {
                        $fail($attr . ' must be less than regular price');
                    }
                },
            ]
        ];
    }
}
