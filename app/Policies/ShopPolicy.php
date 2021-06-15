<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the shop can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list shops');
    }

    /**
     * Determine whether the shop can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Shop  $model
     * @return mixed
     */
    public function view(User $user, Shop $model)
    {
        return $user->hasPermissionTo('view shops');
    }

    /**
     * Determine whether the shop can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create shops');
    }

    /**
     * Determine whether the shop can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Shop  $model
     * @return mixed
     */
    public function update(User $user, Shop $model)
    {
        return $user->hasPermissionTo('update shops');
    }

    /**
     * Determine whether the shop can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Shop  $model
     * @return mixed
     */
    public function delete(User $user, Shop $model)
    {
        return $user->hasPermissionTo('delete shops');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Shop  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete shops');
    }

    /**
     * Determine whether the shop can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Shop  $model
     * @return mixed
     */
    public function restore(User $user, Shop $model)
    {
        return false;
    }

    /**
     * Determine whether the shop can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Shop  $model
     * @return mixed
     */
    public function forceDelete(User $user, Shop $model)
    {
        return false;
    }
}
