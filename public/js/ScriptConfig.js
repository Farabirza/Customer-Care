
const submitConfig = () => {
    if($('#form-config').attr('method') == 'post') {
        var formData = new FormData(document.getElementById('form-config'));
        formData.append('user_id', user_id);
    } else {
        var formData = $('#form-config').serialize();
    }
    var config = {
        method: $('#form-config').attr('method'), url: domain + $('#form-config').attr('action'),
        data: formData,
    }
    axios(config)
    .then((response) => {
        successMessage(response.data.message);
        if(response.data.new) {
            $('#form-config').attr('action', 'config/'+response.data.config_id);
            $('#form-config').attr('method', 'put');
        }
        if(response.data.unlock) {
            $('#btn-config-finish').html(`<a href="/cv/`+username+`?success=your page is now live!" class="text-primary fs-12 d-flex align-items-center">Finish<i class='bx bx-chevrons-right ms-2' ></i></a>`);
        }
    })
    .catch((error) => {
        console.log(error.response);
        if(error.response.data.message) {
            errorMessage(error.response.data.message);
        }
    });
}

const selectTheme = (theme_id, item_id) => {
    let data = { action: 'select_theme', user_id: user_id, theme_id: theme_id };
    var config = {
        method: 'post', url: domain + 'action/preference', data: data,
    }
    axios(config)
    .then((response) => {
        successMessage(response.data.message);
        $('.btn-select-theme').removeClass('btn-primary btn-outline-primary').addClass('btn-outline-primary').html(`<i class="bx bx-check me-2"></i>Select`);
        $('#btn-select-theme-'+item_id).removeClass('btn-outline-primary').addClass('btn-primary').html(`<i class="bx bx-check-double me-2"></i>Selected`);
        if(response.data.new == true) {
            $('#form-config').attr('method', 'put').attr('action', 'config/' + response.data.config_id);
            $('#btn-config-finish').html(`<a href="/cv/`+username+`?success=your page is now live!" class="text-primary fs-12 d-flex align-items-center">Finish<i class='bx bx-chevrons-right ms-2' ></i></a>`);
        }
    })
    .catch((error) => {
        console.log(error.response);
        if(error.response.data.message) {
            errorMessage(error.response.data.message);
        }
    });
}

function submitCover() {
    var formData = new FormData(document.getElementById('form-cover_image'));
    formData.append('user_id', user_id);
    formData.append('action', 'update_cover');
    var config = {
        method: $('#form-cover_image').attr('method'), url: domain + $('#form-cover_image').attr('action'),
        data: formData,
    }
    axios(config)
    .then((response) => {
        successMessage(response.data.message);
        $('#modal-cover_image').modal('hide');
        $('#container-cover_image').css('background', 'linear-gradient(0deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('+$("#preview-cover_image").attr("src")+') center');
        $('#sidebar-profile').css('background', 'linear-gradient(0deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('+$("#preview-cover_image").attr("src")+') center');
        $('#form-cover_image').trigger('reset');
    })
    .catch((error) => {
        console.log(error.response);
        if(error.response.data.message) {
            errorMessage(error.response.data.message);
        }
    });
}

$('#config-cover_image').change(function(e) {
    let reader = new FileReader();
    reader.onload = (e) => { 
        $('#preview-cover_image').attr('src', e.target.result); 
    }
    reader.readAsDataURL(this.files[0]); 
    $('#modal-cover_image').modal('show');
});
