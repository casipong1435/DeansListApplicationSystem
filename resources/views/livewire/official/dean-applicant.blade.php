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
                </div>
                
                <div>
                    @switch($semester_status)
                    @case(0)
                            <button type="button" class="btn btn-secondary disabled">Application Not Started</button>
                        @break
                    @case(1)
                            <button type="button" class="btn btn-success disabled">Application Started</button>
                        @break
                    @case(2)
                            <button type="button" class="btn btn-primary disabled">Application Ended</button>
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
        
        <div class="row mb-2 p-3">
            <div class="d-flex justify-content-md-between p-2">
                <h3>Dean's Pending Applicants</h3>
                <div class="d-block">
                    <select class="p-2 mx-2" wire:model.live="program">
                        <option disabled>Progam</option>
                        <option value="">All</option>
                        @foreach ($programs as $program)
                            <option value="{{$program->id}}">{{$program->program_abbreviation}}</option>
                        @endforeach
                    </select>
                    <select class="p-2 mx-2" wire:model.live="year_level">
                        <option disabled>Year</option>
                        <option value="">All</option>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                    </select>
                    <input type="text" class="custom-form p-2" wire:model.live="search_input" placeholder="Search...">
                </div>
            </div>
            <div class="custom-table-container p-2">
                <table class="border-0" cellpadding="8">
                    <thead class="bg-transparent">
                        <tr>
                            <th>#</th>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Institute</th>
                            <th>Program</th>
                            <th>Year</th>
                            <th>Average</th>
                            <th>Equivalent</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($semester_status != 0)
                            @if (count($applicants_need_dean) > 0)
                            @php
                                $i = 1;
                            @endphp
                                @foreach ($applicants_need_dean as $applicant)
                                    <tr class="border-bottom">
                                        <td data-label="#">{{$i++}}</td>
                                        <td data-label="ID Number">{{$applicant->id_number}}</td>
                                        <td data-label="Name">{{$applicant->last_name.', '.$applicant->first_name}}</td>
                                        <td data-label="Institute">{{$applicant->institute}}</td>
                                        <td data-label="Program">{{$applicant->program_name}}</td>
                                        <td data-label="Year">{{$applicant->year_level}}</td>
                                        <td data-label="Average">{{$applicant->average}}</td>
                                        <td data-label="Equivalent">{{$applicant->equivalent}}</td>
                                        <td data-label="Action"><button type="button" class="custom-button" wire:click="approveApplicant('{{Crypt::encrypt($applicant->id)}}')">Approve</button></td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="8" class="text-center">No Evaluated Applicants Yet!</td>
                            </tr>  
                            @endif
                        @else
                            <tr>
                                <td colspan="9" class="text-center">Application for the <strong>{{$semester}}</strong> S.Y <strong>{{$school_year}}</strong> have not yet started.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="p-2">
                <strong>Total: </strong>
                <span>{{count($applicants_need_dean)}}</span>
            </div>
        
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

</div>
