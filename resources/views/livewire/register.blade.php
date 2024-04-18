<div class="row justify-content-center">

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="Register">
                    @csrf

                    <div class="row text-center mb-3">
                        <div class="form-group mb-2">
                            <img src="images/logo.jpg" alt="TCGC logo" height="100" width="100" style="border-radius: 50%">
                        </div>
                        <div class="form-group fw-bold text-success">Dean's List Application System</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="id_number" class="col-form-label">{{ __('ID Number') }}</label>
                                        <input id="id_number" type="text" class="custom-form p-2 w-100 @error('id_number') is-invalid @enderror" wire:model="id_number" value="{{ old('id_number') }}" required autocomplete="id_number" autofocus placeholder="Enter ID Number">
            
                                            @error('id_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="year_level" class="col-form-label">{{ __('Year Level') }}</label>
                                        <select wire:model="year_level" id="year_level" class="w-100 p-2">
                                            <option value="" disabled>Select</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
            
                                            @error('year_level')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="first_name" class="col-form-label">{{ __('First Name') }}</label>
                                <input id="first_name" type="text" class="custom-form p-2 w-100 @error('first_name') is-invalid @enderror" wire:model="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="Enter First Name">
    
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="middle_name" class="col-form-label">{{ __('Middle Name') }}</label>
                                <input id="middle_name" type="text" class="custom-form p-2 w-100 @error('middle_name') is-invalid @enderror" wire:model="middle_name" value="{{ old('middle_name') }}" autocomplete="middle_name" autofocus placeholder="Enter Middle Name (Optional)">
                            </div>

                            <div class="form-group mb-3">
                                <label for="last_name" class="col-form-label">{{ __('Last Name') }}</label>
                                <input id="last_name" type="text" class="custom-form p-2 w-100 @error('last_name') is-invalid @enderror" wire:model="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="Enter Last Name">
    
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="office" class="col-form-label custom-form">{{ __('Institute') }}</label>
                                <select wire:model.live="institute" id="office" class="w-100 p-2">
                                    <option value="" disabled>Institute</option>
                                    @if (count($offices) > 0)
                                        @foreach ($offices as $office)
                                            <option value="{{$office->id}}">{{$office->office}}</option>
                                        @endforeach
                                    @endif
                                </select>
    
                                    @error('office')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group mb-3">
                                <label for="program" class="col-form-label custom-form">{{ __('Program') }}</label>
                                <select wire:model="program" id="program" class="w-100 p-2">
                                    <option value="" disabled>Program</option>
                                    @if (count($programs) > 0)
                                        @foreach ($programs as $program)
                                            <option value="{{$program->id}}">{{$program->program_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
    
                                    @error('program')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email" class="col-form-label">{{ __('Email') }}</label>

                                <input id="email" type="email" class="custom-form p-2 w-100 @error('email') is-invalid @enderror" wire:model="email" required autocomplete="current-email" placeholder="Enter Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="username" class="col-form-label custom-form">{{ __('Username') }}</label>
                                <input id="username" type="text" class="custom-form p-2 w-100 @error('username') is-invalid @enderror" wire:model="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Enter Username">
    
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>

                                <div class="position-relative">
                                    <input id="password" type="password" class="custom-form p-2 w-100 @error('password') is-invalid @enderror" wire:model="password" required autocomplete="current-password" placeholder="Enter Password">
                                    <label for="password-check" class="password-icon" id="password-eye"><i class="bi bi-eye-slash fs-4" ></i></label>
                                    <input type="checkbox" id="password-check" class="d-none">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="confirm_password" class="col-form-label">{{ __('Confirm Password') }}</label>
                                
                                <div class="position-relative">
                                    <input id="confirm_password" type="password" class="custom-form p-2 w-100 @error('confirm_password') is-invalid @enderror" wire:model="confirm_password" required autocomplete="current-confirm_password" placeholder="Enter Confirm Password">
                                    <label for="confirm_password-check" class="password-icon" id="confirm_password-eye"><i class="bi bi-eye-slash fs-4"></i></label>
                                    <input type="checkbox" id="confirm_password-check" class="d-none">
                                </div>
                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Register') }}
                            </button>
                        </div>

                        @if (session()->get('success'))
                        <div class="form-group mt-3">
                            <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                                <strong>Success!</strong> {{session()->get('success')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif

                        @if (session()->get('error'))
                        <div class="form-group mt-3">
                            <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                <strong>Error!</strong> {{session()->get('error')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>