<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManPower extends Model
{
    protected $fillable = ['nama', 'lengkap', 'jabatan', 'no_telepon'];
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'man_power_task');
    }

}
