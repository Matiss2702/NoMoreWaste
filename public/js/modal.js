function sign_in() {
    $('#sign-in').addClass('active')
    $('#sign-up').removeClass('active')
    $('#reset-tab').removeClass('show active')
    $('#sign-up-tab').removeClass('show active')
    $('#sign-in-tab').addClass('show active')
}

// function adminssign_in() {
//    $('#sign-in').addClass('active')
//    $('#sign-up').removeClass('active')
//    $('#reset-tab').removeClass('show active')
//    $('#sign-up-tab').removeClass('show active')
//    $('#sign-in-tab').addClass('show active')
// }

function sign_up() {
     $('#sign-up').addClass('active')
     $('#sign-in').removeClass('active')
     $('#sign-in-tab').removeClass('show active')
     $('#reset-tab').removeClass('show active')
     $('#sign-up-tab').addClass('show active')
}

function reset_pwd() {
     $('#sign-in').removeClass('active')
     $('#sign-up').removeClass('active')
     $('#sign-in-tab').removeClass('show active')
     $('#sign-up-tab').removeClass('show active')
     $('#reset-tab').addClass('show active')
}


$(document).ready(function() {
   $("#check-pwd").click(function() {
       if ($("input[type=checkbox]").is(
         ":checked")) {
            $('#pwd').removeClass('d-none')
            $('#pwd-confirm').removeClass('d-none')
            $('#lbl-pwd').removeClass('d-none')
            $('#lbl-pwd-confirm').removeClass('d-none')
       } else {
         $('#pwd').addClass('d-none')
         $('#pwd-confirm').addClass('d-none')
         $('#lbl-pwd').addClass('d-none')
         $('#lbl-pwd-confirm').addClass('d-none')
       }
   });
});

$(document).on("change", "#file-name", function () {
   if (this.files && this.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
         $('#preview').attr('src', e.target.result);
      };
      reader.readAsDataURL(this.files[0]);
   }
});

function delete_modal(id) {
   $('#delete-modal').attr('data-id', id)
}

function img_data(status) {
   $('#image-modal').attr('data-status', status)
}

// function modify_product(id, img, name, price, type, reduct, desc, status) {

//    $('#modify-modal').attr('data-id', id)
//    $('#modify-name').val(name)
//    $('#modify-price').val(price)
//    $('#modify-product-type').val(type)
//    $('#modify-img').val(img)
//    $('#modify-img').attr('src', "/images/"+img)
//    $('#modify-hidden-img').val(img)
//    $('#modify-reduction').val(reduct)
//    $('#modify-description').val(desc)

//    if (status == '1') {
//       $("#modify-check-status").attr('checked', true)
//    } else {
//       $("#modify-check-status").attr('checked', false)
//    }
// }



function modify_benevoles(id, fristname,lastname,password,address,city,phone,country,zipcode,) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-fristname').val(fristname)
   $('#modify-lastname').val(lastname)
   $('#modify-password').val(password)
   $('#modify-address').val(address)
   $('#modify-city').val(city)
   $('#modify-phone').val(phone)
   $('#modify-country').val(country)
   $('#modify-zipcode').val(zipcode)

   if (valided == '1') {
      $("#modify-check-valided").attr('checked', true)
   } else {
      $("#modify-check-valided").attr('checked', false)
   }
}
function modify_admins(id, name, password) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-name').val(name)
   $('#modify-password').val(password)
}
function modify_Conditions(id, question) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-question').val(question)

}
function modify_Disponibilitys(id, start,end) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-start').val(start)
   $('#modify-end').val(end)
}
function delete_Has_condition(id) {

   $('#modify-modal').attr('data-id', id)

}
function modify_Jobs(id, name) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-name').val(name)
}
function delete_Necessitys(id) {

   $('#modify-modal').attr('data-id', id)
}
function modify_Plannings(id, lundi,mardi,mercredi,jeudi,vendredi) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-lundi').val(lundi)
   $('#modify-mardi').val(mardi)
   $('#modify-mercredi').val(mercredi)
   $('#modify-jeudi').val(jeudi)
   $('#modify-vendredi').val(vendredi)
   $('#modify-phone').val(phone)
   $('#modify-country').val(country)
   $('#modify-zipcode').val(zipcode)
}
function delete_Tasks(id, strat,end,place_start,description) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-strat').val(strat)
   $('#modify-end').val(end)
   $('#modify-place_start').val(place_start)
   $('#modify-description').val(description)
}

