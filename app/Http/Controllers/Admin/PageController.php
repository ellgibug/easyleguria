<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact(['page']));
    }

    public function update(Request $request, $id)
    {
        // валидация
        $this->validate($request, [
            'h1' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // обновление основной части
        $page = Page::findOrFail($id);
        $page->h1 = $request->h1;
        $page->body = $request->body;
        $page->saveOrFail();
        Session::flash('msg', 'Страница обновлена');

        return redirect()->action('Admin\PageController@index');
    }
}
