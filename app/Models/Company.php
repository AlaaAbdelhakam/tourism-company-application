<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;
    
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
    protected $table = 'company';
    protected $primaryKey = 'id';
    protected $fillable = [
        'company_name',
        'company_code',
        'created_by',
        'updated_by',
       
        'deleted_at',
        'deleted_by',
      
      
    ];

    public $timestamps = true;

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