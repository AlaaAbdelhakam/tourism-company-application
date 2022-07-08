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
                                <li class="breadcrumb-item active">السيارات
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
                                    <h4 class="card-title">جميع السيارات </h4>
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
                                        <form action="{{ route('search.car') }}" method="GET">
                                            <input type="text" class="form-control" placeholder="ابحث" name="search" required/>
                                            <br>
                                            <button class="btn btn-primary" type="submit">بحث<i class="la la-check-square-o"></i></button>
                                        </form>
                                        <br>
                                        @role('developer')
                                        <a href="{{ route('car.restore.all') }}" class="btn btn-success">Restore All</a>
                                        @endrole

                                        <br>
                                        <br>
                                        {{-- <a href="{{ route('admin.city', ['view_deleted' => 'DeletedRecords']) }}"
                                            class="btn btn-primary">View Delete Records</a> --}}

                                        <br>
                                        <br>
                                        <br>
                                        <table class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                                <tr>
                                                    <th>السعة</th>
                                                    <th>رقم اللوحة</th>
                                                    <th>الموديل</th>
                                                    <th>كود السيارة</th>
                                                    <th>كمية استهلاك السولار لكل100 كم</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @isset($cars)
                                                    @foreach ($cars as $car)
                                                        <tr>
                                                            <td>{{ $car->capacity }}</td>
                                                            <td>{{ $car->plate_no }}</td>
                                                            <td>{{ $car->getCarModel() }}</td>
                                                            <td>{{ $car->car_code }}</td>
                                                            <td>{{ $car->expected_amount_of_solar_for_100Km }}</td>
                                                            <td>
                                                                <div class="btn-group" role="group"
                                                                    aria-label="Basic example">
                                                                    <a href="{{ route('admin.cars.edit', $car->id) }}"
                                                                        class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                                    <a href="{{ route('admin.cars.delete', $car->id) }}"
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
                                                            <th>السعة</th>
                                                            <th>رقم اللوحة</th>
                                                            <th>الموديل</th>
                                                            <th>كود السيارة</th>
                                                            <th>كمية استهلاك السولار لكل100 كم</th>
                                                            {{-- <th>صوره القسم</th> --}}

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @isset($tasks_trashed)
                                                            @foreach ($tasks_trashed as $task)
                                                                <tr>
                                                                    {{-- <td>{{ $task->city_name }}</td> --}}
                                                                    <td>{{ $task->capacity }}</td>
                                                                    <td>{{ $task->plate_no }}</td>
                                                                    <td>{{ $task->getCarModel() }}</td>
                                                                    <td>{{ $task->car_code }}</td>
                                                                    <td>{{ $task->expected_amount_of_solar_for_100Km }}</td>
                                                                    {{-- <td>{{$category -> getActive()}}</td> --}}
                                                                    {{-- <td> <img style="width: 150px; height: 100px;" src=" "></td> --}}
                                                                    <td>
                                                                        <div class="btn-group" role="group"
                                                                            aria-label="Basic example">


                                                                            <a href="{{ route('car.restore', $task->id) }}"
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
                                            {{ $cars->links() }}

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
