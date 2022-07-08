
 @extends('layouts.admin')
{{-- 
 <body>
  <br /> --}}
  @section('content')
  <div class="app-content content">
    <div class="content-wrapper">
  <div class="container box">
   <h3 >البحث عن سيارة</h3><br />
   <div class="panel panel-default">
    <div class="panel-heading">بحث</div>
    <div class="panel-body">
     <div class="form-group">
      <form action="{{ route('search.car') }}" method="GET">
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
         <th>السعة</th>
         <th>رقم اللوحة</th>
         <th>الموديل</th>
         <th>كود السيارة</th>
         <th>كمية استهلاك السولار لكل100 كم</th>
       
        </tr>
       </thead>
       <tbody>
        @if($cars->isNotEmpty())
        @foreach ($cars as $car)
        <tr>
          {{-- <td>{{ $car->id }}</td> --}}
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
      @else 
          <div>
              <h2>بيانات هذة السيارة غير موجودة</h2>
          </div>
      @endif
       </tbody>
      </table>
      <div class="justify-content-center d-flex">
        {!! $cars->links() !!}
    </div>
     </div>
    </div>    
   </div>
  </div>
</div>
</div>
  @stop
 
 