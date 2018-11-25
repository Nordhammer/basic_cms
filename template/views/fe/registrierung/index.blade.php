<section class="breadcrumb">
    {BREADCRUMB}
</section>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{SIGNUP.REGISTRIERUNG}</h3>
                    </div>
                    <div class="panel-body mt-3">
                        <form action="/registrieren" method="post" accept-charset="utf-8">
                            <div class="mb-3">
                                <label for="name">{SIGNUP.NAME}</label>
                                <input type="text" name="name" id="name" value="{NAME}" class="form-control" onkeyup="check_username(this.value)" placeholder="" required autofocus>
                                <span id="check_username"></span>
                            </div>
                            <div class="mb-3">
                                <label for="password">{SIGNUP.MAIL}</label>
                                <input type="email" name="mail" value="{MAIL}" class="form-control" placeholder="" required>
                            </div>
                            <button type="submit" formaction="/index.php/registrieren" formmethod="post" class="btn btn-lg btn-success btn-block text-uppercase" name="submit">{SIGNUP.BTN_KONTO_ERSTELLEN}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>