<div class="modal fade loginModal" data-bs-backdrop="static" data-bs-keyboard="false" id="loginModal" tabindex="-1"
    role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xm" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <div>
                    <p class="mb-0 fs-5 fw-semibold">Login to continue.</p>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('auth.login') }}" method="post" class="ajax" data-callback="" id="loginForm" autocomplete="off">
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
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button"
                    class="btn rounded-1 border-0 shadow-none btn-secondary btn-light p-2 pl-3 pr-3 ps-3 pe-3 border-gray "
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="loginForm" data-default="Login"
                    class="border-0 btn p-2 pl-3 pr-3 ps-3 pe-3 rounded-1 continue-btn shadow-none btn-primary border-0 ">Login</button>
            </div>
        </div>
    </div>
</div>
