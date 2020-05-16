@extends('layouts.app')

@section('content')

  <app-component
    :autenticacion="{{ Auth::user() }}"
      >
  </app-component>

@endsection
