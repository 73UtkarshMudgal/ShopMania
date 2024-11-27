<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserObserver
{
    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        // Reset the auto-increment counter in the sqlite_sequence table
        DB::statement('DELETE FROM sqlite_sequence WHERE name="users"');
    }
}
