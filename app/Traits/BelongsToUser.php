<?php

namespace App\Traits;

trait BelongsToUser
{
    /**
     * Returns true if this belongs to the given user. The check is made by matching
     * the user relation id and the given user id. Returns false, if no user relation is
     * defined or the id check fails.
     * 
     * @param \App\User $user
     * @param string $relation_name
     * @return bool
     */
    public function belongsToUser($user, $relation_name = 'user')
    {
        if (is_null($user) || !method_exists($this, $relation_name)) {
            return false;
        }
        return $this->$relation_name->id === $user->id;
    }
}
