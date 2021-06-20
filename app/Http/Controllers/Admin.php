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
    		return Redirect::back()
		        	->withErrors($validator); // send back all errors to the login form
		        
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
				 return Redirect::back()
		        		->withErrors(['Invalid Username or Password']);
			  }

		}	
	}

	public static function adminAuth($credentials){

		return DB::table('admin')->where('user_name',"=",$credentials->user_name)
			    ->where('password',"=",$credentials->password)
			    ->first() ? '1' : '0';
	}

	public static function isAuth(){
		 return Session::has('admin') && self::adminAuth(Session::get('admin')) == '1';
	}

	public function getDashboardStats(){
		return Admin::isAuth() ? view('admin/dashboard') : redirect('admin');
	}

	public function updatePassword(Request $req){
		$table 	  = 'admin';
		$redirect = 'admin/update-password';
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
    			return Redirect::back()->withErrors($validator); // send back all errors to the login form      
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
		$redirect = 'admin/social-links';
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
		$redirect = 'admin/personal-information';
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
		$redirect = 'admin/site-content';
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
		$redirect = 'admin/testimonials';
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
    			return Redirect::back()->withErrors($validator); // send back all errors to the login form      
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
		$redirect = 'admin/testimonials';
		$table 	  = 'testimonials';
		if($this->isAuth()){
			$d = DB::table($table)->where('id', '=', $id)->delete();
			return self::setRedirect($d,'Deleted','An Error Occurred While Deleting');
		} else {
			return redirect('admin');
		}
	}

	public function getSingleTestimonial(Request $req, $id){
		$redirect = 'admin/update-testimonial';
		$table 	  = 'testimonials';
		if($this->isAuth()){
			$g = DB::table($table)->where('id', '=', $id)->where('id', $id)->first();
			return view('/admin/update-testimonial')->with(['g'=>$g]);
	       
		} else {
			return redirect('admin');
		}
	}


	public static function setRedirect($condition,$success,$error){

		return $condition ? redirect()->back()->with('success', $success) : Redirect::back()->withErrors([$error]);
	}

	public function updateTestimonial(Request $req){

		$redirect = 'admin/update-testimonial/'.$req->id;
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
	    			return Redirect::to($redirect)->withErrors($validator); // send back all errors to the login form      
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
		$redirect = 'admin/tags';
		$table 	  = 'tags';

		if($this->isAuth()){
			$rules = array(
			    'name'    	=> 'required'			
			);

			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::back()->withErrors($validator); // send back all errors to the login form      
			} else {
				
				$data 	= array(
		        	'name' 		=> $req->name
		      	);
		      	$i = DB::table($table)->insert($data);
		      	return self::setRedirect($i,'Inserted','An Error Occurred While Inserting');
			}
		} else {
			return redirect('admin');
		}
	}

	public function getTags(){
		$redirect = 'admin/tags';
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

		$redirect = 'admin/tags';
		$table 	  = 'tags';
		if($this->isAuth()){
			//update only text content
			$rules = array(
			    'name'    	=> 'required'
			);

			// run the validation rules on the inputs from the form
			$validator = Validator::make($req->all(), $rules);
			if ($validator->fails()) {
    			return Redirect::to($redirect)->withErrors($validator); // send back all errors to the login form      
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
    			return Redirect::back()->withErrors($validator); // send back all errors to the login form      
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

	public static function getAllTags(){
		return DB::table('tags')->get();
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


	function getPublicPath($path){
        
        return $_SERVER['DOCUMENT_ROOT'].'/'.$path;
    }


}



 ?>