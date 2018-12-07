@extends('Shared.backend')
@section('title', 'Testcase Create')
@section('content')

    <h2>Create</h2>

    <h4>Testcase</h4>
    <hr/>

    <div class="row">

        <div class="col-md-9">
            <form method="post" action="{{url('Testcases/Create')}}">
                @csrf
                <div class="form-group">
                    <label class="control-label">Testcase Name</label>
                    </span>  <input name="name" value="{{ old('name') }}" class="form-control"/>
                </div>
                <div class="form-group">
                    <label class="control-label">Description</label>
                    </span>  <textarea style="height: 150px" name="description"
                                       class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Usecase</label>
                    <select style="width:120%;" name="usecase_id" class="form-control">
                        @foreach($Usecases as $Usecase)
                            @if($Usecase->Subsystem->project->status==='testing')
                            <option value="{{$Usecase->id}}">Usecase{{$Usecase->id}}: {{$Usecase->name}}   | - - |  Subsystem: {{$Usecase->subsystem->name}} | - - |  Project: {{$Usecase->subsystem->project->name}}</option>
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
        <a href="{{url('Testcases/')}}">Back to List</a>
    </div>
@endsection