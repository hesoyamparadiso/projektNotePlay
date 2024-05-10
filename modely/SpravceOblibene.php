<?php 
class SpravceOblibene {

    public static function vratOblibeneSkladby () {
        $sqlDotaz = "
            SELECT s.id_s, s.nazev, s.obrazek, s.zdroj, s.id_z, s.id_i, a.ArtistName
            FROM skladby s, oblibene_skladby o, autori a
            WHERE s.id_s = o.id_s AND id_u = ? AND s.id_i = a.id_i
        ";
        $prihlasenyUzivatel = $_SESSION["uzivatel"]["id_u"];
        $skladbyDB = Db::dotazVsechny($sqlDotaz, [$prihlasenyUzivatel]);

        return $skladbyDB;    
    }


    public function prevedUdajeSkladebNaObjekty($skladbyDB, $pohled = '0') {
        $skladby = [];
        if ($pohled == 0){
            foreach ($skladbyDB as $skladba) {
                $skladby[] = new SkladbaOblibene($skladba["id_s"], $skladba["nazev"], $skladba["obrazek"], $skladba["zdroj"], $skladba["id_z"], $skladba["id_i"], $skladba["ArtistName"]);
            }
        }else{
            foreach ($skladbyDB as $skladba) {
                $skladby[] = new SkladbaOblibene($skladba["id_s"], $skladba["nazev"], $skladba["obrazek"], $skladba["zdroj"], $skladba["id_z"], $skladba["id_i"], $skladba["ArtistName"], $pohled);
            }
        }
        return $skladby;
    }

}