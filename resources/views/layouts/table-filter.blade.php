<div class="d-block p-1">
    <select class="p-2 mx-2" wire:model.live="institute_filter">
        <option disabled>Institute</option>
        <option value="">All</option>
        @foreach ($institutes as $institutes)
            <option value="{{$institutes->id}}">{{$institutes->office}}</option>
        @endforeach
    </select>
    <select class="p-2 mx-2" wire:model="program_filter">
        <option disabled>Progam</option>
        <option value="">All</option>
        @if ($programs != null)
            @foreach ($programs as $program)
                <option value="{{$program->id}}">{{$program->program_abbreviation}}</option>
            @endforeach
        @endif
    </select>
    <select class="p-2 mx-2" wire:model.live="year_filter">
        <option disabled>Year</option>
        <option value="">All</option>
        <option value="1">1st Year</option>
        <option value="2">2nd Year</option>
        <option value="3">3rd Year</option>
        <option value="4">4th Year</option>
    </select>
    <input type="text" class="custom-form p-2" wire:model.live="search_input" placeholder="Search...">
</div>