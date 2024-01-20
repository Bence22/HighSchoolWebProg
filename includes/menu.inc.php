<?php
class Menu {
    public static $menu = array(
        "nyitolap" => array("Nyitólap", "", "111"),    
        "elerhetoseg" => array("Elérhetőség", "", "111"),    
        "kepzesek" => array("Képzések", "", "111"),    
        "felveteli" => array("Felvételi", "", "111"),    
        "ponthatarok" => array("Ponthatárok", "felveteli", "011"), 
        "eredmenyek" => array("Eredmények", "felveteli", "011"),
        "jelentkezo" => array("Jelentkező", "", "111"),  
        "belepes" => array("Belépés", "", "100"),       
        "kilepes" => array("Kilépés", "", "101"),       
        "admin" => array("Admin", "", "110"),            
    );

    public static function getMenu($sItems) {
        $submenu = "";
        $isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
        $userPermission = isset($_SESSION['jogosultsag']) ? $_SESSION['jogosultsag'] : 0;

        $menu = "<ul>";
        foreach(self::$menu as $menuindex => $menuitem) {
            if ($menuitem[1] == "") { 
                // Mindig megjelenik a 111-es jogosultságú menüpont
                if ($menuitem[2] == "111") {
                    $menu .= "<li><a href='".SITE_ROOT.$menuindex."' ".($menuindex==$sItems[0]? "class='selected'":"").">".$menuitem[0]."</a></li>"; 
                }
                
                // Megjelenítjük a kilépés menüpontot csak akkor, ha be van jelentkezve a felhasználó, és a menüpont igényli a bejelentkezést
                if ($isLoggedIn == true && $menuitem[2] == "101") {
                    $menu .= "<li><a href='".SITE_ROOT.$menuindex."' ".($menuindex==$sItems[0]? "class='selected'":"").">".$menuitem[0]."</a></li>"; 
                }
                
                // Megjelenítjük a belépés menüpontot csak akkor, ha nincs bejelentkezve a felhasználó, és a menüpont igényli a bejelentkezést
                if (!$isLoggedIn && $menuitem[2] == "100") {
                    $menu .= "<li><a href='".SITE_ROOT.$menuindex."' ".($menuindex==$sItems[0]? "class='selected'":"").">".$menuitem[0]."</a></li>"; 
                }

                // Megjelenítjük az admin menüpontot csak akkor, ha a bejelentkezett felhasználó jogosultsága 1
                if (!$userPermission == 1 && $menuitem[2] == "110") {
                    $menu .= "<li><a href='".SITE_ROOT.$menuindex."' ".($menuindex==$sItems[0]? "class='selected'":"").">".$menuitem[0]."</a></li>"; 
                }
            }
            else if ($menuitem[1] == $sItems[0]) { 
                $submenu .= "<li><a href='".SITE_ROOT.$sItems[0]."/".$menuindex."' ".($menuindex==$sItems[1]? "class='selected'":"").">".$menuitem[0]."</a></li>"; 
            }
        }
        $menu.="</ul>";
        
        if ($submenu != "") {
            $submenu = "<ul>".$submenu."</ul>";
        }
        
        return $menu.$submenu;
    }
}
?>