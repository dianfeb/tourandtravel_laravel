<?php

namespace App\Http\Controllers\admin;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateSliderRequest;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(request()->ajax()) {
            $slider = Slider::latest()->get();
            return DataTables::of($slider)

            ->addIndexColumn()

            ->addColumn('button', function($slider) {
                return '
                <a class="btn btn-secondary" href="slider/'.$slider->id.'"  style="padding:0 5px"><i class="fas fa-eye"> </i></a>
                <a class="btn btn-primary" href="slider/'.$slider->id.'/edit"  style="padding:0 5px"><i class="fas fa-edit"> </i></a>
                <a class="btn btn-danger" href="#" onclick="deleteSlider(this)" data-id="'.$slider->id.'" style="padding:0 5px"><i class="fas fa-trash"> </i></a>';
            
            })
            ->rawColumns([ 'button'])
            ->make();

        }
        return view ('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        //

        $data = $request->validated(); //jika menggunakan http/request gunakan validated()

        $file = $request->file('img'); //ambil nama gambar (foto)
        $fileName =  uniqid().'.'.$file->getClientOriginalExtension(); //ambil format gambar
        $file->storeAs('public/admin/slider/', $fileName); //folder simpan

        $data['img'] = $fileName;
     

        Slider::create($data);

        return redirect(url('slider'))->with('success', 'Data Slider Has Been Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('admin.slider.show', [
            'slider' => Slider::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        return view('admin.slider.update', [
            'slider' => Slider::find($id)
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, string $id)
    {
        //

        $data = $request->validated(); //jika menggunakan http/request gunakan validated()

        if ($request->file('img')) {
            $file = $request->file('img'); //ambil nama gambar (foto)
            $fileName =  uniqid().'.'.$file->getClientOriginalExtension(); //ambil format gambar
            $file->storeAs('public/admin/slider/', $fileName); //folder simpan
    
            // unlink storage// Delete old image
            Storage::delete('public/admin/slider/'.$request->oldImg);

            $data['img'] = $fileName;
        } else {
            $data['img'] = $request->oldImg;
        }
        


        Slider::find($id)->update($data);

        return redirect(url('slider'))->with('success', 'Data Slider Has Been Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Slider::find($id);
        Storage::delete('public/admin/slider/'.$data->img);
        $data->delete();
        return response()->json([
            'message' => 'Data Slider has been deleted'
        ]);
    }
}
