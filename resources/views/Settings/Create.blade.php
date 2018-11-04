@extends('Shared._layout')
@section('title', 'Setting Create')
@section('content')

    <h2>Create</h2>

    <h4>Setting</h4>
    <hr/>

    <div class="row">

        <div class="col-md-6">
            <form method="post" action="{{url('Settings/Create')}}">
                @csrf

                <div class="form-group">
                    <label class="control-label">Description</label>
                    </span>  <textarea style="height: 150px" name="description"
                                       class="form-control">{{ old('description') }}</textarea>
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
        <a href="{{url('Settings/')}}">Back to List</a>
    </div>
@endsection