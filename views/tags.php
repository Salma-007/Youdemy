<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Youdemy
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <style>
    /* Custom white background for main content */
    .main-content {
      background-color: white; /* Set background to white */
      padding: 20px; /* Adjust padding for better spacing */
      border-radius: 10px; /* Optional: Add rounded corners */
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
<?php include('../public/assets/components/sidebar.php'); ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include('../public/assets/components/navbar.php'); ?>
    <!-- End Navbar -->

    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row">
        <div class="ms-3">
        <div class="container my-5">
    <h3 class="mb-4">Manage Tags</h3>

    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTagModal">
      Add New Tag
    </button>

    <!-- Categories Table -->
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Tag Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($getAllTags as $tag): ?>
          <tr>
            <td><?= htmlspecialchars($tag['nom_tag']) ?></td>
            <td>
            <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editTagModal" 
            data-id="<?= $tag['id'] ?>" 
            data-name="<?= htmlspecialchars($tag['nom_tag']) ?>">
            Update
          </button>
              <a href="/deleteTag?id=<?= $tag['id'] ?>" class="btn btn-danger btn-sm"> delete </a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addTagModalLabel">Add New Tag</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/createTag" method="POST">
              <div class="mb-3">
                <label for="tagName" class="form-label">Tag Name</label>
                <input type="text" class="form-control" id="tagName" name="tagName" placeholder="Enter tag name" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Tag</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Edit Category Modal -->
<div class="modal fade" id="editTagModal" tabindex="-1" aria-labelledby="editTagModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editTagModalLabel">Edit Tag</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/updateTag" method="POST">
          <input type="hidden" name="tagId" id="editTagId">
          <div class="mb-3">
            <label for="tagName" class="form-label">Tag Name</label>
            <input type="text" class="form-control" id="editTagName" name="tagName" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Tag</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  </div>
  <script>

  const editTagModal = document.getElementById('editTagModal');
  editTagModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const categoryId = button.getAttribute('data-id');
    const categoryName = button.getAttribute('data-name');
    
    const modalCategoryId = editTagModal.querySelector('#editTagId');
    const modalCategoryName = editTagModal.querySelector('#editTagName');
    
    modalCategoryId.value = categoryId;
    modalCategoryName.value = categoryName;
  });
</script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/world.js"></script>
  <script>
    // Initialize the vector map
    var map = new jsVectorMap({
      selector: "#vector-map",
      map: "world_merc",
      zoomOnScroll: false,
      zoomButtons: false,
      selectedMarkers: [1, 3],
      markersSelectable: true,
      markers: [{
          name: "USA",
          coords: [40.71296415909766, -74.00437720027804]
        },
        {
          name: "Germany",
          coords: [51.17661451970939, 10.97947735117339]
        },
        {
          name: "Brazil",
          coords: [-7.596735421549542, -54.781694323779185]
        },
        {
          name: "Russia",
          coords: [62.318222797104276, 89.81564777631716]
        },
        {
          name: "China",
          coords: [22.320178999475512, 114.17161225541399],
          style: {
            fill: '#E91E63'
          }
        }
      ],
      markerStyle: {
        initial: {
          fill: "#e91e63"
        },
        hover: {
          fill: "E91E63"
        },
        selected: {
          fill: "E91E63"
        }
      },


    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <!-- <script src="../../public/assets/assets/js/material-dashboard.min.js?v=3.2.0"></script> -->
      <!-- Page level plugins -->
      <script src="../public/assets/vendor/jquery/jquery.min.js"></script>
    <script src="../public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../public/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->

  <script src="../public/assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../public/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>


    <!-- Page level custom scripts -->
  <script src="../public/assets/vendor/js/demo/datatables-demo.js"></script>
      <!-- Page level custom scripts -->
      <script src="../public/assets/js/demo/datatables-demo.js"></script>
</body>

</html>