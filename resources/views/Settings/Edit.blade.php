@extends('Shared.backend')
@section('title', 'Setting Edit')
@section('content')

    <h2>Edit</h2>

    <h4>Setting</h4>
    <hr />

    <div class="row">

        <div class="col-md-6">
            <form method="post" action="{{url('Settings/EditPost/'.$Setting->id)}}">
                @csrf

                <div class="form-group">
                    <label  class="control-label">Description</label>
                    </span>  <textarea style="height: 150px" name="description" class="form-control" >{{$Setting->description}}</textarea>
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
        <a href="{{url('Settings/')}}">Back to List</a>
    </div>
@endsection