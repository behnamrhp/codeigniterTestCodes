<?php
foreach ($users as $user){
    echo '

    <tr>
        <td>' .$user["firstname"]. '</td>
        <td>'.$user["lastname"].'</td>
        <td>'.$user["email"].'</td>
        <td>'.'<a href="/registerController/edit/'.$user['id'].'">edit</a>'.'</td>
        <td>'.'<a href="destroy/'.$user['id'].'" onclick="return confirm(\'are you sure to delete?\')">delete</a>'.'</td>
    </tr>';
} ?>

<!--ajax insert show-->
<script>
    // load
    $(document).ready(function () {

        function load(){
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
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].id+'</td>'
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].firstname+'</td>'
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].lastname+'</td>'
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].email+'</td>'
                        html += '<td class="table_data" ><a data-row_id="'+response.users[count].id+'" data-bs-toggle="modal" data-bs-target="#editmodal" class="btn btn-primary edit" id="'+response.users[count].id+'">edit</a></td>'
                        html += '<td class="table_data" ><a class="btn btn-danger delete" id="'+response.users[count].id+'">delete</a></td></tr>'
                    }
                    $('tbody').html(html);

                }
            })
        }
        load();

    })

    // <!--store-->
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
                    $('.modal').modal('hide');
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
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" data-column_name="firstname" contenteditable >'+response.users[count].firstname+'</td>'
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" data-column_name="lastname" contenteditable>'+response.users[count].lastname+'</td>'
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" data-column_name="email" contenteditable>'+response.users[count].email+'</td>'
                        html += '<td class="table_data" ><a data-row_id="'+response.users[count].id+'" data-bs-toggle="modal" data-bs-target="#editmodal"  class="btn btn-primary edit" id="'+response.users[count].id+'">edit</a></td>'
                        html += '<td class="table_data" ><a class="btn btn-danger delete" id="'+response.users[count].id+'">delete</a></td></tr>'
                    }
                    $('tbody').html(html);
                }
            }
        })
    });


    // delete
    $(document).on('click', '.delete' , function (e) {
        e.preventDefault();
        var id=$(this).attr('id');
        if (confirm('are you sure to delete this user?'));
        $.ajax({
            url:'<?= base_url('/registerController/ajaxdestroy'); ?>',
            dataType: "json",
            method: "post",
            data:{id:id},
            success:function (response) {
                if(response){
                    function load() {
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
                            html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].id+'</td>'
                            html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].firstname+'</td>'
                            html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].lastname+'</td>'
                            html += '<td class="table_data" data-row_id="'+response.users[count].id+'" >'+response.users[count].email+'</td>'
                            html += '<td class="table_data" ><a data-row_id="'+response.users[count].id+'" data-bs-toggle="modal" data-bs-target="#editmodal" class="btn btn-primary edit" id="'+response.users[count].id+'">edit</a></td>'
                            html += '<td class="table_data" ><a class="btn btn-danger delete" id="'+response.users[count].id+'">delete</a></td></tr>'
                        }
                        $('tbody').html(html);
                    }
                    load();
                }

            }
        })
    })


    // update show
    $(document).on('click','.edit',function (e) {
        e.preventDefault();
        var id = $('.edit').data('row_id');

        $.ajax({
            url:'<?= base_url('/registerController/ajaxupdateshow'); ?>',
            method: "post",
            dataType:"json",
            data:{id:id},
            success:function (response) {
                $('#efirstname').val(response.user.firstname);
                $('#elastname').val(response.user.lastname);
                $('#eusername').val(response.user.username);
                $('#eemail').val(response.user.email);
                $('#ephone').val(response.user.phone);
            }
        })
    })

    // update

    $(document).on('click','#edit', function (e) {
        e.preventDefault();
        var id = $('.edit').data('row_id');
        var firstname = $('#efirstname').val();
        var lastname = $('#elastname').val();
        var username = $('#eusername').val();
        var email = $('#eemail').val();
        var phone = $('#ephone').val();
        var password = $('#epassword').val();
        var password_confirm = $('#epassword_confirm').val();

        $.ajax({
            url:'<?= base_url('/registerController/ajaxupdate'); ?>',
            method: "post",
            dataType:"json",
            data:{
                id:id,
                firstname:firstname,
                lastname:lastname,
                username:username,
                email:email,
                phone:phone,
                password:password,
                password_confirm:password_confirm,
            },
            success:function (response) {
                if (response.msgs){
                    $('.nameeError').html(response.msgs.firstname);
                    $('.lasteError').html(response.msgs.lastname);
                    $('.emaileError').html(response.msgs.emailE);
                    $('.usereError').html(response.msgs.usernameE);
                    $('.phoneeError').html(response.msgs.phoneE);
                    $('.passwordeError').html(response.msgs.passwordE);
                    $('.confirmeError').html(response.msgs.password_confirmE);

                }else {

                    $('#editmodal').modal('hide');
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
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" data-column_name="firstname" contenteditable >'+response.users[count].firstname+'</td>'
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" data-column_name="lastname" contenteditable>'+response.users[count].lastname+'</td>'
                        html += '<td class="table_data" data-row_id="'+response.users[count].id+'" data-column_name="email" contenteditable>'+response.users[count].email+'</td>'
                        html += '<td class="table_data" ><a data-row_id="'+response.users[count].id+'" data-bs-toggle="modal" data-bs-target="#editmodal"  class="btn btn-primary edit" id="'+response.users[count].id+'">edit</a></td>'
                        html += '<td class="table_data" ><a class="btn btn-danger delete" id="'+response.users[count].id+'">delete</a></td></tr>'
                    }
                    $('tbody').html(html);

                }
            }

        })
    })

</script>

