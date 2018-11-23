@extends('Shared.backend')
@section('title', 'Staff Index')
@section('content')

    <h2>Staff</h2>

    <p>
      @if(Session::get('user')->title==='manager')
        <a href="{{url('Staff/Create')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New</a>
          @endif
    </p>
    <table class="table">
        <thead>
        <tr>
            <th>
                Staff Id
            </th>
            <th>
              User Name
            </th>
            <th>
              Full Name
            </th>

            <th>
             Title
            </th>
            <th>
              Assigned Work
            </th>

            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($staffs as $staff)
        <tr>
            <td>
                {{ $staff->id}}
            </td>
            <td>
                {{ $staff->userName}}
            </td>

            <td>
                {{ $staff->fullName}}
            </td>
            <td>
                {{ $staff->title}}
            </td>
            <td>
                {{ $staff->workLoad($staff->bugassigns) }}
            </td>
            <td>
                @if(Session::has('user')&&Session::get('user')->title==='manager')
                <a href="{{url('Staff/Edit/'.$staff->id)}}" class="btn btn-primary">Edit</a> |
                @endif
                    @if(Session::has('user')&&Session::get('user')->title==='manager')
                <a href="{{url('Staff/Details/'.$staff->id)}}" class="btn btn-warning" style="color: #0f0f0f">Reassign work</a>
                        @else
                        <a href="{{url('Staff/Details/'.$staff->id)}}" class="btn btn-info">Details</a>
                    @endif
            </td>
        </tr>
       @endforeach
        </tbody>
    </table>

@endsection