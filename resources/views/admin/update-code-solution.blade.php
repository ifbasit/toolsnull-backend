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
                            <form action="{{route('updateCodeSolution')}}" method="POST">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" value="{{$g->title}}" class="form-control" required="" name="title">
                                </div>

                                <label>Content</label>
                                <textarea rows="20" cols="10" id="post_content" name="content" class="TinyMCE">{{$g->content}}</textarea>
                                <input type="hidden" name="code_solution_id" value="{{$g->code_solution_id}}">
                                <div class="mt-4">
                                	<label for="">Current Tags</label>
                                	{{Admin::getTagsNameByCodeSolutionID($g->code_solution_id)}}
                                </div>
                                <div class=" mt-4">
                                  <label for="tags">Choose tags:</label>
                                    <select class="form-control" name="tags[]"  multiple>
                                    	@foreach($t as $i)
										    @php $selected=false; @endphp
											@foreach(Admin::getTagsByCodeSolutionID($g->code_solution_id) as $j)
	                                    			 @if($i->id == $j->tag_id)
													 	@php $selected=true; @endphp
													 @endif
											@endforeach
                                        	<option value="{{$i->id}}" @if($selected) selected="" @endif>{{$i->name}}</option>
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@include('admin.inc.footer')

</body>

</html>