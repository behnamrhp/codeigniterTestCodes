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
