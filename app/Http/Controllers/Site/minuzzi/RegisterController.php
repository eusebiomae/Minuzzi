<?php

namespace App\Http\Controllers\Site\domMassas;

use App\Http\Controllers\Controller;
use App\Mail\ResellerMail;
use App\Model\api\ContentPageModel;
use App\Model\api\ResellerRegistrationModel;
use App\Model\api\SlideModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $flgPage = $request->get('flgPage');

        $pageComponents = ContentPageModel::getByComponent($flgPage);

        $banner = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {

           $query->where('flg_page', $flgPage);

       })->get();

       return view('site/pages/default')
       ->with('pageComponents', $pageComponents)
       ->with('banner', $banner);

   }

   public function store(Request $request) {
    $data = array(
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'type_trade' => $request->type_trade,
        'trade_name' => $request->trade_name,
        'message_pt' => $request->message_pt
    );

    Mail::to( config('mail.from.address') )
    ->send( new ResellerMail($data));

    return back();

}


   public function save(Request $request) {
    (new ResellerRegistrationModel())->fill($request->all())->save();

     return redirect()->back();
 }

}
