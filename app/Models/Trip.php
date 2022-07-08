<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

use App\Models\City;
use App\Models\Car;
use App\Models\Driver;
use App\Models\Codriver;
use App\Models\User;
use App\Models\Company;
class Trip extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;
    
    protected $softDelete = true;
    protected $table = 'trip';
    protected $primaryKey = 'id';
    protected $dates = ['Date_of_trip','deleted_at'];
    protected $fillable = [
        'city_id',
        'car_id',
        'driver_id',
        'co_driver_id',
        'company_id',
        'user_id',
        'route_name',
        'work_code',
        'Km_start',
        'km_end',
        'total_distance',
        'Date_of_trip',
        'time_out',
        'time_in',
        'total_time',
        'created_by',
        'updated_by',
       
        'deleted_at',
        'deleted_by',

      
    ];
  
    protected $appends = [
        // 'total_time',
        'total_distance',
        'user_id',
    ];

    public function getusernameAttribute()
    {
        return $this->attributes['user_id'] = auth()->user()->id;

    }
    public function scopegetusername() {
        return User::where('id', $this->user_id)->first()->name;
    }
   
 
    public function gettotaldistanceAttribute()
    {
        return $this->attributes['total_distance'] = ($this->km_end - $this->Km_start);
    }

    
    
    public $timestamps = true;

    public function cities()
    {
        return $this->belongsTo(City::class,'city_id');
    }
    
     public function scopegetcityname() {
        return City::where('id', $this->city_id)->first()->city_name;
    }
    
    public function cars()
    {
        return $this->belongsTo(Car::class,'car_id');
    }
    
     public function scopegetCardata() {
        return Car::where('id', $this->car_id)->first()->car_code;
    }
    public function drivers()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }
    
     public function scopegetdrivername() {
        return Driver::where('id', $this->driver_id)->first()->driver_name;
    }
    public function codrivers()
    {
        return $this->belongsTo(Codriver::class,'co_driver_id');
    }
    
     public function scopegetCodrivername() {
        return Codriver::where('id', $this->co_driver_id)->first()->co_driver_name;
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
     public function scopegetCarModel() {
        return User::where('id', $this->user_id)->first()->name;
    }
    public function companies()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    
     public function scopegetCompanyname() {
        return Company::where('id', $this->company_id)->first()->company_name;
    }
    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            $model->updated_by = NULL;
        });

        static::updating(function ($model) {
            $model->updated_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
        });
    }

    
}