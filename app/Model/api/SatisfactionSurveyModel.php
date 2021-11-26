<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class SatisfactionSurveyModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'satisfaction_survey';

	public $fillable = [
		'name',
		'email',
		'which_class_attended',
		'satisfaction_level',
		'talk_about_your_satisfaction_rating',
		'how_did_you_meet_cetcc',
		'what_were_your_real_motivations_for_looking_at_the_cetcc',
		'have_your_expectations_regarding_the_course_been_met',
		'in_what_exactly_has_cetcc_helped_you',
		'is_there_anyone_or_anything_that_influenced',
		'how_do_you_consider_our_teaching',
		'how_do_you_consider_our_physical_space',
		'how_do_you_consider_the_friendliness_of_our_service',
		'what_do_you_consider_positive_in_our_institution',
		'what_can_we_improve_on',
		'what_do_you_consider_negative_in_our_institution',
		'which_course_you_havent_done_yet_and_would_like_to_do',
		'is_there_any_course_you_would_like_us_to_have_in_our_grid',
		'would_you_recommend_CETCC_to_your_psychologist_friends',
		'created_by',
		'updated_by',
		'deleted_by',
	];
}
