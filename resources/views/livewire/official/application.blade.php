<div class="row">
    <div class="col-lg-12 p-2">
        @if (session()->get('register'))
            <div class="row mb-2">
                <div class="form-group mt-3">
                    <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                        <strong>Success!</strong> {{session()->get('register')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->get('fail'))
            <div class="row mb-2">
                <div class="form-group mt-3">
                    <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                        <strong>Success!</strong> {{session()->get('fail')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mb-2 px-3">
            <div class="col-lg-2 d-flex justify-content-center align-items-center shadow-sm my-1 rounded me-md-3 add-semester" data-bs-toggle="modal" data-bs-target="#addSemester">
                <div class="p-2">
                    <i class="bi bi-plus-lg text-white" style="font-size: 5rem"></i>
                </div>
            </div>
            @if (count($semesters) > 0)
                @foreach ($semesters as $semester)
                <div class="col-lg-3 px-2 py-4 shadow-sm rounded m-1 semester_item">
                    <div class="form-group text-center mb-4">
                        <div class="fw-bold h2 mb-2">S.Y {{$semester->school_year}}</div>
                        <div class="fw-bold">({{$semester->semester}})</div>
                    </div>
                    <div class="form-group text-center">
                        <a href="{{ route('OfficialApplicationInfo', ['sem' => Crypt::encrypt($semester->semester), 'sy' => Crypt::encrypt($semester->school_year)]) }}" class="custom-button">View Applications</a>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-lg-9 d-flex justify-content-center align-items-center">
                    <h2>No Semester Added Yet!</h2>
                </div>
            @endif
            
        </div>
    </div>


    <!--Delete User Modal -->
  <div wire:ignore.self class="modal fade" id="addSemester" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteUserLabel">Add School Year</h1>
          <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="addSemester">
            @csrf
            <div class="modal-body">
                <div class="col-md-12 p-2">
                  <div class="row">
                      <div class="form-group mb-2">
                          <label for="school_year">School Year</label>
                          <div class="d-flex flex-row p-2 justify-content-center">
                            <input type="text" class="custom-form p-2" wire:model="school_year_from">
                            <span class="fs-3 mx-3"> - </span>
                            <input type="text" class="custom-form p-2 " wire:model="school_year_to">
                          </div>
                          @error('school_year_to')
                              <div class="text-danger mb-2">{{$message}}</div>
                          @enderror
                          @error('school_year_from')
                              <div class="text-danger">{{$message}}</div>
                          @enderror
                      </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary mx-1 shadow-sm" data-bs-dismiss="modal">Cancel</i></button>
                  <button type="submit" class="btn btn-success mx-1 shadow-sm">Save</i></button>
              </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    window.addEventListener('hide_modal', function(){
        $('#addSemester .close-modal').click();
    });
</script>

</div>
