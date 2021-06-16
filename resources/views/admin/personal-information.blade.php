@include('admin.inc.header')
<!-- t -->
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Information</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-md-8 m-auto">

                            <form method="POST" action="{{route('updatePersonalInformation')}}">
                              <div class="row mb-4">
                                <div class="col">
                                  <label>Date Of Birth</label>
                                  <input type="text" class="form-control" name="dob" value="@if($g) {{$g->dob}} @endif ">
                                </div>
                                <div class="col">
                                  <label>Address</label>
                                  <input type="text" class="form-control" name="address" value="@if($g) {{$g->address}} @endif ">
                                </div>
                              </div>
                              <div class="row mb-4">
                                <div class="col">
                                  <label>Personal Email</label>
                                  <input type="email" class="form-control" name="per_email" value="@if($g) {{$g->per_email}} @endif ">
                                </div>
                                <div class="col">
                                  <label>Professional Email</label>
                                  <input type="email" class="form-control" name="pro_email" value="@if($g) {{$g->pro_email}} @endif ">
                                </div>
                              </div>
                              <div class="row mb-4">
                                <div class="col">
                                  <label>Mobile</label>
                                  <input type="text" class="form-control" name="mobile" value="@if($g) {{$g->mobile}} @endif ">
                                </div>
                                 <div class="col">
                                  <label>Tag Line</label>
                                  <input type="text" class="form-control" name="tagline" value="@if($g) {{$g->tagline}} @endif ">
                                </div>
                              </div>
                              <button class="btn btn-primary btn-block w-25 float-right"><i class="fas fa-paper-plane"></i> Post</button>
                              @csrf
                              <div class="form-group" style="width:50%">
                              	@if($errors->any())
									<p class="alert alert-danger mt-5">{{$errors->first()}}</p>
							   @endif
							   @if (Session::has('success'))
							   		<p class="alert alert-success mt-5">{{ Session::get('success') }}</p>	
							   @endif
                            </form>
                            
                            
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@include('admin.inc.footer')

</body>

</html>