<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Role;
use App\Subscription;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'roles_users');
    }

    public function hasRole($slug)
    {
        foreach ($this->roles as $role) {
            if ($role->slug == $slug) return true;
        }

        return false;
    }

    public function subscriptions()
    {
        return $this->belongsToMany('App\Notification', 'notification_subscriptions', 'notification_id', 'user_id');
    }

    public function hasSubscription($id)
    {
        foreach ($this->subscriptions as $sub) {
            if ($sub->id === $id) return true;
        }

        return false;
    }

    public function entries()
    {
        return $this->hasMany('App\Entry', 'user_id');
    }
    
    public function hasCompletedGoalsForToday()
    {
        $entries = $this->entries()->where('completed_on', '=', Carbon::today()->toDateString())->get();

        if (Goal::all()->count() > $entries->count()) return false;

        return true;
    }
}
