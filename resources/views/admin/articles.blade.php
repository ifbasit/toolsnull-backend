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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Article</h1>
                        
                    </div>
                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-md-8 m-auto">   
                            <form action="{{route('addArticle')}}" method="POST" enctype="multipart/form-data">
							    <div class="form-group">
							        <label for="exampleInputEmail1">Title</label>
							        <input type="text" class="form-control" name="title" required="" >
							    </div>

							    <label>Content</label>
								<textarea rows="20" cols="10" name="content" id="post_content" class="TinyMCE" required="">
							        Welcome to TinyMCE!
								</textarea>

								<label class="mt-4">Categories</label>
								<div class="form-group">
									<select class="form-control w-100"  id="type" name="cat_id" required="">
								      @foreach($t as $i)
                                        	<option value="{{$i->id}}">{{$i->cat_name}}</option>
                                        @endforeach
								    </select>
								</div>

								<label>Image</label>
								<div class="form-group">
									<input class="form-control" type="file" name="image" required="">
								</div>

								<label>Description</label>
								<div class="form-group">
									<textarea class="form-control" rows="5" name="description" required=""></textarea>
								</div>

								<label>Keywords</label>
								<div class="form-group">
									<textarea class="form-control" rows="5" name="keywords" required=""></textarea>
								</div>
								<button class="w-25 float-right btn btn-primary mb-5 btn-block" type="submit"><i class="fas fa-paper-plane"></i> Post</button>
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
                <div class="container-fluid ">


                    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mt-4 mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Articles</h6>
                        </div>
                         @if(!$g->isEmpty())
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($g as $i)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$i->title}}</td>
                                                <td>{{$i->description}}</td>
                                                <td>{{$i->cat_name}}</td>
                                                <td>{{$i->added_date}}</td>
                                                <td>
                                                    <a href="{{ route('deleteArticle', $i->article_id) }}" class="btn btn-circle btn-danger ml-4">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="{{ route('getSingleArticle', $i->article_id) }}" class="btn btn-circle btn-primary">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-circle btn-success">
                                                        <i class="fas fa-eye"></i>
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@include('admin.inc.footer')

</body>

</html>