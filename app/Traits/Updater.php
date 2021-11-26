<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Updater {
	protected static function boot() {
		parent::boot();

		static::creating(function($model) {
			$id = empty(Auth::guard('admin')->user()) ? null : Auth::guard('admin')->user()->id;

			$model->created_by = $id;
		});

		static::updating(function($model) {
			$id = empty(Auth::guard('admin')->user()) ? null : Auth::guard('admin')->user()->id;

			$model->updated_by = $id;
		});

		static::deleting(function($model) {
			$id = empty(Auth::guard('admin')->user()) ? null : Auth::guard('admin')->user()->id;

			$model->deleted_by = $id;
			// $model->save();
		});
	}
}
