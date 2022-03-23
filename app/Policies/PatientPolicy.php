<?php

namespace App\Policies;

use App\Models\Patient;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny( $user)
    {
        //
        return $user->hasPermissionTo('Read-Patents')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Patient $user, Patient $patient)
    {
        //
        return $user->hasPermissionTo('Read-Patents')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create( $user)
    {
        //
        return $user->hasPermissionTo('Create-Patent')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Patient $user, Patient $patient)
    {
        //
        return $user->hasPermissionTo('Update-Patent')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete( $user, Patient $patient)
    {
        //
        return $user->hasPermissionTo('Delete-Patent')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore( $user, Patient $patient)
    {
        //
        return $user->hasPermissionTo('Delete-Patent')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete( $user, Patient $patient)
    {
        //
        return $user->hasPermissionTo('Delete-Patent')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }
}
