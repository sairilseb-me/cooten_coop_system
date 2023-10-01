<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'profile_pic', 'date_of_birth', 'role_id', 'office_id', 'address', 'contact_number', 'email', 'password',
    ];

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

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        if (is_null($this->last_name)) {
            return "{$this->name}";
        }

        return "{$this->name} {$this->last_name}";
    }

    /**
     * Set the user's password.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function office()
    {
        return $this->hasOne(Office::class, 'id', 'user_id');
    }

    public function loan()
    {
        return $this->hasMany(Loan::class, 'id', 'applicant_id');
    }

    public function isAdmin()
    {
        if($this->role_id == 1) return true;
        
        return false;
    }

    public function isSecretary()
    {
        if($this->role_id == 2) return true;

        return false;
    }

    public function isAuditor()
    {
        if($this->role_id == 6) return true;

        return false;
    }

    public function isTreasurer()
    {
        if($this->role_id == 8) return true;

        return false;
    }

    public function isMember()
    {
        if($this->role_id == 12) return true;

        return false;
    }

    public function updateUser(Array $data)
    {
        $this->name = $data['name'];
        $this->last_name = $data['last_name'];
        $this->role_id = (int)$data['role'];
        $this->address = $data['address'];
        $this->contact_number = $data['contact_number'];
        $this->email = $data['email'];
        $this->update();
    }

}
