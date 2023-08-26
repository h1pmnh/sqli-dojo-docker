<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid px-0">
    <a class="navbar-brand" href="#">SQLi Dojo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link"href="/">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Traditional Forms
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/lookup_person.php">GET parameter injection</a></li>
            <li><a class="dropdown-item" href="/lookup_person_with_prefix_suffix.php">GET parameter injection in the middle of a string</a></li>
            <li><a class="dropdown-item" href="/lookup_person_multi.php">POST multipart parameter injection</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            APIs
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/json_input.php">JSON POST attribute injection</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/edit_filter_characters.php">Edit Filter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:location.href=location.href+'?&source=1'">View Source</a>
        </li>

      </ul>
    </div>
  </div>
</nav>
