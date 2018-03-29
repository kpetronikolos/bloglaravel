@extends('layouts.admin')

@section('content')

	<h1>Users</h1>

	<table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
      @if ($users)
      	{{-- expr --}}
      	@foreach ($users as $user)
      		{{-- expr --}}
      		<tr>
      			<td>{{$user->id}}</td>
      			<td>{{$user->name}}</td>
      			<td>{{$user->email}}</td>
      			<td>{{$user->created_at->diffForHumans()}}</td>
      			<td>{{$user->updated_at->diffForHumans()}}</td>
      		</tr>
      	@endforeach
      @endif
    </tbody>
  </table>

@stop