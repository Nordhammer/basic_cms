<section class="breadcrumb">
    {BREADCRUMB}
</section>

<section class="suche">
  <div class="container mt-5">
      <h1 class="mb-3">yourMDB - die Filmdatenbank</h1>
      <p class="mb-5">Wir arbeiten an der ersten Phase der Neugestaltung von <a href="https://ymdb.de" target="_blank" title="Weiter zu ymdb.de ...">ymdb.de</a> und rechnen mit deren Fertigstellung im <strong>Juni 2019</strong>! Seit gespannt!</p>
      <form action="/suchergebnis" method="post">
          <div class="input-group">
              <input type="text" id="search" name="q" class="form-control" placeholder="{START.WONACH_SUCHST_DU}">
              <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
              </span>
          </div>
      </form>
      <div id="results"></div>
  </div>
</section>