@php
use App\Http\Controllers\Admin;
@endphp

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
                        <h1 class="h3 mb-0 text-gray-800">Add Tools</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-md-8 m-auto">   
                             <form action="{{route('addTool')}}" method="POST">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control" name="title" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Short Title</label>
                                    <input type="text" class="form-control" name="short_title" required="">
                                </div>
                                 <div class="form-group">
                                 	<label>Content</label>
                                	<textarea rows="20" cols="10" name="content" class="TinyMCE" required="">
                                    Welcome to TinyMCE!
                                	</textarea>
                           		 </div>	


								<div class="form-group">
									 <label>Description</label>
									<textarea class="form-control" rows="5" name="description" required=""></textarea>
								</div>

								
								<div class="form-group">
									<label>Keywords</label>
									<textarea class="form-control" rows="5" name="keywords" required=""></textarea>
								</div>

                                <div class="form-group mt-3">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control" name="slug" required="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Icon Class</label>
                                    <input type="text" class="form-control" name="icon_class" required="">
                                </div>

                                <button class="w-25 float-right btn btn-primary mt-3 mb-5 btn-block"><i class="fas fa-paper-plane"></i> Post</button>
                                @csrf
                              	<div class="form-group w-30-center-alert mt-3" >
	                          	   @if($errors->any())
										<p class="alert alert-danger ">{{$errors->first()}}</p>
								   @endif
								   @if (Session::has('success'))
								   		<p class="alert alert-success">{{ Session::get('success') }}</p>	
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