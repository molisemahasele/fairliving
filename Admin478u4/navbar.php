<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">An-K</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="houses.php">Houses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="landlords.php">Landlords</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="posts.php">Post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="contact.php">Messages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="logout.php">logout</a>
        </li>
      </ul>
      <form class="d-flex" action="search.php" method="POST">
        <input name="search" class="form-control me-2"  type="search" placeholder="Search" aria-label="Search">
        <button name="submit-search" class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<br>
