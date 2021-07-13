@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">all users seen by ( {{ Auth::user()->name }} {{ Auth::user()->email }} )</div> --}}
                <div class="card-header">
                    all users seen by (
                        {{-- {{ session()->get('user_info')->name }}
                        {{ session()->get('user_info')->email }} --}}

                        {{ CAuth::AuthInfo()->name }}
                        {{ CAuth::AuthInfo()->email }}

                    )
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        @foreach (App\Models\User::get() as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
