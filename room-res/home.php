<?php include 'head.php'; ?>
<?php include 'sidebar.php'; ?>


<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: /ROOM-RES/user_admin/index.php");
  exit();
}
 ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h2 class="mb-4 text-dark font-weight-bold">Available Rooms</h2>
    </div>
  </div>

  <!-- Main Content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- Room 1 -->
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card shadow-sm border-0">
            <img src="room1.avif" class="card-img-top" alt="Room 1">
            <div class="card-body">
              <h5 class="card-title text-primary">Room 1</h5>
              <p class="card-text text-muted">Can accommodate up to 20 guests</p>
              <button class="btn btn-outline-primary" data-toggle="modal" data-target="#bookingModal" data-room="Room 1" data-roomid="1">
                <i class="fas fa-calendar-plus mr-1"></i> Book Now
              </button>
            </div>
          </div>
        </div>

        <!-- Room 2 -->
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card shadow-sm border-0">
            <img src="room2.webp" class="card-img-top" alt="Room 2">
            <div class="card-body">
              <h5 class="card-title text-primary">Room 2</h5>
              <p class="card-text text-muted">Can accommodate up to 20 guests</p>
              <button class="btn btn-outline-primary" data-toggle="modal" data-target="#bookingModal" data-room="Room 2" data-roomid="2">
                <i class="fas fa-calendar-plus mr-1"></i> Book Now
              </button>
            </div>
          </div>
        </div>

        <!-- Room 3 -->
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card shadow-sm border-0">
            <img src="room3.avif" class="card-img-top" alt="Room 3">
            <div class="card-body">
              <h5 class="card-title text-primary">Room 3</h5>
              <p class="card-text text-muted">Can accommodate up to 20 guests</p>
              <button class="btn btn-outline-primary" data-toggle="modal" data-target="#bookingModal" data-room="Room 3" data-roomid="3">
                <i class="fas fa-calendar-plus mr-1"></i> Book Now
              </button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="bookingModalLabel">
          <i class="fas fa-calendar-check mr-2"></i> Room Booking Form
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include 'form.php'; ?>
      </div>
    </div>
  </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="confirmModalLabel">
          <i class="fas fa-calendar-check mr-2"></i> Confirm Booking
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="printableSummary">
        <div class="bg-light p-3 rounded">
          <h6 class="text-primary mb-3">Booking Summary</h6>
          <hr>
          <p><strong>Name:</strong> <span id="confirmName"></span></p>
          <p><strong>Company/Agency:</strong> <span id="confirmCompany"></span></p>
          <p><strong>Contact #:</strong> <span id="confirmContact"></span></p>
          <p><strong>Email:</strong> <span id="confirmEmail"></span></p>
          <p><strong>Room:</strong> <span id="confirmRoom"></span></p>
          <p><strong>Date:</strong> <span id="confirmDate"></span></p>
          <p><strong>Time:</strong> <span id="confirmTime"></span></p>
          <p><strong>Guests:</strong> <span id="confirmGuests"></span></p>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline-dark" onclick="printSummary()">Print Summary</button>
        <button type="button" id="confirmSubmit" class="btn btn-primary">Confirm Booking</button>
      </div>
    </div>
  </div>
</div>

<!-- Toast Notification -->
<div class="position-fixed p-3" style="z-index: 1055; right: 1rem; bottom: 1rem;">
  <div id="bookingToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
    <div class="toast-header bg-success text-white">
      <strong class="mr-auto"><i class="fas fa-check-circle"></i> Booking</strong>
      <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      Your booking was successful!
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>

</html>