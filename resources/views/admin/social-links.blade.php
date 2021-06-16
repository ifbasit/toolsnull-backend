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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Social Links</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-md-8 m-auto">

                            <form method="POST" action="{{route('updateSocialLinks')}}">
                              <div class="row mb-4">
                                <div class="col">
                                  <label>Facebook</label>
                                  <input type="url" class="form-control" name="facebook" value="@if($g) {{$g->facebook}} @endif">
                                </div>
                                <div class="col">
                                  <label>Twitter</label>
                                  <input type="url" class="form-control" name="twitter" value="@if($g) {{$g->twitter}} @endif">
                                </div>
                              </div>
                              <div class="row mb-4">
                                <div class="col">
                                  <label>Instagram</label>
                                  <input type="url" class="form-control" name="instagram" value="@if($g) {{$g->instagram}} @endif">
                                </div>
                                <div class="col">
                                  <label>Linkedin</label>
                                  <input type="url" class="form-control" name="linkedin" value="@if($g) {{$g->linkedin}} @endif">
                                </div>
                              </div>
                              <div class="row mb-4">
                                <div class="col">
                                  <label>Whatsapp</label>
                                  <input type="text" class="form-control" name="whatsapp" value="@if($g) {{$g->whatsapp}} @endif">
                                </div>
                                <div class="col">
                                  <label>Skype</label>
                                  <input type="text" class="form-control" name="skype" value="@if($g) {{$g->skype}} @endif">
                                </div>
                              </div>
                              <button class="btn btn-primary btn-block w-25 float-right" type="submit"><i class="fas fa-paper-plane"></i> Post</button>
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