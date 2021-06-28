<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Validator;
use Redirect;
use Session;
use \stdClass;
Use Exception;




class Admin extends Controller {


	public function adminLogin(Request $req){

		// validate the info, create rules for the inputs
		$rules = array(
		    'user_name'    => 'required|alphaNum|min:5', 
		    'password' 	   => 'required|alphaNum|min:5' 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make($req->all(), $rules);
		if ($validator->fails()) {
    		return Redirect::back()->withErrors($validator); // send back all errors 		        
		} else {
			$credentials = new stdClass;
			$credentials->user_name = $req->user_name;
			$credentials->password 	= md5($req->password);

			$e = DB::table('admin')->where('user_name',"=",$credentials->user_name)
			    ->where('password',"=",$credentials->password)
			    ->first();
	      if( $e ){
			    $req->session()->put('admin',$credentials);
			    return redirect('admin/dashboard');
			  } else {
				 return Redirect::back()->withErrors(['Invalid Username or Password']);
			  }

		}	
	}


	public function getDashboardStats(){
		return Admin::isAuth() ? view('admin/dashboard') : redirect('admin');
	}

	public function updatePassword(Request $req){
		$table 	  = 'admin';
		if($this->isAuth()){
			$rules = array(
			    'new_password'    => 'required|alphaNum|min:5'			
			);
			$old_password 		= $req->old_password;
			$new_password 		= $req->new_password;
			$confirm_password 	= $req->confirm_password;

			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::back()->withErrors($validator); // send back all errors       
			} else if($new_password !== $confirm_password){
				return Redirect::back()->withErrors(['New Password Does not Match']);
			} else if(!DB::table($table)->where('password',"=", md5($old_password))->first()){
				return Redirect::back()->withErrors(['Old Password Does Not Match']);
			} else {
    			DB::table($table)->update(['password' => md5($new_password)]);
	        	return redirect()->back()->with('success', 'Password Updated'); 
    		}
		} else {
			return redirect('admin');
		}
	}

	public function updateSocialLinks(Request $req){
		$table 	  = 'social_links';
		if($this->isAuth()){
			$rows = DB::table($table)->count();
			if($rows !== 0){
				//update
				$u = DB::table($table)
					->update([
						'facebook' 	=> $req->facebook,
						'twitter' 	=> $req->twitter,
						'instagram' => $req->instagram,
						'linkedin' 	=> $req->linkedin,
						'whatsapp' 	=> $req->whatsapp,
						'skype' 	=> $req->skype
					]);
				return self::setRedirect($u,'Updated','An Error Occurred While Updating');
			} else {
				//insert 
				$data 	= array(
		        	'facebook' 	=> $req->facebook,
					'twitter' 	=> $req->twitter,
					'instagram' => $req->instagram,
					'linkedin' 	=> $req->linkedin,
					'whatsapp' 	=> $req->whatsapp,
					'skype' 	=> $req->skype
	      		);
	        	$i = DB::table($table)->insert($data);
	        	return self::setRedirect($i,'Inserted','An Error Occurred While Inserting');
			}
		} else {
			return redirect('admin');
		}
	}

	public function getSocialLinks(){
		if($this->isAuth()){
			$g = DB::table('social_links')
	    	->orderBy('id', 'desc')->first();
	       return view('/admin/social-links')->with(['g'=>$g]); 
		} else {
			return redirect('admin');
		}
		 
	}

	public function updatePersonalInformation(Request $req){
		$table 	  = 'p_info';
		if($this->isAuth()){
			$rows = DB::table($table)->count();
			if($rows !== 0){
				//update
				$u = DB::table($table)
					->update([
						'dob' 		=> $req->dob,
						'address' 	=> $req->address,
						'per_email' => $req->per_email,
						'pro_email' => $req->pro_email,
						'mobile' 	=> $req->mobile,
						'tagline' 	=> $req->tagline
					]);
				return self::setRedirect($u,'Updated','An Error Occurred While Updating');
			} else {
				//insert 
				$data 	= array(
		        	'dob' 		=> $req->dob,
					'address' 	=> $req->address,
					'per_email' => $req->per_email,
					'pro_email' => $req->pro_email,
					'mobile' 	=> $req->mobile,
					'tagline' 	=> $req->tagline
	      		);
	        	$i = DB::table($table)->insert($data);
	        	return self::setRedirect($i,'Inserted','An Error Occurred While Inserting');
			}
		} else {
			return redirect('admin');
		}
	}

	public function getPersonalInformation(){
		if($this->isAuth()){
			$g = DB::table('p_info')
	    	->orderBy('id', 'desc')->first();
	       return view('/admin/personal-information')->with(['g'=>$g]); 
		} else {
			return redirect('admin');
		}
	}

	public function updateSiteContent(Request $req){
		$table 	  = 'site_content';
		if($this->isAuth()){
			$rows = DB::table($table)->count();
			if($rows !== 0){
				//update
				$u = DB::table($table)
					->update([
						'about_me' 		=> $req->about_me,
						'hire_me' 		=> $req->hire_me,
						'about_site' 	=> $req->about_site
					]);
				return self::setRedirect($u,'Updated','An Error Occurred While Updating');
			} else {
				//insert 
				$data 	= array(
		        	'about_me' 		=> $req->about_me,
					'hire_me' 		=> $req->hire_me,
					'about_site' 	=> $req->about_site
	      		);
	        	$i = DB::table($table)->insert($data);
	        	return self::setRedirect($i,'Inserted','An Error Occurred While Inserting');
			}
		} else {
			return redirect('admin');
		}
	}

	public function getSiteContent(){
		if($this->isAuth()){
			$g = DB::table('site_content')
	    	->orderBy('id', 'desc')->first();
	       return view('/admin/site-content')->with(['g'=>$g]); 
		} else {
			return redirect('admin');
		}
	}

	public function addTestimonial(Request $req){
		$table 	  = 'testimonials';
		if($this->isAuth()){
			$rules = array(
			    'name'    	=> 'required',
			    'content'	=> 'required',
			    'image'		=> 'required|image|mimes:jpeg,png,jpg,gif,svg'			
			);
			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::back()->withErrors($validator); // send back all errors       
			} else {
				$image 			= $req->file('image');
				$image_name 	= time(). $image->getClientOriginalName();
				$image->move($this->getPublicPath('uploads/testimonials'),$image_name);
				$data 	= array(
		        	'name' 		=> $req->name,
					'content' 	=> $req->content,
					'image' 	=> $image_name
		      	);
		      	$i = DB::table($table)->insert($data);
	        	return self::setRedirect($i,'Inserted','An Error Occurred While Inserting');
			}
		} else {
			return redirect('admin');
		}
	}

	public function getAllTestimonials(){

		if($this->isAuth()){
			$g = DB::table('testimonials')->get();
	       return view('/admin/testimonials')->with(['g'=>$g]); 
		} else {
			return redirect('admin');
		}
	}

	public function deleteTestimonial(Request $req, $id){
		$table 	  = 'testimonials';
		if($this->isAuth()){
			$d = DB::table($table)->where('id', '=', $id)->delete();
			return self::setRedirect($d,'Deleted','An Error Occurred While Deleting');
		} else {
			return redirect('admin');
		}
	}

	public function getSingleTestimonial(Request $req, $id){
		$table 	  = 'testimonials';
		if($this->isAuth()){
			$g = DB::table($table)->where('id', $id)->first();
			return view('/admin/update-testimonial')->with(['g'=>$g]);
	       
		} else {
			return redirect('admin');
		}
	}


	

	public function updateTestimonial(Request $req){
		$table 	  = 'testimonials';
		if($this->isAuth()){
			if($req->hasFile('image')) {
				//now update image as well
				$rules = array(
				    'name'    	=> 'required',
				    'content'	=> 'required',
				    'image'		=> 'required|image|mimes:jpeg,png,jpg,gif,svg'			
				);

				// run the validation rules on the inputs from the form
				$validator = Validator::make($req->all(), $rules);
				if ($validator->fails()) {
	    			return Redirect::back()->withErrors($validator); // send back all errors       
				} else {
					$image 			= $req->file('image');
					$image_name 	= time(). $image->getClientOriginalName();
					$image->move($this->getPublicPath('uploads/testimonials'),$image_name);

			      	$u = DB::table($table)
			      		->where('id', $req->id)
			      		->update([
			      		'name' 		=> $req->name,
						'content' 	=> $req->content,
						'image' 	=> $image_name
					]);

					return self::setRedirect($u,'Updated','An Error Occurred While Updating');
				}				

			} else {
				//update only text content
				$u = DB::table($table)
		      		->where('id', $req->id)
		      		->update([
			      		'name' 		=> $req->name,
						'content' 	=> $req->content
					]);

		      	return self::setRedirect($u,'Updated','An Error Occurred While Updating');
			}
		} else {
			return redirect('admin');
		}
	}

	public function addTag(Request $req){
		$table 	  = 'tags';
		if($this->isAuth()){
			$rules = array('name'  => 'required');
			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::back()->withErrors($validator); // send back all errors       
			} else {				
				$data 	= array('name' => $req->name );
		      	$i = DB::table($table)->insert($data);
		      	return self::setRedirect($i,'Inserted','An Error Occurred While Inserting');
			}
		} else {
			return redirect('admin');
		}
	}

	public function getTags(){
		$table 	  = 'tags';
		if($this->isAuth()){
			$g = DB::table($table)->get();
			return view('/admin/tags')->with(['g'=>$g]);
	       
		} else {
			return redirect('admin');
		}
	}

	public function deleteTag(Request $req, $id){
		$table 	  = 'tags';
		if($this->isAuth()){
			$d = DB::table($table)->where('id', '=', $id)->delete();
	       return self::setRedirect($d,'Deleted','An Error Occurred While Deleting');
		} else {
			return redirect('admin');
		}
	}

	public function getSingleTag($id){
		$table 	  = 'tags';
		if($this->isAuth()){
			$g = DB::table($table)->where('id', '=', $id)->first();
			return view('/admin/update-tag')->with(['g'=>$g]);
	       
		} else {
			return redirect('admin');
		}
	}

	public function updateTag(Request $req){

		$table 	  = 'tags';
		if($this->isAuth()){
			//update only text content
			$rules = array('name'    	=> 'required');
			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::back()->withErrors($validator); // send back all errors       
			} else {
				$u = DB::table($table)
	      		->where('id', $req->id)
	      		->update([
		      		'name' 		=> $req->name
				]);
	      		return self::setRedirect($u,'Updated','An Error Occurred While Updating');
			}
		} else {
			return redirect('admin');
		}
	}

	public function getCodeSolutions(Request $req){
		$table 	  = 'code_solution';
		if($this->isAuth()){
			$g = DB::table($table)->get();
			$t = self::getAllTags();
			return view('/admin/code-solution')->with(['g'=>$g,'t'=>$t]);
	       
		} else {
			return redirect('admin');
		}
	}

	public function addCodeSolution(Request $req){
		$table 	  = 'code_solution';
		if($this->isAuth()){
			$rules = array(
			    'title'    	=> 'required',
			    'content'	=> 'required',
			    'tags'		=> 'required'			
			);

			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::back()->withErrors($validator); // send back all errors       
			} else {				
				$data 	= array(
		        	'title' 		=> $req->title,
		        	'content' 		=> $req->content,
		        	'added_date'	=> date('d-M-Y'),
		        	'views'			=> 0,
		      	);
		      	$i 			= DB::table($table)->insert($data);
		      	$cs_last_id = DB::getPdo()->lastInsertId();
		      	//tags
		      	$tags 		= $req->tags;
		      	foreach($tags as $tag){
		      		$tags	= array(
			        	'code_solution_id' 	=> $cs_last_id,
			        	'tag_id'			=> $tag
			        );
			        DB::table('code_solution_tag')->insert($tags);
		      	}

		      	return self::setRedirect($i,'Inserted','An Error Occurred While Inserting');
			}
		} else {
			return redirect('admin');
		}
	}

	public function getSingleCodeSolution($code_solution_id){
		$table 	  = 'code_solution';
		if($this->isAuth()){
			$g = DB::table($table)->where('code_solution_id', '=', $code_solution_id)->first();
			$t = self::getAllTags();
			return view('/admin/update-code-solution')->with(['g'=>$g,'t'=>$t]);
	       
		} else {
			return redirect('admin');
		}
	}

	public function deleteCodeSolution($code_solution_id){
		$table 	  = 'code_solution';
		if($this->isAuth()){
			$d = DB::table($table)->where('code_solution_id', '=', $code_solution_id)->delete();
	       return self::setRedirect($d,'Deleted','An Error Occurred While Deleting');
		} else {
			return redirect('admin');
		}
	}

	public function updateCodeSolution(Request $req){

		$table 	  = 'code_solution';
		if($this->isAuth()){
			//update only text content
			$rules = array(
			    'title'    	=> 'required',
			    'content'	=> 'required',
			    'tags'		=> 'required'
			);

			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::back()->withErrors($validator); // send back all errors       
			} else {
				$u = DB::table($table)
	      		->where('code_solution_id', $req->code_solution_id)
	      		->update([
		      		'title' 		=> $req->title,
		        	'content' 		=> $req->content,
				]);
				if($u == false || $u == true){
					$d = DB::table('code_solution_tag')->where('code_solution_id', '=', $req->code_solution_id)->delete();
					//tags
			      	$tags 		= $req->tags;
			      	foreach($tags as $tag){
			      		$tags	= array(
				        	'code_solution_id' 	=> $req->code_solution_id,
				        	'tag_id'			=> $tag
				        );
					$i = DB::table('code_solution_tag')->insert($tags);
				}
				
				$a = $u || ($d && $i);
	      		return self::setRedirect($a,'Updated','An Error Occurred While Updating');

				}				
			}
		} else {
			return redirect('admin');
		}
	}

	public static function getAllTags(){
		return DB::table('tags')->get();
	}

	public static function getAllCategories(){
		return DB::table('categories')->get();
	}

	public static function getTagsNameByCodeSolutionID($id,$str = true){
		$g = DB::table('tags')
	    	->join('code_solution_tag', 'tags.id', '=', 'code_solution_tag.tag_id')
	    	->where('code_solution_tag.code_solution_id','=',$id)
	    	->pluck('name');

	    $k = '';
	    foreach($g as $i)
	    	$k.=$i.",";
	    
	    return  $str ? trim($k,",") : $g;
	}

	public static function getTagsByCodeSolutionID($id){
		$g = DB::table('tags')
	    	->join('code_solution_tag', 'tags.id', '=', 'code_solution_tag.tag_id')
	    	->where('code_solution_tag.code_solution_id','=',$id)
	    	->get();
	    return $g;
	}


	public function addCategory(Request $req){
		$table 	  = 'categories';
		if($this->isAuth()){
			$rules = array('cat_name'  => 'required');
			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::back()->withErrors($validator); // send back all errors       
			} else {				
				$data 	= array('cat_name' => $req->cat_name );
		      	$i = DB::table($table)->insert($data);
		      	return self::setRedirect($i,'Inserted','An Error Occurred While Inserting');
			}
		} else {
			return redirect('admin');
		}
	}

	public function getCategories(){
		$table 	  = 'categories';
		if($this->isAuth()){
			$g = DB::table($table)->get();
			return view('/admin/categories')->with(['g'=>$g]);
	       
		} else {
			return redirect('admin');
		}
	}

	public function deleteCategory(Request $req, $id){
		$table 	  = 'categories';
		if($this->isAuth()){
			$d = DB::table($table)->where('id', '=', $id)->delete();
	       return self::setRedirect($d,'Deleted','An Error Occurred While Deleting');
		} else {
			return redirect('admin');
		}
	}

	public function getSingleCategory($id){
		$table 	  = 'categories';
		if($this->isAuth()){
			$g = DB::table($table)->where('id', '=', $id)->first();
			return view('/admin/update-category')->with(['g'=>$g]);
	       
		} else {
			return redirect('admin');
		}
	}

	public function updateCategory(Request $req){

		$table 	  = 'categories';
		if($this->isAuth()){
			//update only text content
			$rules = array('cat_name'    	=> 'required');
			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::back()->withErrors($validator); // send back all errors       
			} else {
				$u = DB::table($table)
	      		->where('id', $req->id)
	      		->update([
		      		'cat_name' 		=> $req->cat_name
				]);
	      		return self::setRedirect($u,'Updated','An Error Occurred While Updating');
			}
		} else {
			return redirect('admin');
		}
	}

	public static function getCategoryNameByID($id){
		$g = DB::table('categories')
	    	->where('id','=',$id)
	    	->pluck('cat_name');
	    return $g ? $g[0] : 'Not Found';
	}

	public function getArticles(Request $req){
		$table 	  = 'articles';
		if($this->isAuth()){
			$g = DB::table($table)
				->join('categories as cat', 'cat.id', '=', 'articles.cat_id')
	    		->get();
			$t = self::getAllCategories();
			return view('/admin/articles')->with(['g'=>$g,'t'=>$t]);
	       
		} else {
			return redirect('admin');
		}
	}

	public function addArticle(Request $req){
		$table 	  = 'articles';
		if($this->isAuth()){
			$rules = array(
			    'title'    		=> 'required',
			    'content'		=> 'required',
			    'cat_id'		=> 'required',	
			    'image'			=> 'required|image|mimes:jpeg,png,jpg,gif,svg',				
			    'description'	=> 'required',			
			    'keywords'		=> 'required'			
			);

			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::back()->withErrors($validator); // send back all errors       
			} else {	
				$image 			= $req->file('image');
				$image_name 	= time(). $image->getClientOriginalName();
				$image->move($this->getPublicPath('uploads/articles'),$image_name);			
				$data 	= array(
		        	'title' 		=> $req->title,
		        	'content' 		=> $req->content,
		        	'cat_id' 		=> $req->cat_id,
		        	'image' 		=> $image_name,
		        	'description' 	=> $req->description,
		        	'keywords' 		=> $req->keywords,
		        	'added_date'	=> date('d-M-Y')
		      	);
		      	$i 			= DB::table($table)->insert($data);
		      	return self::setRedirect($i,'Inserted','An Error Occurred While Inserting');
			}
		} else {
			return redirect('admin');
		}
	}

	public function deleteArticle($article_id){
		$table 	  = 'articles';
		if($this->isAuth()){
			$d = DB::table($table)->where('article_id', '=', $article_id)->delete();
	       return self::setRedirect($d,'Deleted','An Error Occurred While Deleting');
		} else {
			return redirect('admin');
		}
	}

	public function getSingleArticle($article_id){
		$table 	  = 'articles';
		if($this->isAuth()){
			$g = DB::table($table)->where('article_id', '=', $article_id)->first();
			$t = self::getAllCategories();
			return view('/admin/update-article')->with(['g'=>$g,'t'=>$t]);
	       
		} else {
			return redirect('admin');
		}
	}

	public function updateArticle(Request $req){
		$table 	  = 'articles';
		if($this->isAuth()){
			$rules = array(
			    'title'    		=> 'required',
			    'content'		=> 'required',
			    'cat_id'		=> 'required',			
			    'description'	=> 'required',			
			    'keywords'		=> 'required'				
			);
			if($req->hasFile('image')) {
				//now update image as well
				$rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg';
				// run the validation rules on the inputs from the form
				$validator = Validator::make($req->all(), $rules);
				if ($validator->fails()) {
	    			return Redirect::back()->withErrors($validator); // send back all errors       
				} else {
					$image 			= $req->file('image');
					$image_name 	= time(). $image->getClientOriginalName();
					$image->move($this->getPublicPath('uploads/articles'),$image_name);

			      	$u = DB::table($table)
			      		->where('article_id', $req->article_id)
			      		->update([
			      		'title' 		=> $req->title,
			        	'content' 		=> $req->content,
			        	'cat_id' 		=> $req->cat_id,
			        	'image' 		=> $image_name,
			        	'description' 	=> $req->description,
			        	'keywords' 		=> $req->keywords
					]);

					return self::setRedirect($u,'Updated','An Error Occurred While Updating');
				}				

			} else {
				//update only text content
				// run the validation rules on the inputs from the form
				$validator = Validator::make($req->all(), $rules);
				if ($validator->fails()) {
	    			return Redirect::back()->withErrors($validator); // send back all errors       
				} else {
					$u = DB::table($table)
		      		->where('article_id', $req->article_id)
		      		->update([
			      		'title' 		=> $req->title,
			        	'content' 		=> $req->content,
			        	'cat_id' 		=> $req->cat_id,
			        	'description' 	=> $req->description,
			        	'keywords' 		=> $req->keywords
					]);

		      		return self::setRedirect($u,'Updated','An Error Occurred While Updating');
				}
				
			}
		} else {
			return redirect('admin');
		}
	}

	public function getAddToolView(){

		return $this->isAuth() ? view('admin.add-tool') : redirect('admin');
	}

	public function addTool(Request $req){
		$table 	  = 'tools';
		if($this->isAuth()){
			$rules = array(
			    'title'    		=> 'required',
			    'content'		=> 'required',
			    'short_title'	=> 'required',				
			    'description'	=> 'required',			
			    'keywords'		=> 'required',
			    'slug'			=> 'required',	
			    'icon_class'	=> 'required',		
			);

			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::back()->withErrors($validator); // send back all errors       
			} else {			
				$data 	= array(
		        	'title' 		=> $req->title,
		        	'content' 		=> $req->content,
		        	'short_title' 	=> $req->short_title,
		        	'description' 	=> $req->description,
		        	'keywords' 		=> $req->keywords,
		        	'slug' 			=> $req->slug,
		        	'icon_class' 	=> $req->icon_class,
		        	'added_date'	=> date('d-M-Y')
		      	);
		      	$i 			= DB::table($table)->insert($data);
		      	return self::setRedirect($i,'Inserted','An Error Occurred While Inserting');
			}
		} else {
			return redirect('admin');
		}
	}

	public function getTools(Request $req){
		$table 	  = 'tools';
		if($this->isAuth()){
			$g = DB::table($table)->get();
			return view('/admin/tools')->with(['g'=>$g]);
	       
		} else {
			return redirect('admin');
		}
	}

	public function deleteTool(Request $req, $tool_id){
		$table 	  = 'tools';
		if($this->isAuth()){
			$d = DB::table($table)->where('tool_id', '=', $tool_id)->delete();
			return self::setRedirect($d,'Deleted','An Error Occurred While Deleting');
		} else {
			return redirect('admin');
		}
	}

	public function getSingleTool(Request $req, $tool_id){
		$table 	  = 'tools';
		if($this->isAuth()){
			$g = DB::table($table)->where('tool_id', $tool_id)->first();
			return view('/admin/update-tool')->with(['g'=>$g]);
	       
		} else {
			return redirect('admin');
		}
	}

	public function updateTool(Request $req){

		$table 	  = 'tools';
		if($this->isAuth()){
			$rules = array(
			    'title'    		=> 'required',
			    'content'		=> 'required',
			    'short_title'	=> 'required',				
			    'description'	=> 'required',			
			    'keywords'		=> 'required',
			    'slug'			=> 'required',	
			    'icon_class'	=> 'required',		
			);
			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::back()->withErrors($validator); // send back all errors       
			} else {
				$u = DB::table($table)
	      		->where('tool_id', $req->tool_id)
	      		->update([
		      		'title' 		=> $req->title,
		        	'content' 		=> $req->content,
		        	'short_title' 	=> $req->short_title,
		        	'description' 	=> $req->description,
		        	'keywords' 		=> $req->keywords,
		        	'slug' 			=> $req->slug,
		        	'icon_class' 	=> $req->icon_class,
				]);
	      		return self::setRedirect($u,'Updated','An Error Occurred While Updating');
			}
		} else {
			return redirect('admin');
		}
	}

	
	public static function setRedirect($condition,$success,$error){

		return $condition ? redirect()->back()->with('success', $success) : Redirect::back()->withErrors([$error]);
	}

	public function getPublicPath($path){
        
        return $_SERVER['DOCUMENT_ROOT'].'/'.$path;
    }

    public static function isAuth(){
		 return Session::has('admin') && self::adminAuth(Session::get('admin')) == '1';
	}

	public static function adminAuth($credentials){

		return DB::table('admin')->where('user_name',"=",$credentials->user_name)
			    ->where('password',"=",$credentials->password)
			    ->first() ? '1' : '0';
	}

}



 ?>