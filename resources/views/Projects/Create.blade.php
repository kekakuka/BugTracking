@extends('Shared.backend')
@section('title', 'Project Create')
@section('content')

    <h2>Create</h2>

    <h4>Project</h4>
    <hr />

    <div class="row">

        <div class="col-md-6">
            <form method="post" action="{{url('Projects/Create')}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">Project Name</label>
                   <input name="name" value="{{ old('name') }}" class="form-control" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Description</label>
                   <textarea style="height: 150px" name="description"  class="form-control" >{{ old('description') }}</textarea>
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
        <a href="{{url('Projects/')}}">Back to List</a>
    </div>
@endsection