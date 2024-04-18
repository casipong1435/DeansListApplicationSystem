<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4 p-3">
                <div class="shadow d-flex flex-row">
                    <div class="d-flex justify-content-center align-items-center p-2 bg-success">
                        <i class="bi bi-people-fill fs-3 text-white px-2"></i>
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-column p-2 w-100">
                        <span class="fw-bold fs-3 m-2">{{$user_count}}</span>
                        <span>Total Registered Users</span>
                    </div>
                </div>
            </div>
            <div class="row col-md-12 mt-3">
                @if (count($users_per__institute) > 0)
                 @foreach ($users_per__institute as $user)
                    <div class="col-md-4 p-3">
                        <div class="shadow d-flex flex-row">
                            <div class="d-flex justify-content-center align-items-center p-2 bg-success">
                                <div class="fs-4 text-white">{{$user->program_abbreviation}}</div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center flex-column p-2 w-100">
                                <span class="fw-bold fs-3 m-2">{{$user->count}}</span>
                                <span>Total</span>
                            </div>
                        </div>
                    </div>
                 @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
