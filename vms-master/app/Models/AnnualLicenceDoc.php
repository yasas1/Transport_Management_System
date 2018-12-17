<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnualLicenceDoc extends Model
{
    protected $table = 'annual_licence_doc';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'path'
	];

	public function vehicals()
	{
		return $this->hasMany(\App\Models\Vehical::class);
	}
}
