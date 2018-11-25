
        <div class="container mt-6">
            <h1>{MAINTENANCE.H1}</h1>
            <div class="row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-xl-8">
                    <p class="mt-4">{MAINTENANCE.HINWEIS}</p>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-md-offset-4 col-xl-4">
                    <div class="login-panel panel panel-default">
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
                                <button type="submit" formaction="/wartung" formmethod="post" class="btn btn-lg btn-primary btn-block text-uppercase" name="submit">{LOGIN.ANMELDEN}</button>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
        </div>