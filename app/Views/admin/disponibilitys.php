<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Disponibilitys</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">Disponibilitys</li>
</ol>
<div class="row pt-5">
  <div class="pb-2 row">
    <a type="button" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></a>
  </div>
  <table id="Disponibilitys-table">
    <thead>
      <tr>
        <th>id</th>
        <th>start</th>
        <th>end</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($Disponibilitys as $Disponibility) : ?>
        <tr>
          <td><?= $Disponibility['id'] ?></td>
          <td><?= $Disponibility['start'] ?></td>
          <td><?= $Disponibility['end'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_Disponibilitys('<?= $Disponibility['id'] ?>', '<?= $Disponibility['start'] ?>', '<?= $Disponibility['end'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $Disponibility['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
      $('#Disponibilitys-table').DataTable();
      $('Disponibilitys_wrapper').addClass("none");
    });
  </script>

  <div class="modal" id="add-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Disponibilitys</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-start" class="form-label">start</label>
            <input class="form-control" type="text" id="add-start" name="add-start" placeholder="start">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-end" class="form-label">end</label>
            <input class="form-control" type="text" id="add-end" name="add-end" placeholder="end">
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_Disponibilitys('<?php echo csrf_hash() ?>')">ajouter</button>
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
          <h4 class="modal-title">Modifier Disponibilitys</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" value="id" value="<?= $Disponibility['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-start" class="form-label">start</label>
            <input class="form-control" type="datetime" id="modify-start" name="modify-start" value="<?= $Disponibility['start'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-end" class="form-label">end</label>
            <input class="form-control" type="datetime" id="modify-end" name="modify-end" value="<?= $Disponibility['end'] ?>">
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_Disponibilitys($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">modifié</button>
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
          <h4 class="modal-title">delete Disponibilitys</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer ce Disponibilitys ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_Disponibilitys($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
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
