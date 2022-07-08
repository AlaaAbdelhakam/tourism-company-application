<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarModel;
use App\Models\Trip;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;
    
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
    protected $table = 'cars';
    protected $primaryKey = 'id';
    protected $fillable = [
        'capacity',
        'plate_no',
        'car_code',
        'expected_amount_of_solar_for_100Km',
        'car_model_id',
        'created_by',
        'updated_by',
       
        'deleted_at',
        'deleted_by',
      
    ];
    
    public $timestamps = true;

    public function carmodels()
    {
        return $this->belongsTo(CarModel::class);
    }
    
     public function scopegetCarModel() {
        return CarModel::where('id', $this->car_model_id)->first()->car_model_name;
    }
    public function trips()
    {
        return $this->hasMany(Trip::class);
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