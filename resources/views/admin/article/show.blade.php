
@extends('admin.layouts.template')
@section('title', 'category')
@section('content')
<div class="card">
  <div class="card-body overflow-hidden p-lg-6">
    <div class="row align-items-center">
        <div class="col-lg-12 ps-lg-4 mb-3 p-3 text-center text-lg-start border-bottom">
            <h3 class="text-primary">Detail Article</h3>
          </div>
           
          
          <div class="col-md-12">
            <div>
                <div class="table-responsive scrollbar">
                  <table class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-200">
                      <tr>
                        <th>Category</th>
                        <td>: {{$article->category->name}}</td>
                      </tr>
                      <tr>
                        <th>Title</th>
                        <td>: {{$article->title}}</td>
                      </tr>

                      <tr>
                        <th>Deskripsi</th>
                        <td>: {!!$article->desc !!}</td>
                      </tr>
                      <tr>
                        <th>Images</th>
                        <td>: <a href="{{asset('storage/admin/article/'.$article->img)}}" target="_blank" rel="noopener noreferrer">
                            <img src="{{asset('storage/admin/article/'.$article->img)}}" alt="" srcset="" width="100px;">
                            </a>
                            
                        </td> 
                        {{-- jalankan artisan storage link --}}
                      </tr>
                      <tr>
                        <th>Views</th>
                        <td>: {{$article->views}}</td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        @if ($article->status == 1)
                        <td>:  <span class="badge bg-success">Published</span></td>
                        @else
                        <td>:  <span class="badge bg-danger">Private</span></td>
                        @endif
                        <tr>
                            <th>Published Date</th>
                            <td>: {{$article->publish_date}}</td>
                          </tr>
                      </tr>
                    </thead>
                    
                  </table>

                  <div class="fload-end mt-3">
                    <a href="{{url('article')}}" class="btn btn-primary">Back</a>
                </div>
                </div>
            </div>
         </div>
     
    </div>
  </div>
</div>


@endsection
        
   
