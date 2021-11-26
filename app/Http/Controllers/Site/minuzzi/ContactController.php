<?php

namespace App\Http\Controllers\Site\minuzzi;

use App\Http\Controllers\Controller;
use App\Model\api\ContactModel;
use App\Model\api\ContentPageModel;
use App\Model\api\FAQModel;
use App\Model\api\SlideModel;
use Illuminate\Http\Request;

use Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail as FacadesMail;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $faqModel = FAQModel::get();

        $flgPage = $request->get('flgPage');

        $pageComponents = ContentPageModel::getByComponent($flgPage);

        $banner = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {

            $query->where('flg_page', $flgPage);

        })->get();

        return view('site/pages/contact', [
            'faq' => $faqModel,
        ])
        ->with('pageComponents', $pageComponents)
        ->with('banner', $banner);

    }

    public function store(Request $request) {
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'subject' => $request->subject,
            'message' => $request->message
        );

        FacadesMail::to( config('mail.from.address') )
        ->send( new SendMail($data));

        return back();

    }

    public function save(Request $request) {
       (new ContactModel())->fill($request->all())->save();

        return redirect()->back();
    }

}
