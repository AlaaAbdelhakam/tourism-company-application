@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> السيارات </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">الرحلات
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
                                    <h4 class="card-title">جميع الرحلات </h4>
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


                                        <form action="{{ route('search.trips') }}" method="GET">
                                            <input type="text" class="form-control" placeholder="ابحث" name="search"
                                                required />
                                            <br>
                                            <div class="btn-group">
                                                <button class="btn btn-primary mr-1 mb-1" type="submit">بحث<i
                                                        class="la la-check-square-o"></i></button>
                                        </form>
                                        <br>
                                        <br>
                                        <a href="{{ route('report') }}" class="btn btn-primary mr-1 mb-1">بحث بالتاريخ و
                                            المدينة
                                            معا<i class="la la-check-square-o"></i></a>
                                        <br>
                                        <br>
                                    </div>

                                    @role('developer')
                                        <a href="{{ route('trip.restore.all') }}" class="btn btn-success">Restore All</a>
                                    @endrole

                                    <br>
                                    <br>
                                    {{-- <a href="{{ route('admin.city', ['view_deleted' => 'DeletedRecords']) }}"
                                            class="btn btn-primary">View Delete Records</a> --}}

                                    <br>
                                    <br>

                                    <table class="table display nowrap table-striped table-bordered scroll-vertical">
                                        <thead class="">
                                            <tr>
                                                {{-- <th width="1%" colspan="1">id</th > --}}
                                                <th width="1%" colspan="1">تاريخ الرحلة</th>
                                                {{-- @role('editor') --}}
                                                <th width="1%" colspan="1">المدينة</th>
                                                {{-- @endrole --}}

                                                <th width="1%" colspan="1">السيارة</th>
                                                <th width="1%" colspan="1">السائق</th>
                                                <th width="1%" colspan="1">السائق الاحتياطي</th>
                                                <th width="1%" colspan="1">لشركة</th>
                                                <th width="1%" colspan="1">المسخدم المدخل</th>
                                                <th width="1%" colspan="1">المسار</th>
                                                <th width="1%" colspan="1">كود التشغيل</th>
                                                <th width="1%" colspan="1">كم البداية</th>
                                                <th width="1%" colspan="1">كم النهاية</th>
                                                <th width="1%" colspan="1">المسافة الكلية</th>

                                                <th width="1%" colspan="1">توقيت المغادرة</th>
                                                <th width="1%" colspan="1">توقيت العودة</th>
                                                <th width="1%" colspan="1">الوقت الكلي</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($trips)
                                                @foreach ($trips as $trip)
                                                    <tr>
                                                        <td>{{ $trip->Date_of_trip->format('Y-m-d') }}</td>

                                                        {{-- <td>{{ $trip->id }}</td> --}}
                                                        {{-- @role('editor') --}}
                                                        <td>{{ $trip->getcityname() }}</td>
                                                        {{-- @endrole --}}

                                                        <td>{{ $trip->getCardata() }}</td>
                                                        <td>{{ $trip->getdrivername() }}</td>
                                                        <td>{{ $trip->getCodrivername() }}</td>
                                                        <td>{{ $trip->getCompanyname() }}</td>
                                                        <td>{{ $trip->getusername() }}</td>
                                                        <td>{{ $trip->route_name }}</td>
                                                        <td>{{ $trip->work_code }}</td>
                                                        <td>{{ $trip->Km_start }}</td>
                                                        <td>{{ $trip->km_end }}</td>
                                                        <td>{{ $trip->total_distance }}</td>
                                                        <td>{{ date('H:i:s', strtotime($trip->time_out)) }}</td>
                                                        <td>{{ date('H:i:s', strtotime($trip->time_in)) }}</td>
                                                        <td>{{ date('H:i', strtotime($trip->total_time)) }}</td>
                                                        {{-- <td>{{ $trip->total_time }}</td> --}}

                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="{{ route('admin.trip.edit', $trip->id) }}"
                                                                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                                <a href="{{ route('admin.trip.delete', $trip->id) }}"
                                                                    class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset


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
                                                            <th width="1%" colspan="1">تاريخ الرحلة</th>
                                                            <th width="1%" colspan="1">المدينة</th>
                                                            <th width="1%" colspan="1">السيارة</th>
                                                            <th width="1%" colspan="1">السائق</th>
                                                            <th width="1%" colspan="1">السائق الاحتياطي</th>
                                                            <th width="1%" colspan="1">لشركة</th>
                                                            <th width="1%" colspan="1">المسخدم المدخل</th>
                                                            <th width="1%" colspan="1">المسار</th>
                                                            <th width="1%" colspan="1">كود التشغيل</th>
                                                            <th width="1%" colspan="1">كم البداية</th>
                                                            <th width="1%" colspan="1">كم النهاية</th>
                                                            <th width="1%" colspan="1">المسافة الكلية</th>

                                                            <th width="1%" colspan="1">توقيت المغادرة</th>
                                                            <th width="1%" colspan="1">توقيت العودة</th>
                                                            <th width="1%" colspan="1">الوقت الكلي</th>
                                                            {{-- <th>صوره القسم</th> --}}

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @isset($tasks_trashed)
                                                            @foreach ($tasks_trashed as $task)
                                                                <tr>
                                                                    {{-- <td>{{ $task->city_name }}</td> --}}
                                                                    <td>{{ $task->getcityname() }}</td>
                                                                    <td>{{ $task->getCardata() }}</td>
                                                                    <td>{{ $task->getdrivername() }}</td>
                                                                    <td>{{ $task->getCodrivername() }}</td>
                                                                    <td>{{ $task->getCompanyname() }}</td>
                                                                    <td>{{ $task->getusername() }}</td>
                                                                    <td>{{ $task->route_name }}</td>
                                                                    <td>{{ $task->work_code }}</td>
                                                                    <td>{{ $task->Km_start }}</td>
                                                                    <td>{{ $task->km_end }}</td>
                                                                    <td>{{ $task->total_distance }}</td>
                                                                    <td>{{ date('H:i:s', strtotime($task->time_out)) }}</td>
                                                                    <td>{{ date('H:i:s', strtotime($task->time_in)) }}</td>
                                                                    <td>{{ date('H:i', strtotime($task->total_time)) }}</td>
                                                                    {{-- <td>{{$category -> getActive()}}</td> --}}
                                                                    {{-- <td> <img style="width: 150px; height: 100px;" src=" "></td> --}}
                                                                    <td>
                                                                        <div class="btn-group" role="group"
                                                                            aria-label="Basic example">


                                                                            <a href="{{ route('trip.restore', $task->id) }}"
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
                                        {{-- {{ $trips->links() }} --}}

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
