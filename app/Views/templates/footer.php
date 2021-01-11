<?php

use App\Controllers\registerController;

?>
<em style="margin-left: 20px">&copy; 2021</em>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
        crossorigin="anonymous"></script>
<script>
$(document).ready(function () {
$.ajax({
    url: '<?= base_url('/registerController/loaddata'); ?>',
    dataType:"json",
    success:function (response) {
        var html = '<tr>';
        html += '<th>id</th>'
        html += '<th>firstname</th>'
        html += '<th>lastname</th>'
        html += '<th>email</th>'
        html += '<th>edit</th>'
        html += '<th>delete</th>'
        html += '</tr>'
        for (var count=0; count<response.users.length; count++){
            html += '<tr>';
            html += '<td class="table_data" data-row_id="'+response.users[count].id+'" data-column_name="id" contenteditable>'+response.users[count].id+'</td>'
            html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].firstname+'</td>'
            html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].lastname+'</td>'
            html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].email+'</td></tr>'
        }
        $('tbody').html(html);
    }
})
})
</script>
<script>

    $(document).on("click", '#add', function (e) {
        e.preventDefault();

        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var username = $('#username').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var password = $('#password').val();
        var password_confirm = $('#password_confirm').val();


        $.ajax({
            url: '<?= base_url('/registerController/store'); ?>',
            method: "post",
            dataType:"json",
            data: {
                firstname: firstname,
                lastname: lastname,
                username: username,
                email: email,
                phone: phone,
                password: password,
                password_confirm: password_confirm,
            },
            success: function (response) {

                if (response.msgs){
                    $('.nameError').html(response.msgs.firstname);
                    $('.lastError').html(response.msgs.lastname);
                    $('.emailError').html(response.msgs.emailE);
                    $('.userError').html(response.msgs.usernameE);
                    $('.phoneError').html(response.msgs.phoneE);
                    $('.passwordError').html(response.msgs.passwordE);
                    $('.confirmError').html(response.msgs.password_confirmE);

                }else {
                    $('.modal').modal('toggle');

                    var html = '<tr>';
                    html += '<th>id</th>'
                    html += '<th>firstname</th>'
                    html += '<th>lastname</th>'
                    html += '<th>email</th>'
                    html += '<th>edit</th>'
                    html += '<th>delete</th>'
                    html += '</tr>'
                    for (var count=0; count<response.users.length; count++){
                        html += '<tr>';
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" data-column_name="id" contenteditable>'+response.users[count].id+'</td>'
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].firstname+'</td>'
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].lastname+'</td>'
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].email+'</td></tr>'
                    }
                    $('tbody').html(html);
                }
            }
        })
    });

</script>
</body>
</html>