<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    
    //activity logging starts
    use LogsActivity;
    protected static $logAttributes = ['name', 'email'];
    protected static $logName = 'User';
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    //activity logging ends

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    //customize Description of activity logs
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} the user";
    }




    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function purchases()
    {
       return $this->hasMany(Purchase::class);
    }

    // public function territory()
    // {
    //     return $this->belongsTo(Territory::class);
    // }

    // public function warehouses()
    // {
    //     return $this->hasMany(Warehouse::class);
    // }

    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }
}
