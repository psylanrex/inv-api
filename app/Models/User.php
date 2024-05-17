<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Vendor;
use App\Models\VendorContact;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'vendorinv.User';

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'create_time';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'update_time';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'username', 
        'password', 
        'display_alerts', 
        'vendor_id', 
        'text_alerts', 
        'email_notifications', 
        'create_user_id', 
        'create_time', 
        'update_user_id', 
        'update_time'
    
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

        'password',
        'remember_token',

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {

        return [

            'password' => 'hashed',

        ];

    }

    /**
     * Relation to the Vendor table to link the user to the vendor he/she represents
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {

        return $this->hasOne(Vendor::class, 'id', 'vendor_id');

    }

    /**
     * Create the relation to the VendorContact table so you can retrieve any
     * contact information.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vendorContact()
    {

        return $this->hasOne(VendorContact::class, 'vendor_id', 'vendor_id');

    }

    /**
     * Override the method that gets the email address for the Invtory user
     * through the vendor contact table.
     *
     * @return mixed
     */
    public function getEmailForPasswordReset()
    {

        return $this->vendorContact()->value('email');

    }

    /**
     * Override the method for mailing out the actual reset password
     * email message with the token for resetting.
     *
     * @param string $token
     * @return mixed
     */
    public function sendPasswordResetNotification($token)
    {

       // event(new TransactionalEmailEvent($this->getEmailForPasswordReset(), new ResetRequested($token)));

    }

    /**
     * Set the notification hook for slack on Vendor users.
     *
     * @return string
     */
    public function routeNotificationForSlack()
    {

        return 'https://hooks.slack.com/services/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';
        
    }
   
}
