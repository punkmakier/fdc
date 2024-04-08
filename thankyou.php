<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you</title>
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
    <h1>Thank you for registering</h1>
    <button class="btn btn-success" id="loginForm">Continue</button>
    <!-- <a href="javascript:void(0);" style="text-decoration: none; background-color: #ccc; border: 1px solid #000; border-radius: 8px;color: #000; padding: 10px;"></a> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $("#loginForm").click(function() {
            let form = {
                email: localStorage.getItem("email"),
                password: localStorage.getItem("password"),
                action: "login",
            };
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
                        localStorage.removeItem("email")
                        localStorage.removeItem("password")
                        window.location.href="contact.php"
                    }
                    console.log(res)
                }
            })
        })
    </script>
</body>
</html>