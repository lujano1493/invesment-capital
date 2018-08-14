<form class="" action = "{{ route($route) }}" >
  <div class="input-group">
    <input class="form-control" name="{{!isset($id) ? 'query_search' : $id }}"  id="{{!isset($id) ? 'query_search' : $id }}" 
    type="text" value= "{{ old(  !isset($id) ? 'query_search' : $id ) }}" placeholder="Buscar...">
    <span class="input-group-append">
      <button class="btn btn-primary" type="submit">
        <i class="fa fa-search"></i>
      </button>
    </span>
  </div>
</form>