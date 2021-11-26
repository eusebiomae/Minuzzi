<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class GuestBookPhoneCallsModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'guest_book_phone_calls';

	public $fillable = [
		'guest_book_id',
		'contact_name',
		'phone_contact',
		'subject',
		'guest_book_status_id',
		'observation',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function guestBook() {
		return $this->belongsTo('App\Model\api\GuestBookModel');
	}

	public function guestBookStatus() {
		return $this->belongsTo('App\Model\api\GuestBookStatusModel');
	}
}
