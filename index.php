<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="christophe farin" />
    <meta
      name="description"
      content="Cable Tray Sizing a été conçu pour proposer aux utilisateurs des fonctions avancées de calculs et de contrôles pour la définition de chemins de câbles. Ces fonctions concernent le volume et la charge acceptables basées sur des données standards de chemins de câbles et de câbles."
    />
    <meta
      name="keywords"
      content="ingénierie, bureau d'études, chemin de câbles, cheminement de câbles, électricité, instrumentation, courant fort, courant faible"
    />
    <!-- meta uniquement pour les mobiles -->
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0"
    />
    <!-- </* lien vers jQuery hébergé chez Google (à placer en 1er) */> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- </* lien vers Bootstrap v5.0.2 */> -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- </* lien vers css Font Awesome */> -->
    <link rel="stylesheet" href="styles/css/all.min.css" />
    <!-- </* lien vers l'icon DataTables affichée dans l'onglet du navigateur web */> -->
    <link rel="shortcut icon" type="image/ico" href="datatables\media\images">
    <!-- </* lien vers jQuery du plugin DataTables */> -->
    <script type="text/javascript" src="datatables/media/js/jquery.dataTables.min.js"></script>
    <!-- </* lien vers css du plugin DataTables */> -->
    <link rel="stylesheet" type="text/css" href="datatables/media/css/jquery.dataTables.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> -->
    <!-- </* lien vers Select for DataTables 1.6.2 */> -->
    <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"> </script>
    <!-- </* lien vers jQuery du plugin tabledit */> -->
    <script type="text/javascript" src="tabledit/jquery.tabledit.min.js"></script>
  </head>
  
  <body>

    <!-- Header -->
    <header class="bd-header bg-dark py-3 px-3 align-items-stretch border-bottom border-dark">
      <div class="container-fluid d-flex align-items-center">
        <h1 class="d-flex align-items-center fs-4 text-white mb-0">
          Cable Tray Sizing - Outil de pré-dimensionnement des chemins de câbles
        </h1>
      </div>
    </header>

    <main class="bg-light">
      <div class="container-fluid">
        <div class="row">

          <!-- Side Bar -->
          <div class="col-md-auto bg-light sticky-top">
            <div class="d-flex flex-md-column flex-row flex-nowrap bg-light align-items-center sticky-top fs-3">
              <a href="#" class="d-block p-3 link-dark text-decoration-none" title="Website created by Christophe Farin" data-bs-toggle="tooltip" data-bs-placement="right">
                <img src="images/icon_CTS.ico" alt="Logo CTS" />
              </a>
              <ul class="nav nav-pills nav-flush flex-md-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center mb-sm-auto">
                <li class="nav-item">
                  <a href="#" class="nav-link link-secondary py-3 px-2" title="Back to top" data-bs-toggle="tooltip" data-bs-placement="right">
                    <i class="fa-solid fa-chevron-up navbar-icon"></i>
                  </a>
                </li>
                <li>
                  <a href="#myModal" class="nav-link link-secondary py-3 px-2" title="Information" data-bs-toggle="modal" data-bs-placement="right">
                    <i class="fa-solid fa-circle-info navbar-icon"></i>
                  </a>
                </li>
                <li>
                  <a href="about-me/about-me.html" class="nav-link link-secondary py-3 px-2" title="About" data-bs-toggle="tooltip" data-bs-placement="right">
                    <i class="fa-solid fa-user navbar-icon"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div class="col-md p-3 min-vh-100">

            <!-- welcome -->
            <section class="py-5 bg-white">
              <div class="container">
                <div class="row">

                  <h2>Bienvenue</h2>
                  <p>
                    Avec « Cable tray sizing », pré-dimensionnez vos chemins de câbles
                    pour tous vos projets industriels ou tertiaires. A partir des « cable
                    routing », identifiez et repérez les tronçons de chemins de câbles que
                    vous souhaitez dimensionner. Munissez-vous de la liste de câbles
                    devant être supportés par chacun des tronçons.<br />
                    Vous êtes près pour découvrir les astuces et les fonctions de cette
                    application en ligne.
                  </p>

                </div>
              </div>
            </section>

            <!-- cable-tray-data -->
            <section class="py-5 my-2 bg-white" id="cable-tray-data">
              <div class="container">
                <div class="row">
                  <h2>Choisissez les caractéristiques du chemin de câbles</h2>
                  <p>
                    Choisir le type du chemin de câbles et sa hauteur, sa largeur minimum
                    (par défaut cette valeur est la plus petite du catalogue), sa largeur maximum (par défaut
                    cette valeur est la plus grande).<br />
                    Ce choix est important si l’encombrement disponible pour
                    l’installation du cheminement est réduit ou si l’on souhaite utiliser
                    des chemins de câbles de dimension standard.<br />
                    Le pourcentage de réserve (30% par défaut) est modifiable. Le nombre de couches de câbles dans le cheminement peut être renseigné pour limiter la superposition des câbles. S’il n’y a pas de limitation, alors ne rien inscrire dans cette zone.
                  </p>
                </div>
                <div class="row">
                  <form method="post" action="">
                  <div class="table-responsive">
                    <table id="my-table" class="table display compact" style="width:100%">
                      <thead>
                        <tr>
                          <th scope="col">Type</th>
                          <th scope="col">Hauteur (mm)</th>
                          <th scope="col">Largeur min (mm)</th>
                          <th scope="col">Largeur max (mm)</th>
                          <th scope="col">Réserve (%)</th>
                          <th scope="col">Nb de couches de câbles</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <select name="t" id="types" class="form-control" onChange="getHauteur(this.value)">
                              <option value="">Sélectionnez le type</option>
                            </select>
                          </td>
                          <td>
                            <select name="h" id="hauteurs" class="form-control" onChange="getLargeurmin(this.value)">
                              <option value="">Sélectionnez la hauteur</option>
                            </select>
                          </td>
                          <td>
                            <select name="lmin" id="largeursmin" class="form-control" onChange="">
                              <option value="">Sélectionnez la largeur Min</option>
                            </select>
                          </td>
                          <td>
                            <select name="lmax" id="largeursmax" class="form-control" onChange="controlValue()">
                              <option value="">Sélectionnez la largeur Max</option>
                            </select>
                          </td>
                          <td>
                            <input type="number" name="r" id="reserve" min="0" max="100" value="30" class="form-control" onChange="" required>
                          </td>
                          <td>
                            <input type="number" name="nbc" id="nbcouches" min="1" class="form-control" value="" onChange="">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  </form>
                </div>
              </div>
            </section>

            <!-- cable-select -->
            <section class="py-5 my-2 bg-white" id="cable-select">
              <div class="container">
                <div class="row">
                  <h2>Sélectionner tous les câbles contenus dans le chemin de câbles</h2>
                  <p>
                    Sélectionner chaque type de câbles passant dans le cheminement depuis le catalogue de câbles proposé puis modifier la quantité si nécessaire dans la liste des câbles sélectionnées. La sélection s'effectue d'un simple clic de souris sur le câble choisi.<br />
                  </p>
                </div>
                <div class="row">
                  <div class="col" onmouseover=selvide();>
                    <h3>Catalogue de câbles</h3>
                    <p><br />
                    </p>
                    <div class="table-responsive">
                      <table id="tableft" class="table table-striped table-hover" style="width:100%">
                        <thead>
                            <th>ID</th>
                            <th>Type de câble</th>
                            <th>Diamètre ext</th>
                            <th>Poids</th>
                            <th>Section</th>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="col-auto">
                    <h3>Liste des câbles sélectionnés</h3>
                    <p><br />
                    </p>
                    <div class="table-responsive">
                      <table id="tabright" class="table table-striped table-hover" style="width:100%">
                        <thead>
                          <th>ID</th>
                          <th>Type de câble</th>
                          <th>Diamètre ext</th>
                          <th>Poids</th>
                          <th>Section</th>
                          <th>Quantité</th>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                    <div class="py-2">
                      <button class="btn btn-secondary" id="valider" name="valider" onclick="calculs()">Valider la sélection / Calculer</button>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- result -->
            <section class="py-5 my-2 bg-white" id="result">
              <div class="container">
                <div class="row">
                  <h2>Résultats</h2>
                  <p>
                    Le chemin de câbles ciblé doit pouvoir contenir le volume des câbles sélectionnés et supporter leurs charges en tenant compte de la réserve.<br />
                    Les critères calculés pour le choix du chemin de câbles sont récapitulés avant le tableau de résultats.<br />
                  </p>
                  <div class="table-responsive">
                    <table cellspacing="0" id="my-table" class="table">
                      <thead>
                        <tr>
                          <th scope="col">Largeur min cible (mm)</th>
                          <th scope="col">Charge cible (kg/m)</th>
                          <th scope="col">Volume cible (mm²)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>
                              <input type="readonly" name="largeurcible" id="largeurcible" class="form-control" readonly="true">
                            </td>
                            <td>
                              <input type="readonly" name="chargecible" id="chargecible" class="form-control" readonly="true">
                            </td>
                            <td>
                              <input type="readonly" name="volumecible" id="volumecible" class="form-control" readonly="true">
                            </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col">
                  <h3>Liste des chemins de câbles possibles</h3>

                  <div class="table-responsive">
                    <table id="tableresult" class="table table-striped table-hover" style="width:100%">
                      <thead>
                          <th>ID</th>
                          <th>Type</th>
                          <th>Largeur (mm)</th>
                          <th>Hauteur (mm)</th>
                          <th>Charge maxi (kg/m)</th>
                          <th>Poids (kg/m)</th>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </section>

          </div>
        </div>
      </div>
    </main>

    <!-- taskbar pour les messages en bas d'écran -->
    <div class="w-75 position-fixed bottom-0 start-50 translate-middle-x">
      <div class="taskbar">
        <div class="alert alert-warning alert-dismissible fade show" id="control" style="display:none;">
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          <strong>Warning!</strong> La largeur max doit être supérieure ou égale à la largeur min.
        </div>
        <div class="alert alert-info alert-dismissible fade show" id="vide" style="display:none;">
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          <strong>Info!</strong> Votre sélection est vide.
        </div>
        <div class="alert alert-warning alert-dismissible fade show" id="control2" style="display:none;">
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          <strong>Warning!</strong> La hauteur du chemin de câble est inférieure au diamètre d'au moins un câble.
        </div>
      </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Systèmes de chemins de câbles</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <h3>Comment déterminer le volume de câbles ?</h3>
            <p>
              Un critère important pour la sélection du bon système est le volume
              des câbles, pour lequel le chemin de câbles doit offrir suffisamment
              d'espace. Comme les câbles ne sont jamais posés les uns contre les
              autres et de manière absolument parallèle, pour le calcul du volume,
              la prise en compte du seul diamètre des câbles ne suffit pas. Une base
              de calcul réaliste est assurée par la formule (2r)².
            </p>
            <h3>Comment trouver le système doté d'un volume approprié ?</h3>
            <p>
              La hauteur des câbles ne doit en aucun cas dépasser celle des arêtes
              du chemin de câbles.<br />
              Lors du choix du système, il convient de prévoir une réserve de volume
              d'au moins 30 % pour une installation ultérieure éventuelle.
            </p>
            <p class="text-muted">
              Simplification : formule de calcul selon la norme VDE 0639 T1
            </p>
            <p>
              La première partie de la norme DIN VDE 0639 (sur les systèmes de
              chemins de câbles) propose la formule suivante pour calculer la
              capacité de charge de câbles.
            </p>
            <p>
              Charge de câbles =
              <math
                ><mfrac><mi>0,028 𝑁</mi><mi>𝑚 𝑥 𝑚𝑚²</mi></mfrac>
              </math>
              x section utile
            </p>
            <p>
              Dans l'exemple suivant, la charge de câbles admissible maximale pour
              un chemin de câbles d'une dimension de 60 mm x 300 mm et d'une section
              utile de 178 cm².
            </p>
            <p>
              Charge de câbles =
              <math
                ><mfrac><mi>0,028 𝑁</mi><mi>𝑚 𝑥 𝑚𝑚²</mi></mfrac>
              </math>
              x 17.800 mm² = 498,4 N/m
            </p>
            <p>
              Conversion des Newtons (N) en kilogrammes (kg) :<br />
              10 N ~ 1 kg soit une charge maximale de 50 kg/m
            </p>
            <h3>
              Comment répartir les contraintes des câbles sur des cheminements
              superposés ?
            </h3>
            <p>
              La charge et le volume induits par les câbles sont répartis de manière
              égale lorsque plusieurs rangs de chemins de câbles sont nécessaires.
              Cette optimisation permet d’obtenir des rangs de largeur identique.
            </p>
            <p>
              <img src="images/rang_CTS.png" />
            </p>
            <h3>
              Comment calculer la charge appliquée aux supports du cheminement ?
            </h3>
            <p>
              La masse totale devant être supportée par les supports du chemin de
              câbles est la somme des poids du chemin de câbles et des câbles
              (réserve incluse).
            </p>
            <p class="text-muted">
              La formule suivante permet de calculer la charge par support
            </p>
            <p>
              Charge par support (kg) = (Charge de câbles/mètre + propre poids du
              chemin de câbles/mètre) x distance entre supports
            </p>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer justify-content-between">
            <span class="text-muted me-auto"><small>Certains passages sont extraits du catalogue KTS de OBO BETTERMANN</small></span>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 px-3 my-4 border-top" id="contact">
      <div class="col-md-4 d-flex align-items-center">
        <span class="text-muted">© 2023 Christophe FARIN</span>
      </div>
      <div class="col-md-4 d-flex align-items-center justify-content-center">
        <span class="text-muted text-center">100 C rue Coste<br>69300 Caluire-et-Cuire<br>Tél : 06 20 27 54 36<br><a href="mailto:chfarin69@gmail.com">chfarin69@gmail.com</a></span>
      </div>
      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3">
          <a href="https://www.linkedin.com/in/christophe-farin-564b2132/"><i class="fa-brands fa-linkedin fa-2xl"></i></a>
        </li>
      </ul>

      <!-- Script js -->
      <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      ></script>
    </footer>
    <script type="text/javascript" src="scripts/table.js"></script>
    <script type="text/javascript" src="scripts/cart.js"></script>
    <script type="text/javascript" src="scripts/cts.js"></script>
  </body>
</html>
