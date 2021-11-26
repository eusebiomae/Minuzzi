<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class _Controller extends Controller {

	public function generateFooterLinks() {
		return [
			'title' => 'Links',
			'links' => \App\Model\api\LinkFooterModel::get()->toArray(),
		];
	}

}
