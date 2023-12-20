<?php

namespace App\Http\Controllers\admin;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Storage;
use App\Http\Requests\ArticleRequest;

use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (request()->ajax()) {
            $article = Article::with('Category')->latest()->get();
            return DataTables::of($article)
            // memanggil id terbaru
            ->addIndexColumn()
            // custom memanggil nama kategori
            ->addColumn('category_id', function($article) {
                return $article->category->name;
            })
            // custom menampilkan publish / private
            ->addColumn('status', function($article) {
                if ($article->status == 0) {
                    return '<span class="badge bg-danger">Private</span>';
                } else {
                    return '<span class="badge bg-success">Published</span>';
                }
                
            })

            ->addColumn('button', function($article) {
                return '
                <a class="btn btn-secondary" href="article/'.$article->id.'"  style="padding:0 5px"><i class="fas fa-eye"> </i></a>
                <a class="btn btn-primary" href="article/'.$article->id.'/edit"  style="padding:0 5px"><i class="fas fa-edit"> </i></a>
                <a class="btn btn-danger" href="#" onclick="deleteArticle(this)" data-id="'.$article->id.'" style="padding:0 5px"><i class="fas fa-trash"> </i></a>';
            
            })
            ->rawColumns(['category_id', 'status', 'button'])
            ->make();
        }
        return view('admin.article.index');
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.article.create', [
            'categories' => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request) /** * ArticleRequest diambil dari http/request/articlerequest   */
    {
        //
        $data = $request->validated(); //jika menggunakan http/request gunakan validated()

        $file = $request->file('img'); //ambil nama gambar (foto)
        $fileName =  uniqid().'.'.$file->getClientOriginalExtension(); //ambil format gambar
        $file->storeAs('public/admin/', $fileName); //folder simpan

        $data['img'] = $fileName;
        $data['slug'] = Str::slug($data['title']);

        Article::create($data);

        return redirect(url('article'))->with('success', 'Data Article Has Been Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('admin.article.show', [
            'article' => Article::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('admin.article.update', [
            'article' => Article::find($id),
            'categories' => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, string $id)
    {
        //

        $data = $request->validated(); //jika menggunakan http/request gunakan validated()

        if ($request->file('img')) {
            $file = $request->file('img'); //ambil nama gambar (foto)
            $fileName =  uniqid().'.'.$file->getClientOriginalExtension(); //ambil format gambar
            $file->storeAs('public/admin/', $fileName); //folder simpan
    
            // unlink storage// Delete old image
            Storage::delete('public/admin/'.$request->oldImg);

            $data['img'] = $fileName;
        } else {
            $data['img'] = $request->oldImg;
        }
        

      
        $data['slug'] = Str::slug($data['title']);

        Article::find($id)->update($data);

        return redirect(url('article'))->with('success', 'Data Article Has Been Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Article::find($id);
        Storage::delete('public/admin/'.$data->img);
        $data->delete();
        return response()->json([
            'message' => 'Data article has been deleted'
        ]);
    }
}
