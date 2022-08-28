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
        <th>id_jobs</th>
        <th>id_tasks</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($necessitys as $Necessity) : ?>
        <tr>
          <td><?= $Planning['id'] ?></td>
      <?php foreach ($id_jobs as $id_Jobs) : ?>
        <?php if ($id_Jobs['id'] ==$Necessity['id_jobs']):?>
          <td><?= $id_Jobs['name'] ?></td>
        <?php endif; ?>
        <?php endforeach; ?>


        <?php foreach ($id_tasks as $id_Tasks) : ?>
        <?php if ($id_Tasks['id'] ==$Necessitys['id_tasks']):?>
          <td><?= $id_Tasks['description'] ?></td>
        <?php endif; ?>
        <?php endforeach; ?>


          <td><button type="button" class="btn btn-outline-success" onclick="modify_Necesitys('<?= $Necessity['id'] ?>', '<?= $Necessity['id_jobs'] ?>', '<?= $Necessity['id_tasks'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $Necessity['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
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
          <h4 class="modal-title">Add Necessitys</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <select class="form-select" id="add-id_jobs" name="add-id_jobs">
        <?php foreach ($id_jobs as $id_Jobs) : ?>
            <option value="<?= $id_Jobs['id'] ?>"><?= $id_Jobs['name'] ?></option>
            <?php endforeach; ?>
            </select>

            <select class="form-select" id="add-id_tasks" name="add-id_tasks">
            <?php foreach ($id_tasks as $id_Tasks) : ?>
                <option value="<?= $id_Tasks['id'] ?>"><?= $id_Tasks['description'] ?></option>
              <?php endforeach; ?>
            </select>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_Necessitys('<?php echo csrf_hash() ?>')">ajouter</button>
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
          <h4 class="modal-title">Modifier Necessitys</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" value="id" value="<?= $Necessity['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id_benevoles" class="form-label">id_jobs</label>
            <select class="form-select" id="modify-id_benevoles" name="modify-id_benevoles">
            <?php foreach ($id_jobs as $id_Jobs) : ?>
                <option value="<?= $id_Jobs['id'] ?>"><?= $id_Jobs['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id_disponibilitys" class="form-label">id_tasks</label>
            <select class="form-select" id="modify-id_disponibilitys" name="modify-id_disponibilitys">
            <?php foreach ($id_tasks as $id_Tasks) : ?>
                <option value="<?= $id_Tasks['id'] ?>"><?= $id_Tasks['description'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_Necessitys($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">modifié</button>
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
          <h4 class="modal-title">delete Necessitys</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer ce Necessitys ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_Necessitys($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
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
