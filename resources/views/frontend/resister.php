<?php include('_partials/header.php'); ?>
	<section>
		<div class="resister_section">
			<div class="container">
				<div class="row">
					<div class="col-sm-offset-1 col-md-10">
						<div class="resister_page" style=" ">
							<h3>Create an account</h3>
							<hr>
							<form>
							  	<div class="form-horizontal">
							  		<div class="row">
							  			<div class="col-sm-12">
							  				<div class="form-group">
											  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 	Ms./Mrs.
											  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> Mr.
											</div>
							  				
							  			</div>
							  		</div>
							  		<div class="row">
							  			<div class="col-sm-12">
							  				<div class="row">
							  					<div class="col-sm-4">
							  						<div class="form-group">
													    <label for="FirstName">First Name *:</label>
													    <input type="text" class="form-control input-sm" id="FirstName" placeholder="First Name" required>
													</div>
							  					</div>
							  					<div class="col-sm-4">
							  						<div class="form-group">
													    <label for="MiddleName">Middle Name :</label>
													    <input type="text" class="form-control" id="MiddleName" placeholder="Middle Name :">
													</div>
							  					</div>
							  					<div class="col-sm-4">
							  						<div class="form-group">
													    <label for="LastName">Last Name *:</label>
													    <input type="text" class="form-control" id="LastName" placeholder="Last Name">
													</div>
							  					</div>
							  				</div>
							  			</div>
							  		</div>
							  		<div class="row">
							  			<div class="col-sm-12">
							  				<div class="form-group">
											    <label for="Password">Current City *:</label>
											    <select data-placeholder="Choose a Country..." class="chosen" tabindex="1">
													<option>Choose...</option>
													<option>Barguna</option>
													<option >Barisal</option>
													<option>Bhola</option>
													<option >Jhalokati</option>
													<option >Patuakhali</option>
													<option >Pirojpur</option>
													<option >Bandarban</option>
													<option >Brahmanbaria</option>
													<option >Chandpur</option>
													<option >Chittagong</option>
													<option >Comilla</option>
													<option >Cox's Bazar</option>
													<option >Feni</option>
													<option >Khagrachhari</option>
													<option >Lakshmipur</option>
													<option >Noakhali</option>
													<option >Rangamati</option>
													<option >Dhaka </option>
													<option >Faridpur </option>
													<option >Gazipur </option>
													<option >Gopalganj</option>
													<option >Kishoreganj</option>
													<option >Madaripur</option>
													<option >Manikganj</option>
													<option >Munshiganj</option>
													<option >Narsingdi </option>
													<option >Rajbari</option>
													<option >Shariatpur</option>
													<option >Tangail </option>
													<option >Bagerhat </option>
													<option >Chuadanga</option>
													<option >Jessore </option>
													<option >Jhenaidah</option>
													<option >Khulna</option>
												</select>
											</div>	
							  			</div>
							  		</div>
							  		<div class="row">
							  			<div class="col-sm-12">
							  				<div class="row">
							  					<div class="col-sm-6">
							  						<div class="form-group">
													    <label for="Email">Email *:</label>
													    <input type="email" class="form-control" id="Email" placeholder="Email" required>
													</div>
							  					</div>
							  					<div class="col-sm-6">
							  						<div class="form-group">
													    <label for="PhoneNumber">Phone Number *:</label>
													    <input type="phone" class="form-control" id="PhoneNumber" placeholder="Phone Number">
													</div>
							  					</div>
							  				</div>
							  			</div>
							  		</div>
							  		<div class="row">
							  			<div class="col-sm-12">
							  				<div class="form-group">
											    <label for="UserName">User Name *:</label>
											    <input type="text" class="form-control" id="UserName" placeholder="User Name" required>
											</div>	
							  			</div>
							  		</div>
							  		<div class="row">
							  			<div class="col-sm-12">
							  				<div class="form-group">
											    <label for="Password">Password *:</label>
											    <input type="password" class="form-control" id="Password" placeholder="Password" required>
											</div>	
							  			</div>
							  		</div>
							  		<div class="row">
							  			<div class="col-sm-12">
							  				<div class="form-group">
											    <label for="Password">Confirm Password *:</label>
											    <input type="password" class="form-control" id="Password" placeholder="Confirm Password" required>
											</div>	
							  			</div>
							  		</div>
							  		
							  		
									  
									 <button type="submit" class="btn btn-success">Confirm</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</section>

<?php include('_partials/footer.php'); ?>