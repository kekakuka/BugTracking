@extends('Shared.backend')
@section('title', 'Test Suite Create')
@section('content')

    <h2>Create</h2>

    <h4>Test Suite</h4>
    <hr/>

    <div class="row">

        <div class="col-md-6">
            <form method="post" action="{{url('Testsuites/Create')}}">
                @csrf

                <div class="form-group">
                    <label class="control-label">Summary</label>
                    </span>  <textarea style="height: 150px" name="summary"
                                       class="form-control">{{ old('summary') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Setting</label>
                    <select  style="width:140%;" name="setting_id" class="form-control">
                        @foreach($settings as $setting)
                            <option value="{{$setting->id}}">Setting: {{$setting->id}}:{{$setting->description}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Project</label>
                    <select name="project_id" class="form-control">
                        @foreach($projects as $project)
                          @if($project->status==='testing')
                            <option value="{{$project->id}}">{{$project->id}}: {{$project->name}}</option>
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
        <a href="{{url('Testsuites/')}}">Back to List</a>
    </div>
@endsection