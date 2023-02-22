<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrodecompras extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'shopping_cart';

	protected $fillable = [
		'product_id',
		'category_id',
		'user_id',
		'price',
		'quantity'
	];

    public function Product()
	{
		return $this->belongsTo(Product::class, 'product_id', 'id');
	}

	public function Category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	public function User()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
}
