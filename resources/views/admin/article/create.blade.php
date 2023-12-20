
@extends('admin.layouts.template')
@section('title', 'Article | Create')
@section('content')
<div class="card">
  <div class="card-body overflow-hidden p-lg-6">
    <div class="row align-items-center">
        <div class="col-lg-12 ps-lg-4 mb-3 p-3 text-center text-lg-start border-bottom">
            <h3 class="text-primary">Create Article</h3>
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
           
            <form action="{{url('article')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" >Title</label>
                            <input type="text" class="form-control" id="name" name="title" value="{{old('title')}}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" >Category</label>
                            <select class="form-select" id="category_id" name="category_id" aria-label="Default select example">
                                <option value="" hidden>- Choose -</option>

                                @foreach ($categories as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                        
                              </select>
                        </div>
                    </div>
                    
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="ckeditor" name="desc" cols="20" rows="10"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="img">Images (max 2MB)</label>
                            <input class="form-control" id="img" name="img" type="file" />
                        </div>
                        
                   
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" >Status</label>
                            <select class="form-select" name="status" id="status" aria-label="Default select example">
                                <option value="" hidden>- Choose -</option>
                                    <option value="0">Private</option>
                                    <option value="1">Publish</option>
                              </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="publish_date">Publish Date</label>
                            <input class="form-control" id="publish_date" name="publish_date" type="date" />
                        </div>
                        
                    </div>
                </div>
                <div class="fload-end">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
     
    </div>
  </div>
</div>


@endsection
        
@push('js')

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
      clipboard_handleImages:false
    };
  </script>
<script>
    CKEDITOR.replace('ckeditor', options);
</script>


@endpush
