<?php

namespace App\Services\Auth;

use App\Models\State;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorAddress;
use App\Models\VendorContact;
use Illuminate\Support\Facades\DB;

class RegistrationTransactionService
{
    public function createUser(array $request)
    {

        $ext = ( ! empty($request['ext']) ) ? $request['ext'] : null;
        $fax = ( ! empty($request['fax']) ) ? $request['fax'] : null;

        // Start transaction!

        DB::beginTransaction();

        try {

            // Create the Vendor record

            $vendor = Vendor::create([

                'active' => 1,
                'name' => $request['billing_company'],
                'category_id' => $request['category'],
                'website' => $request['website'],
                'account' => '',
                'balance' => 0.00,
                'accepts_returns' => 1,
                'avg_delivery_time' => 0,
                'default_ship_method_id' => 5,
                'default_payment_term_id' => $request['terms'],
                'prepackage' => 0,
                'labor_rate' => 0,
                'profit_rate' => 0,
                'import_rate' => 0,
                'vendor_priority_id' => 1,
                'approval_window_days' => 0,
                'communication' => 0,
                'reliabilty' => 0,
                'timely' => 0,
                'overall_rating' => 0,
                'advanced_po' => 0,
                'assigned_employee_id' => 0,
                'test_vendor' => 0

            ]);

            // Create the VendorContact record

            VendorContact::create([

                'vendor_id' => $vendor->id,
                'primary' => 1,
                'first_name' => $request['firstname'],
                'last_name' => $request['lastname'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'extension' => $ext,
                'fax' => $fax

            ]);

            // Create the VendorAddress record

            VendorAddress::create([

                'vendor_id' => $vendor->id,
                'primary' => 1,
                'shipping' => ( ! empty($request['same']) ) ? 1 : 0,
                'billing' => 1,
                'address_label' => 'Billing',
                'address' => $request['billing_address'],
                'city' => $request['billing_city'],
                'state' => State::where('id', $request['billing_state'])->value('code'),
                'zip_code' => $request['billing_zip'],
                'country_id' => $request['billing_country']

            ]);

            // If there is a different shipping address entered then the billing

            if (!empty($request['shipping_address']) && ($request['shipping_address'] != $request['billing_address'])) {

                VendorAddress::create([

                    'vendor_id' => $vendor->id,
                    'primary' => 0,
                    'shipping' => 1,
                    'billing' => 0,
                    'address_label' => 'Shipping',
                    'address' => $request['shipping_address'],
                    'city' => $request['shipping_city'],
                    'state' => State::where('id', $request['shipping_state'])->value('code'),
                    'zip_code' => $request['shipping_zip'],
                    'country_id' => $request['shipping_country']

                ]);
            }

            // Create the User record

            $user = User::create([

                'username' => $request['username'],
                'password' => bcrypt($request['password']),
                'display_alerts' => 0,
                'vendor_id' => $vendor->id,
                'text_alerts' => 0,
                'email_notifications' => 0

            ]);

            // Commit transaction

            DB::commit();
        } catch (\Exception $e) {

            // Rollback transaction

            DB::rollback();

            return response([

                'message' => 'Registration failed' . $e->getMessage()

            ], 500);
        }

        return $user;
    }
}
