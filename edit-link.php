<?php 
// Ajout du header
require_once __DIR__ . '/inc/header.php';
require_once __DIR__ . '/functions.php';
$link_info = get_link_by_id($_GET['link_id']);
?>

<!-- Main content -->
    <main>
      <div class="container h-100">
        <div class="row justify-content-center h-50">
          <div class="col-md-6 shadow p-3 pt-5">
            <h2 class="mb-3">Éditer le lien : <?= $link_info['title']?></h2>
            <div class="mb-3">
              <form action="./controllers/edit-link-controller.php" method="post">
                <div class="mb-3">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="title"
                      name="title"
                      placeholder="Stack overflow"
                    />
                    <label for="title">Titre</label>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-floating">
                    <input
                      type="url"
                      class="form-control"
                      id="url"
                      name="url"
                      placeholder="https://stackoverflow.com"
                    />
                    <label for="url">Lien</label>
                  </div>
                </div>
                <div class="col-md-auto d-flex">
                  <button type="submit" class="btn btn-primary btn-lg">Enregister</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

<?php 
// Ajout du footer
require_once __DIR__ . '/inc/footer.php';
?>
