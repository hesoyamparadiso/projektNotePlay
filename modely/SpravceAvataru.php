<?php 
class SpravceAvataru {
    public function vratAvatary() {
        $sqlDotaz = "
            SELECT * FROM autori
        ";
        $avatariDB = Db::dotazVsechny($sqlDotaz);

        return $avatariDB;
    }

    public function prevedUdajeAvataruNaObjekty($avatariDB) {
        $avatari = [];
        foreach ($avatariDB as $avatar) {
            $avatari[] = new Avatar($avatar["id_i"], $avatar["foto"], $avatar["ArtistName"]);
        }
        return $avatari;
    }
}