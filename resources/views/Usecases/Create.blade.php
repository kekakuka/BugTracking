@extends('Shared._layout')
@section('title', 'Usecase Create')
@section('content')

    <h2>Create</h2>

    <h4>Usecase</h4>
    <hr/>

    <div class="row">

        <div class="col-md-8">
            <form method="post" action="{{url('Usecases/Create')}}">
                @csrf
                <div class="form-group">
                    <label class="control-label">Usecase Name</label>
                    </span>  <input name="name" value="{{ old('name') }}" class="form-control"/>
                </div>
                <div class="form-group">
                    <label class="control-label">Description</label>
                    </span>  <textarea style="height: 150px" name="description"
                                       class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Subsystem</label>
                    <select name="subsystem_id" class="form-control">
                        @foreach($Subsystems as $Subsystem)
                            @if($Subsystem->project->status==='testing')
                            <option value="{{$Subsystem->id}}">{{$Subsystem->id}}: {{$Subsystem->name}}   | - - - |  Project: {{$Subsystem->project->name}}</option>
                            @endif
@endforeach
                    </select>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <input type="submit" class="btn btn-default"/>
                </div>

            </form>
        </div>

    </div>

    <div>
        <a href="{{url('Usecases/')}}">Back to List</a>
    </div>
@endsection