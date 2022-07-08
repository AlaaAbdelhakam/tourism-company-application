<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">


    <style>
    #list1 .form-control {
        border-color: transparent;
    }
    #list1 .form-control:focus {
        border-color: transparent;
        box-shadow: none;
        }
    #list1 .select-input.form-control[readonly]:not([disabled]) {
    background-color: #fbfbfb;
    }
    </style>

</head>
<body>
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
       
          <div class="card-body py-4 px-4 px-md-5">
           
            <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                             
                                
                          
           <a class="nav-link" href="{{ route('login') }}">Welcome Press here to login into your list</a>
            </p>
            <hr class="my-4">
            
          


{{-- 
<a class="nav-link d-none" href="{{  URL::temporarySignedRoute('register', now()->addMinutes(30));  }}">{{ __('Register link') }}</a> --}}


          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>