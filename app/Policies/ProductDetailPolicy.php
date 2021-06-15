<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductDetail;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductDetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the productDetail can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list productdetails');
    }

    /**
     * Determine whether the productDetail can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductDetail  $model
     * @return mixed
     */
    public function view(User $user, ProductDetail $model)
    {
        return $user->hasPermissionTo('view productdetails');
    }

    /**
     * Determine whether the productDetail can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create productdetails');
    }

    /**
     * Determine whether the productDetail can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductDetail  $model
     * @return mixed
     */
    public function update(User $user, ProductDetail $model)
    {
        return $user->hasPermissionTo('update productdetails');
    }

    /**
     * Determine whether the productDetail can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductDetail  $model
     * @return mixed
     */
    public function delete(User $user, ProductDetail $model)
    {
        return $user->hasPermissionTo('delete productdetails');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductDetail  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete productdetails');
    }

    /**
     * Determine whether the productDetail can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductDetail  $model
     * @return mixed
     */
    public function restore(User $user, ProductDetail $model)
    {
        return false;
    }

    /**
     * Determine whether the productDetail can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductDetail  $model
     * @return mixed
     */
    public function forceDelete(User $user, ProductDetail $model)
    {
        return false;
    }
}
