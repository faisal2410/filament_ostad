<?php

namespace App\Models;


use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable=['name','slug','parent_id','is_visible','description'];

    public function parent():BelongsTo
    {
        return $this->belongsTo(Category::class,'parent_id');

    }

    public function child():HasMany
    {

        return $this->hasMany(Category::class,'parent_id');
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }


}
