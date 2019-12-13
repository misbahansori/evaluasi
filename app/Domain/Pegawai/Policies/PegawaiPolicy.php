<?php

namespace App\Domain\Pegawai\Policies;

use App\Domain\User\Models\User;
use App\Domain\Pegawai\Models\Pegawai;
use Illuminate\Auth\Access\HandlesAuthorization;

class PegawaiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pegawai.
     *
     * @param  \App\Domain\User\Models\User  $user
     * @param  \App\Domain\Pegawai\Models\Pegawai  $pegawai
     * @return mixed
     */
    public function view(User $user, Pegawai $pegawai)
    {
        if (! $pegawai->unit) {
            return true;
        }
        return $user->hasRole($pegawai->unit->name);
    }

    public function update(User $user, Pegawai $pegawai)
    {
        return $user->hasPermissionTo('edit pegawai');
    }

}
