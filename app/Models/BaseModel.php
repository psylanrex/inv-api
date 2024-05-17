<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BaseModel extends Model
{

    // We are going to disable timestamps by default so we can handle them on our own.

    public $timestamps = false;

    // These fields allow you to turn on or off the automatically updating fields one at a time.

    protected $has_create_time = true;
    protected $has_update_time = true;
    protected $has_create_user_id = true;
    protected $has_update_user_id = true;

    /**
     * Override the boot method to add in some create / update fields as needed.
     */

    protected static function boot()
    {
        parent::boot();

        /**
         * Whenever a model is being created
         */

        static::creating(function($model){

            // if we have create_time
            if ( $model->has_create_time ) {

                $model->create_time = Carbon::now();

            }

            // if we have create_user_id

            if ( $model->has_create_user_id ) {

                $model->create_user_id = Auth::check() ? Auth::user()->id : 1;

            }

        });

        /**
         * Whenever a model is being updated
         */

        static::saving(function($model){

            // if we have an update user id, set it.

            if ( $model->has_update_user_id ) {

                $model->update_user_id = Auth::check() ? Auth::user()->id : 1;

            }

            // if we have an update time,

            if ( $model->has_update_time ) {

                $model->update_time = Carbon::now();

            }

        });

    }

}