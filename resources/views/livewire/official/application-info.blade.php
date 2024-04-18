<div class="row">
    <div class="col-lg-12 p-2 ">
        <button type="button" class="custom-button rounded" onclick="history.back()"><i class="bi bi-arrow-left-circle-fill me-2"></i> Back</button>
        <div class="row text-center mb-2">
            <h1>S.Y {{$school_year}}</h1>
        </div>
        <div class="row mb-2 p-3">
            <div class="d-flex justify-content-between p-2 semester-group">
                <div class="">
                    <span class="fw-bold fs-2 me-2">{{$semester}}</span>
                    <select class="p-2" wire:model.live="table_content">
                        <option value="0">Evaluation</option>
                        <option value="1">Dean's Pending</option>
                        <option value="2">VP Pending</option>
                        <option value="3">Approved</option>
                        <option value="4">Rejected</option>
                    </select>
                </div>
                
                <div>
                    @switch($semester_status)
                    @case(0)
                            <button type="button" class="custom-button" wire:click.prevent="modifyApplication('{{Crypt::encrypt(1)}}')">Start Application</button>
                        @break
                    @case(1)
                            <button type="button" class="custom-button-2 mx-1" wire:click.prevent="modifyApplication('{{Crypt::encrypt(0)}}')">Cancel</button>
                            <button type="button" class="custom-button-3 mx-1" wire:click.prevent="modifyApplication('{{Crypt::encrypt(2)}}')">End Application</button>
                        @break

                    @case(2)
                            <button type="button" class="btn btn-secondary disabled">Application Ended</button>
                        @break
                        
                    @endswitch
                </div>
            </div>
        </div>
        @if (session()->get('success'))
            <div class="row my-2">
                <div class="form-group mt-3">
                    <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                        <strong>Success!</strong> {{session()->get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->get('error'))
            <div class="row my-2">
                <div class="form-group mt-3">
                    <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                        <strong>Success!</strong> {{session()->get('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
        
        @switch($table_content)
            @case(0)
                    @include('livewire.official.application-content.evaluation')
                @break
            @case(1)
                    @include('livewire.official.application-content.deans_pending')
                @break
            @case(2)
                    @include('livewire.official.application-content.vp_pending')
                @break
            @case(3)
                    @include('livewire.official.application-content.approved')
                @break
            @case(4)
                    @include('livewire.official.application-content.rejected')
                @break
                
        @endswitch

        
    </div>


    <!--Evaluate Applicant Modal -->
  <div wire:ignore.self class="modal fade" id="evaluateApplicant" tabindex="-1" aria-labelledby="evaluateApplicantLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="evaluateApplicantLabel">Evaluate</h1>
          <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="evaluateApplicant">
            @csrf
            <div class="modal-body">
                <div class="col-md-12">
                  <div class="row">
                    <div class="form-group mb-2">
                        <label for="id_number">ID Number</label>
                        <input type="text" id="id_number" wire:model="id_number" class="p-2 w-100" disabled>
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text" id="name" wire:model="name" class="p-2 w-100" disabled>
                    </div>
                    <div class="form-group mb-2">
                        <label for="applicant_office">Institute</label>
                        <input type="text" id="applicant_office" wire:model="applicant_office" class="p-2 w-100" disabled>
                    </div>
                    <div class="form-group mb-2">
                        <label for="program">Program</label>
                        <input type="text" id="program" wire:model="program" class="p-2 w-100" disabled>
                    </div>
                    <div class="form-group mb-2">
                        <label for="year_level">Year Level</label>
                        <input type="text" id="year_level" wire:model="year_level" class="p-2 w-100" disabled>
                    </div>
                    <div class="form-group mb-2">
                        <label for="average">Average</label>
                        <input type="text" id="average" wire:model="average" class="p-2 w-100" disabled>
                    </div>
                    <div class="form-group mb-2">
                        <label for="equivalent">Equivalence</label>
                        <input type="text" id="equivalent" wire:model="equivalent" class="p-2 w-100">
                        @error('equivalent')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger mx-1 shadow-sm" wire:confirm="Are you sure you want to reject this student?" wire:click="rejectApplicant">Reject</i></button>
                  <button type="submit" class="btn btn-primary mx-1 shadow-sm">Confirm</i></button>
              </div>
        </form>
      </div>
    </div>
  </div>

  

  <script>
    window.addEventListener('hide_modal', function(){
        $('#evaluateApplicant .close-modal').click();
    });
</script>

</div>
