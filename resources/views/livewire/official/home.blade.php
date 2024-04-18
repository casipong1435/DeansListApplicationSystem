<div class="row">
    
   <container class="d-flex justify-content-center">
    <div class="col-md-12 p-2 ">
        <div class="shadow rounded text-center p-2">
            @if ($semester)
                <div class="form-group mb-3">
                    <h1>SY: {{$semester->school_year}}</h1>
                </div>
                <div class="form-group mb-3">
                    <h4>{{$semester->semester}}</h4>
                </div>
                <hr>
                <div class="row mt-2 p-2 d-flex justify-content-center">
                    <div class="col-md-5 p-1 m-2">
                        <div class="rounded" style="border-top: 5px solid #cc7a43; border-bottom: 1px solid #cc7a43">
                            <div class="text-center fw-bold h3 border-bottom mb-3">Pending Applicants</div>
                            <div class="d-flex justify-content-around border-bottom">
                                <div class="text-center fw-bold">
                                    <h4>Program</h4>
                                </div>
                                <div class="text-center fw-bold">
                                    <h4>Total</h4>
                                </div>
                            </div>
                            @if (count($pending_applicants) > 0)
                                @foreach ($pending_applicants as $applicant)
                                <div class="d-flex justify-content-between p-2">
                                    <div class="fw-bold">{{$applicant->program_abbreviation}}</div>
                                    <div>{{$applicant->count}}</div>
                                </div>
                                @endforeach
                            @else
                                <h4>No Applicant Yet!</h4>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-5 p-1 m-2">
                        <div class="rounded" style="border-top: 5px solid #2e802e; border-bottom: 1px solid #2e802e">
                            <div class="text-center fw-bold h3 border-bottom mb-3">Approved Applicants</div>
                            <div class="d-flex justify-content-around border-bottom">
                                <div class="text-center fw-bold">
                                    <h4>Program</h4>
                                </div>
                                <div class="text-center fw-bold">
                                    <h4>Total</h4>
                                </div>
                            </div>
                            @if (count($approved_applicants) > 0)
                                @foreach ($approved_applicants as $applicant)
                                <div class="d-flex justify-content-between p-2">
                                    <div class="fw-bold">{{$applicant->program_abbreviation}}</div>
                                    <div>{{$applicant->count}}</div>
                                </div>
                                @endforeach
                            @else
                                <h4>No Applicant Yet!</h4>
                            @endif
                        </div>
                    </div>   
                </div>
                <div class="row mt-2 px-4">
                    <div class="my-2">
                        <a href="{{ route('OfficialApplicationInfo', ['sem' => Crypt::encrypt($semester->semester), 'sy' => Crypt::encrypt($semester->school_year)]) }}" class="btn btn-success w-100">View Now</a>
                    </div>
                </div>
            @else
                <h1>Semestral Dean's List Application Has Not Yet Started!</h1>
                <div class="my-4">
                    <a href="{{route('OfficialApplication')}}" class="rounded custom-button shadow-sm">Start Now</a>
                </div>
            @endif
        </div>
    </div>
   </container>
</div>
