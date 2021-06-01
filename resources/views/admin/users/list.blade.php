@extends('admin.layout')

@section('content')

    <div id="users-list">

        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table table-striped table-sm table-bordered mt-5 mb-5">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nazwa</th>
                            <th>E-mail</th>
                            <th class="text-center">Aktywny</th>
                            <th class="text-center">Admin</th>
                            <th class="text-center">Rejestracja</th>
                            <th class="text-center">Facebook</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr class="@if(isToday($user->created_at)) bg-success text-white @endif">
                                <td class="text-center">{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td class="text-center">
                                    @if($user->is_active)
                                        Tak
                                    @else
                                        <span class="text-danger">Nie</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($user->is_admin)
                                        Tak
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">{{$user->created_at}}</td>
                                <td class="text-center">
                                    @if($user->provider)
                                        Tak
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection