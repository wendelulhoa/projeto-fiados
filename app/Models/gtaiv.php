<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gtaiv extends Model
{
    protected static function getCategoryIndex($category)
    {
        $categories = games::getCategoriesEn();
        return array_search($category, $categories);
    }

    protected static function getCategoriesKeys()
    {
        return [0, 3, 4, 5, 6, 7, 8];
    }
    
    /**
     * retorna as tags em português
     *
     * @param 0 = veiculos
     * @param 3 = armas
     * @param 4 = scripts
     * @param 5 = personagem
     * @param 6 = mapas
     * @param 7 = outros
     * @param 8 = ferramentas
     * @return array
     */
    protected static function getTags($category)
    {
        switch ($category) {
            case 0:
                return ['Audi', 'Bentley', 'BMW', 'Bugatti', 'Cadillac', 'Chevrolet', 'Dodge', 'Ferrari', 'Ford', 'Honda', 'Hummer',
                        'Infiniti', 'Jaguar', 'Jeep', 'Lamborghini', 'Lexus', 'Mazda', 'MClaren', 'Mercedes-Benz', 'Mistubishi', 'Nissan', 'Pagani',
                        'Peugeot', 'Pontiac', 'Porsche', 'Range-Rover', 'Rolls-Royce', 'Subaru', 'Toyota', 'Volkswagen'];
                break;
            case 3:

                break;
            case 4:
                return ['Trainers', 'Missões', 'Gameplay', 'Plugins', 'ASI', '.NET', '.LUA'];
                
                break;
            case 5:
                return ['Personagem', 'Roupas' ,'Skins' ,'Add-ON' ,'Sapatos' ,'Máscaras' ,'Capacetes' ,'Cabelo' ,'Tatuagens'];
                
                break;
            case 6:
                return ['Construções' ,'Rampa' ,'Circuitos', 'Interiores', 'Outros'];
                
                break;
            case 7:
                return ['Gráficos', 'Front-End', 'Configurações', 'Sons', 'Save-Games', 'Outros'];
               
                break;
            case 8:
                return ['Para desenvolvedores', 'Configurações', 'Programas', 'Scripts'];
                
                break;
        }
    }

    /**
     * retorna as tags em inglês
     *
     * @param 0 = veiculos
     * @param 3 = armas
     * @param 4 = scripts
     * @param 5 = personagem
     * @param 6 = mapas
     * @param 7 = outros
     * @param 8 = ferramentas
     * @return array
     */
    protected static function getTagsEn($category)
    {
        switch ($category) {
            case 0:
                return ['Audi', 'Bentley', 'BMW', 'Bugatti', 'Cadillac', 'Chevrolet', 'Dodge', 'Ferrari', 'Ford', 'Honda', 'Hummer',
                        'Infiniti', 'Jaguar', 'Jeep', 'Lamborghini', 'Lexus', 'Mazda', 'MClaren', 'Mercedes-Benz', 'Mistubishi', 'Nissan', 'Pagani',
                        'Peugeot', 'Pontiac', 'Porsche', 'Range-Rover', 'Rolls-Royce', 'Subaru', 'Toyota', 'Volkswagen'];
                break;
            case 3:

                break;
            case 4:
                return ['Trainers', 'Missions', 'Gameplay', 'Plugins', 'ASI', '.NET', '.LUA'];
                
                break;
            case 5:
                return ['Person', 'Clothes' ,'Skins' ,'Add-ON' ,'Shoes' ,'Masks' ,'Helmets' ,'Hair' ,'Tattoos'];
                
                break;
            case 6:
                return ['Constructions', 'Ramp', 'Circuits', 'Interiors', 'Others'];
                
                break;
            case 7:
                return ['Graphics', 'Front-End', 'Settings', 'sounds', 'Save-Games', 'Others'];
               
                break;
            case 8:
                return ['for-developers', 'Settings', 'Programs', 'Scripts'];
                
                break;
        }
    }
}
