
@extends('admin.layouts.template')

@push('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
@endpush
@section('title', 'Slider')

@section('content')
<div class="card">
  <div class="card-body overflow-hidden p-lg-6">
    <div class="row align-items-center">
        <div class="col-lg-12 ps-lg-4 mb-3 p-3 text-center text-lg-start border-bottom">
            <h3 class="text-primary">Slider</h3>
            <a href="{{url('slider/create')}}" class="btn btn-falcon-primary mt-2"><i class="fas fa-plus me-2"></i>Add Slider
            </a>
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
 <div class="swal" data-swal="{{ session('success')}}"></div>
     <div class="col-md-12">
        <div id="tableExample2">
            <div class="table-responsive scrollbar">
              <table class="table table-bordered table-striped fs-10 mb-0" style="width:100%">
                <thead class="bg-200">
                  <tr>
                    <th class="text-900 sort">No</th>
                    <th class="text-900 sort">Name</th>
                 
                    <th class="text-900 sort" style="width:20%">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                   
             
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

@endsection
        
   @push('js')
       <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
       <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
       <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       {{-- sweet alert --}}
        <script>
          const swal = $('.swal').data('swal');
          if (swal) {
            Swal.fire({
              'title': 'Success',
              'text' : swal,
              'icon' : 'success',
              'showConfirmButton' :false,
              'timer' : 2500
            })
          }

          function deleteSlider(e) {
            let id = e.getAttribute('data-id');

            Swal.fire({
              title: 'Delete',
              text: 'Are you sure?',
              icon: 'question',
              showCancelButton: true,
              ConfirmButtonColor: '#d33',
              cancelButtonColor:  '#3885d6',
              confirmButtonText: 'Delete!',
              cancelButtonText: 'Cancel'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type: 'DELETE',
                  url: '/slider/' + id,
                  dataType: "json",
                  success: function(response) {
                    Swal.fire({
                      title: 'Success',
                      text: response.message,
                      icon: 'success',
                    }).then((result) => {
                      window.location.href = '/slider';
                    })
                  },
                  error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                  }
                });
              }
            })
          }
        </script>

       {{-- data table --}}
       <script>
        $(document).ready(function() {
            $('.table').DataTable({
              processing: true,
              serverside:true,
              ajax: '{{ url()->current() }}',
              columns: [
                {
                  data:'DT_RowIndex',
                  name:'DT_RowIndex'
                },
                
                {
                  data:'name',
                  name:'name'
                },
              
                {
                  data:'button',
                  name:'button'
                },
                
              ]
            });
        })
       </script>
   @endpush
