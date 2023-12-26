
@extends('admin.layouts.template')
@section('title', 'category')
@section('content')
<div class="card">
  <div class="card-body overflow-hidden p-lg-6">
    <div class="row align-items-center">
        <div class="col-lg-12 ps-lg-4 mb-3 p-3 text-center text-lg-start border-bottom">
            <h3 class="text-primary">Category</h3>
            <button class="btn btn-falcon-primary mt-2" data-bs-toggle="modal" data-bs-target="#modalCreate"><i class="fas fa-plus me-2"></i>Add Category
            </button>
          </div>
          @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 @if (session('success'))
 <div class="alert alert-success">
    {{session('success')}}
</div>
 @endif
     <div class="col-md-12">
        <div id="tableExample2">
            <div class="table-responsive scrollbar">
              <table class="table table-bordered table-striped fs-10 mb-0" style="width:100%">
                <thead class="bg-200">
                  <tr>
                    <th class="text-900 sort">No</th>
                    <th class="text-900 sort">Category</th>
                    <th class="text-900 sort">Created At</th>
                    <th class="text-900 sort">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                    @forelse ($categories as $row) 
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->created_at}}</td>
                        <td>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$row->id}}"><i class="fas fa-edit"></i> </button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$row->id}}"><i class="fas fa-trash"></i> </button>
                   
                        </td>
                      </tr>

                      @empty
                      <div class="alert alert-warning">
                          Data Category belum Tersedia.
                      </div>
                    @endforelse
             
                </tbody>
              </table>
            </div>
            {{-- <div class="d-flex justify-content-center mt-3"><button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
              <ul class="pagination mb-0"></ul><button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
            </div> --}}
        </div>
     </div>
    </div>
  </div>
</div>



@include('admin.category.create')
@include('admin.category.update')
@include('admin.category.delete')
@endsection
        
   
