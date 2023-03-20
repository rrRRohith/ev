<div class="modal loginModal auth-modal" data-bs-backdrop="static" data-bs-keyboard="false" id="loginModal"
    tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xm modal-fullscreen-md-down" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <div>
                    <p class="mb-0 fs-5 fw-semibold">Login to continue.</p>
                    <a href="#" class="text-primary text-decoration-none" data-bs-toggle="modal"
                        data-bs-target="#registerModal">Register new account</a>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('auth.login') }}" method="post" class="ajax" data-callback="" id="loginForm"
                    autocomplete="off">
                    @csrf
                    <input type="hidden" name="requestPath" value="{{ $request->requestPath }}">
                    <div class="form-group mb-2">
                        <label for="email" class="fw-semibold">Email</label>
                        <input type="email" form="loginForm" name="email" id="email"
                            placeholder="Enter your email" value="" autocomplete="off"
                            class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                    </div>
                    <div class="form-group mb-2">
                        <label for="password" class="fw-semibold">Password</label>
                        <input type="password" form="loginForm" name="password" autocomplete="off" id="password"
                            placeholder="Enter password"
                            class='form-control reset-value shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                    </div>
                    <a href="#" class="text-primary text-decoration-none" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Keep calm and try to remember your password.">Forgot
                        password?</a>
                </form>
            </div>
            <div class="modal-footer border-0 align-items-center">
                <button type="button"
                    class="btn rounded-1 border-0 shadow-none btn-secondary btn-light p-2 pl-3 pr-3 ps-3 pe-3 border-gray "
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="loginForm" data-default="Login"
                    class="border-0 btn p-2 pl-3 pr-3 ps-3 pe-3 rounded-1 continue-btn shadow-none btn-primary border-0 ">Login</button>
            </div>
        </div>
    </div>
</div>
<div class="modal registerModal auth-modal" data-bs-backdrop="static" data-bs-keyboard="false" id="registerModal"
    tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xm modal-fullscreen-md-down" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <div>
                    <p class="mb-0 fs-5 fw-semibold">Register your {{ $app->name }} account.</p>
                    <a href="#" class="text-primary text-decoration-none" data-bs-toggle="modal"
                        data-bs-target="#loginModal">Already have an account</a>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('auth.register') }}" method="post" class="ajax" data-callback=""
                    id="registerForm" autocomplete="off">
                    @csrf
                    <input type="hidden" name="requestPath" value="{{ $request->requestPath }}">
                    <div class="form-group mb-2">
                        <label for="name" class="fw-semibold">Name</label>
                        <input type="name" form="registerForm" name="name" id="name"
                            placeholder="Enter your name" value="" autocomplete="off"
                            class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="fw-semibold">Email</label>
                        <input type="email" form="registerForm" name="email" id="email"
                            placeholder="Enter your email" value="" autocomplete="off"
                            class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                    </div>
                    <div class="form-group mb-2">
                        <label for="password" class="fw-semibold">Password</label>
                        <input type="password" form="registerForm" name="password" autocomplete="off"
                            id="password" placeholder="Enter new password"
                            class='form-control reset-value shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button"
                    class="btn rounded-1 border-0 shadow-none btn-secondary btn-light p-2 pl-3 pr-3 ps-3 pe-3 border-gray "
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="registerForm" data-default="Register"
                    class="border-0 btn p-2 pl-3 pr-3 ps-3 pe-3 rounded-1 continue-btn shadow-none btn-primary border-0 ">Register</button>
            </div>
        </div>
    </div>
</div>
