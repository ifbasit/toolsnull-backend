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
                        <h1 class="h3 mb-0 text-gray-800">Update Tool</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-md-8 m-auto"> 
                         @if($g !== null)   
                             <form action="{{route('updateTool')}}" method="POST">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control" name="title" required="" value="{{$g->title}}">
                                </div>
                                <input type="hidden" name="tool_id" value="{{$g->tool_id}}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Short Title</label>
                                    <input type="text" class="form-control" name="short_title" required="" value="{{$g->short_title}}">
                                </div>
                                 <div class="form-group">
                                 	<label>Content</label>
                                	<textarea rows="20" cols="10" name="content" class="TinyMCE" required="" value="">{{$g->content}}
                                	</textarea>
                           		 </div>	


								<div class="form-group">
									 <label>Description</label>
									<textarea class="form-control" rows="5" name="description" required="">{{$g->description}}</textarea>
								</div>

								
								<div class="form-group">
									<label>Keywords</label>
									<textarea class="form-control" rows="5" name="keywords" required="">{{$g->keywords}}</textarea>
								</div>

                                <div class="form-group mt-3">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control" name="slug" required="" value="{{$g->slug}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Icon Class</label>
                                    <input type="text" class="form-control" name="icon_class" required="" value="{{$g->icon_class}}">
                                </div>
                                <a href="{{ route('tools') }}" class="float-left btn btn-default mt-3  mb-5" >
                                        <i class="fas fa-undo"></i> Back</a>
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
                            @else
								<div class="center w-50 text-center">
	                        		<p class="alert alert-danger  mt-3">Not Found</p>
	                        	</div>
                        	@endif
                        </div>
                    </div>

                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@include('admin.inc.footer')

</body>

</html>