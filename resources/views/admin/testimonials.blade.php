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
                        <h1 class="h3 mb-0 text-gray-800">Testimonial</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                    	<div class="col-md-8 m-auto">	
		                    <form method="POST" action="{{route('addTestimonial')}}" enctype="multipart/form-data">

							    <div class="form-group">
							        <label for="exampleInputEmail1">Name</label>
							        <input type="text" class="form-control" name="name" required="">
							    </div>

							    <div class="form-group">
							    	<label>Content</label>
									<textarea class="form-control" rows="10" name="content" required="">
								       
									</textarea>
							    </div>

								<label>Image</label>
								<div class="form-group">
									<input class="form-control" type="file" name="image" required="">
								</div>

								<button class="w-25 float-right btn btn-primary mb-5 btn-block" type="submit"><i class="fas fa-paper-plane"></i> Post</button>
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

                    <div class="row mt-4">
                    	<div class="col-md-8 m-auto">

                    		

                        <div class="card shadow mt-4 mb-4">
	                        <div class="card-header py-3">
	                            <h6 class="m-0 font-weight-bold text-primary">Testimonials</h6>
	                        </div>
	                        @if(!$g->isEmpty())
                        	<div class="card-body">
                            	<div class="table-responsive">
                                	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    	<thead>
                                        	<tr>
	                                            <th># Serial No.</th>
	                                            <th>Name</th>
	                                            <th>Content</th>
	                                            <th>Image</th>
	                                            <th>Actions</th>
                                        	</tr>
                                    	</thead>
                                   		<tbody>
                                   			@foreach($g as $i)
                                        	<tr>
                                        		<td>{{$loop->iteration}}</td>
	                                            <td>{{$i->name}}</td>
	                                            <td>{{$i->content}}</td>
	                                            <td>
	                                            	<img src="{{URL::asset('uploads/testimonials/' . $i->image)}}">
	                                            </td>
	                                            <td>
	                                                <a href="{{ route('deleteTestimonial', $i->id) }}" class="btn btn-circle btn-danger ml-4">
	                                                    <i class="fas fa-trash"></i>
	                                                </a>
	                                                <a href="{{ route('getSingleTestimonial', $i->id) }}" class="btn btn-circle btn-primary">
	                                                    <i class="fas fa-pencil-alt"></i>
	                                                </a>
	                                            </td>
                                        	</tr> 
                                        	@endforeach                                     
                                    	</tbody>
                                	</table>
                            	</div>
                        	</div>
                        	@else
                        	<div class="center w-50 text-center">
                        		<p class="alert alert-warning  mt-3">Not Found</p>
                        	</div>
                        	@endif
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