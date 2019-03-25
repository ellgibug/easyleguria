<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Footer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    public function getContacts()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts', compact(['contacts']));
    }

    public function getFooter()
    {
        $footer = Footer::findOrFail(1);
        return view('admin.footer', compact(['footer']));
    }

    public function updateFooter(Request $request)
    {
        $footer = Footer::findOrFail(1);
        $footer->body = $request->body;
        $footer->saveOrFail();

        Session::flash('msg', 'Футер обновлен');
        return back();
    }
}
