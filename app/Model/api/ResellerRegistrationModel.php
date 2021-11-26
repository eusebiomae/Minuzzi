<?php

namespace App\Model\api;

use App\Traits\Updater;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResellerRegistrationModel extends Model {
    use SoftDeletes;
    use Updater;

    protected $table = 'reseller_registration';

    public $fillable = [
        'name',
        'email',
        'phone',
        'type_trade',
        'trade_name',
        'message_pt',

        'created_by',
		'updated_by',
		'deleted_by',
    ];

    protected $dates = ['deleted_at'];
}
