@extends('Shared._layout')
@section('title', 'Test Suite Edit')
@section('content')

    <h2>Edit</h2>

    <h4>Testsuite</h4>
    <hr />

    <div class="row">

        <div class="col-md-6">
            <form method="post" action="{{url('Testsuites/EditPost/'.$Testsuite->id)}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">Test Suite Summary</label>
                   </span>  <input name="name" value="{{$Testsuite->summary}}" class="form-control" />
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
        <a href="{{url('Testsuites/')}}">Back to List</a>
    </div>
@endsection