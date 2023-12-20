@foreach ($categories as $row)
    
<div class="modal fade" id="modalUpdate{{$row->id}}" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mt-6" role="document">
      <div class="modal-content border-0">
        <div class="position-absolute top-0 end-0 mt-3 me-3 z-1"><button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button></div>
        <div class="modal-body p-0">
          <div class="rounded-top-3 bg-body-tertiary py-3 ps-4 pe-6">
            <h4 class="mb-1" id="staticBackdropLabel">Update Category</h4>
          
          </div>
          <div class="p-4">
              <form action="{{ url('categories/'. $row->id) }}" method="post">
                @method('PUT')
                  @csrf
                  <div class="mb-3">
                    <label class="col-form-label" for="recipient-name">Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{old('name', $row->name)}}"/>
                    @error('name') 
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                      @enderror
                  </div>
                 
                  <div class="modal-footer">
                      <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endforeach