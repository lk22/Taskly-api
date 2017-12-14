<?php

namespace Taskly;

use Illuminate\Database\Eloquent\Model;

use Taskly\User;

class Company extends Model
{
	/**
	 * Define database table to use
	 * @var string
	 */
    protected $table = 'companies';

    /**
     * allow columns to be mass assignable
     * @var array
     */
    protected $fillable = array(
    	'company_name',
    	'company_type',
    	'company_address',
    	'company_registration_nr',
    	'company_phone_nr',
    	'company_bank_account_nr',
    	'company_bank_registration_nr',
    	'company_iban_nr',
    	'company_swift_address'
    );

    /**
     * define columns to hide
     * @var array
     */
    protected $hidden = array(
    	'user_id'
    );

    /**
     * a company belongs to owner
     * @return [type] [description]
     */
    public function owner()
    {
    	return $this->belongsTo(User::class);
    }
}
