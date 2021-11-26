<?php

namespace App\Model\api;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class CommentModel extends Model
{
	use SoftDeletes;
	use Updater;

	protected $table = 'comment';
	public $fillable = [
		'user_id',
		'blog_id',
		'name',
		'email',
		'comments',
		'approved',
		'approved_by',
		'approved_at',
		'answer_from',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function answerFrom()
	{
		return $this->hasMany('\App\Model\api\CommentModel', 'answer_from')->with('answerFrom');
	}

	static public function getByBlog($blogId) {
		return CommentModel::where('blog_id', $blogId)->whereNull('answer_from')->with('answerFrom')->get();
	}
}
