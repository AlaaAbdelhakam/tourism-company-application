<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Post;
use App\Models\City;
use App\Models\UserTeam;
use Hash;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Trip;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
    protected $table = 'users';
    protected $primaryKey = 'id';
    // protected $guarded = [];

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'city_id',
        'last_login_at',
        'last_login_ip',
        'created_by',
        'updated_by',
       
        'deleted_at',
        'deleted_by',
    ];
    public $timestamps = true;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'team_id' => 'array',
    ];
  
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
    }
    public function cities()
    {
        return $this->belongsTo(City::class);
    }

    public function scopegetcityname() {
        return City::where('id', $this->city_id)->first()->city_name;
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