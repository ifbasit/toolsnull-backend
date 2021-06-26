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
                        @if($g !== null) 
                            <form action="{{route('updateArticle')}}" method="POST" enctype="multipart/form-data">
							    <div class="form-group">
							        <label for="exampleInputEmail1">Title</label>
							        <input type="text" class="form-control" name="title" required="" value="{{$g->title}}">
							    </div>

							    <label>Content</label>
								<textarea rows="20" cols="10" name="content" class="TinyMCE" required="">{{$g->content}}</textarea>
								<input type="hidden" name="article_id" value="{{$g->article_id}}">
								<label class="mt-4">Categories</label>
								<div class="form-group">
									<select class="form-control w-100"  id="type" name="cat_id" required="">
								      @foreach($t as $i)
                                        	<option value="{{$i->id}}" @if($i->id == $g->cat_id)  selected=""  @endif >{{$i->cat_name}}</option>
                                        @endforeach
								    </select>
								</div>

								<label>Current Image:</label>
								<div class="form-group">
									<img src="{{URL::asset('uploads/articles/' . $g->image)}}" style="width: 10%">
								</div>
								<label>Image</label>
								<div class="form-group">
									<input class="form-control" type="file" name="image">
								</div>

								<label>Description</label>
								<div class="form-group">
									<textarea class="form-control" rows="5" name="description" required="">{{$g->description}}</textarea>
								</div>

								<label>Keywords</label>
								<div class="form-group">
									<textarea class="form-control" rows="5" name="keywords" required="">{{$g->keywords}}</textarea>
								</div>
								<a href="{{ route('articles') }}" class="float-left btn btn-default  mb-5" >
                                        <i class="fas fa-undo"></i> Back</a>
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