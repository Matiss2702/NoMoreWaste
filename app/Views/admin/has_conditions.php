<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Benevoles</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">Benevoles</li>
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
        <th>password</th>
        <th>mail</th>
        <th>address</th>
        <th>city</th>
        <th>zipcode</th>
        <th>country</th>
        <th>phone</th>
        <th>valided</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($Has_conditions as $Has_condition) : ?>
        <tr>
          <td><?= $Benevole['id'] ?></td>
      <?php foreach ($id_jobs as $id_Jobs) : ?>
        <?php if ($id_Jobs['id'] ==$Has_condition['id_jobs']):?>
          <td><?= $id_Jobs['name'] ?></td>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php foreach ($id_conditions as $id_Conditions) : ?>
        <?php if ($id_Conditions['id'] ==$Has_condition['id_conditions']):?>
          <td><?= $id_Conditions['question'] ?></td>
        <?php endif; ?>
        <?php endforeach; ?>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_Has_conditions('<?= $Has_condition['id'] ?>', '<?= $Has_condition['id_jobs'] ?>', '<?= $Has_condition['id_conditions'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $Has_condition['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
      $('#product-table').DataTable();
      $('#product-table_wrapper').addClass("none");
    });
  </script>

  <div class="modal" id="add-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Has_condition</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <select class="form-select" id="add-id_jobs" name="add-id_jobs">
        <?php foreach ($id_jobs as $id_Jobs) : ?>
            <option value="<?= $id_Benevoles['id'] ?>"><?= $id_Jobs['name'] ?></option>
            <?php endforeach; ?>
            </select>
            <select class="form-select" id="add-id_jobs" name="add-id_conditions">
        <?php foreach ($id_conditions as $id_Conditions) : ?>
            <option value="<?= $id_Conditions['id'] ?>"><?= $id_Conditions['question'] ?></option>
            <?php endforeach; ?>
            </select>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_Has_conditions('<?php echo csrf_hash() ?>')">ajouter</button>
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
          <h4 class="modal-title">Modifier Has_conditions</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" value="id" value="<?= $Benevole['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id_jobs" class="form-label">id_jobs</label>
            <select class="form-select" id="modify-id_jobs" name="modify-id_jobs">
            <?php foreach ($id_jobs as $id_Jobs) : ?>
                <option value="<?= $id_Jobs['id'] ?>"><?= $id_Jobs['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id_conditions" class="form-label">id_conditions</label>
            <select class="form-select" id="modify-id_conditions" name="modify-id_conditions">
            <?php foreach ($id_conditions as $id_Conditions) : ?>
                <option value="<?= $id_Conditions['id'] ?>"><?= $id_Conditions['question'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_Has_conditions($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">modifié</button>
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
          <h4 class="modal-title">delete Has_conditions</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer ce Has_conditions ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_Has_condition($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
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
