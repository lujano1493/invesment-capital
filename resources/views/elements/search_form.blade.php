<form class="" action = "{{ route($route) }}" >
  <div class="input-group">
    <input class="form-control" name="query_search"  id="query_search" type="text" value= "{{ old('query_search') }}" placeholder="Buscar...">
    <span class="input-group-append">
      <button class="btn btn-primary" type="submit">
        <i class="fa fa-search"></i>
      </button>
    </span>
  </div>
</form>