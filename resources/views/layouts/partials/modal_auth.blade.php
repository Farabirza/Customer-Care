

<!-- Modal Login -->
<div class="modal fade" id="modal-login" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center fw-medium"><i class='bx bx-log-in-circle me-2'></i><span>Masuk ke akun anda</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/login" id="form-login" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" name="email" id="modal-login-email" class="form-control form-control-sm" placeholder="Email / username" value="" required>
                    <label for="modal-login-email" class="label">Email atau username</label>
                </div>
                <div class="input-group form-floating mb-3">
                    <input type="password" name="password" id="modal-login-password" class="form-control form-control-sm" placeholder="Password" value="" required>
                    <span class="input-group-text hover-pointer" onclick="togglePassword(password_visible)">
                        <i class='btn-password-toggle bx bx-show-alt'></i>
                    </span>
                    <label for="modal-login-password" class="label">Password</label>
                </div>
                <div class="form-outline mb-3">
                    <p class="text-muted fs-9" style="color: #393f81;"><input type="checkbox" name="remember" value="true" class="me-1"> Ingat saya</p>
                </div>
                <p class="text-muted">Belum punya akun? <a class="text-primary" href="#" onclick="modal_register_show()">Daftar</a>, atau</p>
                <a href="/auth/google" class="btn btn-danger btn-sm"><i class='bx bx-xs bxl-google-plus me-2'></i>Masuk dengan akun Google</a>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-primary flex-start gap-2"><i class='bx bx-log-in-circle' ></i> Sign in</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Login end -->
<!-- Modal Register -->
<div class="modal fade" id="modal-register" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center"><i class='bx bxs-user-plus me-2'></i><span>Buat akun baru</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/register" id="form-register" method="POST">
            @csrf
            <div class="modal-body">
                <div class="input-group form-floating mb-2">
                    <input type="text" name="username" id="modal-register-username" class="form-control form-control-sm" placeholder="Username" value="" required>
                    <span class="input-group-text hover-pointer fs-8 d-flex align-items-center" onclick="checkUsername()"><i class='bx bx-search me-2' ></i>Periksa username</span>
                    <label for="modal-register-username" class="label">Username</label>
                </div>
                <div class="mb-3">
                    <p id="username-check-result" class="mb-0 fs-8"><span class="fst-italic text-secondary">*) klik periksa username sebelum melanjutkan</span></p>
                </div>
                @error('username')
                <div id="alert-danger-username" class="alert alert-danger mb-3">{{$message}}</div>
                @enderror
                <div class="form-floating mb-3">
                    <input type="email" name="email" id="modal-register-email" class="form-control form-control-sm" placeholder="Email" value="" required>
                    <label for="modal-register-email" class="label">Email</label>
                </div>
                @error('email')
                <div id="alert-danger-email" class="alert alert-danger mb-3">{{$message}}</div>
                @enderror
                <div class="input-group form-floating mb-3">
                    <input type="password" name="password" id="modal-register-password" class="input form-control form-control-sm" placeholder="Password" value="" required>
                    <span class="input-group-text hover-pointer" onclick="togglePassword(password_visible)">
                        <i class='btn-password-toggle bx bx-show-alt'></i>
                    </span>
                    <label for="modal-register-password" class="label">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" id="modal-register-password_confirmation" class="form-control form-control-sm" name="password_confirmation" placeholder="Confirm Password" required>
                    <label for="modal-register-password_confirmation" class="form-label">Confirm password</label>
                </div>
                @error('password')
                <div id="alert-danger-password" class="alert alert-danger mb-3">{{$message}}</div>
                @enderror
                <p class="text-muted fst-italic fs-8 mb-3">*Password minimal terdiri dari 6 karakter</p>
                <div class="form-outline mb-3">
                    <p class="fs-9" style="color: #393f81;"><input type="checkbox" name="agreement" value="true" class="mr-8"> Saya setuju dengan <span class="text-primary hover-pointer" onclick="modal_tos_show()">Syarat dan ketentuan serta kebijakan privasi</span> yang berlaku.</p>
                </div>
                <p class="text-muted">Sudah memiliki akun? <a class="text-primary" href="#" onclick="modal_login_show()">Masuk</a></p>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn-submit-signup" class="btn btn-sm btn-primary disabled flex-start gap-2"><i class='bx bx-log-in-circle' ></i> Sign Up</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Register end -->

<!-- Modal Terms start -->
<div class="modal fade" id="modal-terms" aria-hidden="true"> 
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center"><i class='bx bx-file me-2'></i>Terms of Service Agreement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-sm mr-3" onclick="modal_register_show()">I understand</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Terms end -->

@push('scripts')
<script type="text/javascript">
const modal_login_show = () => {
  $('.modal').modal('hide');
  $('#modal-login').modal('show');
}
const modal_register_show = () => {
  $('.modal').modal('hide');
  $('#modal-register').modal('show');
}
const modal_tos_show = () => {
    $('.modal').modal('hide');
    $('#modal-terms').modal('show');
}

var password_visible = false;
const togglePassword = () => {
    let input = $('[name="password"]');
    let input_confirm = $('[name="password_confirmation"]');
    let input_btn = $('.btn-password-toggle');
    if(password_visible == false) {
        input.attr("type", "text");
        input_confirm.attr("type", "text");
        input_btn.removeClass('bx-show-alt').addClass('bx-hide');
        password_visible = true;
    } else {
        input.attr("type", "password");
        input_confirm.attr("type", "password");
        input_btn.removeClass('bx-hide').addClass('bx-show-alt');
        password_visible = false;
    }
}

$('[name="username"]').keyup(function(){
    $('#btn-submit-signup').removeClass('disabled').addClass('disabled');
    $('#username-check-result').html('<span class="fst-italic text-secondary">*please check username availability first</span>');
});

const checkUsername = () => {
    let result = $('#username-check-result');
    result.html('<span class="btn spinner"></span>');
    var config = {
        method: 'post', url: domain + 'action/home',
        data: {
            action: 'check_username', username: $('#modal-register-username').val(),
        },
    }
    axios(config)
    .then((response) => {
        // infoMessage(response.data.message);
        if(response.data.available) {
            result.html('<span class="fs-bold text-success"><i class="bx bx-check-double me-1" ></i>' + response.data.message + '</span>');
            $('#btn-submit-signup').removeClass('disabled');
        } else {
            if(response.data.message.length > 1) {
                result.html('');
                response.data.message.forEach(messages);
                function messages(item, index) {
                    result.append('<span class="fs-bold text-danger"><i class="bx bx-error me-1" ></i>' + item + '</span><br/>');
                }
            } else {
                result.html('<span class="fs-bold text-danger"><i class="bx bx-error me-1" ></i>' + response.data.message + '</span>');
            }
            $('#btn-submit-signup').removeClass('disabled').addClass('disabled');
        }
    })
    .catch((error) => {
        console.log(error);
    });
}

$('#form-register').submit(function(e){
    e.preventDefault();
    if($('input[name="agreement"]').is(":checked")) {
        e.currentTarget.submit();
    } else {
        Swal.fire({
            icon: 'error',
            title: "Failed",
            text: "Please check the terms conditions and privacy policy before continue",
            showConfirmButton: true,
        });
    }
});
$(document).ready(function(){
    @error('username')
    errorMessage('Username error : {{$message}}');
    @enderror
    @error('email')
    errorMessage('Email error : {{$message}}');
    @enderror
    @error('password')
    errorMessage('Password error : {{$message}}');
    @enderror
});
</script>
@endpush