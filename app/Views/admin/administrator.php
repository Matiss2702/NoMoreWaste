<html>
<head>
<title> No_More_Waste - Administrator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/toastr.min.css">
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/toastr.min.js"></script>
    <script src="/js/administrator.js"></script>
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <script src="/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/css/fontawesome/all.min.css">
    <script src="/js/fontawesome/all.min.js"></script>
</head>
<body>
 <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" id="mail" class="form-control" />
    <label class="form-label" for="mail">Email address</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" id="password" class="form-control" />
    <label class="form-label" for="password">Password</label>
  </div>

  <!-- Submit button -->
  <button type="button" class="btn btn-primary btn-block mb-4" onclick="login_admin('<?php echo csrf_hash() ?>')">se connecter</button>
  </div>
</body>
</html>
