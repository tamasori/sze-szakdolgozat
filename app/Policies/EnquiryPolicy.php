<?php

namespace App\Policies;

use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnquiryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Enquiry  $enquiry
     * @return mixed
     */
    public function view(User $user, Enquiry $enquiry)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Enquiry  $enquiry
     * @return mixed
     */
    public function update(User $user, Enquiry $enquiry)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Enquiry  $enquiry
     * @return mixed
     */
    public function delete(User $user, Enquiry $enquiry)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Enquiry  $enquiry
     * @return mixed
     */
    public function restore(User $user, Enquiry $enquiry)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Enquiry  $enquiry
     * @return mixed
     */
    public function forceDelete(User $user, Enquiry $enquiry)
    {
        return true;
    }
}
