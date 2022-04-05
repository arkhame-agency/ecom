<?php

namespace Modules\User\Entities;

use Modules\Admin\Ui\AdminTable;
use Modules\User\Repositories\Permission;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Modules\Support\Eloquent\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends EloquentRole
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'global_marge',
        'increase_or_decrease',
    ];

    /**
     * Get a list of all roles.
     *
     * @return array
     */
    public static function list()
    {
        return static::select('id')->get()->pluck('name', 'id');
    }

    /**
     * The Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id')->withTimestamps();
    }

    /**
     * Set role's permissions.
     *
     * @param array $permissions
     * @return void
     */
    public function setPermissionsAttribute(array $permissions)
    {
        $this->attributes['permissions'] = Permission::prepare($permissions);
    }

    public function hasMargePrice() {
        return $this->global_marge > 0;
    }

    public function isMargeIncrease() {
        return $this->increase_or_decrease === "1";
    }

    public function getMargeInterest() {
        return $this->global_marge;
    }

    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new AdminTable($this->newQuery());
    }
}
