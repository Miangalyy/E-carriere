<template>
  <div class="card text-center mt-4">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link active" href="#">Active</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <h5 class="card-title">Best platforms</h5>
      <p class="card-text">Bienvenue dans l'application gestion des carrieres.</p>
      <Link :href="route('employer')" class="btn btn-primary">Allez quelque part</Link>
    </div>
  </div>
</template>