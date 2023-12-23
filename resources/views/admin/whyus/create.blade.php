
@extends('admin.layouts.template')
@section('title', 'Why Choose Us | Create')
@section('content')
<div class="card">
  <div class="card-body overflow-hidden p-lg-6">
    <div class="row align-items-center">
        <div class="col-lg-12 ps-lg-4 mb-3 p-3 text-center text-lg-start border-bottom">
            <h3 class="text-primary">Create Why Choose Us</h3>
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
           
            <form action="{{url('whyus')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" >Title</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}"/>
                        </div>
                    </div>
                
                
                        <div class="mb-3">
                            <label class="form-label" for="img">Images (max 2MB)</label>
                            <input class="form-control" id="img" name="img" type="file" />
                        </div>
                        

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="ckeditor" name="desc" cols="20" rows="10"></textarea>
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
