
@extends('admin.layouts.template')
@section('title', 'category')
@section('content')
<div class="card">
  <div class="card-body overflow-hidden p-lg-6">
    <div class="row align-items-center">
        <div class="col-lg-12 ps-lg-4 mb-3 p-3 text-center text-lg-start border-bottom">
            <h3 class="text-primary">Detail Slider</h3>
          </div>
           
          
          <div class="col-md-12">
            <div>
                <div class="table-responsive scrollbar">
                  <table class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-200">
                   
                      <tr>
                        <th>Title</th>
                        <td>: {{$slider->name}}</td>
                      </tr>

                    
                      <tr>
                        <th>Images</th>
                        <td>: <a href="{{asset('storage/admin/slider/'.$slider->img)}}" target="_blank" rel="noopener noreferrer">
                            <img src="{{asset('storage/admin/slider/'.$slider->img)}}" alt="" srcset="" width="100px;">
                            </a>
                            
                        </td> 
                        {{-- jalankan artisan storage link --}}
                      </tr>
                     
                    </thead>
                    
                  </table>

                  <div class="fload-end mt-3">
                    <a href="{{url('slider')}}" class="btn btn-primary">Back</a>
                </div>
                </div>
            </div>
         </div>
     
    </div>
  </div>
</div>


@endsection
        
   
