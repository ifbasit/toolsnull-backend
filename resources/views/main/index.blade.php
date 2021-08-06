@extends('layouts.master')
@php
use App\Http\Controllers\Admin;
@endphp



@section('title', 'About Us')

@section('content')
<!-- TOOLS -->
@if(!$t->isEmpty())
<section class="bg-light-blue">
	<h1 class="text-center  fw-900 p-5 clr-blue letter-spacing">Tools I Offer</h1>
	<div class="container">
      <div class="row align-items-center justify-content-center pb-5">
      	@foreach($t as $i)
	        <div class="col-lg-3 col-sm-5 col-md-4 col-xs-10 post tool-card box-shadow" data-href="{{$i->slug}}">
	            <div class="text-center">
	              <i class="{{$i->icon_class}} img-fluid tool-icon" aria-hidden="true"></i>
	            </div>
	            <p class="text-center">
	               <a href="{{$i->slug}}" class="clr-blue">{{$i->short_title}}</a>
	            </p>
	        </div>
        @endforeach
               
    </div>
  </div>
</section>
@endif
<!-- TOOLS -->

<!-- BLOG -->
@if(!$a->isEmpty())
<section class="featured-posts no-padding-top ">
	<h1 class="text-center fw-900 p-5 clr-blue">Articles for you</h1>
      <div class="container">
        <!-- Post-->
        @foreach($a as $i)
        	
        <div class="row d-flex align-items-stretch">
        	@if($loop->index % 2 == 0)
        		<div class="text col-lg-7 custom-order-1">
		            <div class="text-inner d-flex align-items-center">
		              <div class="content">
		                <header class="post-header">
		                  <div class="category">
		                  	<a href="#">{{$i->cat_name}}</a>
		                  </div>
		                  	<a href="{{ route('getSingleArticleMain', $i->slug) }}">
		                    	<h2 class="post-heading">{{$i->title}} </h2>
		                    </a>
		                </header>
		                <p>{{ \Illuminate\Support\Str::limit(strip_tags($i->content), 225, $end='...') }}</p>
		                <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
		                    <div class="avatar"><img src="{{URL::asset('main-assets/images/abdul-basit.jpeg')}}" alt="Abdul Basit - Useless Programmer" class="img-fluid"></div>
		                    <div class="title"><span>Abdul Basit</span></div></a>
		                  <div class="date"><i class="fas fa-clock"></i> <span>{{$i->added_date}}</span></div>
		                  <div class="comments"><i class="fas fa-fire"></i>12</div>
		                </footer>
		              </div>
		            </div>
		          </div>
		          <div class="image col-lg-5" style="min-height: 344px;"><img src="{{URL::asset('uploads/articles/' . $i->image)}}" alt="{{$i->title}}"></div>
        	@else
        		 <div class="row d-flex align-items-stretch">
		          <div class="image col-lg-5" style="min-height: 344px;"><img src="{{URL::asset('uploads/articles/' . $i->image)}}" alt="{{$i->title}}"></div>
		          <div class="text col-lg-7 custom-order-1">
		            <div class="text-inner d-flex align-items-center">
		              <div class="content">
		                <header class="post-header">
		                  <div class="category">
		                  	<a href="#">{{$i->cat_name}}</a>
		                  </div>
		                  	<a href="{{ route('getSingleArticleMain', $i->slug) }}">
		                    	<h2 class="post-heading">{{$i->title}} </h2>
		                    </a>
		                </header>
		                <p>{{ \Illuminate\Support\Str::limit(strip_tags($i->content), 225, $end='...') }}</p>
		                 <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
		                    <div class="avatar"><img src="{{URL::asset('main-assets/images/abdul-basit.jpeg')}}" alt="Abdul Basit - Useless Programmer" class="img-fluid"></div>
		                    <div class="title"><span>Abdul Basit</span></div></a>
		                  <div class="date"><i class="fas fa-clock"></i> <span>{{$i->added_date}}</span></div>
		                  <div class="comments"><i class="fas fa-fire"></i>12</div>
		                </footer>
		              </div>
		            </div>
		          </div>
		        </div>
        	@endif
          
        </div>
        @endforeach

      </div>
    </section>
@endif

<!-- BLOG -->
<!-- CODE SOLUTIONS -->
@if(!$c->isEmpty())
<section class="bg-light-blue">
	<h1 class="text-center fw-900 p-5 clr-blue">Code Solutions</h1>
	<div class="container">
        <div class="row align-items-center justify-content-center pb-5">
        	@foreach($c as $i)
	        <div class="code-solution-card box-shadow">
	           <header>
	            <h3>
	              <a href="#">{{ \Illuminate\Support\Str::limit(strip_tags($i->title), 40, $end='...') }}</a>
	            </h3>
	           </header>
	           <div class="author-info-primary">
	            <span class="author-info">
		        <a class="author-link" href="#">Abdul Basit</a> |&nbsp;
		      </span>
		      <span class="published-date">{{$i->added_date}}</span>
		           </div>
	           <footer>
	             <div class="code-solution-card-footer">
	              <div class="views">
	                <i class="fas fa-fire"></i> 48
	              </div>
	              <div class="tags"> 
	                <i class="fas fa-tag"></i> 
	                	@foreach(Admin::getTagsByCodeSolutionID($i->code_solution_id) as $t)
	                		<a href="#">{{$t->name}}</a>
	                	@endforeach
	              </div>
	             </div>
	           </footer>
		    </div>
		    @endforeach
      </div>
  </div>
</section>
@endif
@endsection

