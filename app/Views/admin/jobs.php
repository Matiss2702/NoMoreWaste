<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Jobs</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">Jobs</li>
</ol>
<div class="row pt-5">
  <div class="pb-2 row">
    <a type="button" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></a>
  </div>
  <table id="Jobs-table">
    <thead>
      <tr>
        <th>id</th>
        <th>name</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($Jobs as $Job) : ?>
        <tr>
          <td><?= $Job['id'] ?></td>
          <td><?= $Job['name'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_Jobs('<?= $Job['id'] ?>', '<?= $Job['name'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $Job['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
      $('#modify_Jobs-table').DataTable();
      $('#Jobs-table_wrapper').addClass("none");
    });
  </script>

  <div class="modal" id="add-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Jobs</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-name" class="form-label">name</label>
            <input class="form-control" type="text" id="add-name" name="add-name" placeholder="prenom">
          </div>
        <button class="btn btn-primary d-flex mx-auto" onclick="add_Jobs('<?php echo csrf_hash() ?>')">ajouter</button>
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
          <h4 class="modal-title">Modifier Jobs</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" value="id" value="<?= $Job['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-name" class="form-label">name</label>
            <input class="form-control" type="text" id="modify-name" name="modify-name" value="<?= $Job['name'] ?>">
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_Jobs($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">modifié</button>
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
          <h4 class="modal-title">delete Jobs/h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer ce Jobs ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_Jobs($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
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
