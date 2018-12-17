<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AnnualLicence
 * 
 * @property int $id
 * @property int $vehical_id
 * @property \Carbon\Carbon $from
 * @property \Carbon\Carbon $to
 * @property \Carbon\Carbon $licence_date
 * @property string $licence_no
 * @property float $ammount
 * 
 * @property \App\Models\Vehical $vehical
 *
 * @package App\Models
 */
class AnnualLicence extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
		'ammount' => 'float'
	];

	protected $dates = [
		'from',
		'to',
		'licence_date'
	];

	protected $fillable = [
		'vehical_id',
		'from',
		'to',
		'licensing_authority',
		'licence_date',
		'licence_no',
		'ammount',
		'emission_test_details',
		'annual_licence_doc_id'
	];

	public function annualLicenceDoc()
	{
		return $this->belongsTo(\App\Models\AnnualLicenceDoc::class);
	}
}
