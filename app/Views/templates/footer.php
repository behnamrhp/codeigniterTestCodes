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
</body>
</html>