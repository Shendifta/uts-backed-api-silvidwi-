<?php

namespace App\Models;

use App\Http\Controllers\Api\Categories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class products extends Model
{
    use HasFactory;

    protected $table = 'products';
    //field/kolom yang berada pada tabel products di databes
    use HasFactory;
    protected $fillable = [
        'category_id',
        'product',
        'description',
        'price',
        'stock',
        'image',
    ];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }
}
