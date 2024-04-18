<div class="row">
    <div class="col-md-12">
        <div class="row mb-3">
            <h2 class="mb-4 fw-bold">Institutes & Programs</h2>
            <div class="col-md-3">
                <div class="form-group shadow p-2">
                    <label for="institutes" class="mb-1">Select Institute</label>
                    <select id="institutes" class="w-100 p-2" wire:model.live="institute_id">
                        <option value="" disabled>Institute</option>
                        @foreach ($institutes as $institute)
                            <option value="{{$institute->id}}">{{$institute->office}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        @if ($institute_id != null)
        <div class="row mb-2">
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#addProgram">+</button>
                <div class="px-2">
                  <label for="program_status">Program Satus: </label>
                  <select class="p-2" wire:model.live="program_status">
                    <option value="0">Active</option>
                    <option value="1">Archived</option>
                  </select>
                </div>
            </div>
        </div>
        @endif

        @if (session()->get('archived'))
            <div class="row my-2">
                <div class="form-group mt-3">
                    <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                        <strong>Success!</strong> {{session()->get('archived')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

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

        <div class="row text-center">
            <div class="px-3">
                <table cellpadding="10" cellspacing="10">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Institute</th>
                            <th>Program</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($institute_id != null)
                          @if (count($programs) > 0)
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($programs as $program)
                            
                                <tr class="border-bottom">
                                    <td data-label="#">{{$i++}}</td>
                                    <td data-label="Institute">{{ $program->office}}</td>
                                    <td data-label="Program">{{$program->program_abbreviation}}</td>
                                    <td data-label="Status"><span class="{{$program->status == 0 ? 'bg-success':' bg-warning'}}">{{$program->status == 0 ? 'Active':'Archived'}}</span></td>
                                    <td data-label="Action">
                                        <button class="btn btn-primary mx-1 shadow-sm btn-circle" data-bs-toggle="modal" data-bs-target="#editProgram" wire:click.prevent="getProgramID('{{Crypt::encrypt($program->id)}}')">Edit</button>
                                        @if ($program->status == 0)
                                          <button class="btn btn-warning mx-1 shadow-sm btn-circle" data-bs-toggle="modal" data-bs-target="#archiveProgram" wire:click.prevent="getProgramID('{{Crypt::encrypt($program->id)}}')">Archive</button>
                                        @else
                                          <button class="btn btn-warning mx-1 shadow-sm btn-circle" wire:click.prevent="UnarchiveProgram('{{Crypt::encrypt($program->id)}}')">Unarchive</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                          @else
                                  <tr>
                                    <td colspan="5" class="text-center">No Programs Added Yet!</td>
                                  </tr>
                          @endif
                        
                        @else
                                  <tr>
                                    <td colspan="5" class="text-center">No Institute Selected Yet!</td>
                                  </tr> 
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  <!--Add Program Modal -->
  <div wire:ignore.self class="modal fade" id="addProgram" tabindex="-1" aria-labelledby="addProgramLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addProgramLabel">Add Program</h1>
          <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" wire:click.prevent="resetFields" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="addProgram">
            @csrf
            <div class="modal-body">
                <div class="col-md-12">
                  <div class="row">
                     <div class="form-group mb-2">
                      <div class="fw-bold h3">{{$institute_name}}</div>
                     </div>
                     <div class="form-group mb-2">
                      <label for="new_program">Program Name</label>
                      <input type="text" id="new_program" class="w-100 p-2" wire:model="new_program">
                      @error('new_program')
                          <div class="text-danger">{{$message}}</div>
                      @enderror
                     </div>
                     <div class="form-group">
                        <label for="program_abbreviation">Program Abbreviation</label>
                        <input type="text" id="program_abbreviation" class="w-100 p-2" wire:model="program_abbreviation">
                        @error('program_abbreviation')
                          <div class="text-danger">{{$message}}</div>
                        @enderror
                      </div>

                      @if (session()->get('add'))
                        <div class="form-group mt-3">
                          <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                              <strong>Success!</strong> {{session()->get('add')}}
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                      </div>
                    @endif

                    @if (session()->get('error'))
                      <div class="form-group mt-3">
                        <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                            <strong>Success!</strong> {{session()->get('error')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary mx-1 shadow-sm" data-bs-dismiss="modal" wire:click.prevent="resetFields">Close</i></button>
                  <button type="submit" class="btn btn-success mx-1 shadow-sm">Add</i></button>
              </div>
        </form>
      </div>
    </div>
  </div>

  <!--Edit Program Modal -->
  <div wire:ignore.self class="modal fade" id="editProgram" tabindex="-1" aria-labelledby="addProgramLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editProgramLabel">Edit Program</h1>
          <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" wire:click.prevent="resetFields" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="SaveChanges">
            @csrf
            <div class="modal-body">
                <div class="col-md-12">
                  <div class="row">
                     <div class="form-group mb-2">
                      <div class="fw-bold h3">{{$institute_name}}</div>
                     </div>
                     <div class="form-group mb-2">
                      <label for="new_program">Program Name</label>
                      <input type="text" id="new_program" class="w-100 p-2" wire:model="new_program">
                      @error('new_program')
                          <div class="text-danger">{{$message}}</div>
                      @enderror
                     </div>
                     <div class="form-group">
                      <label for="program_abbreviation">Program Abbreviation</label>
                      <input type="text" id="program_abbreviation" class="w-100 p-2" wire:model="program_abbreviation">
                      @error('program_abbreviation')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary mx-1 shadow-sm" data-bs-dismiss="modal" wire:click.prevent="resetFields">Close</i></button>
                  <button type="submit" class="btn btn-primary mx-1 shadow-sm">Save</i></button>
              </div>
        </form>
      </div>
    </div>
  </div>

  <!--Delete Program Modal -->
  <div wire:ignore.self class="modal fade" id="archiveProgram" tabindex="-1" aria-labelledby="archiveProgramLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="archiveProgramLabel">Archive Porgram</h1>
          <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" wire:click.prevent="resetFields" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="row text-center">
                <div class="mb-2" style="font-size: 5rem">
                    <i class="bi bi-info-circle-fill text-warning"></i>
                </div>
                <div class="mb-2">
                    <span class="text-dark"><strong>Are you sure you want to archive this program?</strong></span>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary mx-1 shadow-sm" data-bs-dismiss="modal" wire:click.prevent="resetFields">Cancel</i></button>
            <button class="btn btn-warning mx-1 shadow-sm" wire:click.prevent="archiveProgram">Confirm</i></button>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.addEventListener('hide_modal', function(){
        $('#editProgram .close-modal').click();
        $('#archiveProgram .close-modal').click();
    });
</script>
</div>
