<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use DB;

class AuthorModel extends Model {
	use SoftDeletes;
	use Updater;

	public function getUser() {
		$authors = DB::table('user')->where([['author', '=', '1'],])->get();

		return $authors;
	}

}
