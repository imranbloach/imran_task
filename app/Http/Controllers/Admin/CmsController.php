<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Session;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page', 'pages');
        $cmsPages = CmsPage::get();
        return view('admin.cms.index')->with(compact('cmsPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id=null)
    {
        if($id==""){
            $title = 'Add New Page';
            $page = new CmsPage;
            $message = "Page is added successfully.";
        }else {
            $title = 'Edit Page';
            $page = CmsPage::find($id);
            $message = "Page is updated successfully.";
        }
        if($request->isMethod('post')){
            $rules = [
                'title'=>'required',
                'url'=>'required',
                'description'=>'required'
            ];
            $customMessages = [
                'title.required'=>'Page title is required.',
                'url.required'=>'Page url is required.',
                'description.required'=>'Page description is required.',
            ];

            $this->validate($request, $rules, $customMessages);
            $page->title = $request->title;
            $page->url = $request->url;
            $page->description = $request->description;
            $page->meta_title = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->meta_keywords = $request->meta_keywords;
            $page->status = 1;
            $page->save();

            return redirect('admin/cms-pages')->with('success_message', $message);

        }
        return view("admin.cms.add_edit_cms_page")->with(compact('title', 'page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CmsPage $cmsPage)
    {
        if($request->ajax()){
            $status = ($request->status == 'active')? 0:1;
            CmsPage::where('id', $request->page_id)->update(['status'=>$status]);

            return response()->json(
                [
                    'status'=>$status,
                    'page_id'=>$request->page_id
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CmsPage::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Page has been deleted successfully.');
    }
}
