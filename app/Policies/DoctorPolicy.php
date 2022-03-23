<?php

namespace App\Policies;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        return $user->hasPermissionTo('Read-Doctors')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Doctor $doctor)
    {
        return $user->hasPermissionTo('Read-Doctors')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-Doctor')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, $doctor)
    {
        return $user->hasPermissionTo('Update-Doctor')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, $doctor)
    {
        return $user->hasPermissionTo('Delete-Doctor')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore( $user,  $doctor)
    {
        return $user->hasPermissionTo('Delete-Doctor')
        ? $this->allow()
        : $this->deny("Con't using this page");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Patient $patient, Doctor $doctor)
    {
        //
    }
}
