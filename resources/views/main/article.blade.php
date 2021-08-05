@include('main.inc.header')
@if(!$g->isEmpty())
<section class="bg-light-blue p-5">
	<div class="container single-post-container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-blog-post">
					<div class="single-blog-post-meta">					
						<img src="{{URL::asset('uploads/articles/' . $g[0]->image)}}" class="img-fluid" alt="{{$g[0]->title}}">
						<h1 class="fw-900 p-5 clr-blue">{{$g[0]->title}}</h1>

						<div class="single-blog-post-author">
							<div class="single-blog-post-author-image">
								<div class="single-blog-post-author-image-fluid-ratio">
									<img class="" src="{{URL::asset('main-assets/images/abdul-basit.jpeg')}}" alt="Abdul Basit - Useless Programmer" style="opacity: 1; visibility: inherit;">
								</div>
							</div>
							<div>
								<p class="clr-blue single-blog-post-author-name">Abdul Basit</p>
								<p class="single-blog-post-date">{{$g[0]->added_date}}</p>
							</div>
						</div>
					</div>
					<div class="separator"></div>
					<div class="single-blog-post-content">
						<p>{!! $g[0]->content !!}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif
@if(!$l->isEmpty())
	<div class="container">
		<div class="row related-posts">
			<h2 class="text-center fw-900 p-5 clr-blue text-center">Related posts you might interested in..</h2>
			@foreach($l as $i)
				@if($i->title !== $g[0]->title)
					<div class="col-md-4">
						<div class="card">
						  <img class="card-img-top" src="{{URL::asset('uploads/articles/' . $i->image)}}" alt="{{$i->title}}">
						  <div class="card-body">
						    <a href="{{ route('getSingleArticleMain', $i->slug) }}">
						    	<h5 class="card-title text-center">{{$i->title}}</h5>
						    </a>
						    <p class="card-text text-center">{{ \Illuminate\Support\Str::limit(strip_tags($i->content), 90, $end='...') }}</p>
						  </div>
						</div>
					</div>
				@endif
			@endforeach
		</div>
	</div>
@endif
</section>

<!-- FOOTER -->
@include('main.inc.footer')
<!-- FOOTER -->