<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 02 May 2018 05:03:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Vehical
 * 
 * @property int $id
 * @property string $name
 * @property int $photo_id
 * @property string $registration_no
 * @property string $dept_no
 * @property \Carbon\Carbon $date_of_registration
 * @property string $make_and_type
 * @property string $chassis_no
 * @property string $engine_no
 * @property string $type_of_body
 * @property int $no_of_cylinders
 * @property float $horse_power
 * @property float $pay_load
 * @property string $bore
 * @property string $stroke
 * @property string $carburettor_make_and_type
 * @property string $sizes_of_jets_main
 * @property string $sizes_of_jets_compensation
 * @property string $sizes_of_jets_choke
 * @property string $fuel_injection_pump_make_and_make
 * @property string $fuel_injection_pump_makers_no
 * @property string $atomisers_make
 * @property string $coil_or_magneto_make
 * @property string $coil_or_magneto_makers_no
 * @property string $coil_or_magneto_type
 * @property string $coil_or_magneto_rotation
 * @property string $lighting_set_make
 * @property string $lighting_set_type
 * @property float $lighting_set_voltage
 * @property string $tyres_size_front
 * @property string $tyres_size_rear
 * @property string $tyres_pressure_front
 * @property string $tyres_pressure_rear
 * @property string $battery_dimensions
 * @property float $bettery_voltage
 * @property float $battery_amperage
 * @property float $capacity_of_fuel_tank
 * @property float $capacity_of_reserve_tank
 * @property string $engine_crank_case
 * @property string $gear_box
 * @property string $rear_axel
 * @property string $oil_specifications_engine
 * @property string $oil_specifications_gear_oil
 * @property string $oil_specifications_shock_absorber_fluid
 * @property string $oil_specifications_differential_oil
 * @property float $perchase_price
 * @property \Carbon\Carbon $date_of_perchase
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property string $create_approved_by
 * @property string $update_approved_by
 * @property int $id_card_id
 * @property int $reg_book_id
 * @property int $driver_id
 * 
 * @property \App\Models\Driver $driver
 * @property \App\Models\IdCard $id_card
 * @property \App\Models\Photo $photo
 * @property \App\Models\RegBook $reg_book
 * @property \Illuminate\Database\Eloquent\Collection $accidents
 * @property \Illuminate\Database\Eloquent\Collection $annual_licences
 * @property \Illuminate\Database\Eloquent\Collection $custody_changes
 * @property \Illuminate\Database\Eloquent\Collection $documents
 * @property \Illuminate\Database\Eloquent\Collection $driver_changes
 * @property \Illuminate\Database\Eloquent\Collection $fuel_consumptions
 * @property \Illuminate\Database\Eloquent\Collection $journeys
 * @property \Illuminate\Database\Eloquent\Collection $ownership_transfers
 * @property \Illuminate\Database\Eloquent\Collection $parts_replacement_or_repaires
 * @property \Illuminate\Database\Eloquent\Collection $repaires
 * @property \Illuminate\Database\Eloquent\Collection $reservations
 * @property \Illuminate\Database\Eloquent\Collection $services
 * @property \Illuminate\Database\Eloquent\Collection $tyre_position_changes
 * @property \Illuminate\Database\Eloquent\Collection $tyre_replaces
 *
 * @package App\Models
 */
class Vehical extends Eloquent
{
	protected $table = 'vehical';

	protected $casts = [
		'photo_id' => 'int',
		'no_of_cylinders' => 'int',
		'horse_power' => 'float',
		'pay_load' => 'float',
		'lighting_set_voltage' => 'float',
		'bettery_voltage' => 'float',
		'battery_amperage' => 'float',
		'capacity_of_fuel_tank' => 'float',
		'capacity_of_reserve_tank' => 'float',
		'perchase_price' => 'float',
		'id_card_id' => 'int',
		'reg_book_id' => 'int',
		'driver_id' => 'int'
	];

	protected $dates = [
		'date_of_registration',
		'date_of_perchase'
	];

	protected $fillable = [
		'name',
		'photo_id',
		'registration_no',
		'dept_no',
		'date_of_registration',
		'make_and_type',
		'chassis_no',
		'engine_no',
		'type_of_body',
		'no_of_cylinders',
		'horse_power',
		'pay_load',
		'bore',
		'stroke',
		'carburettor_make_and_type',
		'sizes_of_jets_main',
		'sizes_of_jets_compensation',
		'sizes_of_jets_choke',
		'fuel_injection_pump_make_and_make',
		'fuel_injection_pump_makers_no',
		'atomisers_make',
		'coil_or_magneto_make',
		'coil_or_magneto_makers_no',
		'coil_or_magneto_type',
		'coil_or_magneto_rotation',
		'lighting_set_make',
		'lighting_set_type',
		'lighting_set_voltage',
		'tyres_size_front',
		'tyres_size_rear',
		'tyres_pressure_front',
		'tyres_pressure_rear',
		'battery_dimensions',
		'bettery_voltage',
		'battery_amperage',
		'capacity_of_fuel_tank',
		'capacity_of_reserve_tank',
		'engine_crank_case',
		'gear_box',
		'rear_axel',
		'oil_specifications_engine',
		'oil_specifications_gear_oil',
		'oil_specifications_shock_absorber_fluid',
		'oil_specifications_differential_oil',
		'perchase_price',
		'date_of_perchase',
		'created_by',
		'updated_by',
		'create_approved_by',
		'update_approved_by',
		'id_card_id',
		'reg_book_id',
		'driver_id',
		'journey_color'
	];

	public function driver()
	{
		return $this->belongsTo(\App\Models\Driver::class);
	}

	public function id_card()
	{
		return $this->belongsTo(\App\Models\IdCard::class);
	}

	public function photo()
	{
		return $this->belongsTo(\App\Models\Photo::class);
	}

	public function reg_book()
	{
		return $this->belongsTo(\App\Models\RegBook::class);
	}

	public function accidents()
	{
		return $this->hasMany(\App\Models\Accident::class);
	}

	public function annual_licences()
	{
		return $this->hasMany(\App\Models\AnnualLicence::class);
	}

	public function custody_changes()
	{
		return $this->hasMany(\App\Models\CustodyChange::class);
	}

	public function documents()
	{
		return $this->hasMany(\App\Models\Document::class);
	}

	public function driver_changes()
	{
		return $this->hasMany(\App\Models\DriverChange::class);
	}

	public function fuel_consumptions()
	{
		return $this->hasMany(\App\Models\FuelConsumption::class);
	}

	public function journeys()
	{
		return $this->hasMany(\App\Models\Journey::class);
	}

	public function ownership_transfers()
	{
		return $this->hasMany(\App\Models\OwnershipTransfer::class);
	}

	public function parts_replacement_or_repaires()
	{
		return $this->hasMany(\App\Models\PartsReplacementOrRepaire::class);
	}

	public function repaires()
	{
		return $this->hasMany(\App\Models\Repaire::class);
	}

	public function reservations()
	{
		return $this->hasMany(\App\Models\Reservation::class);
	}

	public function services()
	{
		return $this->hasMany(\App\Models\Service::class);
	}

	public function vehicleMileage()
	{
		return $this->hasMany(\App\Models\VehicleMileage::class);
	}

	public function tyre_position_changes()
	{
		return $this->hasMany(\App\Models\TyrePositionChange::class);
	}

	public function tyre_replaces()
	{
		return $this->hasMany(\App\Models\TyreReplace::class);
	}

    public function getFullNameAttribute(){
        return $this->registration_no.' ( '.$this->name.' ) ';
    }
}
