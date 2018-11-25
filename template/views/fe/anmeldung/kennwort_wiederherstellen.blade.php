<section class="breadcrumb">
    {BREADCRUMB}
</section>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{RECOVER.KENNWORT_WIEDERHERSTELLEN}</h3>
                    </div>
                    <div class="panel-body mt-3">
                        <form role="form" accept-charset="utf-8">
                            <div class="mb-3">
                                <label for="recover">{RECOVER.NAME_MAIL}</label>
                                <input type="text" name="recover" id="recover" class="form-control" placeholder="" required autofocus>
                            </div>
                            <button type="submit" formaction="/index.php/kennwort-wiederherstellen" formmethod="post" class="btn btn-lg btn-primary btn-block text-uppercase" name="submit">{RECOVER.MAIL_ANFORDERN}</button>
                        </form>
                        <hr class="my-4">
                        <a href="/registrieren" class="btn btn-lg btn-info btn-block text-uppercase text-white">{SIGNUP.BTN_KONTO_ERSTELLEN}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>