<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmissionTestDoc extends Model
{
    protected $table = 'emission_test_doc';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'path'
	];

	public function annualLicences()
	{
		return $this->hasOne(\App\Models\AnnualLicence::class,'emission_test_doc_id');
	}
}
