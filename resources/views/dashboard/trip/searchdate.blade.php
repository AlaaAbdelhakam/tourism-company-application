@extends('layouts.admin')
@push('style')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush


@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="container box">
                <h3>البحث عن رحلة</h3><br />
                <div class="panel panel-default">
                    <div class="panel-heading">بحث</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <form action="{{ route('report') }}" method="GET">
                                <label for="">من تاريخ</label>
                                <input type="date" class="form-control" name="start_date">

                                {{-- <input type="text" class="form-control"
                                    placeholder="ابحث عن طريق التاريخ او المسار او كود التشغيل" name="search" required /> --}}
                                <br>
                                <label for="">الى تاريخ</label>
                                <input type="date" class="form-control" name="end_date">
                                <br>
                                <br>
                                <input type="text" class="form-control" placeholder="اكتب اسم المدينة" name="search"
                                    required />
                               
                        </div>
                        <button class="btn btn-primary" type="submit">بحث<i class="la la-check-square-o"></i></button>
                        </form>
                       
                    </div>
                    <div class="table-responsive">
                        {{-- <h3 >مجموع النتائج : <span id="total_records"></span></h3> --}}

                        <table class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th width="1%" colspan="1">تاريخ الرحلة</th>

                                    {{-- <th width="1%" colspan="1">id</th > --}}
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
                                </tr>
                            </thead>
                            <tbody>
                                @if ($trips->isNotEmpty())
                                    @foreach ($trips as $trip)
                                        <tr>
                                            {{-- <td>{{ $trip->id }}</td> --}}
                                            <td>{{ $trip->Date_of_trip->format('Y-m-d') }}</td>

                                            <td>{{ $trip->getcityname() }}</td>
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
                                @else
                                    <div>
                                        {{-- <h2>بيانات هذة الرحلة غير موجودة</h2> --}}
                                    </div>
                                @endif
                            </tbody>
                        </table>
                        <div class="justify-content-center d-flex">
                            {{-- {!! $trips->links() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
