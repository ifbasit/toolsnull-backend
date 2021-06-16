@include('admin.inc.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       @include('admin.inc.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               @include('admin.inc.top-bar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                   <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Password</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row align-items-center justify-content-center">
                    	<div class="col-md-6 m-auto ">	
		                    <form method="POST" action="{{route('updatePassword')}}">

							    <div class="form-group">
							        <label for="exampleInputEmail1">Old Password</label>
							        <input type="Password" class="form-control" name="old_password" required="">
							    </div>
							     <div class="form-group">
							        <label for="exampleInputEmail1">New Password</label>
							        <input type="Password" class="form-control" name="new_password" required="">
							    </div>
							     <div class="form-group">
							        <label for="exampleInputEmail1">Confirm New Password</label>
							        <input type="Password" class="form-control" name="confirm_password" required="">
							    </div>

								<button class="w-25 float-right btn btn-primary mb-5 btn-block" type="submit"><i class="fas fa-paper-plane"></i> Update</button>
								@csrf
                                  <div class="form-group" style="width:50%">
                                  	@if($errors->any())
										<p class="alert alert-danger mt-5">{{$errors->first()}}</p>
								   @endif
								   @if (Session::has('success'))
								   		<p class="alert alert-success mt-5">{{ Session::get('success') }}</p>	
								   @endif
                                  </div>
							</form>

                    	</div>
                    </div>


                </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@include('admin.inc.footer')

</body>

</html>