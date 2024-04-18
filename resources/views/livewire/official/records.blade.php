<div class="row">
    <div class="col-lg-12 p-2">
        <div class="row text-center mb-2">
            <h2>Deans List Record</h2>
        </div>
        <div class="row mb-4">
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
                                        <button type="button" class="w-100 btn btn-success disabled">Ongoing</button>
                                    @break
                                @case(2)
                                        <button type="button" class="w-100 btn btn-danger disabled">Ended</button>
                                    @break
                                 
                            @endswitch
                        
                            </button>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 p-2">
                <div class="d-flex justify-content-md-between p-2">
                    <h3>Dean's List</h3>
                    <div class="d-block">
                        <select class="p-2 mx-2 institute" wire:model.live="office">
                            <option disabled>Institute</option>
                            <option value="">All</option>\
                            @foreach ($institutes as $institutes)
                                <option value="{{$institutes->id}}">{{$institutes->office}}</option>
                            @endforeach
                        </select>
                        <select class="p-2 mx-2 program" wire:model="program">
                            <option disabled>Progam</option>
                            <option value="">All</option>
                            @if ($programs != null)
                                @foreach ($programs as $program)
                                    <option value="{{$program->id}}">{{$program->program_abbreviation}}</option>
                                @endforeach
                            @endif
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
                <div class="custom-table-container p-2 mb-2">
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
                            </tr>
                        </thead>
                        <tbody>
                            @if ($current_sem != null)
                                @if ($semester_status != 0)
                                    @if (count($deans_list) > 0)
                                    @php
                                        $i = 1;
                                    @endphp
                                        @foreach ($deans_list as $applicant)
                                            <tr class="border-bottom">
                                                <td data-label="#">{{$i++}}</td>
                                                <td data-label="ID Number">{{$applicant->id_number}}</td>
                                                <td data-label="Name">{{$applicant->last_name.', '.$applicant->first_name}}</td>
                                                <td data-label="Institute">{{$applicant->institute}}</td>
                                                <td data-label="Program">{{$applicant->program_name}}</td>
                                                <td data-label="Year">{{$applicant->year_level}}</td>
                                                <td data-label="Average">{{$applicant->average}}</td>
                                                <td data-label="Equivalent">{{$applicant->equivalent}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8" class="text-center">No Evaluated Applicants Yet!</td>
                                    </tr>  
                                    @endif
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">Application for the <strong>{{$current_sem->semester}}</strong> S.Y <strong>{{$current_sem->school_year}}</strong> have not yet started.</td>
                                    </tr>
                                @endif
                            @else
                            <tr>
                                <td colspan="9" class="text-center">Select Semester</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="p-2 d-flex justify-content-start">
                    <div class="d-flex justify-content-center align-items-center">
                        <strong class="me-1">Total: </strong>
                        <span class="me-3">{{count($deans_list)}}</span>
                        @if (count($deans_list) > 0)
                        <button type="button" data-bs-toggle="modal" data-bs-target="#generateReport" class="btn btn-transparent"><i class="bi bi-file-earmark-fill text-success fs-1"></i></button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="generateReport" tabindex="-1" aria-labelledby="generateReportLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="generateReportLabel">Delete Account</h1>
              <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="col-md-12">
                <div class="row">
                    <div class="mb-2">
                        <label for="report_office">Institute</label>
                        <select wire:model.live="report_office" id="report_office" class="p-2 w-100">
                            <option value="" disabled>Office</option>
                            <option value="" >All</option>
                            @foreach ($report_institutes as $institute)
                                <option value="{{$institute->id}}">{{$institute->office}}</option>
                            @endforeach
                        </select>
                        @error('report_office')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="report_program">Program</label>
                        <select wire:model="report_program" id="report_program" class="p-2 w-100">
                            <option value="" disabled>Program</option>
                            <option value="" >All</option>
                            @if ($report_office != null || $report_office != '')
                                @foreach ($report_programs as $program)
                                    <option value="{{$program->id}}">{{$program->program_name}}</option>
                                @endforeach
                                @error('report_office')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                            @endif
                        </select>
                    </div>
                    @if (session()->get('success'))
                        <div class="mb-2">
                            <div class="alert alert-success alert-dismissible fade show w-100 d-flex position-relative" role="alert">
                                <span><strong>Success!</strong> {{session()->get('success')}}</span>
                                <a target="_blank" class="download_icon" href="{{route('DownloadDeansList', ['semester_id' => $semester_id, 'office' => $report_office, 'program' => $report_program ])}}"><i class="bi bi-printer text-primary fs-1"></i></a>
                            </div>
                        </div>
                    @endif

                    @if (session()->get('fail'))
                        <div class="mb-2">
                            <div class="alert alert-warning alert-dismissible fade show w-100" role="alert">
                                <strong>Fail!</strong> {{session()->get('fail')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session()->get('error'))
                        <div class="mb-2">
                            <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                <strong>Error!</strong> {{session()->get('error')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary mx-1 shadow-sm" data-bs-dismiss="modal">Cancel</i></button>
                <button class="btn btn-primary mx-1 shadow-sm" wire:click="generateList">Generate</i></button>
            </div>
          </div>
        </div>
      </div>

</div>
