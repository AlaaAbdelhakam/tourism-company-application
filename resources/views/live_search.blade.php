
 @extends('layouts.admin')

  @section('content')
  <div class="app-content content">
    <div class="content-wrapper">
  <div class="container box">
   <h3 >Live search in Integrated Co.</h3><br />
   <div class="panel panel-default">
    <div class="panel-heading">Search </div>
    <div class="panel-body">
     <div class="form-group">
      <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
     </div>
     <div class="table-responsive">
      <h3 >Total Data : <span id="total_records"></span></h3>
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         {{-- <th>ID</th> --}}
         <th>Title</th>
         <th>description</th>
         <th>body</th>
          <th>Show it</th>
        </tr>
       </thead>
       <tbody>

       </tbody>
      </table>
     </div>
    </div>    
   </div>
  </div>
</div>
</div>
  @endsection
