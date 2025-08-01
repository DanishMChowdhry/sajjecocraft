<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nextOrder = Slider::max('order') + 1;

    return view('slider.create', compact('nextOrder'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->tag = $request->tag;
        $slider->cta_label = $request->cta_label;
        $slider->cta_url = $request->cta_url;
        $slider->order = $request->order;
        $slider->status = $request->status;
        if ($request->hasFile('image')) {
            $image_path = ImageHelper::uploadImage($request->file('image'), 'images/sliders');
            $slider->image = $image_path;
        }
        $slider->save();
        return redirect()->route('slider.index')->with('status','Slider created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->tag = $request->tag;
        $slider->cta_label = $request->cta_label;
        $slider->cta_url = $request->cta_url;
        $slider->order = $request->order;
        $slider->status = $request->status;
        if ($request->hasFile('image')) {
            $image_path = ImageHelper::uploadImage($request->file('image'), 'images/sliders');
            $slider->image = $image_path;
        }
        $slider->save();
        return redirect()->route('slider.index')->with('status','Slider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Slider::destroy($id);
        return redirect()->route('slider.index')->with('status','Slider deleted successfully');
    }

}
