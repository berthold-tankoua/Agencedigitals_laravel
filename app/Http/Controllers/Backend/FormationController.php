<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Formation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class FormationController extends Controller
{
    //
    public function ctrAddFormationView()
    {
        $formations = Formation::latest()->get();
        $categories = Category::orderBy('category_name_fr', 'ASC')->get();
        return view('backend.formation.formation_view', compact('formations', 'categories'));
    }

    public function ctrStoreFormation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required|numeric',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $formation = new Formation();
        $formation->category_id = $request->category_id;
        $formation->name = $request->name;
        $formation->slug = strtolower(str_replace(' ', '-', $request->name));
        $formation->author = $request->author;
        $formation->payment_link = $request->link;
        $formation->desc = $request->desc;
        $formation->price = $request->price;
        $formation->created_at = Carbon::now();

        if ($request->hasFile('thumbnail')) {

            $thumbnail = $request->file('thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->fit(1000, 666)->save('upload/formations/' . $name_gen);
            $save_url = 'upload/formations/' . $name_gen;
            $formation->thumbnail = $save_url;
        }

        $formation->save();

        $notification = array(
            'message' => 'Formation added successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ctrEditFormation($id)
    {
        $formation = Formation::findOrFail($id);
        $categories = Category::orderBy('category_name_fr', 'ASC')->get();
        return view('backend.formation.formation_edit', compact('formation', 'categories'));
    }

    public function ctrUpdateFormation(Request $request)
    {
        $formation_id = $request->id;

        $formation = Formation::findOrFail($formation_id);
        $formation->category_id = $request->category_id;
        $formation->name = $request->name;
        $formation->slug = strtolower(str_replace(' ', '-', $request->name));
        $formation->author = $request->author;
        $formation->payment_link = $request->link;
        $formation->desc = $request->desc;
        $formation->price = $request->price;
        $formation->updated_at = Carbon::now();

        if ($request->hasFile('thumbnail')) {

            $thumbnail = $request->file('thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->fit(1000, 666)->save('upload/formations/' . $name_gen);
            $save_url = 'upload/formations/' . $name_gen;
            $formation->thumbnail = $save_url;
        }

        $formation->save();

        $notification = array(
            'message' => 'Formation updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
