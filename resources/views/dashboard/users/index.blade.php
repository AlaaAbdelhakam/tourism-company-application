@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> المستخدمين </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع المستخدمين </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <form action="{{ route('search.users') }}" method="GET">
                                            <input type="text" class="form-control" placeholder="ابحث" name="search"
                                                required />
                                            <br>
                                            <button class="btn btn-primary" type="submit">بحث<i
                                                    class="la la-check-square-o"></i></button>
                                        </form>
                                        <br>
                                        @role('developer')
                                            <a href="{{ route('users.restore.all') }}" class="btn btn-success">Restore All</a>
                                        @endrole

                                        <br>
                                        <br>
                                        {{-- <a href="{{ route('admin.city', ['view_deleted' => 'DeletedRecords']) }}"
                                            class="btn btn-primary">View Delete Records</a> --}}

                                        <br>
                                        <br>
                                        <br>
                                        <table class="table display nowrap table-striped table-bordered ">
                                            <thead class="">
                                                <tr>
                                                    <th>الاسم </th>
                                                    <th> المدينة </th>

                                                    <th>الايميل </th>
                                                    <th scope="col" width="10%">Roles</th>
                                                    <th colspan="3"></th>
                                                    {{-- <th>header 3</th>
                                                    {{-- <th>صوره القسم</th> --}}
                                                    {{-- <th>header 4</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>

                                                {{-- @isset($categories) --}}
                                                {{-- @foreach ($users as $user) --}}
                                                @foreach ($data as $key => $user)
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->getcityname() }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            {{-- @foreach ($user->roles as $role) --}}
                                                            @foreach ($user->getRoleNames() as $v)
                                                                <span class="badge bg-primary">{{ $v }}</span>
                                                            @endforeach
                                                        </td>
                                                        {{-- <td>{{$user -> slug}}</td>
                                                        <td>{{$category -> getActive()}}</td> --}}
                                                        {{-- <td> <img style="width: 150px; height: 100px;" src=" "></td> --}}
                                                        <td>
                                                            @role('superadmin')
                                                                <div class="btn-group" role="group"
                                                                    aria-label="Basic example">
                                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                                        class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                    <a href="{{ route('admin.users.delete', $user->id) }}"
                                                                        class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>



                                                                </div>
                                                            </td>
                                                        @endrole


                                                    </tr>
                                                @endforeach
                                                {{-- @endisset --}}


                                            </tbody>
                                        </table>
                                        @role('developer')

                                            <div class="card-content collapse show">

                                                <div class="card-body card-dashboard">

                                                    <table
                                                        class="table display nowrap table-striped table-bordered scroll-horizontal">
                                                        <thead class="">
                                                            Deleted List
                                                            <tr>
                                                                <th>الاسم </th>
                                                                <th> المدينة </th>

                                                                <th>الايميل </th>
                                                                <th scope="col" width="10%">Roles</th>
                                                                <th colspan="3"></th>
                                                                {{-- <th>صوره القسم</th> --}}

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @isset($tasks_trashed)
                                                                @foreach ($tasks_trashed as $task)
                                                                    <tr>
                                                                        {{-- <td>{{ $task->city_name }}</td> --}}
                                                                        <td>{{ $task->name }}</td>
                                                                        <td>{{ $task->getcityname() }}</td>
                                                                        <td>{{ $task->email }}</td>
                                                                        <td>
                                                                            {{-- @foreach ($user->roles as $role) --}}
                                                                            @foreach ($task->getRoleNames() as $v)
                                                                                <span
                                                                                    class="badge bg-primary">{{ $v }}</span>
                                                                            @endforeach
                                                                        </td>
                                                                        {{-- <td>{{$category -> getActive()}}</td> --}}
                                                                        {{-- <td> <img style="width: 150px; height: 100px;" src=" "></td> --}}
                                                                        <td>
                                                                            <div class="btn-group" role="group"
                                                                                aria-label="Basic example">


                                                                                <a href="{{ route('users.restore', $task->id) }}"
                                                                                    class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">Restore</a>


                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endisset


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endrole

                                        <div class="justify-content-center d-flex">

                                            {!! $data->links() !!}


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop
