<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 02 May 2018 05:05:25 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Driver
 * 
 * @property int $id
 * @property int $title_id
 * @property string $firstname
 * @property string $surname
 * @property string $initials
 * @property string $nic
 * @property string $licence_no
 * @property string $mobile
 * @property \Carbon\Carbon $licence_expire_date
 * 
 * @property \App\Models\Title $title
 * @property \Illuminate\Database\Eloquent\Collection $journeys
 * @property \Illuminate\Database\Eloquent\Collection $reservations
 * @property \Illuminate\Database\Eloquent\Collection $vehicals
 *
 * @package App\Models
 */
class Driver extends Eloquent
{
	protected $table = 'driver';
	public $timestamps = false;

	protected $casts = [
		'title_id' => 'int'
	];

	protected $dates = [
		'licence_expire_date'
	];

	protected $fillable = [
		'title_id',
		'firstname',
		'surname',
		'initials',
		'nic',
		'licence_no',
		'mobile',
		'licence_expire_date',
		'emp_id'
	];

	public function title()
	{
		return $this->belongsTo(\App\Models\Title::class);
	}

	public function journeys()
	{
		return $this->hasMany(\App\Models\Journey::class);
	}

	public function reservations()
	{
		return $this->hasMany(\App\Models\Reservation::class);
	}

	public function vehical()
	{
		return $this->hasOne(\App\Models\Vehical::class);
	}

    public function getFullNameAttribute(){
        return $this->title->name.' '.$this->initials.$this->surname;
	}
	
	public function accidents()
	{
		return $this->hasMany(\App\Models\Accident::class);
	}
}
