@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">User Profile</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">User Profile</li>
			</ol>
		</nav>
	</div>
 





</div>



<!--end breadcrumb-->
<div class="container">
	<div class="main-body">
		<div class="row">
			<div class="col-lg-4">
				<div class="card">
					<div class="card-body">
						<div class="d-flex flex-column align-items-center text-center">

	 <img src="{{ (!empty($adminData->profile_photo_path))?url('upload/admin_images/'.$adminData->profile_photo_path):url('upload/no_image.jpg')   }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">




							<div class="mt-3">
	<h4>{{ $adminData->name }}</h4>
	<p class="text-secondary mb-1">{{ $adminData->email }}</p>
	<!-- <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p> -->
	 
</div>
						</div>
						<hr class="my-4">
						
					</div>
				</div>
			</div>




	 

			<div class="col-lg-8">



<form method="post" action="{{ route('user.profile.store') }}" enctype="multipart/form-data"> 
	 @csrf



				<div class="card">
					<div class="card-body">
						<div class="row mb-3">
	<div class="col-sm-3">
		<h6 class="mb-0">Full Name</h6>
	</div>
	<div class="col-sm-9 text-secondary">
		<input type="text" name="name" class="form-control" value="{{ $adminData->name }}">
	</div>
</div>
<div class="row mb-3">
	<div class="col-sm-3">
		<h6 class="mb-0">Email</h6>
	</div>
	<div class="col-sm-9 text-secondary">
		<input type="text" name="email" class="form-control" value="{{ $adminData->email }}">
	</div>
</div>
 
<div class="mb-3">
 <label for="formFile" class="form-label">Upload Profile Image</label>
	 <input class="form-control" name="profile_photo_path" type="file" id="image">
	 </div>


	 <div class="mb-3">

	 	<img id="showImage" src="{{ (!empty($adminData->profile_photo_path))?url('upload/admin_images/'.$adminData->profile_photo_path):url('upload/no_image.jpg')   }}" style="width:100px; height: 100px;" >
 
	 </div>



 
<div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-9 text-secondary">
		<input type="submit" class="btn btn-primary px-4" value="Save Changes">
	</div>
</div>
					</div>
				</div>


</form>
				 
 



							</div>
						</div>
					</div>
				</div>
			</div>
		</div>




<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);

		});
	});	
</script>







@endsection