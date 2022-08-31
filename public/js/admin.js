function change_image_add(new_image) {
  document.getElementById("add-hidden-img").setAttribute("value", new_image)
  document.getElementById("add-img").setAttribute("src", "/images/" + new_image)
}

function change_image_update(new_image) {
  document.getElementById("modify-hidden-img").setAttribute("value", new_image)
  document.getElementById("modify-img").setAttribute("src", "/images/" + new_image)
}

function add_image(csrf_token) {
  let file = document.getElementById('file-name').value
  let array = file.split('\\')
  let file_name = array.pop()
  var form_data = new FormData($('#upload-file')[0])
  $.ajax({
    url: "/add_image/",
    type: "POST",
    contentType: false,
    cache: false,
    processData: false,
    data: form_data,
    success: function (response) {
      console.log(file_name)
      toastr.success(response.message)
      if ($('#image-modal').attr('data-status') == "add") {
        change_image_add(file_name)
      } else {
        change_image_update(file_name)
      }
    },
    error: function (response) {
      var errors = JSON.parse(response.responseText)
      for (var message in errors.messages) {
        toastr.error(errors.messages[message])
      }
    }
  })
}

function add_Admins(csrf_token) {
  password= $('#add-password').val()
  mail = $('#add-mail').val()
  let data = { password: password, mail: mail, csrf_token_name: csrf_token }
  if ($("#add-check-valided").is(":checked")) {
    data['valided'] = '1'
  } else {
    data['valided'] = '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/Admins/create/",
    type: "POST",
    data: data,
    success: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.success(reponse.message)
    },
    error: function (reponse) {
      var errors = JSON.parse(reponse.responseText)
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      for (var message in errors.messages) {
        toastr.error(errors.messages[message])
      }
    }
  })
}

function modify_Admins(id,csrf_token) {
  id =$('#modify-id').val()
  password = $('#modify-password').val()
  mail = $('#modify-mail').val()
  let data = { id: id,  mail: mail, password: password, csrf_token_name: csrf_token }
    if($("#modify-check-valided").is(":checked")){
      data['valided']= '1'
    } else{
        data['valided']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/Admins/update/" + id,
      type: "POST",
      data: data,
      success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
        toastr.success(reponse.message)
      },
      error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
         for (var message in errors.messages){
           toastr.error(errors.messages[message])
         }
      }
    })
}

function delete_Admins(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/Admins/delete/"+id,
        type: "POST",
        data: data,
        success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
        toastr.success(reponse.messages.success)
        },
        error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
         for (var message in errors.messages){
             toastr.error(errors.messages[message])
         }
        }
    })
}

function add_Benevoles(csrf_token) {
  password= $('#add-password').val()
  firtname = $('#add-firtname').val()
  lastname = $('#add-lastname').val()
  mail = $('#add-mail').val() 
  address = $('#add-address').val()
  city = $('#add-city').val()
  zipcode = $('#add-zipcode').val()
  country = $('#add-country').val()
  phone = $('#add-phone').val()
  id_jobs = $('#add-id_jobs').val()
  let data = { password: password, firtname: firtname, lastname: lastname, mail: mail, address: address, city: city, zipcode: zipcode, country: country, phone: phone, id_jobs: id_jobs, csrf_token_name: csrf_token }
  if ($("#add-check-valided").is(":checked")) { 
    data['valided'] = '1'
  } else {
    data['valided'] = '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/Benevoles/create/",
    type: "POST",
    data: data,
    success: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.success(reponse.message)
    },
    error: function (reponse) {
      var errors = JSON.parse(reponse.responseText)
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      for (var message in errors.messages) {
        toastr.error(errors.messages[message])
      }
    }
  })
}

function modify_Benevoles(id,csrf_token) {
  id =$('#modify-id').val()
  password= $('#modify-password').val()
  firtname = $('#modify-firtname').val()
  lastname = $('#modify-lastname').val()
  mail = $('#modify-mail').val() 
  address = $('#modify-address').val()
  city = $('#modify-city').val()
  zipcode = $('#modify-zipcode').val()
  country = $('#modify-country').val()
  phone = $('#modify-phone').val()
  id_jobs = $('#modify-id_jobs').val()
  let data = { id: id, password: password, firtname: firtname, lastname: lastname, mail: mail, address: address, city: city, zipcode: zipcode, country: country, phone: phone, id_jobs: id_jobs, csrf_token_name: csrf_token }
    if($("#modify-check-valided").is(":checked")){
      data['valided']= '1'
    } else{
        data['valided']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/Benevoles/update/" + id,
      type: "POST",
      data: data,
      success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
        toastr.success(reponse.message)
      },
      error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
         for (var message in errors.messages){
           toastr.error(errors.messages[message])
         }
      }
    })
}

function delete_Benevoles(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/Benevoles/delete/"+id,
        type: "POST",
        data: data,
        success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
        toastr.success(reponse.messages.success)
        },
        error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
         for (var message in errors.messages){
             toastr.error(errors.messages[message])
         }
        }
    })
}

function add_Conditions(csrf_token) {
  question= $('#add-question').val()
  let data = { question: question, csrf_token_name: csrf_token }
  if ($("#add-check-valided").is(":checked")) { 
    data['valided'] = '1'
  } else {
    data['valided'] = '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/Conditions/create/",
    type: "POST",
    data: data,
    success: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.success(reponse.message)
    },
    error: function (reponse) {
      var errors = JSON.parse(reponse.responseText)
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      for (var message in errors.messages) {
        toastr.error(errors.messages[message])
      }
    }
  })
}

function modify_Conditions(id,csrf_token) {
  id =$('#modify-id').val()
  question= $('#modify-question').val()
  let data = { id: id, question: question, csrf_token_name: csrf_token }
    if($("#modify-check-valided").is(":checked")){
      data['valided']= '1'
    } else{
        data['valided']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/Conditions/update/" + id,
      type: "POST",
      data: data,
      success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
        toastr.success(reponse.message)
      },
      error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
         for (var message in errors.messages){
           toastr.error(errors.messages[message])
         }
      }
    })
}

function delete_Conditions(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/Conditions/delete/"+id,
        type: "POST",
        data: data,
        success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
        toastr.success(reponse.messages.success)
        },
        error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
         for (var message in errors.messages){
             toastr.error(errors.messages[message])
         }
        }
    })
}

function add_Disponibilitys(csrf_token) {
  start= $('#add-start').val()
  end= $('#add-end').val()
  
  let data = { start: start, end: end, csrf_token_name: csrf_token }
  if ($("#add-check-valided").is(":checked")) { 
    data['valided'] = '1'
  } else {
    data['valided'] = '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/Disponibilitys/create/",
    type: "POST",
    data: data,
    success: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.success(reponse.message)
    },
    error: function (reponse) {
      var errors = JSON.parse(reponse.responseText)
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      for (var message in errors.messages) {
        toastr.error(errors.messages[message])
      }
    }
  })
}

function modify_Disponibilitys(id,csrf_token) {
  id =$('#modify-id').val()
  start= $('#modify-start').val()
  end= $('#modify-end').val()
  let data = { id: id, start: start,end: end, csrf_token_name: csrf_token }
    if($("#modify-check-valided").is(":checked")){
      data['valided']= '1'
    } else{
        data['valided']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/Disponibilitys/update/" + id,
      type: "POST",
      data: data,
      success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
        toastr.success(reponse.message)
      },
      error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
         for (var message in errors.messages){
           toastr.error(errors.messages[message])
         }
      }
    })
}

function delete_Disponibilitys(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/Disponibilitys/delete/"+id,
        type: "POST",
        data: data,
        success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
        toastr.success(reponse.messages.success)
        },
        error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
         for (var message in errors.messages){
             toastr.error(errors.messages[message])
         }
        }
    })
}


function add_Has_Conditions(csrf_token) {
  id_jobs= $('#add-id_jobs').val()
  id_conditions= $('#add-id_conditions').val()
  
  let data = { id_jobs: id_jobs, id_conditions: id_conditions, csrf_token_name: csrf_token }
  if ($("#add-check-valided").is(":checked")) { 
    data['valided'] = '1'
  } else {
    data['valided'] = '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/Has_Conditions/create/",
    type: "POST",
    data: data,
    success: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.success(reponse.message)
    },
    error: function (reponse) {
      var errors = JSON.parse(reponse.responseText)
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      for (var message in errors.messages) {
        toastr.error(errors.messages[message])
      }
    }
  })
}

function modify_Has_Conditions(id,csrf_token) {
  id =$('#modify-id').val()
  id_jobs= $('#modify-id_jobs').val()
  id_conditions= $('#modify-id_conditions').val()
  let data = { id: id, id_jobs: id_jobs,id_conditions: id_conditions, csrf_token_name: csrf_token }
    if($("#modify-check-valided").is(":checked")){
      data['valided']= '1'
    } else{
        data['valided']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/Has_Conditions/update/" + id,
      type: "POST",
      data: data,
      success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
        toastr.success(reponse.message)
      },
      error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
         for (var message in errors.messages){
           toastr.error(errors.messages[message])
         }
      }
    })
}

function delete_Has_Conditions(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/Has_Conditions/delete/"+id,
        type: "POST",
        data: data,
        success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
        toastr.success(reponse.messages.success)
        },
        error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
         for (var message in errors.messages){
             toastr.error(errors.messages[message])
         }
        }
    })
}


function add_Has_Jobs(csrf_token) {
  label= $('#add-name').val() 
  let data = { name: label, csrf_token_name: csrf_token }
  if ($("#add-check-valided").is(":checked")) { 
    data['valided'] = '1'
  } else {
    data['valided'] = '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/Jobs/create/",
    type: "POST",
    data: data,
    success: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.success(reponse.message)
    },
    error: function (reponse) {
      var errors = JSON.parse(reponse.responseText)
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      for (var message in errors.messages) {
        toastr.error(errors.messages[message])
      }
    }
  })
}

function modify_Jobs(id,csrf_token) {
  id =$('#modify-id').val()
  label= $('#modify-name').val()
  let data = { id: id, name: label, csrf_token_name: csrf_token }
    if($("#modify-check-valided").is(":checked")){
      data['valided']= '1'
    } else{
        data['valided']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/Jobs/update/" + id,
      type: "POST",
      data: data,
      success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
        toastr.success(reponse.message)
      },
      error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
         for (var message in errors.messages){
           toastr.error(errors.messages[message])
         }
      }
    })
}

function delete_Jobs(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/Jobs/delete/"+id,
        type: "POST",
        data: data,
        success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
        toastr.success(reponse.messages.success)
        },
        error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
         for (var message in errors.messages){
             toastr.error(errors.messages[message])
         }
        }
    })
}

function add_Necessitys(csrf_token) {
  id_jobs= $('#add-id_jobs').val() 
  id_tasks= $('#add-id_tasks').val()
  let data = { id_tasks: id_tasks, id_jobs: id_jobs, csrf_token_name: csrf_token }
  if ($("#add-check-valided").is(":checked")) { 
    data['valided'] = '1'
  } else {
    data['valided'] = '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/Necessitys/create/",
    type: "POST",
    data: data,
    success: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.success(reponse.message)
    },
    error: function (reponse) {
      var errors = JSON.parse(reponse.responseText)
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      for (var message in errors.messages) {
        toastr.error(errors.messages[message])
      }
    }
  })
}

function modify_Necessitys(id,csrf_token) {
  id =$('#modify-id').val()
  id_jobs= $('#modify-name').val()
  id_tasks= $('#modify-id_tasks').val()
  let data = { id: id, id_jobs: id_jobs,id_tasks:id_tasks, csrf_token_name: csrf_token }
    if($("#modify-check-valided").is(":checked")){
      data['valided']= '1'
    } else{
        data['valided']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/Necessitys/update/" + id,
      type: "POST",
      data: data,
      success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
        toastr.success(reponse.message)
      },
      error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
         for (var message in errors.messages){
           toastr.error(errors.messages[message])
         }
      }
    })
}

function delete_Necessitys(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/Necessitys/delete/"+id,
        type: "POST",
        data: data,
        success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
        toastr.success(reponse.messages.success)
        },
        error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
         for (var message in errors.messages){
             toastr.error(errors.messages[message])
         }
        }
    })
}


function add_Plannings(csrf_token) {
  id_benevoles= $('#add-id_benevoles').val() 
  id_disponibilitys= $('#add-id_disponibilitys').val()
  let data = { id_benevoles: id_benevoles, id_disponibilitys: id_disponibilitys, csrf_token_name: csrf_token }
  if ($("#add-check-valided").is(":checked")) { 
    data['valided'] = '1'
  } else {
    data['valided'] = '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/Plannings/create/",
    type: "POST",
    data: data,
    success: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.success(reponse.message)
    },
    error: function (reponse) {
      var errors = JSON.parse(reponse.responseText)
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      for (var message in errors.messages) {
        toastr.error(errors.messages[message])
      }
    }
  })
}

function modify_Plannings(id,csrf_token) {
  id =$('#modify-id').val()
  id_benevoles= $('#modify-id_benevoles').val()
  id_disponibilitys= $('#modify-id_disponibilitys').val()
  let data = { id: id, id_benevoles: id_benevoles,id_disponibilitys:id_disponibilitys, csrf_token_name: csrf_token }
    if($("#modify-check-valided").is(":checked")){
      data['valided']= '1'
    } else{
        data['valided']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/Plannings/update/" + id,
      type: "POST",
      data: data,
      success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
        toastr.success(reponse.message)
      },
      error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
         for (var message in errors.messages){
           toastr.error(errors.messages[message])
         }
      }
    })
}

function delete_Plannings(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/Plannings/delete/"+id,
        type: "POST",
        data: data,
        success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
        toastr.success(reponse.messages.success)
        },
        error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
         for (var message in errors.messages){
             toastr.error(errors.messages[message])
         }
        }
    })
}


function add_Tasks(csrf_token) {
  start= $('#add-start').val() 
  end= $('#add-end').val()
  place_start= $('#add-place_start').val() 
  id_benevoles= $('#add-id_benevoles').val()
  description= $('#add-description').val()
  let data = { start: start, end: end,  place_start: place_start,  id_benevoles: id_benevoles,description: description,  csrf_token_name: csrf_token }
  if ($("#add-check-valided").is(":checked")) { 
    data['valided'] = '1'
  } else {
    data['valided'] = '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/Tasks/create/",
    type: "POST",
    data: data,
    success: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.success(reponse.message)
    },
    error: function (reponse) {
      var errors = JSON.parse(reponse.responseText)
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      for (var message in errors.messages) {
        toastr.error(errors.messages[message])
      }
    }
  })
}

function modify_Tasks(id,csrf_token) {
  id =$('#modify-id').val()
  start= $('#modify-start').val()
  end= $('#modify-end').val()
  place_start= $('#modify-place_start').val()
  id_benevoles= $('#modify-id_benevoles').val()
  description= $('#modify-description').val()
  let data = { id: id,  start: start, end: end,  place_start: place_start,  id_benevoles: id_benevoles,description: description, csrf_token_name: csrf_token }
    if($("#modify-check-valided").is(":checked")){
      data['valided']= '1'
    } else{
        data['valided']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/Tasks/update/" + id,
      type: "POST",
      data: data,
      success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
        toastr.success(reponse.message)
      },
      error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
         for (var message in errors.messages){
           toastr.error(errors.messages[message])
         }
      }
    })
}

function delete_Tasks(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/Tasks/delete/"+id,
        type: "POST",
        data: data,
        success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
        toastr.success(reponse.messages.success)
        },
        error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
         for (var message in errors.messages){
             toastr.error(errors.messages[message])
         }
        }
    })
}

