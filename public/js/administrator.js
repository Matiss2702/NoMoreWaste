function login_admin(csrf_token) {
"use strict";
  var check = true;
  const mail = document.getElementById('mail').value
  const pwd = document.getElementById('password').value

  $.ajax({
    url: "/login_admin",
    type: 'POST',
    data: { mail: mail, password: pwd, csrf_token_name: csrf_token },
    success: function (reponse) {
      console.log(reponse)
      toastr.success(reponse.message)
      window.location.href='/admin'
    },
    error: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.error(reponse.responseJSON.messages['error'])
    }
  })
}
