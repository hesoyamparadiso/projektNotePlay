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

    public function vratZdrojSkladby($id_s) {
        $sqlDotaz = "
            SELECT *
            FROM skladby
            WHERE id_s = ?
        ";
        $skladbaDB = Db::dotazJeden($sqlDotaz, [$id_s]);

        return $skladbaDB["zdroj"]; 
    }
    
    public function vratNazevSkladby($id_s) {
        $sqlDotaz = "
            SELECT *
            FROM skladby
            WHERE id_s = ?
        ";
        $skladbaDB = Db::dotazJeden($sqlDotaz, [$id_s]);

        return $skladbaDB["nazev"]; 
    }

    public function vratIDSkladby($id_s) {
        $sqlDotaz = "
            SELECT *
            FROM skladby
            WHERE id_s = ?
        ";
        $skladbaDB = Db::dotazJeden($sqlDotaz, [$id_s]);

        return $skladbaDB["id_s"]; 
    }

    
    public function pridejOblibeny($id_u, $id_s) {
        $sqlDotaz = "
            SELECT *
            FROM oblibene_skladby
            WHERE id_u = ? AND id_s = ? 
        ";

        $navratDB = Db::dotazVsechny($sqlDotaz, [$id_u, $id_s]);

        if (empty($navratDB)){
            $udaje["id_obl"] = $id_u . $id_s;
            $udaje["id_u"] = $id_u;
            $udaje["id_s"] = $id_s;

            Db::vloz("oblibene_skladby", $udaje); 
        }
        else {
            Db::odstran("oblibene_skladby", "id_obl", $id_u . $id_s);
        }
    }

    public function vratLike($id_s, $id_u) {
        $sqlDotaz = "
            SELECT *
            FROM oblibene_skladby
            WHERE id_u = ? AND id_s = ? 
        ";

        $navratDB = Db::dotazVsechny($sqlDotaz, [$id_u, $id_s]);

        if (empty($navratDB)) 
            return 0;
        else 
            return 1;
        
    }

    public function vratVyhledaneSkladby($search) {
        $search = "%".$search."%";
        $sqlDotaz = "
            SELECT skladby.id_s, skladby.nazev, skladby.obrazek, skladby.zdroj, skladby.id_z, skladby.id_i, autori.ArtistName
            FROM skladby, autori
            WHERE skladby.id_i = autori.id_i AND autori.ArtistName LIKE ? OR skladby.id_i = autori.id_i AND skladby.nazev LIKE ? 
        ";
        $skladbyDB = Db::dotazVsechny($sqlDotaz, [$search, $search]);

        return $skladbyDB;
    }

    public function prevedUdajeSkladebNaObjekty($skladbyDB, $pohled = '0', $searchMode = '0') {
        $skladby = [];
            foreach ($skladbyDB as $skladba) {
                $skladby[] = new Skladba($skladba["id_s"], $skladba["nazev"], $skladba["obrazek"], $skladba["zdroj"], $skladba["id_z"], $skladba["id_i"], $skladba["ArtistName"], $pohled, $searchMode);
            
        }
        return $skladby;
    }
}