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
            <li><a class="dropdown-item" href="/lookup_person.php?id=1">GET parameter injection at end of query</a></li>
            <li><a class="dropdown-item" href="/lookup_person_single_quotes.php?id=1">GET parameter injection with single quotes surrounding at end of query</a></li>
            <li><a class="dropdown-item" href="/lookup_person_midquery_injection.php?id=1">GET parameter injection with surrounding query content</a></li>
            <li><a class="dropdown-item" href="/lookup_person_with_prefix_suffix.php?id=a:1:a">GET parameter injection in the middle of a parameter</a></li>
            <li><a class="dropdown-item" href="/show_all_people.php">GET parameter injection in ORDER BY clause</a></li>
            <li><a class="dropdown-item" href="/lookup_person_query_with_crlf.php?id=1">GET parameter injection with CR/LF in query</a></li>
            <li><a class="dropdown-item" href="/lookup_person_mixed_query_injection.php?id=1">GET parameter injection with mixed parameterized query</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Non-Traditional Forms
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/lookup_person_multi.php">POST multipart parameter injection</a></li>
            <li><a class="dropdown-item" href="/json_form_input.php">JSON injection via POST parameter</a></li>
            <li><a class="dropdown-item" href="/xml_form_input.php">XML injection via POST parameter</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            APIs
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/json_post_body.php">JSON POST attribute injection (body)</a></li>
            <li><a class="dropdown-item" href="/xml_post_body.php">XML POST attribute injection (body)</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Customize Filters
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="/edit_filter_characters.php">Edit Character Filters (e.g. <code>&lt;&gt;=</code>)</a>
            </li>
            <li>
              <a class="dropdown-item" href="/edit_filter_strings.php">Edit String Filters (e.g. <code>AND</code>)</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:location.href=location.href+'?&source=1'">View Source (this Page)</a>
        </li>

      </ul>
    </div>
  </div>
</nav>
