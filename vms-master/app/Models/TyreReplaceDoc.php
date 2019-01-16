<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TyreReplaceDoc extends Model
{
    protected $table = 'tyre_replaces_doc';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'path'
	];

	public function tyreReplace()
	{
		return $this->hasOne(\App\Models\TyreReplace::class,'tyre_replace_doc_id');
	}
}
