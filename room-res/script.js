document.addEventListener("DOMContentLoaded", function () {
  const bookingDateInput = document.getElementById("bookingDate");
  const bookingTimeSelect = document.getElementById("bookingTime");
  const roomIdInput = document.querySelector('input[name="room_id"]');

  // Format date to YYYY-MM-DD
  function formatDateLocal(date) {
    return (
      date.getFullYear() +
      "-" +
      String(date.getMonth() + 1).padStart(2, "0") +
      "-" +
      String(date.getDate()).padStart(2, "0")
    );
  }

  // Fetch booked dates and initialize Flatpickr
  fetch("get-booked-dates.php?t=" + new Date().getTime())
    .then((response) => response.json())
    .then((bookedDates) => {
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      const bookedDateSet = new Set(bookedDates);

      flatpickr(bookingDateInput, {
        dateFormat: "Y-m-d",
        minDate: "today",
        disable: [
          function (date) {
            const day = date.getDay();
            const isWeekend = day === 0 || day === 6;
            const isPast = date < today;
            const isoDate = formatDateLocal(date);
            return isWeekend || isPast || bookedDateSet.has(isoDate);
          },
        ],
        onDayCreate: function (dObj, dStr, fp, dayElem) {
          const date = dayElem.dateObj;
          const isoDate = formatDateLocal(date);
          const day = date.getDay();

          if (date < today) {
            dayElem.classList.add("past-date");
          } else if (day === 0 || day === 6) {
            dayElem.classList.add("weekend");
          } else if (bookedDateSet.has(isoDate)) {
            dayElem.classList.add("unavailable");
          } else {
            dayElem.classList.add("available");
          }
        },
        onChange: function (selectedDates, dateStr) {
          const roomId = roomIdInput.value;
          if (!roomId) return;

          fetch(`get-booked-times.php?date=${dateStr}&room_id=${roomId}`)
            .then((response) => response.json())
            .then((bookedTimes) => {
              Array.from(bookingTimeSelect.options).forEach((option) => {
                const timeText = option.text.trim();
                if (bookedTimes.includes(timeText)) {
                  option.disabled = true;
                  option.style.backgroundColor = "#f8d7da";
                  option.style.color = "#721c24";
                } else {
                  option.disabled = false;
                  option.style.backgroundColor = "";
                  option.style.color = "";
                }
              });
            });
        },
      });
    });

  // Populate booking modal with room info
  $("#bookingModal").on("show.bs.modal", function (event) {
    const button = $(event.relatedTarget);
    const roomName = button.data("room");
    const roomId = button.data("roomid");

    $("#bookingForm input[name='room_id']").val(roomId);
    $("#bookingForm").data("roomName", roomName);
  });

  // Populate confirmation modal
  $("#bookingForm").on("submit", function (e) {
    e.preventDefault();

    const date = bookingDateInput.value;
    const time = bookingTimeSelect.value;
    const guests = document.getElementById("guestCount").value;

    if (!date || !time || !guests) {
      alert("Please fill out all fields.");
      return;
    }

    const roomName = $(this).data("roomName") || "—";
    $("#confirmRoom").text(roomName);
    $("#confirmName").text($("#userName").val());
    $("#confirmCompany").text($("#userCompany").val());
    $("#confirmContact").text($("#userContact").val());
    $("#confirmEmail").text($("#userEmail").val());
    $("#confirmDate").text(date);
    $("#confirmTime").text(time);
    $("#confirmGuests").text(guests);

    $("#bookingModal").modal("hide");
    $("#confirmModal").modal("show");
  });

  // Final booking submission
  $("#confirmSubmit").on("click", function () {
    const form = document.getElementById("bookingForm");
    const formData = new FormData(form);

    fetch(form.action, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          $("#confirmModal").modal("hide");
          $("#bookingToast .toast-body").text("Your booking was successful!");
          $("#bookingToast .toast-header").removeClass("bg-danger").addClass("bg-success");
          $("#bookingToast").toast("show");
          form.reset();
          const fp = bookingDateInput._flatpickr;
          if (fp) fp.clear();
        } else {
          $("#confirmModal").modal("hide");
          $("#bookingToast .toast-body").text(data.message || "Booking failed.");
          $("#bookingToast .toast-header").removeClass("bg-success").addClass("bg-danger");
          $("#bookingToast").toast("show");
        }
      })
      .catch((error) => {
        alert("Something went wrong: " + error.message);
      });
  });

  // Print summary
  window.printSummary = function () {
    const content = document.getElementById("printableSummary").innerHTML;
    const printWindow = window.open("", "", "height=600,width=800");
    printWindow.document.write("<html><head><title>Booking Summary</title>");
    printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">');
    printWindow.document.write("<style>@media print { body { font-size: 14px; } }</style>");
    printWindow.document.write("</head><body>");
    printWindow.document.write('<div class="container mt-4">');
    printWindow.document.write('<h4 class="mb-3">Room Reservation Summary</h4>');
    printWindow.document.write(content);
    printWindow.document.write('<p class="mt-4 text-muted">Thank you for booking with us!</p>');
    printWindow.document.write("</div></body></html>");
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
  };
});