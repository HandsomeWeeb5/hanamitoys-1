<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
	use HasFactory;

	public const UPLOAD_DIR = 'uploads';

	protected $guarded = [
		'id',
		'created_at',
		'updated_at'
	];

	public const SMALL = '300x300';
	public const MEDIUM = '600x600';
	public const LARGE = '900x90';
	public const EXTRA_LARGE = '1200x1200';

	/**
	 * Relationship with the product
	 *
	 * @return array
	 */
	public function product()
	{
		return $this->belongsTo('App\Models\Product');
	}
}
