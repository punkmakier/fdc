
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
    <h3>Registration</h3>
    <form class="mt-5" style="width: 30%;" id="registerForm">
      <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="fname" class="form-control" id="name" placeholder="John Doe">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" >
        </div>
        <div class="mb-3">
            <label for="con_password" class="form-label">Confirm Password</label>
            <input type="password" name="con_password" id="con_password" class="form-control" >
        </div>
        <button class="btn btn-info w-100" type="submit">Submit</button>
        <div class="mt-3">
            <span>Already have account? <a href="index.php">Login</a></span>
        </div>
    </form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<script>
    $("#registerForm").submit(function(e) {
        e.preventDefault();
        let form = $("#registerForm").serialize()+"&action=register";

        if($("#password").val() != $("#con_password").val()){
            Swal.fire({
                title: "Failed",
                text: "Passwords do not match",
                icon: "error"
            });
            return;
        }


        $.ajax({
            type: "POST",
            url: "Controller/AuthController.php",
            data: form,
            success: function(res){
                if(res === 'Email exist'){
                    Swal.fire({
                        title: "Failed",
                        text: "Email already registered",
                        icon: "error"
                    });
                    return;
                }else{
                    localStorage.setItem('email',$("#email").val())
                    localStorage.setItem('password',$("#password").val())
                    window.location.href='thankyou.php'
                }
                console.log(res)
            }
        })
    })


</script>

</body>
</html>