<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ets2 extends Model
{
    protected static function getCategoryIndex($category)
    {
        $categories = games::getCategoriesEn();
        return array_search($category, $categories);
    }

    protected static function getCategoriesKeys()
    {
        return [1, 2, 6, 7, 8];
    }
    
    /**
     * retorna as tags em português
     *
     * @param 1 = caminhões
     * @param 2 = ônibus
     * @param 6 = mapas
     * @param 7 = outros
     * @param 8 = ferramentas
     * @return array
     */
    protected static function getTags($category)
    {
        switch ($category) {
            case 1:
                return ['Chevrolet', 'Ford', 'International', 'Mercedes-Benz', 'Man', 'Scania', 'Volvo', 'Volkswagen', 'Outros'];
                break;
            case 2:
                return ['Busscar', 'Comil', 'Caio', 'Irizar', 'Marcopolo', 'Outros'];
                break;
            case 6:
                return ['Mapas Brasileiros', 'Texturas', 'Outros'];
                break;
            case 7:
                return ['Gráficos', 'Save-Game', 'Outros'];
                break;
            case 8:
                return ['Programas', 'Plugins', 'Rodas e Pneus', 'Para desenvolvedores'];
                break;
        }
    }

    /**
     * retorna as tags em inglês
     *
     * @param 1 = caminhões
     * @param 2 = ônibus
     * @param 6 = mapas
     * @param 7 = outros
     * @param 8 = ferramentas
     * @return array
     */
    protected static function getTagsEn($category)
    {
        switch ($category) {
            case 1:
                return ['Chevrolet', 'Ford', 'International', 'Mercedes-Benz', 'Man', 'Scania', 'Volvo', 'Volkswagen', 'Others'];
                break;
            case 2:
                return ['Busscar', 'Comil', 'Caio', 'Irizar', 'Marcopolo', 'Others'];
                break;
            case 6:
                return ['BrazilianMaps', 'Texturas', 'Others'];
                break;
            case 7:
                return ['Graphics', 'Save-Game', 'Others'];
                break;
            case 8:
                return ['Programs', 'Plugins', 'Wheels-and-tires', 'for-developers'];
                break;
        }
    }

}
