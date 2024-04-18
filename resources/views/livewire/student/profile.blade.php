<div class="row">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-4 p-2">
            <div class="form-group shadow p-2 rounded-top" style="border-top: 5px solid #288025; border: 1px solid #a3a3a3f">
                <div class="form-group text-center border-bottom mb-4">
                    <div class="fw-bold">{{ $user_profile->first_name.' '.$user_profile->last_name}}</div>
                </div>
                <div class="form-group d-flex justify-content-between border-bottom mb-2">
                    <div class="fw-bold me-2">ID Number: </div>
                    <div>{{$user_profile->id_number}}</div>
                </div>
                <div class="form-group d-flex justify-content-between border-bottom mb-2">
                    <div class="fw-bold me-2">Institute: </div>
                    <div>{{$user_profile->office}}</div>
                </div>
                <div class="form-group d-flex justify-content-between border-bottom mb-2">
                    <div class="fw-bold me-2">Program: </div>
                    <div>{{$user_profile->program_abbreviation}}</div>
                </div>
                <div class="form-group d-flex justify-content-between border-bottom mb-2">
                    <div class="fw-bold me-2">Year Level: </div>
                    <div>{{$user_profile->year_level}}</div>
                </div>
                <div class="form-group d-flex justify-content-between border-bottom mb-2">
                    <div class="fw-bold me-2">Email: </div>
                    <div>{{$user_profile->email}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
