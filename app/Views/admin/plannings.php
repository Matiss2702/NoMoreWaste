<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Planning</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">Planning</li>
</ol>
<div class="row pt-5">
  <div class="pb-2 row">
    <a type="button" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></a>
  </div>
  <table id="Benevoles-table">
    <thead>
      <tr>
        <th>id</th>
        <th>lastname</th>
        <th>firstname</th>
        <th>start</th>
        <th>end</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($planning as $Plannings) : ?>
        <tr>
          <td><?= $Plannings['id'] ?></td>
      <?php foreach ($id_benevoles as $id_Benevoles) : ?>
        <?php if ($id_Benevoles['id'] ==$Plannings['id_benevoles']):?>
          <td><?= $id_Benevoles['firstname'] ?></td>
          <td><?= $id_Benevoles['lastname'] ?></td>
        <?php endif; ?>
        <?php endforeach; ?>


        <?php foreach ($id_disponibilitys as $id_Disponibilitys) : ?>
        <?php if ($id_Disponibilitys['id'] ==$Plannings['id_benevoles']):?>
          <td><?= $id_Disponibilitys['start'] ?></td>
          <td><?= $id_Disponibilitys['end'] ?></td>
        <?php endif; ?>
        <?php endforeach; ?>


          <td><button type="button" class="btn btn-outline-success" onclick="modify_Plannings('<?= $Plannings['id'] ?>', '<?= $Plannings['id_benevoles'] ?>', '<?= $Plannings['id_disponibilitys'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $Plannings['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
      $('#Planning-table').DataTable();
      $('#Planning-table_wrapper').addClass("none");
    });
  </script>

  <div class="modal" id="add-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Planning</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <select class="form-select" id="add-id_benevoles" name="add-id_benevoles">
              <?php foreach ($id_benevoles as $id_Benevoles) : ?>
                <option value="<?= $id_Benevoles['id'] ?>"><?= $id_Benevoles['firstname'] ?>
                <?= $id_Benevoles['lastname'] ?></option>
              <?php endforeach; ?>
            </select>
            <select class="form-select" id="add-id_disponibilitys" name="add-id_disponibilitys">
              <?php foreach ($id_disponibilitys as $id_Disponibilitys) : ?>
                <option value="<?= $id_Disponibilitys['id'] ?>"><?= $id_Disponibilitys['start'] ?>
                <?= $id_Disponibilitys['end'] ?></option>
              <?php endforeach; ?>
            </select>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_Plannings('<?php echo csrf_hash() ?>')">ajouter</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modify-modal" data-id="">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modifier Planning</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" value="id" value="<?= $Plannings['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id_benevoles" class="form-label">id_benevoles</label>
            <select class="form-select" id="modify-id_benevoles" name="modify-id_benevoles">
            <?php foreach ($id_benevoles as $id_Benevoles) : ?>
                <option value="<?= $id_Benevoles['id'] ?>"><?= $id_Benevoles['firstname'] ?>
                <?= $id_Benevoles['lastname'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id_disponibilitys" class="form-label">id_disponibilitys</label>
            <select class="form-select" id="modify-id_disponibilitys" name="modify-id_disponibilitys">
            <?php foreach ($id_disponibilitys as $id_Disponibilitys) : ?>
                <option value="<?= $id_Disponibilitys['id'] ?>"><?= $id_Disponibilitys['start'] ?>
                <?= $id_Disponibilitys['end'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_Plannings($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">modifié</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="delete-modal" data-id="">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">delete Planning</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer ce Planning ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_Plannings($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
          <button class="btn btn-danger d-flex mx-auto" data-bs-dismiss="modal">cancel</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

</div>
<?= $this->endSection() ?>
