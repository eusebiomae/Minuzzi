<?php

namespace App\Http\Controllers\StudentArea;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\api\Configuration\CityModel;
use App\model\api\PlaceModel;
use App\Model\api\Prospection\ClassModel;
use App\Model\api\Prospection\ContentCourseModel;
use App\Model\api\Prospection\CourseCategoryModel;
use App\Model\api\Prospection\CourseCategoryTypeModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\Prospection\CourseSubcategoryModel;
use App\Model\api\TeamModel;

class RankController extends BaseMethodAdminController {

	private function getListSelectBox() {
		$list = new \stdClass();

		$list->courseCategoryType = CourseCategoryTypeModel::orderBy('title')->get();
		$list->courseCategory = CourseCategoryModel::orderBy('description_pt')->get();
		$list->courseSubcategory = CourseSubcategoryModel::orderBy('description_pt')->get();
		$list->contentCourse = ContentCourseModel::orderBy('description_pt')->get();
		$list->city = CityModel::orderBy('name')->get();
		$list->place = PlaceModel::orderBy('description')->get();
		$list->class = ClassModel::orderBy('name')->get();
		$list->course = CourseModel::with([
			'class' => function($query) {
				$query->where('does_registre', '1');
			}
		])->orderBy('title_pt')->get();

		return $list;
	}

	public function all(Request $request) {
		// HEADER TABLE
		$dataTableHeader = [
			[ 'title' => 'Posição', 'data' => 'position', 'width' => '10px', ],
			[ 'title' => 'Nome', 'data' => 'name', ],
			[ 'title' => 'Pontuação', 'data' => 'points', ],
			[ 'title' => 'Regição/Turma', 'data' => 'class', ],
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
		];

		// BODY TABLE Enar -- Exemplo
		$data_enar = [
			[
				'id' => '1',
				'position' => '1°',
				'name' => 'Joel Poderoso Chefinho',
				'points' => '1000',
				'class' => 'União Sul',
			],
			[
				'id' => '2',
				'position' => '2°',
				'name' => 'Indiao Zica',
				'points' => '970',
				'class' => 'União Sul',
			],
			[
				'id' => '3',
				'position' => '3°',
				'name' => 'Gabriel da Motoquinha',
				'points' => '966',
				'class' => 'União Sul',
			],
			[
				'id' => '4',
				'position' => '4°',
				'name' => 'Alanna War',
				'points' => '784',
				'class' => 'União Norte',
			],
			[
				'id' => '5',
				'position' => '5°',
				'name' => 'Jow',
				'points' => '780',
				'class' => 'União Norte',
			],
			[
				'id' => '6',
				'position' => '6°',
			'name' => 'Mario! Que Mario?',
				'points' => '780',
				'class' => 'União Norte',
			],
		];

		// BODY TABLE Enar -- Exemplo
		$data_kids = [
			[
				'id' => '1',
				'position' => '1°',
				'name' => 'Junior',
				'points' => '1000',
				'class' => 'União Sul',
			],
			[
				'id' => '2',
				'position' => '2°',
				'name' => 'Aninha',
				'points' => '970',
				'class' => 'União Sul',
			],
			[
				'id' => '3',
				'position' => '3°',
				'name' => 'Pedrinho',
				'points' => '966',
				'class' => 'União Sul',
			],
			[
				'id' => '4',
				'position' => '4°',
				'name' => 'Juãozinho',
				'points' => '784',
				'class' => 'União Norte',
			],
			[
				'id' => '5',
				'position' => '5°',
				'name' => 'Enzo',
				'points' => '780',
				'class' => 'União Norte',
			],
			[
				'id' => '6',
				'position' => '6°',
				'name' => 'Amandinha',
				'points' => '780',
				'class' => 'União Norte',
			],
		];

		return view('student_area.rank.all')
		->with('listSelectBox', $this->getListSelectBox())
		->with('dataTable', [
			'enar' => [
				'header' => $dataTableHeader,
				'data' => $data_enar
			],
			'kids' => [
				'header' => $dataTableHeader,
				'data' => $data_kids
			]
		]);
	}
}
