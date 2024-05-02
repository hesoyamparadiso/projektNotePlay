<?php
class SpravceMainu {
    public function vratSkladbySJmenem() {
        $sqlDotaz = "
            SELECT skladby.id_s, skladby.nazev, skladby.obrazek, skladby.zdroj, skladby.id_z, skladby.id_i, autori.ArtistName
            FROM skladby, autori
            WHERE skladby.id_i = autori.id_i
        ";
        $skladbyDB = Db::dotazVsechny($sqlDotaz);

        return $skladbyDB;
    }
    
    public function prevedUdajeSkladebNaObjekty($skladbyDB, $pohled = '0') {
        $skladby = [];
            foreach ($skladbyDB as $skladba) {
                $skladby[] = new Skladba($skladba["id_s"], $skladba["nazev"], $skladba["obrazek"], $skladba["zdroj"], $skladba["id_z"], $skladba["id_i"], $skladba["ArtistName"], $pohled);
            
        }
        return $skladby;
    }
}