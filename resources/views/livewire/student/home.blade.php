<div class="row">
    <div class="container d-flex p-2">
        <div class="h2 fw-bold me-2">Hello, </div>
        <div class="h2">{{$user_first_name.'!'}}</div>
    </div>
    <div class="container my-3 d-flex justify-content-center align-items-center">
        <div class="col-md-5 p-2  rounded shadow">
            <div class="form-group p-2 text-center">
                @if ($semester)
                    <div class="form-group mb-3">
                        <h2>SY: {{$semester->school_year}}</h2>
                    </div>
                    <div class="form-group mb-3">
                        <h4>{{$semester->semester}}</h4>
                    </div>
                    <div class="form-group mb-3">
                        <div>Dean's List Application for this Semester is now open!</div>
                    </div>
                    <div class="form-group mb-3">
                        <a href="{{route('StudentApplication')}}" class="custom-button">Apply Now</a>
                    </div>
                @else
                    <div class="p-3">
                        <h1>Application for Dean's List is currently unavailable!</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
