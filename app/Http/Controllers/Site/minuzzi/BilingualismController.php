<?php

namespace App\Http\Controllers\site;

use Illuminate\Support\Facades\DB;

use App\model\site\Bilingualism;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\api\SchoolInformationModel;

class BilingualismController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = (object) [];

        $results->slide = DB::select('SELECT * FROM slide WHERE content_page_id = 8');
        $results->bilingualism = DB::select('SELECT * FROM content WHERE content_page_id = 8 AND content_section_id = 15');
        $results->questions = DB::select('SELECT cont.* , ctsec.description_pt AS content_section_description_pt, ctsec.description_en AS content_section_description_en, ctsec.description_es AS content_section_description_es FROM content cont LEFT JOIN content_section ctsec ON ctsec.id = cont.content_section_id LEFT JOIN content_page ctpg ON ctsec.id = cont.content_page_id WHERE cont.content_page_id = 8 AND cont.content_section_id = 26');
        $results->contact = (new SchoolInformationModel())->get();
        // print_r($results->mission); die;
        //View
        return view('site/bilingualism')
        ->with('results', $results);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\site\Bilingualism  $bilingualism
     * @return \Illuminate\Http\Response
     */
    public function show(Bilingualism $bilingualism)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\site\Bilingualism  $bilingualism
     * @return \Illuminate\Http\Response
     */
    public function edit(Bilingualism $bilingualism)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\site\Bilingualism  $bilingualism
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bilingualism $bilingualism)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\site\Bilingualism  $bilingualism
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bilingualism $bilingualism)
    {
        //
    }
}
