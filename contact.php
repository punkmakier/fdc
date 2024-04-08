<?php 
session_start();

if(!isset($_SESSION['name'])){
    header("Location: index.php");
}
$uidSes = $_SESSION['uid'];
include  'Model/Pagination.php' ;
$paginate=new Pagination("contacts",basename(__FILE__),5,2,"","WHERE uid='$uidSes'") ;

$paginate->paginate_links();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >

    <style>
        body{
            display: grid;
            /* justify-content: center;
            align-items: center; */
            place-items: center;
            height: 100vh;
            /* flex-direction: column; */
        }
        .pagination{
            position: absolute;
            left: 25%;
            bottom: 10% !important;
        }
    </style>
</head>
<body>
    <div style="width: 50%;display:flex; justify-content: flex-start; gap: 20px;flex-direction: column">
        <h4>Hi, good day!</h4>
        <div>
            <span><?php echo $_SESSION['name']; ?></span>
            <a href="Controller/logout.php">Logout</a>
        </div>
        
    </div>


    <div style="width: 50%;margin-top: 30px;position: relative; " class="position-relative">
        <h1>Contacts</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addContactModal">Add</button>
        <div style="display:flex; justify-content: end;">
        <input type="email" class="form-control mt-3 w-25" id="searchKeyword" placeholder="Search here..." oninput="handleSearch()">
        </div>
        <table class="table mt-3 table-striped table-bordered position-relative">
            <thead>
                <th>Name</th>
                <th>Company</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody class="position-relative" id="bodyTable">
                <?php   
                    if($paginate->getData() === 'No data'){
                        echo "<h4 style='margin-top: 80px;'>No Data.</h4>";
                    }
                    else {
                    foreach($paginate->getData() as $data){
                    ?>
                <tr>
                    <td style='display: none;'><?php echo $data["uid"] ?></td>
                    <td><?php echo $data["name"] ?></td>
                    <td><?php echo $data["company"] ?></td>
                    <td><?php echo $data["phone"] ?></td>
                    <td><?php echo $data["email"] ?></td>
                    <td>
                        <button class='btn btn-warning edit' >Edit</button>
                        <button class='btn btn-danger' onclick='deleteContact(<?php echo $data["uid"] ?>, <?php echo $data["id"] ?>)'>Delete</button>
                    </td>
                </tr>
                
                <?php  } }?>
            </tbody>
        </table>

    </div>

    <div class="modal fade" id="addContactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Contact</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_contact_form">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['uid'] ?>" name="uid">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"  placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="company" name="company" placeholder="FDC">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="john@gmail.com">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add_contact">Submit</button>
                </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="updateContactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Contact</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update_contact_form">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['uid'] ?>" name="updt_uid">
                    <div class="mb-3">
                        <label for="updt_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="updt_name" name="updt_name" placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label for="updt_company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="updt_company" name="updt_company" placeholder="FDC">
                    </div>
                    <div class="mb-3">
                        <label for="updt_phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="updt_phone" name="updt_phone">
                    </div>
                    <div class="mb-3">
                        <label for="updt_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="updt_email" name="updt_email" placeholder="john@gmail.com">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="updt_submit">Submit</button>
                </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<script>

    

    $("#add_contact_form").submit(function(e) {
        e.preventDefault();
        let form = $("#add_contact_form").serialize()+"&action=add";
        $.ajax({
            type: "POST",
            url: "Controller/ContactController.php",
            data: form,
            success: function(res){
                console.log(res)
                if(res === "success"){
                    Swal.fire({
                    title: "Success",
                    text: "New contact has been added successfully.",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                    return
                }else{
                     Swal.fire({
                        title: "Failed",
                        text: "Something went wrong...",
                        icon: "error"
                    });
                }
            }
        })
    })


    $("body").on("click", ".edit", function(){
        $tr = $(this).closest('tr');
        var row = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#updt_name').val(row[1]);
        $('#updt_company').val(row[2]);
        $('#updt_phone').val(row[3]);
        $('#updt_email').val(row[4]);
        $("#updateContactModal").modal("show");
    });



    $("#update_contact_form").submit(function(e) {
        e.preventDefault();
        let form = $("#update_contact_form").serialize()+"&action=update";
        $.ajax({
            type: "POST",
            url: "Controller/ContactController.php",
            data: form,
            success: function(res){
                console.log(res)
                if(res === "success"){
                    Swal.fire({
                    title: "Success",
                    text: "Contact details has been updated successfully.",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                    return
                }else{
                     Swal.fire({
                        title: "Failed",
                        text: "Something went wrong...",
                        icon: "error"
                    });
                }
            }
        })
    })


function handleSearch() {
    var searchValue = document.getElementById("searchKeyword").value;
     $.ajax({
            type: "POST",
            url: "Controller/ContactController.php",
            data: {action: "search", keyword: searchValue, uid: <?php echo $_SESSION['uid']; ?>},
            success: function(res){
                $("#bodyTable").html(res)
                console.log(res)
            }
        });
    // return searchValue
}

function handleKeyPress(event) {
    if (event.keyCode === 13) {
        $.ajax({
            type: "POST",
            url: "Controller/ContactController.php",
            data: {action: "search", keyword: handleSearch(), uid: <?php echo $_SESSION['uid']; ?>},
            success: function(res){
                $("#bodyTable").html(res)
                console.log(res)
            }
        });
    }
}




    function deleteContact(uid, id){
        Swal.fire({
        title: "Confirmation needed",
        text: "Are you sure you want to delete this contact?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                type: "POST",
                url: "Controller/ContactController.php",
                data: {action: "delete", uid: uid, id: id},
                success: function(res){
                    console.log(res)
                    if(res === "success"){
                        Swal.fire({
                        title: "Success",
                        text: "Selected contact deleted successfully",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                        return
                    }else{
                        Swal.fire({
                            title: "Failed",
                            text: "Something went wrong...",
                            icon: "error"
                        });
                    }
                }
            })
            }
        });


        
    }


</script>
</body>
</html>