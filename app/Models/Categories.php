<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
	use HasFactory;

	protected $table = 'categories';
	protected $fillable = ['name', 'slug', 'parent_id'];
	protected $primaryKey = 'id';

	public function childs()
	{
		return $this->hasMany('App\Models\Categories', 'parent_id');
	}

	public function parent()
	{
		return $this->belongsTo('App\Models\Categories', 'parent_id');
	}

	public function products()
	{
		return $this->belongsToMany('App\Models\Product', 'product_categories');
	}
}
