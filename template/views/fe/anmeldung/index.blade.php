<section class="breadcrumb">
    {BREADCRUMB}
</section>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{LOGIN.ANMELDUNG}</h3>
                    </div>
                    <div class="panel-body mt-3">
                        <form role="form" accept-charset="utf-8">
                            <div class="mb-3">
                                <label for="name">{LOGIN.NAME}</label>
                                <input type="text" name="name" class="form-control" placeholder="" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password">{LOGIN.KENNWORT}</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <button type="submit" formaction="/index.php/anmelden" formmethod="post" class="btn btn-lg btn-primary btn-block text-uppercase" name="submit">{LOGIN.ANMELDEN}</button>
                        </form>
                        <hr class="my-4">
                        <a href="/kennwort-wiederherstellen" class="btn btn-lg btn-info btn-block text-uppercase text-white">{LOGIN.KENNWORT_WIEDERHERSTELLEN}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>