@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">all users seen by ( {{ Auth::user()->name }} {{ Auth::user()->email }} )</div> --}}
                <div class="card-header">
                    <h1 class="text-danger">you are in teacher page</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
