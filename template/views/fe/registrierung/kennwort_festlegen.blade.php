<section class="breadcrumb">
    {BREADCRUMB}
</section>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{SIGNUP.KENNWORT_FESTLEGEN}</h3>
                    </div>
                    <div class="panel-body mt-3">
                        <form action="/kennwort-festlegen" method="post" accept-charset="utf-8">                        
                            <div class="mb-3">
                                <label for="password">{SIGNUP.KENNWORT}</label>
                                <!--<input type="password" name="password" class="form-control" placeholder="" required autofocus>-->
                                <input type="password" name="password" id="password" class="form-control" placeholder="" onkeyup="passwordsecurity(this.value)">
                                <span id="passwordsecurityhint"></span>
                            </div>
                            <div class="mb-3">
                                <label for="password2">{SIGNUP.KENNWORT_WIEDERHOLEN}</label>
                                <input type="password2" name="password2" class="form-control" placeholder="" required>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" name="submit">{SIGNUP.ABSENDEN}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>