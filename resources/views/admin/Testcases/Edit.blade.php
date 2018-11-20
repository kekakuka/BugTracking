@extends('Shared.backend')
@section('title', 'Testcase Edit')
@section('content')

    <h2>Edit</h2>

    <h4>Testcase</h4>
    <hr />

    <div class="row">

        <div class="col-md-9">
            <form method="post" action="{{url('Testcases/EditPost/'.$Testcase->id)}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">Testcase Name</label>
                   </span>  <input name="name" value="{{$Testcase->name}}" class="form-control" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Description</label>
                    </span>  <textarea style="height: 150px" name="description" class="form-control" >{{$Testcase->description}}</textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Usecase</label>
                    <select name="usecase_id" class="form-control">
                        @foreach($Usecases as $Usecase)
                            @if($Usecase->Subsystem->project->status==='testing')
                            @if($Usecase->id==$Testcase->Usecase->id)
                            <option selected value="{{$Usecase->id}}">{{$Usecase->id}}: {{$Usecase->name}}| | - - |  Subsystem: {{$Usecase->subsystem->name}} | - - |  Project: {{$Usecase->subsystem->project->name}}</option>
                            @else
                                <option value="{{$Usecase->id}}">{{$Usecase->id}}: {{$Usecase->name}}  | - - |  Subsystem: {{$Usecase->subsystem->name}} | - - |  Project: {{$Usecase->subsystem->project->name}}</option>
                                @endif
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
                    <input type="submit"  class="btn btn-default" />
                </div>

            </form>
        </div>

    </div>

    <div>
        <a href="{{url('Testcases/')}}">Back to List</a>
    </div>
@endsection