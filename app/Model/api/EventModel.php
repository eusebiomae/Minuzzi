<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'event';

	public $fillable = [
		'title_pt',
		'title_en',
		'title_es',
		'description_pt',
		'description_en',
		'description_es',
		'event_datetime',
		'localization',
		'annual_repeat',
		'special_date',
		'class_status',
		'status',
		'calendar_id',
		'calendar_privacy_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
	protected $appends = [ 'event_date', 'event_time', 'status_label', 'annual_repeat_label'];

	// public function classStatus() {
	// 	return $this->belongsTo('\App\Model\api\Configuration\ClassStatusModel');
	// }

	public function calendar() {
		return $this->belongsTo('\App\Model\api\Configuration\CalendarModel');
	}

	public function calendarPrivacy() {
		return $this->belongsTo('\App\Model\api\Configuration\CalendarModel');
	}

	public function getEventDateAttribute() {
		if (isset($this->attributes['event_datetime'])) {
			return Carbon::parse(explode(' ', $this->attributes['event_datetime'])[0])->format('d/m/Y');
		}

		return null;
	}

	public function getEventTimeAttribute() {
		if (isset($this->attributes['event_datetime'])) {
			return explode(' ', $this->attributes['event_datetime'])[1];
		}

		return null;
	}

	public function getStatusLabelAttribute() {
		if(isset($this->attributes['status'])){
			return is_null($this->attributes['status']) ? 'Inativo' : 'Ativo';
		}
	}

	public function getAnnualRepeatLabelAttribute() {
		if(isset($this->attributes['annual_repeat'])){
			return is_null($this->attributes['annual_repeat']) ? 'Inativo' : 'Ativo';
		}
	}



	// public function get() {
	// 	return DB::select('
	// 		select evt.*,
	// 		cld.description_pt as calendar_description_pt,
	// 		cld.description_en as calendar_description_en,
	// 		cld.description_es as calendar_description_es,
	// 		cldp.description_pt as calendar_privacy_description_pt,
	// 		cldp.description_en as calendar_privacy_description_en,
	// 		cldp.description_es as calendar_privacy_description_es,
	// 		clstt.description_pt as class_status_description_pt,
	// 		clstt.description_en as class_status_description_en,
	// 		clstt.description_es as class_status_description_es
	// 		from event evt
	// 		inner join calendar cld on cld.id = evt.calendar_id
	// 		inner join calendar_privacy cldp on cldp.id = evt.calendar_privacy_id
	// 		inner join class_status clstt on clstt.id = evt.class_status_id
	// 	');
	// }
}
