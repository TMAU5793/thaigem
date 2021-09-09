<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <strong class="ff-semibold fs-4">Sign in</strong>
                    <p>Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ip the dummy text industry.</p>                    
                </div>
                <form action="">
                    <div class="input-nobg plr-2rem">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="txt_username" placeholder="USERNAME">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="txt_password" placeholder="PASSWORD" autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn bg-lightgold ff-semibold w-100">SIGN IN</button>                                                
                    </div>
                </form>
                <a href="" class="text-uppercase mt-3 d-block text-center c-black text-decoration-none">forgot password</a>
                <div class="login-with-social plr-2rem mt-3">
                    <a href="" class="btn bg-lightgold ff-semibold text-uppercase d-block w-100 mb-3"> sing in with facebook</a>
                    <a href="" class="btn bg-lightgold ff-semibold text-uppercase d-block w-100"> sing in with gmail</a>
                </div>
                <div class="signup-account text-center p-3">
                    <strong class="ff-semibold fs-4 d-block">Create Account</strong>
                    <span>You are not a member yet?</span>
                    <a href="" class="ff-semibold c-black text-decoration-none text-uppercase" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Register -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <strong class="ff-semibold fs-4">Create Account</strong>              
                </div>
                <form action="">
                    <div class="input-nobg plr-2rem">
                        <div class="form-group mb-3">
                            <input type="email" class="form-control" name="txt_username" placeholder="Email">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="txt_name" placeholder="Name">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="txt_password" placeholder="PASSWORD" autocomplete="new-password">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="txt_confirm_password" placeholder="COMFIRM PASSWORD">
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="cb_newsletter">
                            <label class="form-check-label" for="cb_newsletter">
                                Get Newsletter
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="cb_term">
                            <label class="form-check-label" for="cb_term">
                                ยอมรับ <a href="" class="ff-semibold c-black">ข้อกำหนด และเงื่อนไข</a>
                            </label>
                        </div>
                        <button type="submit" class="btn bg-lightgold ff-semibold w-100 text-uppercase mb-3">Register</button>
                        <a href="" class="c-black ff-semibold text-center d-block" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>