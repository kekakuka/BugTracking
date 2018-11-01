@extends('Shared._layout')
@section('title', 'Subsystem Edit')
@section('content')

    <h2>Edit</h2>

    <h4>Subsystem</h4>
    <hr />

    <div class="row">

        <div class="col-md-6">
            <form method="post" action="{{url('Subsystems/EditPost/'.$Subsystem->id)}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">Subsystem Name</label>
                   </span>  <input name="name" value="{{$Subsystem->name}}" class="form-control" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Description</label>
                    </span>  <textarea style="height: 150px" name="description" class="form-control" >{{$Subsystem->description}}</textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Project</label>
                    <select name="project_id" class="form-control">
                        @foreach($projects as $project)
                            @if($project->status==='testing')


                            @if($project->id==$Subsystem->project->id)
                            <option selected value="{{$project->id}}">{{$project->id}}: {{$project->name}}</option>
                            @else
                                <option value="{{$project->id}}">{{$project->id}}: {{$project->name}}</option>
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
        <a href="{{url('Subsystems/')}}">Back to List</a>
    </div>
@endsection