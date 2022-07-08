
@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> تعديل بيانات الرحلة </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل 
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل بيانات الرحلة </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
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
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('admin.trip.update',$trip->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <input name="id" value="{{$trip->id}}" type="hidden">

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i>تعديل الرحلة </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الوجهه
                                                            </label>
                                                            <input type="text" id="route_name" class="form-control"
                                                                placeholder="  " value="{{ old('route_name') }}"
                                                                name="route_name">
                                                            @error('route_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> كود التشغيل
                                                            </label>
                                                            <input type="text" id="work_code" class="form-control"
                                                                placeholder="  " value="{{ old('work_code') }}"
                                                                name="work_code">
                                                            @error('work_code')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> كم البداية
                                                            </label>
                                                            <input type="number" id="Km_start" class="form-control"
                                                                placeholder="  " value="{{ old('Km_start') }}"
                                                                name="Km_start">
                                                            @error('Km_start')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> كم النهاية
                                                            </label>
                                                            <input type="number" id="km_end" class="form-control"
                                                                placeholder="  " value="{{ old('km_end') }}"
                                                                name="km_end">
                                                            @error('km_end')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> تاريخ الرحلة
                                                            </label>
                                                            <div class='input-group date' id='datetimepicker2'>
                                                                <input type='text' name="Date_of_trip"
                                                                    class="form-control" />
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> وقت المغادرة

                                                            </label>
                                                            <div class='input-group date' id='datetimepicker2'>
                                                                {{-- <input type='text' name="time_out" class="form-control" /> --}}
                                                                <input type="time" name="time_out" class="form-control" required >
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-time"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> وقت العودة
                                                            </label>
                                                            <div class='input-group date' id='datetimepicker2'>
                                                                {{-- <input type='text' name="time_in" class="form-control" /> --}}
                                                                <input type="time" name="time_in" class="form-control" required >
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-time"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                   


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر الشركة المتعامل معها
                                                            </label>
                                                            <select name="company_id" class="select1 form-control">
                                                                <optgroup label="من فضلك أختر الشركة ">
                                                                    {{-- @if ($models && $models->count() > 0) --}}
                                                                    @foreach ($companies as $company)
                                                                        <option value="{{ $company->id }}">
                                                                            {{ $company->company_name }}</option>
                                                                    @endforeach
                                                                    {{-- @endif --}}
                                                                </optgroup>
                                                            </select>
                                                            @error('company_id')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>







                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر السيارة
                                                            </label>
                                                            <select name="car_id" class="select1 form-control">
                                                                <optgroup label="من فضلك أختر السيارة ">
                                                                    {{-- @if ($models && $models->count() > 0) --}}
                                                                    @foreach ($cars as $car)
                                                                        <option value="{{ $car->id }}">
                                                                            {{ $car->car_code }}</option>
                                                                    @endforeach
                                                                    {{-- @endif --}}
                                                                </optgroup>
                                                            </select>
                                                            @error('car_id')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                               

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر السائق
                                                            </label>
                                                            <select name="driver_id" class="select1 form-control">
                                                                <optgroup label="من فضلك أختر السائق ">
                                                                    {{-- @if ($models && $models->count() > 0) --}}
                                                                    @foreach ($drivers as $driver)
                                                                        <option value="{{ $driver->id }}">
                                                                            {{ $driver->driver_name }}</option>
                                                                    @endforeach
                                                                    {{-- @endif --}}
                                                                </optgroup>
                                                            </select>
                                                            @error('driver_id')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر السائق الاحتياطي
                                                            </label>
                                                            <select name="co_driver_id" class="select1 form-control">
                                                                <optgroup label="من فضلك أختر السائق الاحتياطي ">
                                                                    {{-- @if ($models && $models->count() > 0) --}}
                                                                    @foreach ($codrivers as $codriver)
                                                                        <option value="{{ $codriver->id }}">
                                                                            {{ $codriver->co_driver_name }}</option>
                                                                    @endforeach
                                                                    {{-- @endif --}}
                                                                </optgroup>
                                                            </select>
                                                            @error('co_driver_id')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                
                                                   
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1" class="hidden">  المستخدم المدخل
                                                            </label>
                                                            <select name="user_id" class="select1 form-control hidden" >
                                                                <optgroup label="من فضلك أختر السائق الاحتياطي ">
                                                                     {{-- @if ($users && $users->count() > 0)  --}}
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}">
                                                                            {{ $user->name }}</option>
                                                                    @endforeach
                                                                     {{-- @endif  --}}
                                                                </optgroup>
                                                            </select>
                                                            @error('user_id')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1" class="hidden"> اختر المدينة
                                                        </label>
                                                        <select name="city_id" class="select1 form-control hidden" >
                                                            <optgroup label="من فضلك أختر المدينة ">
                                                                {{-- @if ($models && $models->count() > 0) --}}
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->id }}">
                                                                        {{ $city->city_name }}</option>
                                                                @endforeach
                                                                {{-- @endif --}}
                                                            </optgroup>
                                                        </select>
                                                        @error('car_model_id')
                                                            <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@stop