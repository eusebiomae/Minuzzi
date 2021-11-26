<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Updater;

class FileContentCourseModel extends Model { 
  use Updater;

  protected $table = 'file_content_course';

  public $fillable = [
    'file_id',
    'content_course_id',
    'created_by',
    'updated_by',
    'deleted_by',
  ];

	protected $dates = ['deleted_at'];

  public function file() {
		return $this->belongsTo('\App\Model\api\Prospection\FileModel');
  }

  public function contentCourse() {
		return $this->belongsTo('\App\Model\api\Prospection\ContentCourseModel');
  }
  
  static public function getIDsModule($idFile) {
    $payload = FileContentCourseModel::where('file_id', $idFile)->get();
    $ids = [];

    for ($i = 0, $ii = count($payload); $i < $ii; $i++) { 
      $ids[] = $payload[$i]->content_course_id;
    }

    return $ids;
	}
}