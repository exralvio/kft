<div class="remodal" id="modalEditProfile" data-remodal-id="editProfile">
  <form>
    <div class="col-md-12">
        <div class="profile-picture">
          <img src="{{ url('') }}/images/pp-icon.png"/>
        </div>
        <!-- pp-icon.png -->
    </div>
    <div>
      <div class="col-md-6">
        <label for="firstname">First Name*</label>
        <input type="text" class="form-control" id="firstname" placeholder="First Name">
      </div>
      <div class="col-md-6">
        <label for="lastname">Last Name</label>
        <input type="text" class="form-control" id="lastname" placeholder="Last Name">
      </div>
    </div>
    <div>
      <div class="col-md-6">
        <label for="department">Department*</label>
        <input type="text" class="form-control" id="department" placeholder="Department">
      </div>
      <div class="col-md-6">
        <label for="birthday">Birthday</label>
        <input type="date" name="birthday" id="birthday" class="input-md form-control">
      </div>
    </div>
    <div>
      <div class="col-md-6">
        <label for="gender">Gender</label>
        <select id="gender" class="form-control">
          <option value="">== Select Gender ==</option>
          <option value="M">Male</option>
          <option value="F">Female</option>
        </select>
      </div>
    </div>
    <div>
        <div class="col-md-12">
          <label for="about">About</label>
          <textarea  class="form-control" id="about" placeholder="About"></textarea>
        </div>
    </div>
    <div class="profile-button col-md-12 text-right">
      <button type="button" class="btn btn-default">Cancel</button>
      <button type="button" class="btn btn-primary">Save</button>
    </div>
  </form>
</div>