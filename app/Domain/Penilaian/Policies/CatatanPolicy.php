<?php

namespace App\Domain\Penilaian\Policies;

use App\Domain\User\Models\User;
use App\Domain\Penilaian\Models\Catatan;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatatanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the catatan.
     *
     * @param  \App\Domain\User\Models\User  $user
     * @param  \App\Domain\Penilaian\Models\Catatan  $catatan
     * @return mixed
     */
    public function update(User $user, Catatan $catatan)
    {
        return $user->id == $catatan->user_id;
    }

    /**
     * Determine whether the user can delete the catatan.
     *
     * @param  \App\Domain\User\Models\User  $user
     * @param  \App\Domain\Penilaian\Models\Catatan  $catatan
     * @return mixed
     */
    public function delete(User $user, Catatan $catatan)
    {
        return $user->id == $catatan->user_id;
    }
}
