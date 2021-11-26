<?php

namespace App\Console\Jobs;

use App\Model\api\BlogModel;

class CronBlogScheduling {
	public static function run() {
		$posts = BlogModel::whereNotNull('scheduling_date')->where('status', 'AG')->get();

		$currentDate = date('Y-m-d');
		foreach ($posts as $post) {
			$date = preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$3-$2-$1', $post->scheduling_date);

			echo "{$currentDate} >= {$date}";
			if (strtotime($currentDate) >= strtotime($date)) {
				$post->fill([ 'status' => 'AT' ])->save();
			}
		}
	}
}
