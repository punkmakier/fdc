
      </div>
    
    </div>

    <script>
        Swal.fire(
        "Hooray!",
        'This is your basic setup project!',
        'success'
        )
    </script>

    <!-- Modal -->
<div class="modal fade" id="addCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" placeholder="Add Category">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitCategory">Submit</button>
      </div>
    </div>
  </div>
</div>



    <script type="text/javascript">
      $(document).ready(function () {
        $(".sub-btn").click(function () {
          $(this).next(".sub-menu").slideToggle();
          $(this).find(".dropdown-icon").toggleClass("rotate");
        });

        $(".close-sidebar").on("click", function () {
          $(".sidebar").animate({ width: "toggle" }, 500);
          $(".show-sidebar").css("display", "block");
        });
        $(".show-sidebar").on("click", function () {
          $(".sidebar").animate({ width: "toggle" }, 500);
          $(".show-sidebar").css("display", "none");
        });
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function () {
        let myRole = $("#role").val();

        if (myRole === "encoder") {
          $("#pcTech").hide();
          $("#adminTools").hide();
        } else if (myRole === "pcTech") {
          $("#encoder").hide();
          $("#adminTools").hide();
          $("#reportAnnually").hide();
        }
      });
    </script>

    <script>
      $(document).ready( function () {
      $('#myTable').DataTable();
      });
    </script>

    <script>
      $(document).ready(function(){
        $("#itemLists").on('click',function(){
          $("#headerTitle").text("Item Lists");
          $(".dashboard").hide();
          $(".itemListsTable").show();
        });
        $("#dashboardMenu").on('click',function(){
          $("#headerTitle").text("Dashboard");
          $(".dashboard").show();
          $(".itemListsTable").hide();
        });

        $("#submitCategory").on('click', function(){
          Swal.fire({
          title: 'Please confirm!',
          text: "Are you sure do you want to add this item? ",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Confirm'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Success!',
              'Your item is added successfully!',
              'success'
              
            )
            $("#addCategory").modal('hide');
          }
        })
        })
        
      })
    </script>
  </body>
</html>
