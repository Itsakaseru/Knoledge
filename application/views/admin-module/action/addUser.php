<div class="ui two column stackable grid container center aligned" style="padding: 0 !important;">
    <div class="user-info sixteen wide computer eleven wide tablet column">
        <h1>Add User</h1>
    </div>
    <div class="user-container eight wide computer five wide tablet column">
        <div class="editProfileForm">
            <form class="ui form <?php if(validation_errors()) echo "error" ?>" method="post" action="<?php echo base_url('user/add'); ?>" enctype="multipart/form-data">
                <div class="image-container circular" for="uploadImage">
                    <img id="profileImage" class="ui circular image centered" src="<?php echo base_url('data/users-img/') . 'placeholder.jpg'; ?>">
                    <label class="changeImage" for="uploadImage">
                        Change Image
                    </label>
                </div>
                <div class="ui error message">
                    <div class="header">Update User Failed!</div>
                    <ul class="list">
                        <?php if(form_error('firstName') != NULL) echo form_error('firstName');?>
                        <?php if(form_error('lastName') != NULL) echo form_error('lastName');?>
                        <?php if(form_error('email') != NULL) echo form_error('email');?>
                        <?php if(form_error('password') != NULL) echo form_error('password');?>
                        <?php if(form_error('dob') != NULL) echo form_error('dob');?>
                        <?php if(form_error('gender') != NULL) echo form_error('gender');?>
                        <?php if(form_error('role') != NULL) echo form_error('role');?>
                        <?php if(form_error('password') != NULL) echo form_error('imageFile');?>
                    </ul>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>First Name</label>
                        <input type="text" name="firstName">
                    </div>
                    <div class="field">
                        <label>Last Name</label>
                        <input type="text" name="lastName">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Email</label>
                        <input type="text" name="email">
                    </div>
                    <div id="changePassword" class="field">
                        <label>Password</label>
                        <input type="password" name="password">
                    </div>
                </div>
                <div class="three fields">
                    <div class="field">
                        <label>Date Of Birth</label>
                        <input type="date" name="dob">
                    </div>
                    <div class="field">
                        <label>Gender</label>
                        <select id="gender" class="ui fluid dropdown" name="gender">
                            <option value="">Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Unspecified</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Role</label>
                        <select id="role" class="ui fluid dropdown" name="role">
                            <option value="">Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Teacher</option>
                            <option value="3">Student</option>
                        </select>
                    </div>
                    <input type="file" name="imageFile" class="inputFile" id="uploadImage" onchange="readURL(this);">
                </div>
                <button class="ui button" type="submit">Add User</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
		$('#role').dropdown();
		$('#gender').dropdown();
	});

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profileImage')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>