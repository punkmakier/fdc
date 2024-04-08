
<?php 
session_start();

if(isset($_SESSION['name'])){
    header("Location: contact.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technical Exam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >

    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <h3>Sign In</h3>
    <form class="mt-5" style="width: 30%;" id="loginForm">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" >
        </div>
        <button class="btn btn-info w-100" type="submit">Submit</button>
        <div class="mt-3">
            <span>Don't have an account yet? <a href="register.php">Register</a></span>
        </div>
    </form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<script>
    $("#loginForm").submit(function(e) {
        e.preventDefault();
        let form = $("#loginForm").serialize()+"&action=login";
        $.ajax({
            type: "POST",
            url: "Controller/AuthController.php",
            data: form,
            success: function(res){
                if(res != "success"){
                    Swal.fire({
                        title: "Failed",
                        text: "Invalid email or password credentials.",
                        icon: "error"
                    });
                    return
                }else{
                    window.location.href="contact.php"
                }
                console.log(res)
            }
        })
    })


</script>

</body>
</html>