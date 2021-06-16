@include('admin.inc.header')
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-8 col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5 text-center">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{route('adminLogin')}}">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="user_name" 
                                                placeholder="Enter Username..." required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Password" required="">
                                        </div>
                                       <button class="btn btn-primary btn-user btn-block" type="submit">Login</button>
                                       @csrf
                                       @if($errors->any())
										<p class="alert alert-danger mt-4">{{$errors->first()}}</p>
									   @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<script src="{{asset('admin-assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin-assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('admin-assets/js/sb-admin-2.min.js')}}"></script>

</body>

</html>