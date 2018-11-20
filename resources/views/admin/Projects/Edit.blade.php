@extends('Shared.backend')
@section('title', 'Project Edit')
@section('content')

    <h2>Edit</h2>

    <h4>Project</h4>
    <hr />

    <div class="row">

        <div class="col-md-4">
            <form method="post" action="{{url('Projects/EditPost/'.$Project->id)}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">Project Name</label>
                   </span>  <input name="name" value="{{$Project->name}}" class="form-control" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Description</label>
                    </span>  <textarea style="height: 150px" name="description" class="form-control" >{{$Project->description}}</textarea>
                </div> <div class="form-group">
                <label >Status</label>
                <select class="form-control"  name="status" >

                    <option  value="testing">Testing</option>
                    <option  value="finished">Finished</option>
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
        <a href="{{url('Projects/')}}">Back to List</a>
    </div>
@endsection