<?php
class SpravceKomentaru {

    public function pridejKomentar($coment, $id_u, $id_s) {
      if(isset($udaje))
        unset($udaje["id_k"]);
      $udaje["id_u"] = $id_u;
      $udaje["id_s"] = $id_s;
      $udaje["komentar"] = $coment;

      Db::vloz("komentare", $udaje);  
    }

    public function vratKomentare($id_s) {
        $sqlDotaz = "
            SELECT * 
            FROM komentare
            WHERE id_s = ?
        ";
        $komentareDB = Db::dotazVsechny($sqlDotaz, [$id_s]);

        return $komentareDB;
    }

    public function odstranKomentar($id_k) {
        Db::odstran("komentare", "id_k", $id_k);
    }
}
?>