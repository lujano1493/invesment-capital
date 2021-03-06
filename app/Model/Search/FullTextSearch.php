<?php
namespace App\Model\Search;

  /**
   * Aspecto para busquedas con indice
   */
trait FullTextSearch
  {
    /**
   * Replaces spaces with full text search wildcards
   *
   * @param string $term
   * @return string
   */
    function fullTextWildcards($term)
    {

      //check  terminos is email
      if(   false !== filter_var($term, FILTER_VALIDATE_EMAIL) ){
        return  "\"" . $term . "\"";
      }


      // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '_', $term);

        $words = explode(' ', $term);

        foreach($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if(strlen($word) >= 3) {
                $words[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode( ' ', $words);
        return $searchTerm;
    }

    /**
    * Scope a query that matches a full text search of term.
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @param string $term
    * @return \Illuminate\Database\Eloquent\Builder
    */
   public function scopeSearch($query, $term)
   {
       $columns = implode(',',$this->searchable);
       if(!empty( $term)){
         $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)" , $this->fullTextWildcards($term));
       }
       return $query;
   }
  }



 ?>
