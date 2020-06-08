<?php
namespace App\Domains\Webinar\Policies;

use App\Domains\Webinar\Models\Webinar;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebinarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\User $user
     * @param Webinar   $webinar
     * @return mixed
     */
    public function view(User $user, Webinar $webinar)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_admin == true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param Webinar   $webinar
     * @return mixed
     */
    public function update(User $user, Webinar $webinar)
    {
        return $user->is_admin == true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\User $user
     * @param Webinar   $webinar
     * @return mixed
     */
    public function delete(User $user, Webinar $webinar)
    {
        return $user->is_admin == true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\User $user
     * @param Webinar   $webinar
     * @return mixed
     */
    public function restore(User $user, Webinar $webinar)
    {
        return $user->is_admin == true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\User $user
     * @param Webinar   $webinar
     * @return mixed
     */
    public function forceDelete(User $user, Webinar $webinar)
    {
        return $user->is_admin == true;
    }
}
