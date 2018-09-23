<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Auth\Access\HandlesAuthorization;

class PegawaiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pegawai.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pegawai  $pegawai
     * @return mixed
     */
    public function view(User $user, Pegawai $pegawai)
    {
        return $user->hasRole($pegawai->unit->nama);
    }

}
