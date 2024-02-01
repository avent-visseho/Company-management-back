<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    public const ADMIN_ROLE_ALIAS = "A";
    public const COLLABORATOR_ROLE_ALIAS = "COL";
    public const CLIENT_ROLE_ALIAS = "CLI";
    public const FOURNISSEUR_ADMIN_ROLE_ALIAS = "FOR";
    public const COMMERCIAL_ROLE_ALIAS = "COM";
    public const CONSTRUCTOR_ROLE_ALIAS = "CON";

    public const ROLE_ALIASES = [
        self::ADMIN_ROLE_ALIAS,
        self::CLIENT_ROLE_ALIAS,
        self::COLLABORATOR_ROLE_ALIAS,
        self::FOURNISSEUR_ADMIN_ROLE_ALIAS,
        self::COMMERCIAL_ROLE_ALIAS,
        self::CONSTRUCTOR_ROLE_ALIAS,
    ];

    public const ADMINS_ROLE_ALIASES = [
        self::ADMIN_ROLE_ALIAS,
    ];

    public $table = 'roles';

    protected $fillable = [
        'title',
        'description',
        'alias',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, "permission_role")->withPivot(['is_active']);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('panel.datetime_format'));
    }
}
