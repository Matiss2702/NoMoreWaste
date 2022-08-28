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
      <?php foreach ($benevoles as $Benevole) : ?>
        <tr>
          <td><?= $Benevole['id'] ?></td>
          <td><?= $Benevole['lastname'] ?></td>
          <td><?= $Benevole['firstname'] ?></td>
          <td><?= $Benevole['password'] ?></td>
          <td><?= $Benevole['mail'] ?></td>
          <td><?= $Benevole['address'] ?></td>
          <td><?= $Benevole['city'] ?></td>
          <td><?= $Benevole['zipcode'] ?></td>
          <td><?= $Benevole['country'] ?></td>
          <td><?= $Benevole['phone'] ?></td>
          <td><?= $Benevole['valided'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_Benevoles('<?= $Benevole['id'] ?>', '<?= $Benevole['lastname'] ?>', '<?= $Benevole['firstname'] ?>', '<?= $Benevole['password'] ?>',
          '<?= $Benevole['mail'] ?>', '<?= $Benevole['address'] ?>', '<?= $Benevole['city'] ?>',
          '<?= $Benevole['zipcode'] ?>', '<?= $Benevole['country'] ?>', '<?= $Benevole['phone'] ?>','<?= $Benevole['valided'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $Benevole['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
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
          <h4 class="modal-title">Add Benevole</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-fistname" class="form-label">firstname</label>
            <input class="form-control" type="text" id="add-firstname" name="add-fristname" placeholder="prenom">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-lastname" class="form-label">lastname</label>
            <input class="form-control" type="text" id="add-lastname" name="add-lastname" placeholder="nom">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-password" class="form-label">password</label>
            <input class="form-control" type="password" id="add-password" name="add-password" placeholder="password">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-mail" class="form-label">mail</label>
            <input class="form-control" type="float" id="add-mail" name="add-mail" placeholder="mail">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-address" class="form-label">address</label>
            <input class="form-control" type="float" id="add-address" name="add-address" placeholder="address">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-city" class="form-label">city</label>
            <input class="form-control" type="float" id="add-city" name="add-city" placeholder="city">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-zipcode" class="form-label">zipcode</label>
            <input class="form-control" type="text" id="add-zipcode" name="add-zipcode" placeholder="zipcode">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-country" class="form-label">country</label>
            <input class="form-control" type="text" id="add-country" name="add-country" placeholder="country">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-phone" class="form-label">phone</label>
            <input class="form-control" type="number" id="add-phone" name="add-phone" placeholder="phone">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="add-check-valided">
              <label class="form-check-label" for="add-check-status">valided</label>
            </div>
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_Benevoles('<?php echo csrf_hash() ?>')">ajouter</button>
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
          <h4 class="modal-title">Modifier Benevole</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" value="id" value="<?= $Benevole['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-firstname" class="form-label">firstname</label>
            <input class="form-control" type="text" id="modify-firstname" name="modify-firstname" value="<?= $Benevole['firstname'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-lastname" class="form-label">lastname</label>
            <input class="form-control" type="float" id="modify-lastname" name="modify-lastname" value="<?= $Benevole['lastname'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-password" class="form-label">password</label>
            <input class="form-control" type="password" id="modify-password" name="modify-password" value="<?= $Benevole['password'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-mail" class="form-label">mail</label>
            <input class="form-control" type="float" id="modify-mail" name="modify-mail" value="<?= $Benevole['mail'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-address" class="form-label">address</label>
            <input class="form-control" type="text" id="modify-address" name="modify-address" value="<?= $Benevole['address'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-city" class="form-label">city</label>
            <input class="form-control" type="text" id="modify-city" name="modify-city" value="<?= $Benevole['city'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-zipcode" class="form-label">zipcode</label>
            <input class="form-control" type="text" id="modify-zipcode" name="modify-zipcode" value="<?= $Benevole['zipcode'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-country" class="form-label">country</label>
            <input class="form-control" type="text" id="modify-country" name="modify-country" value="<?= $Benevole['country'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-phone" class="form-label">phone</label>
            <input class="form-control" type="number" id="modify-phone" name="modify-phone" placeholder="<?= $Benevole['phone'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-valided" class="form-label">valided</label>
            <input class="form-control" type="number" id="modify-valided" name="modify-valided" placeholder="<?= $Benevole['valided'] ?>">
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_Benevoles($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">modifié</button>
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
          <h4 class="modal-title">delete Benevole</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer ce Benevole ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_Benevoles($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
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
