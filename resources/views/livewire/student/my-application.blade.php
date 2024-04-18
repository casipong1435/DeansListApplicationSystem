<div class="row">
    <div class="col-lg-12 p-2">
        <div class="row text-center mb-2">
            <h2>Application</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 p-2">
                <div class="p-4 shadow-sm rounded-top" style="border-top: 5px solid #336e45">
                    <div class="form-group mb-2">
                        <select wire:model.live="semester_id" class="p-2 w-100">
                            <option value="" disabled>Semester</option>
                            @foreach ($semester_list as $semester)
                                <option value="{{$semester->id}}">{{$semester->semester. ' (S.Y. '.$semester->school_year.')'}}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="form-group mb-2 d-flex justify-content-between">
                        <div class="fw-bold">School Year:</div>
                        <div>{{$current_sem != null ? $current_sem->school_year : ''}}</div>
                    </div>
                    <div class="form-group mb-2 d-flex justify-content-between">
                        <div class="fw-bold">Semester:</div>
                        <div>{{$current_sem != null ? $current_sem->semester : ''}}</div>
                    </div>
                    <div class="form-group mb-2">
                        @if ($current_sem  != null)
                            @switch($semester_status)
                                @case(0)
                                        <button type="button" class="w-100 btn btn-secondary disabled">Not Started</button>
                                    @break
                                @case(1)
                                        @if (!$current_application)
                                            <button type="button" class="w-100 btn btn-success" data-bs-toggle="modal" data-bs-target="#applyDeansList">Apply</button>
                                        @else
                                            <button type="button" class="w-100 btn btn-success disabled">Applied</button>
                                        @endif
                                    @break
                                @case(2)
                                        <button type="button" class="w-100 btn btn-danger disabled">Ended</button>
                                    @break
                                 
                            @endswitch
                        
                            </button>
                        @endif
                    </div>
                    @if (session()->get('success'))
                    <div class="form-group mb-2 px-2">
                        <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                            <strong>Success!</strong> {{session()->get('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
            <div class="col-lg-9 px-4 py-2">
                <div class="p-4 shadow-sm rounded-top" style="border-top: 5px solid #336e45">
                    <div class="form-group mb-3 border-bottom d-flex flex-column">
                        <strong class="mb-1">Registrar Evaluation</strong>
                        <div class="mb-1">Status: 
                            @if ($current_application != null)
                                @if ($current_application->status >= 1 && $current_application->status <= 3)
                                    <span class="text-white bg-primary mx-1"> Evaluated</span>
                                @elseif ($current_application->status == 0)
                                    <span class="text-white mx-1" style="background: #f37e50"> Pending</span>
                                @else
                                    <span class="text-white bg-danger mx-1">GWA Not Reached</span>
                                @endif

                            @endif
                        </div>
                        <div class="mb-1">Date Evaluated: <span class="fw-bold">{{$current_application != null ? $current_application->registrar_date_approved : ''}}</span></div>
                    </div>
                    
                    <div class="form-group mb-3 border-bottom d-flex flex-column">
                        <strong class="mb-1">Dean Approval</strong>
                        <div class="mb-1">Status: 
                            @if ($current_application != null)
                                @if ($current_application->status >= 2 && $current_application->status <= 3)
                                    <span class="text-white bg-success mx-1"> Approved</span>
                                @elseif ($current_application->status <= 1)
                                    <span class="text-white mx-1" style="background: #f37e50"> Pending</span>
                                @endif

                            @endif
                        </div>
                        <div class="mb-1">Date Approved: <span class="fw-bold">{{$current_application != null ? $current_application->dean_date_approved : ''}}</span></div>
                    </div>
                    <div class="form-group mb-3 border-bottom d-flex flex-column">
                        <strong class="mb-1">VPAA Approval</strong>
                        <div class="mb-1">Status: 
                            @if ($current_application != null)
                                @if ($current_application->status == 3)
                                    <span class="text-white bg-success mx-1"> Approved</span>
                                @elseif ($current_application->status <= 2)
                                    <span class="text-white mx-1" style="background: #f37e50"> Pending</span>
                                @endif
                            @endif
                        </div>
                        <div class="mb-1">Date Approved: <span class="fw-bold">{{$current_application != null ? $current_application->vp_date_approved : ''}}</span></div>
                    </div>

                    
                    <div class="form-group mb-3 border-bottom d-flex flex-column">
                        <div class="mb-1">GWA: 
                            <span class=" mx-1">{{$current_application != null ? $current_application->average:''}}</span>
                        </div>
                    </div>

                    <div class="form-group mb-3 border-bottom d-flex flex-column">
                        <div class="mb-1">Equivalent: 
                            <span class=" mx-1">{{$current_application != null ? $current_application->equivalent:''}}</span>
                        </div>
                    </div>

                    @if ($current_sem != null)
                        @if (!$current_application)
                            <div class="form-group p-2 w-100 text-center text-white bg-secondary ">
                                <span>No Data</span>
                            </div>
                        @else
                            @switch($current_application->status)
                                @case(0)
                                @case(1)
                                @case(2)
                                    <div class="form-group p-2 w-100 text-center text-white disabled" style="background: #f37e50">
                                        <span>Pending</span>
                                    </div>
                                    @break
                                @case(3)
                                    <div class="form-group p-2 w-100 text-center text-white bg-success disabled">
                                        <span>Approved</span>
                                    </div>
                                    @break
                                @case(4)
                                    <div class="form-group p-2 w-100 text-center text-white bg-danger disabled">
                                        <span>GWA Not Reached</span>
                                    </div>
                                    @break
                                    
                            @endswitch
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

        <!--Apply Dean's List Modal -->
  <div wire:ignore.self class="modal fade" id="applyDeansList" tabindex="-1" aria-labelledby="applyDeansListLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="applyDeansListLabel">Apply for Dean's List</h1>
          <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.pevent="applyDeansList">
            @csrf
            <div class="modal-body">
                <div class="col-md-12">
                  <div class="row">
                    @if (session()->get('error'))
                        <div class="form-group mb-2">
                            <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                <strong>Error!</strong> {{session()->get('error')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session()->get('exist'))
                        <div class="form-group mb-2">
                            <div class="alert alert-warning alert-dismissible fade show w-100" role="alert">
                                <strong>Exist!</strong> {{session()->get('exist')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text" id="name" wire:model="name" class="p-2 w-100" disabled>
                    </div>
                    <div class="form-group mb-2">
                        <label for="office">Institute</label>
                        <input type="text" id="office" wire:model="office" class="p-2 w-100" disabled>
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
                        <label for="grade">Upload Grade (PDF)</label>
                        <input type="file" id="grade" wire:model="grade" accept=".pdf" class="p-2 w-100">
                        @error('grade')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="average">Average</label>
                        <input type="text" id="average" wire:model="average" class="p-2 w-100">
                        @error('average')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary mx-1 shadow-sm" data-bs-dismiss="modal">Cancel</i></button>
                  <button type="submit" class="btn btn-success mx-1 shadow-sm">Apply Now</i></button>
              </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    window.addEventListener('hide_modal', function(){
        $('#applyDeansList .close-modal').click();
    });
</script>


</div>
