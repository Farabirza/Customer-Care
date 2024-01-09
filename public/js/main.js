const domain = 'http://localhost:8000/';
// const domain = 'https://cvkreatif.com/';

/**
* Main Javascript
*/

$(window).resize(function() {
  if($(window).width() < 992) {
      $('.flex-remove-md').removeClass('d-flex');
  } else {
      $('.flex-remove-md').removeClass('d-flex').addClass('d-flex');
  }
});

const confirmDelete = (message) => {
  Swal.fire({
      title: 'Are you sure?',
      icon: 'info',
      text: message,
      showCancelButton: true,
      cancelButtonColor: '#666',
      cancelButtonText: 'Cancel',
      confirmButtonColor: '#d9534f',
      confirmButtonText: "Delete"
      }).then((result) => {
      if(result.isConfirmed) {
          return true;  
      } else { return false; }
  });
};


$(document).ready(function(){

  $('.btn-warn').on('click', function(e){
      e.preventDefault();
      var url = $(this).attr('href');
      Swal.fire({
          title: 'Apakah anda yakin?',
          icon: 'info',
          text: $(this).attr('data-warning'),
          showCancelButton: true,
          cancelButtonColor: '#666',
          cancelButtonText: 'Batalkan',
          confirmButtonColor: '#6777ef',
          confirmButtonText: "Lanjutkan"
          }).then((result) => {
          if(!result.isConfirmed) {
              return false;
          }
          return window.location.href = url;
      })
  });

  // window size
  if($(window).width() < 992) {
      $('.flex-remove-md').removeClass('d-flex');
  } else {
      $('.flex-remove-md').removeClass('d-flex').addClass('d-flex');
  }
});

// form handler
$('.formHandler').submit(function(e) {
  e.preventDefault();
  $('.alert').hide().html('');
  let formData = ($(this).attr('method') == "Post") ? new FormData($(this)[0]) : $(this).serialize();
  let config = {
      method: $(this).attr('method'), url: domain + $(this).attr('action'), data: formData,
  };
  axios(config)
  .then((response) => {
      $('#alert-success').hide().removeClass('d-none').fadeIn('slow').append(response.data.message);
      successMessage(response.data.message);
      if(response.data.refresh == true) {
          window.location.reload();
      }
      if(response.data.reset == true) {
          $(this).trigger('reset');
      }
  })
  .catch((error) => {
      console.log(error.response);
      errorMessage(error.response.data.message);
      if(error.response.data) {
          validationMessage(error.response.data.errors);
      }
  });
});

// validation message
const validationMessage = (errorObject) => {
    Object.keys(errorObject).forEach(name => {
        $('#alert-'+name).html('');
        errorObject[name].forEach(message => {
            $('#alert-'+name).hide().removeClass('d-none').fadeIn('slow').append("<li class='list-unstyled'>"+message+"</li>");
        });
    });
};
