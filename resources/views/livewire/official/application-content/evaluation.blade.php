<div class="row mb-2 p-3">
    <h3>Evaluation</h3>
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
                    <th>Grade</th>
                    <th>Average</th>
                    <th>Evaluate</th>
                </tr>
            </thead>
            <tbody>
                @if ($semester_status != 0)
                    @if (count($applicants_need_evaluation) > 0)
                    @php
                        $i = 1;
                    @endphp
                        @foreach ($applicants_need_evaluation as $applicant)
                            <tr class="border-bottom">
                                <td data-label="#">{{$i++}}</td>
                                <td data-label="ID Number">{{$applicant->id_number}}</td>
                                <td data-label="Name">{{$applicant->last_name.', '.$applicant->first_name}}</td>
                                <td data-label="Institute">{{$applicant->institute}}</td>
                                <td data-label="Program">{{$applicant->program_name}}</td>
                                <td data-label="Year">{{$applicant->year_level}}</td>
                                <td data-label="Grade"><a href="{{route('downloadGrade', $applicant->grade)}}"><i class="bi bi-filetype-pdf me-2"></i>{{$applicant->grade}}</a></td>
                                <td data-label="Average">{{$applicant->average}}</td>
                                <td data-label="Evaluate"><button type="button" class="custom-button-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#evaluateApplicant" wire:click="getUserIDNumber('{{Crypt::encrypt($applicant->id)}}')"><i class="bi bi-clipboard2-fill me-2"></i>Evaluate</button></td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="10" class="text-center">No Applicants Yet!</td>
                    </tr>  
                    @endif
                @else
                    <tr>
                        <td colspan="10" class="text-center">Application for the <strong>{{$semester}}</strong> S.Y <strong>{{$school_year}}</strong> have not yet started.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="p-2">
        <strong>Total: </strong>
        <span>{{count($applicants_need_evaluation)}}</span>
    </div>
</div>