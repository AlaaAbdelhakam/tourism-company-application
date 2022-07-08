
 @extends('layouts.admin')
{{-- 
 <body>
  <br /> --}}
  @section('content')
  <div class="app-content content">
    <div class="content-wrapper">
  <div class="container box">
   <h3 >البحث عن سائق</h3><br />
   <div class="panel panel-default">
    <div class="panel-heading">بحث</div>
    <div class="panel-body">
     <div class="form-group">
      <form action="{{ route('search.driver.action') }}" method="GET">
        <input type="text" class="form-control" placeholder="ابحث" name="search" required/>
        <br>
        <button class="btn btn-primary" type="submit">بحث<i class="la la-check-square-o"></i></button>
      </form>
      </div>
     <div class="table-responsive">
      {{-- <h3 >مجموع النتائج : <span id="total_records"></span></h3> --}}

      <table class="table table-striped table-bordered">
      
       <thead>
        <tr>
         {{-- <th>ID</th> --}}
         <th>الاسم</th>
         <th>تاريخ الميلاد</th>
         <th>العنوان</th>
          <th>تعديل</th>
        </tr>
       </thead>
       <tbody>
        @if($drivers->isNotEmpty())
        @foreach ($drivers as $driver)
        <tr>
          {{-- <td>{{ $driver->id }}</td> --}}
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
      @else 
          <div>
              <h2>بيانات هذا السائق غير موجودة</h2>
          </div>
      @endif
       </tbody>
      </table>
      <div class="justify-content-center d-flex">
        {!! $drivers->links() !!}
    </div>
     </div>
    </div>    
   </div>
  </div>
</div>
</div>
  @stop
 
