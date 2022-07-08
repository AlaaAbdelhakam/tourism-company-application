
 @extends('layouts.admin')
{{-- 
 <body>
  <br /> --}}
  @section('content')
  <div class="app-content content">
    <div class="content-wrapper">
  <div class="container box">
   <h3 >البحث عن السائق الاحتياطي</h3><br />
   <div class="panel panel-default">
    <div class="panel-heading">بحث</div>
    <div class="panel-body">
     <div class="form-group">
      <form action="{{ route('search.codrivers') }}" method="GET">
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
         <th>الاسم </th>
        <th>تاريخ الميلاد</th>
         {{-- <th>العنوان</th>
          <th>تعديل</th> --}}
        </tr>
       </thead>
       <tbody>
        @if($codrivers->isNotEmpty())
        @foreach ($codrivers as $codriver)
        <tr>
          {{-- <td>{{ $codriver->id }}</td> --}}
          <td>{{ $codriver->co_driver_name }}</td>
          <td>{{ $codriver->Date_of_birth }}</td>
          {{-- <td>{{ $user->address }}</td> --}}
          <td>
            <div class="btn-group" role="group"
                aria-label="Basic example">
                <a href="{{ route('admin.codriver.edit', $codriver->id) }}"
                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                <a href="{{ route('admin.codriver.delete', $codriver->id) }}"
                    class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>



            </div>
        </td>
      </tr>
      @endforeach
      @else 
          <div>
              <h2>بيانات هذا السائق الاحتياطي غير موجودة</h2>
          </div>
      @endif
       </tbody>
      </table>
      <div class="justify-content-center d-flex">
        {!! $codrivers->links() !!}
    </div>
     </div>
    </div>    
   </div>
  </div>
</div>
</div>
  @stop
 