<?php session_start(); ?><!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("inc/rmhead.inc.php") ?>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Add the style for image -->
  <style>
    .hero{
    background-image: url('https://c4.wallpaperflare.com/wallpaper/357/694/537/tables-cafe-view-interior-wallpaper-preview.jpg');  /* Replace 'path/to/your/image.jpg' with the actual path to your image file */
    background-size: cover; /* You can use 'contain' or other values depending on your preference */
    background-repeat: no-repeat;
    background-attachment: fixed; /* This makes the background image fixed while scrolling */
    animation: fadeIn 4s ease;
}
    .edit-form {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      padding: 20px;
      border: 1px solid #ccc;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>

  <script>
    $(document).ready(function () {
      // Fetch and display dishes when the page loads
      updateTable();

      // Function to show/hide the add dish form
      $('#addDishBtn').click(function () {
        $('#addDishForm').toggle();
      });

      // Function to handle the submission of the add dish form
      $('#addDishForm').submit(function (event) {
        event.preventDefault();

        // Implement AJAX request to add the dish to the database
        $.ajax({
          url: 'process_dishes.php',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function () {
            // After successful addition, update the table and hide the form
            updateTable();
            $('#addDishForm').hide();
          },
          error: function (error) {
            console.log('Error adding dish: ', error);
          }
        });
      });

      // Function to handle the deletion of a dish
      $(document).on('click', '.deleteBtn', function () {
        var dishId = $(this).data('dish-id');

        // Implement AJAX request to delete the dish from the database based on dishId
        $.ajax({
          url: 'delete_dish.php',
          type: 'POST',
          data: { dishId: dishId },
          success: function () {
            // After successful deletion, update the table
            updateTable();
          },
          error: function (error) {
            console.error('Error deleting dish: ', error);
          }
        });
      });

      // Function to handle the edit of a dish
      $(document).on('click', '.editBtn', function () {
    var dishId = $(this).data('dish-id');

    // Fetch all dishes
    $.ajax({
        url: 'get_dishes.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Find the selected dish based on dishId
            var selectedDish = data.find(dish => dish.d_id == dishId);

            // Populate the edit form with fetched details
            $('#editDName').val(selectedDish.d_name);
            $('#editDPrice').val(selectedDish.d_price);
            $('#editDDesc').val(selectedDish.d_desc);

            // Set dishId for the Done button
            $('#saveEditBtn').data('dish-id', dishId);

            // Show the edit form (popup)
            $('#editForm').show();
        },
        error: function (error) {
            console.error('Error fetching dish details: ', error);
        }
    });
});

      // Function to handle the cancellation of the edit form
      $('#cancelEditBtn').click(function () {
        // Hide the edit form (popup)
        $('#editForm').hide();
      });

      // Function to handle the submission of the edit form
      $('#saveEditBtn').click(function () {
    var dishId = $(this).data('dish-id');

    // Implement AJAX request to update the dish in the database
    $.ajax({
        url: 'update_dish.php',
        type: 'POST',
        data: {
            dishId: dishId,
            dname: $('#editDName').val(),
            dprice: $('#editDPrice').val(),
            ddesc: $('#editDDesc').val(),
            // Add other fields for update if needed
        },
        success: function (response) {
            console.log('Update response:', response);

            // Update the table directly in the success handler
            updateTable();
        },
        error: function (error) {
            var errorMessage = error.responseJSON && error.responseJSON.error ? error.responseJSON.error : 'Unknown error';
            console.error('Error updating dish:', errorMessage);

            // Log the error on the client side for additional debugging
            alert('Error updating dish: ' + errorMessage);
        }
    });
});

// Function to handle AJAX request and update the table dynamically
function updateTable() {
    $.ajax({
        url: 'get_dishes.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Clear the existing table body
            $('#dishTable tbody').empty();

            // Populate the table with updated data
            data.forEach(function (dish) {
                // Create a new row
                var newRow = $('<tr></tr>');

                // Append the image to the "Photo" column
                newRow.append($('<td class="photo-column"></td>').html(`<img src="${dish.d_photo}" alt="${dish.d_name} Photo" style="width: 150px; height: 100px; object-fit: cover;">`));

                // Append other columns
                newRow.append($('<td></td>').text(dish.d_name));
                newRow.append($('<td></td>').text(dish.d_price));
                newRow.append($('<td></td>').text(dish.d_desc));

                // Append actions column
                var actionsColumn = $('<td></td>');
                actionsColumn.append($('<button class="editBtn btn btn-success" data-dish-id="' + dish.d_id + '">Edit</button>'));
                actionsColumn.append($('<button class="deleteBtn btn btn-danger" data-dish-id="' + dish.d_id + '">Delete</button>'));
                newRow.append(actionsColumn);

                // Append the new row to the table body
                $('#dishTable tbody').append(newRow);
            });

            // Hide the edit form after the table has been updated
            $('#editForm').hide();
        },
        error: function (error) {
            console.log('Error fetching dishes: ', error);
        }
    });
}
    });
  </script>
</head>

<body class="index-page" data-bs-spy="scroll" data-bs-target="#navmenu">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">

    <?php require_once("inc/hungry.inc.php") ?>
    <?php require_once("inc/nav.inc.php") ?>  
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- Hero Section - Home Page -->
    <section id="hero" class="hero">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <!-- Button to add dishes -->
        <button id="addDishBtn" class="btn btn-outline-info">Add Dishes</button>
        <!-- Form to add a dish -->
        <form id="addDishForm" style="display: none;" action="process_dishes.php" method="post" enctype='multipart/form-data'>
          <!-- Add your form fields for dish details here -->
          <div class="mb-3">
          <input type="text" id="dname" name="dname" placeholder="Dish Name" aria-label="Dish Name"><br>
          <input type="text" id="dprice" name="dprice" placeholder="Dish Price" aria-label="Dish Price"><br>
          Photo: <input type="file" id="dphoto" name="dphoto"><br>
          <textarea id="ddesc" name="ddesc" placeholder="Dish Description" aria-label="Dish Description"></textarea><br>
          </div>
          <button type="submit" class="btn btn-outline-success">Done</button>
        </form>
       
        <!-- Edit Form (popup) -->
        <div id="editForm" class="edit-form mb-3">
          <h2>Edit Dish</h2>
          Dish Name: <input type="text" id="editDName" name="editDName"><br>
          Price: <input type="text" id="editDPrice" name="editDPrice"><br>
          Description: <textarea id="editDDesc" name="editDDesc"></textarea><br>
          <!-- Add other fields for editing -->
          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
          <button id="saveEditBtn" data-dish-id="" class="btn btn-success">Done</button>
          <button id="cancelEditBtn" class="btn btn-danger">Cancel</button>
          </div>
        </div>
       <!-- Restaurant Manager Table -->
        <table id="dishTable" class="table">
          <thead>
            <tr>
              <th scope="col" class="photo-column">Photo</th>
              <th scope="col">Dish Name</th>
              <th scope="col">Price</th>
              <th scope="col">Description</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Table rows will be dynamically populated here -->
          </tbody>
        </table><!-- End Restaurant Manager Table -->

      </div>
    </section>
  </main>
  <?php require_once("inc/footer.inc.php") ?>
</body>

</html>