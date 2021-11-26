<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\ContentPageModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;
use App\Model\api\UserModel;
use stdClass;

class DocController extends _Controller {
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request) {
		$flgPage = $request->get('flgPage');

		$slides = SlideModel::whereHas('contentPage', function($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->first();

		$pageComponents = ContentPageModel::getByComponent($flgPage);

		$contentTable = (object) [
			'header' => [
				(object) [
					'label' => 'ID',
					'column' => 'id',
				],
				(object) [
					'label' => 'Informações',
					'column' => 'info',
				],
				(object) [
					'label' => 'Download',
					'column' => 'btn',
				],
			],
			'data' => []
		];

		$search = new stdClass;

		if ($request->get('search')) {
			$search = $request->get('search');
		}

		foreach ($pageComponents->contentSection as &$contentSection) {
			if ($contentSection->component != 'table') {
				continue;
			}

			foreach ($contentSection->content as &$content) {

				if (is_array($search)) {
					if (!empty($search['year']) && substr($content->created_at, 0, 4) != $search['year']) {
						continue;
					}

					if (!empty($search['author']) && $search['author'] != $content->created_by) {
						continue;
					}

					if (!empty($search['text']) && strpos(strtolower("{$content->title_pt} {$content->subtitle_pt} {$content->text_pt}"), strtolower($search['text'])) === false) {
						continue;
					}
				}

				$contentTable->data[] = [
					'id' => $content->id,
					'info' => "<br />
					<b class='text-uppercase'>{$content->title_pt}</b>
					<br />{$content->subtitle_pt}
					<br />{$content->text_pt}
					",
					'btn' => '<a  class="btn btn-success" style="margin:30% 12%;" target="_blank" href="' . $content->link . '"><i class="icon-download"></i></a>',
				];
			}

			$contentSection->content = $contentTable;
		}

		// return $pageComponents;

		/*
		foreach($data as &$item) {
			$item['author'] .= "<br />
			<b class='text-uppercase'>{$item['title']}</b>
			<br />{$item['info']}
			";

			$item['btn'] = '<a  class="btn btn-success" style="margin:30% 12%;" href="'.$item['link'].'"><i class="icon-download"></i></a>';
		}

		$pageComponents->contentSection = [
			(object) [
				'component' => "doc",
				'content' => (object) []
			],
			(object) [
				'description_pt' => "Teses e Monografias",
				'subtitle_pt' => "Subtítulo de Teses e Monografias",
				'component' => "table",
				'component_order' => null,
				'content' => $contentTable,
			],
		];
		*/

		$years = [];
		$yearAt = date('Y') - 5;
		for ($year = date('Y'); $year > $yearAt; $year--) {
			$years[] = $year;
		}

		return view('site/cetcc/pages/default')
		->with('filters', (object) [
			'years' => $years,
			'author' => UserModel::withTrashed()->where('author', 'S')->orderBy('name')->get(),
		])
		->with('search', $search )
		->with('flgPage', $flgPage)
		->with('banner', $slides)
		->with('pageComponents', $pageComponents)
		->with('footerLinks', $this->generateFooterLinks());
	}


}
