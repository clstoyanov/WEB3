<?php

namespace App\Policies;

use App\User;
use App\comments;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the comments.
     *
     * @param  \App\User  $user
     * @param  \App\comments  $comments
     * @return mixed
     */
    public function view(User $user, comments $comments)
    {
        //
    }

    /**
     * Determine whether the user can create comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the comments.
     *
     * @param  \App\User  $user
     * @param  \App\comments  $comments
     * @return mixed
     */
    public function update(User $user, comments $comments)
    {
        //
    }

    /**
     * Determine whether the user can delete the comments.
     *
     * @param  \App\User  $user
     * @param  \App\comments  $comments
     * @return mixed
     */
    public function delete(User $user, comments $comment)
    {
        if($user->isAdmin == 1 || $comment->user_id == $user->id)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can restore the comments.
     *
     * @param  \App\User  $user
     * @param  \App\comments  $comments
     * @return mixed
     */
    public function restore(User $user, comments $comments)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the comments.
     *
     * @param  \App\User  $user
     * @param  \App\comments  $comments
     * @return mixed
     */
    public function forceDelete(User $user, comments $comments)
    {
        //
    }
}
