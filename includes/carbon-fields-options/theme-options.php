<?php


use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make( 'theme_options', __( 'Theme Options' ) )
        ->add_tab('Загальні налаштування', [
            Field::make( 'image', 'site_logo', 'Лого' ),
        ] )

        ->add_tab('Загальні налаштування', [
            Field::make( 'text', 'site_phone', 'Телефон' ),
            Field::make( 'text', 'site_number_digits', 'Номер без пробілу' ),
            Field::make( 'text', 'site_address', 'Адреса' ),
        ] );

?>