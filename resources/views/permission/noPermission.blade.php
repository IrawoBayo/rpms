@extends('layouts.master')
@section('content')

	<h1>Hi {{ Auth::user()->name }}, you do not have the permission to view this section</h1>

@endsection