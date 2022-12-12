$('.login-btn').click(function (e){
    e.preventDefault()
    let username = $('input[name="username"]').val();
    let password = $('input[name="password"]').val();

    $.ajax({
        url: 'vendor/signin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            username: username,
            password: password
        },
        success(data){
            if(data.status){
                document.location.href = '/main.php';
            } else {
                $('#error').text(data.error);
            }
        }
    })
});

$('.signup-btn').click(function (e){
    e.preventDefault()
    let username = $('input[name="username"]').val();
    let password = $('input[name="password"]').val();
    let subPassword = $('input[name="sub_password"]').val();
    let email = $('input[name="email"]').val();
    let name = $('input[name="name"]').val();

    $.ajax({
        url: 'vendor/signup.php',
        type: 'POST',
        dataType: 'json',
        data: {
            username: username,
            password: password,
            sub_password: subPassword,
            email: email,
            name: name
        },
        success(data){
            $('.error').text('');
            $('.error_field').text('');
            if(data.status){
                document.location.href = '/index.php';
                $('.success').text("Successfully signed up");
            } else {
                $("#error" + data.error_id).text(data.message);
                console.log(data.error_id);
            }
        }
    })
});

