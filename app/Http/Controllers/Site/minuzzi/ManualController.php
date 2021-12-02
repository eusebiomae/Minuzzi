<?php

namespace App\Http\Controllers\Site\minuzzi;

use App\Http\Controllers\Controller;
use App\Model\api\ContentPageModel;
use App\Model\api\ManualModel;
use App\Model\api\SlideModel;
use Illuminate\Http\Request;

class ManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $flgPage = $request->get('flgPage');

        $pageComponents = ContentPageModel::getByComponent($flgPage);

        $manuals = ManualModel::get();


        // return $pageComponents;
        return view('site/pages/default')
        ->with('flgPage', $flgPage)
        ->with('pageComponents', $pageComponents)
        ->with('manuals', $manuals);
    }

}
