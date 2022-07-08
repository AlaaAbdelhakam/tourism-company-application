<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car;
class CarModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;
    
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
    protected $table = 'car_model';
    protected $fillable = [
        'car_model_name',
        'created_by',
        'updated_by',
       
        'deleted_at',
        'deleted_by',
      
      
    ];

    public $timestamps = true;
 public function cars()
    {
        return $this->hasMany(Car::class);
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