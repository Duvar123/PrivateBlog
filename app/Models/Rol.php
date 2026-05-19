<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rols';

    protected $fillable = [
        'name',
    ];

    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'rol_permissions',
            'rol_id',
            'permission_id'
        );
    }
}
