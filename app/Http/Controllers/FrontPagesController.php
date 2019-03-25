<?php

namespace App\Http\Controllers;

use App\House;
use App\Page;
use App\Slider;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Contact;

class FrontPagesController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('priority')->get();
        $houses = House::where('display', 1)->inRandomOrder()->get()->take(3);
        return view ('front.pages.index', compact(['sliders', 'houses']));
    }

    public function houses(Request $request)
    {
        $sortsBy = ['price','area', 'capacity'];
        $orders = ['asc','desc'];

        if($request->has('sortBy') && $request->has('order')) {
            if (\in_array($request->sortBy, $sortsBy) && \in_array($request->order, $orders)) {
                $houses = House::where('display', 1)->orderBy($request->sortBy, $request->order);
            } else {
                $houses = House::where('display', 1);
            }
        } else {
            $houses = House::where('display', 1)->latest();
        }

        $houses = $houses->paginate(15)->appends([
            'sortBy' => $request->sortBy,
            'order' => $request->order,
        ]);

        return view ('front.pages.houses', compact(['houses']));
    }

    public function house($id)
    {
        $house = House::findOrFail($id);
        if($house->display){
            return view ('front.pages.house', compact(['house']));
        } else {
            abort(404);
        }

    }

    public function getContactPage()
    {
        return view ('front.pages.contacts');
    }

    public function sendContactMessage(Request $request)
    {
        if($request->ajax()){
            // валидация
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|max:255',
                'message' => 'required|max:5000'
            ]);

            // сохраняю в БД
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->saveOrFail();

            // отправляю письмо
            \Mail::to('info@your-test.site')->send(new ContactMail($contact));
            \Mail::to('oly-fomenk@yandex.ru')->send(new ContactMail($contact));
            return response()->json([
                'data' => 1,
            ]);
        } else {
            return back();
        }
    }

    public function getPage()
    {
        $page = Page::findOrFail(1);
        return view ('front.pages.page', compact(['page']));
    }


}
