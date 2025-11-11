<form id="bookingForm" action="admin.php" method="POST" class="needs-validation" novalidate>
  <div class="form-row">
    <!-- All your existing input fields -->
    <div class="form-group col-md-6">
      <label for="userName">Full Name</label>
      <input type="text" class="form-control" id="userName" name="user_name" required>
    </div>
    <div class="form-group col-md-6">
      <label for="userCompany">Company / Agency</label>
      <input type="text" class="form-control" id="userCompany" name="user_company" required>
    </div>
    <div class="form-group col-md-6">
      <label for="userContact">Contact Number</label>
      <input type="tel" class="form-control" id="userContact" name="user_contact" required>
    </div>
    <div class="form-group col-md-6">
      <label for="userEmail">Email Address</label>
      <input type="email" class="form-control" id="userEmail" name="user_email" required>
    </div>
    <div class="form-group col-12">
      <label>Legend:</label><br>
      <span class="badge badge-success mr-1">Available</span>
      <span class="badge badge-danger mr-1">Booked</span>
      <span class="badge badge-secondary">Weekend</span>
    </div>
    <div class="form-group col-md-6">
      <label for="bookingDate">Booking Date</label>
      <input type="text" class="form-control" id="bookingDate" name="booking_date" placeholder="Choose Date" required>
    </div>
    <div class="form-group col-md-6">
      <label for="bookingTime">Booking Time Range</label>
      <select class="form-control" id="bookingTime" name="booking_time" required>
        <option value="">Select Time</option>
        <option>08:00 - 15:00</option>
        <option>08:30 - 15:30</option>
        <option>09:00 - 16:00</option>
        <option>09:30 - 16:30</option>
        <option>10:00 - 17:00</option>
        <option>10:30 - 17:30</option>
        <option>11:00 - 18:00</option>
        <option>11:30 - 18:30</option>
        <option>12:00 - 19:00</option>
        <option>12:30 - 19:30</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="guestCount">Number of Guests</label>
      <input type="number" class="form-control" id="guestCount" name="guest_count" min="1" max="20" required>
    </div>
    <input type="hidden" name="room_id" value="">
  </div>

  <!-- Submit Button -->
  <div class="text-right mt-3">
    <button type="submit" class="btn btn-primary">
      <i class="fas fa-calendar-check mr-2"></i> Book Now
    </button>
  </div>
</form>