<div class="row mb-2 p-3">
    <h3>Rejected Applicants</h3>
    <div class="d-flex justify-content-end p-2">
        
        @include('layouts.table-filter')
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
                </tr>
            </thead>
            <tbody>
                @if ($semester_status != 0)
                    @if (count($applicants_rejected) > 0)
                    @php
                        $i = 1;
                    @endphp
                        @foreach ($applicants_rejected as $applicant)
                            <tr class="border-bottom">
                                <td data-label="#">{{$i++}}</td>
                                <td data-label="ID Number">{{$applicant->id_number}}</td>
                                <td data-label="Name">{{$applicant->last_name.', '.$applicant->first_name}}</td>
                                <td data-label="Institute">{{$applicant->institute}}</td>
                                <td data-label="Program">{{$applicant->program_name}}</td>
                                <td data-label="Year">{{$applicant->year_level}}</td>
                                <td data-label="Average">{{$applicant->average}}</td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="8" class="text-center">No Evaluated Applicants Yet!</td>
                    </tr>  
                    @endif
                @else
                    <tr>
                        <td colspan="8" class="text-center">Application for the <strong>{{$semester}}</strong> S.Y <strong>{{$school_year}}</strong> have not yet started.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="p-2">
            <strong>Total: </strong>
            <span>{{count($applicants_rejected)}}</span>
        </div>
    </div>