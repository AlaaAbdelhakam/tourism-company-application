@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> السائق </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> السائق
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
                                        <form action="{{ route('search.driver.action') }}" method="GET">
                                            <input type="text" class="form-control" placeholder="ابحث" name="search"
                                                required />
                                            <br>
                                            <button class="btn btn-primary" type="submit">بحث<i
                                                    class="la la-check-square-o"></i></button>
                                        </form>
                                        <br>
                                        @role('developer')

                                        <a href="{{ route('drivers.restore.all') }}" class="btn btn-success">Restore
                                            All</a>
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
                                                    <th> تاريخ الميلاد</th>
                                                    <th>العنوان</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                {{-- @isset($tags) --}}
                                                @foreach ($drivers as $driver)
                                                    <tr>
                                                        <td>{{ $driver->driver_name }}</td>
                                                        <td>{{ $driver->Date_of_birth->format('Y-m-d') }}</td>
                                                        <td>{{ $driver->address }}</td>
                                                        <td>

                                                            <div class="btn-group" role="group"
                                                                aria-label="Basic example">
                                                                <a href="{{ route('admin.drivers.edit', $driver->id) }}"
                                                                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                <a href="{{ route('admin.drivers.delete', $driver->id) }}"
                                                                    class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>



                                                            </div>

                                                        </td>
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
                                                                <th> تاريخ الميلاد</th>
                                                                <th>العنوان</th>
                                                                {{-- <th>صوره القسم</th> --}}

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @isset($tasks_trashed)
                                                                @foreach ($tasks_trashed as $task)
                                                                    <tr>
                                                                        {{-- <td>{{ $task->city_name }}</td> --}}
                                                                        <td>{{ $task->driver_name }}</td>
                                                                        <td>{{ $task->Date_of_birth->format('Y-m-d') }}</td>
                                                                        <td>{{ $task->address }}</td>
                                                                        {{-- <td>{{$category -> getActive()}}</td> --}}
                                                                        {{-- <td> <img style="width: 150px; height: 100px;" src=" "></td> --}}
                                                                        <td>
                                                                            <div class="btn-group" role="group"
                                                                                aria-label="Basic example">


                                                                                <a href="{{ route('drivers.restore', $task->id) }}"
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

                                            {{-- {!! $drivers->links() !!} --}}
                                            {{ $drivers->links() }}
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
