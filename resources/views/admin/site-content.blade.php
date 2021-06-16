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
                        <h1 class="h3 mb-0 text-gray-800">Site Content</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-md-8 m-auto">   
                            <form method="POST" action="{{route('updateSiteContent')}}">

                                 <label>About Me</label>
                                <textarea rows="20" cols="10" name="about_me" class="TinyMCE">
                                   @if($g) {{$g->about_me}} @endif
                                </textarea>

                                 <label class="mt-3">Hire Me</label>
                                <textarea rows="20" cols="10" name="hire_me" class="TinyMCE">
                                   @if($g) {{$g->hire_me}} @endif
                                </textarea>
                                 <label class="mt-3">About Site</label>
                                <textarea rows="20" cols="10" name="about_site" class="TinyMCE">
                                   @if($g) {{$g->about_site}} @endif
                                </textarea>


                                <button class="w-25 float-right btn btn-primary mt-3 mb-5 btn-block" type="submit"><i class="fas fa-paper-plane"></i> Post</button>
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@include('admin.inc.footer')

</body>

</html>