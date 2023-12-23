<?php

namespace App\Http\Controllers\admin;

use App\Models\Whyus;
use Illuminate\Http\Request;
use App\Http\Requests\WhyusRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateWhyusRequest;

class WhyusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(request()->ajax()) {
            $whyus = Whyus::latest()->get();
            return DataTables::of($whyus)

            ->addIndexColumn()

            ->addColumn('button', function($whyus) {
                return '
                <a class="btn btn-secondary" href="whyus/'.$whyus->id.'"  style="padding:0 5px"><i class="fas fa-eye"> </i></a>
                <a class="btn btn-primary" href="whyus/'.$whyus->id.'/edit"  style="padding:0 5px"><i class="fas fa-edit"> </i></a>
                <a class="btn btn-danger" href="#" onclick="deleteWhyus(this)" data-id="'.$whyus->id.'" style="padding:0 5px"><i class="fas fa-trash"> </i></a>';
            
            })
            ->rawColumns([ 'button'])
            ->make();

        }
        return view ('admin.whyus.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view ('admin.whyus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WhyusRequest $request)
    {
        //
        $data = $request->validated();
        
        $file = $request->file('img');
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/admin/whyus/', $fileName);

        $data['img'] = $fileName;

        Whyus::create($data);
        return redirect(url('whyus'))->with('success', 'Data Slider Has Been Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('admin.whyus.update', [
            'whyus' => Whyus::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWhyusRequest $request, string $id)
    {
        //

        $data = $request->validated(); //jika menggunakan http/request gunakan validated()

        if ($request->file('img')) {
            $file = $request->file('img'); //ambil nama gambar (foto)
            $fileName =  uniqid().'.'.$file->getClientOriginalExtension(); //ambil format gambar
            $file->storeAs('public/admin/whyus/', $fileName); //folder simpan
    
            // unlink storage// Delete old image
            Storage::delete('public/admin/whyus/'.$request->oldImg);

            $data['img'] = $fileName;
        } else {
            $data['img'] = $request->oldImg;
        }
        


        Whyus::find($id)->update($data);

        return redirect(url('whyus'))->with('success', 'Data whyus Has Been Update');
    


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $data = Whyus::find($id);
        Storage::delete('public/admin/whyus/'.$data->img);
        $data->delete();
        return response()->json([
            'message' => 'Data Whyus has been deleted'
        ]);
    }
}
