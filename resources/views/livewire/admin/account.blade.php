<div class="row">
    <div class="col-md-12">
        <div class="row mb-2">
            <h2 class="mb-4 fw-bold">Account List</h2>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#addUser">+</button>
                <div class="col-md-3 mx-1">
                    <input type="text" class="p-1 w-100" wire:model.live="search_input" placeholder="Search Account....">
                </div>
            </div>
        </div>

        @if (session()->get('register'))
            <div class="row my-2">
                <div class="form-group mt-3">
                    <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                        <strong>Success!</strong> {{session()->get('register')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->get('fail'))
            <div class="row my-2">
                <div class="form-group mt-3">
                    <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                        <strong>Success!</strong> {{session()->get('fail')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row text-center">
            <div class="px-3">
                <table cellpadding="10" cellspacing="10">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Office</th>
                            <th>User Name</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) > 0)
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($users as $user)
                            
                                <tr class="border-bottom">
                                    <td data-label="#">{{$i++}}</td>
                                    <td data-label="Name">{{ $user->first_name, ' '.$user->middle_name.' '.$user->last_name}}</td>
                                    <td data-label="Office">{{$user->office}}</td>
                                    <td data-label="User Name">{{$user->username}}</td>
                                    <td data-label="Password">{{$user->plain_password}}</td>
                                    <td data-label="Action">
                                        <button class="btn btn-primary mx-1 shadow-sm btn-circle" data-bs-toggle="modal" data-bs-target="#view_user_info" wire:click="getUserInfo('{{Crypt::encrypt($user->id)}}')"><i class="bi bi-eye-fill"></i></button>
                                        <button class="btn btn-danger mx-1 shadow-sm btn-circle" data-bs-toggle="modal" data-bs-target="#deleteUser" wire:click="getUserID('{{Crypt::encrypt($user->id)}}')"><i class="bi bi-trash-fill"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else

                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  
  <!--View User Info Modal -->
  <div wire:ignore.self class="modal fade" id="view_user_info" tabindex="-1" aria-labelledby="view_user_infoLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="view_user_infoLabel">User Information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">

            @if (session()->get('success'))
            <div class="row mb-2 px-2">

                <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                    <strong>Success!</strong> {{session()->get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
            @endif

            @if (session()->get('error'))
                <div class="row mb-2">
                    <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                        <strong>Success!</strong> {{session()->get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
            @endif

            @if ($id_number)
            <div class="row mb-2">
                <div class="form-group">
                    <label for="id_number">ID Number</label>
                    <input id="id_number" type='text' class="p-2 w-100" {{!$isEdit ? 'disabled':''}} wire:model="id_number">
                </div>
            </div>
            @endif
            <div class="row mb-2">
                <div class="col-md-6 text-cente">
                    <div class="form-group mb-2">
                        <label for="first_name">First Name</label>
                        <input id="first_name" type='text' class="p-2 w-100" {{!$isEdit ? 'disabled':''}} wire:model="first_name" placeholder="Enter First Name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="middle_name">Middle Name</label>
                        <input id="middle_name" type='text' class="p-2 w-100" {{!$isEdit ? 'disabled':''}} wire:model="middle_name" placeholder="(Optional)">
                    </div>
                    <div class="form-group mb-2">
                        <label for="last_name">Last Name</label>
                        <input id="last_name" type='text' class="p-2 w-100" {{!$isEdit ? 'disabled':''}} wire:model="last_name" placeholder="Enter Last Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input id="email" type='email' class="p-2 w-100" {{!$isEdit ? 'disabled':''}} wire:model="email" placeholder="Enter Email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="office">Office</label>
                        <select id="office" class="p-2 mt-1 w-100" {{!$isEdit ? 'disabled':''}} wire:model.live="office">
                            <option value="" disabled>Select</option>
                            @foreach ($offices as $office)
                                <option value="{{$office->id}}">{{$office->office}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="program">Program</label>
                        <select id="program" class="p-2 mt-1 w-100" {{!$isEdit ? 'disabled':''}} wire:model="program">
                            <option value="" disabled>Select</option>
                            @foreach ($programs as $program)
                                <option value="{{$program->id}}">{{$program->program_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="plain_password">Password</label>
                    <input id="plain_password" type='text' class="p-2 w-100" {{!$isEdit ? 'disabled':''}} wire:model="plain_password" placeholder="Enter Password">
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            @if (!$isEdit)
                <button class="btn btn-warning mx-1 shadow-sm" wire:click.prevent="editState">Edit</i></button>
            @else
                <button class="btn btn-primary mx-1 shadow-sm" wire:click.prevent="editAccount">Save</i></button>
                <button class="btn btn-secondary mx-1 shadow-sm" wire:click.prevent="editState">Cancel</i></button>
            @endif
        </div>
      </div>
    </div>
  </div>

  <!--Add Official User Modal -->
  <div wire:ignore.self class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addUserLabel">Add Official's Account</h1>
          <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="row mb-2">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type='text' class="p-2 w-100"  wire:model="username" required>
                    @error('username')
                        <div class="text-danger" role="alert">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6 text-cente">
                    <div class="form-group mb-2">
                        <label for="first_name">First Name</label>
                        <input id="first_name" type='text' class="p-2 w-100"  wire:model="first_name" placeholder="Enter First Name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="middle_name">Middle Name</label>
                        <input id="middle_name" type='text' class="p-2 w-100"  wire:model="middle_name" placeholder="(Optional)">
                    </div>
                    <div class="form-group mb-2">
                        <label for="last_name">Last Name</label>
                        <input id="last_name" type='text' class="p-2 w-100"  wire:model="last_name" placeholder="Enter Last Name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input id="email" type='email' class="p-2 w-100"  wire:model="email" placeholder="Enter Email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="office">Office</label>
                        <select id="office" class="p-2 mt-1 w-100"  wire:model.live="office" required>
                            <option value="" disabled>Select</option>
                            @foreach ($offices as $office)
                                <option value="{{$office->id}}">{{$office->office}}</option>
                            @endforeach
                        </select>
                        @error('office')
                            <div class="text-danger" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="program">Program</label>
                        <select id="program" class="p-2 mt-1 w-100"  wire:model="program">
                            <option value="" disabled>Select</option>
                            @foreach ($programs as $program)
                                <option value="{{$program->id}}">{{$program->program_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2 position-relative">
                        <label for="password">Password</label>
                        <input id="password" type='password' class="p-2 w-100"  wire:model="password" placeholder="Enter Password" required>
                        <label for="password-check" class="password-icon mt-4" id="password-eye"><i class="bi bi-eye-slash fs-4" ></i></label>
                        <input type="checkbox" id="password-check" class="d-none">
                        @error('password')
                            <div class="text-danger" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group position-relative">
                        <label for="confirm_password">Confirm Password</label>
                        <input id="confirm_password" type='password' class="p-2 w-100"  wire:model="confirm_password" placeholder="Confirm Password" required>
                        <label for="confirm_password-check" class="password-icon mt-4" id="confirm_password-eye"><i class="bi bi-eye-slash fs-4"></i></label>
                        <input type="checkbox" id="confirm_password-check" class="d-none">
                        @error('confirm_password')
                            <div class="text-danger" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success mx-1 shadow-sm" wire:click.prevent="addUser">Add</i></button>
        </div>
      </div>
    </div>
  </div>

  <!--Delete User Modal -->
  <div wire:ignore.self class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteUserLabel">Delete Account</h1>
          <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="row text-center">
                <div class="mb-2" style="font-size: 5rem">
                    <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                </div>
                <div class="mb-2">
                    <span class="text-dark"><strong>Are you sure you want to delete this account?</strong></span>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary mx-1 shadow-sm" data-bs-dismiss="modal">Cancel</i></button>
            <button class="btn btn-danger mx-1 shadow-sm" wire:click.prevent="deleteUser">Confirm</i></button>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.addEventListener('hide_modal', function(){
        $('#addUser .close-modal').click();
        $('#deleteUser .close-modal').click();
    });
</script>
</div>
