 <div class="navigasi">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="img/home2.png" width="25%">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
          <li class="nav-item active">
            <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Transaksi</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              Master
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="kategori.php">kategori</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="store.php">Store</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              <?php  echo $_SESSION['username']?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="user.php">user</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>

        </ul>
        <form class="d-flex">
          <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </nav>
  </div>
</div>

