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
                        <h1 class="h3 mb-0 text-gray-800">Add Code Solution</h1>
                        
                    </div>
                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-md-8 m-auto">   
                            <form action="{{route('addCodeSolution')}}" method="POST">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control" required="" name="title">
                                </div>

                                <label>Content</label>
                                <textarea rows="20" cols="10" id="post_content" name="content" class="TinyMCE"></textarea>

                                <div class=" mt-4">
                                  <label for="tags">Choose tags:</label>
                                    <select class="form-control" name="tags[]"  multiple>
                                    	@foreach($t as $i)
                                        	<option value="{{$i->id}}">{{$i->name}}</option>
                                        @endforeach
                                    </select>  
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
                <div class="container-fluid ">


                    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mt-4 mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Code Solutions</h6>
                        </div>
                         @if(!$g->isEmpty())
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Views</th>
                                            <th>Tags</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($g as $i)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$i->title}}</td>
                                                <td>{{$i->views}}</td>
                                                <td>{{Admin::getTagsNameByCodeSolutionID($i->code_solution_id)}}</td>
                                                <td>
                                                    <a href="{{ route('deleteCodeSolution', $i->code_solution_id) }}" class="btn btn-circle btn-danger ml-4">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="{{ route('getSingleCodeSolution', $i->code_solution_id) }}" class="btn btn-circle btn-primary">
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