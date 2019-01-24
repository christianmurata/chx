<?php
/**
 * Simple Templating function
 *
 * @param $file   - Path to the PHP file that acts as a template.
 * @param $args   - Associative array of variables to pass to the template file.
 * @return string - Output of the template file. Likely HTML.
 */

use Utils\Utils;

function template($template, $args = null){
    global $templates;

    $path = $templates[$template];
    $temp = file_get_contents(__DIR__ . '/' . $path);

    ob_start();
    ob_get_clean();

    // Make values in the associative array easier to access by extracting them
    if (is_array($args)){
        foreach($args as $key => $value){
            // verifica se é um array
            if(is_array($value))
                $value = Utils::liTemplate($value, $template);
            
            $key  = '{' . $key . '}';
            $temp = str_replace("$key", $value, $temp);
        }
    }

    return $temp;

    // global $templates;

    // $file = $templates[$template];

    // // ensure the file exists
    // if (file_exists($file)) {
    //     return 'Erro! Template não encontrado!';
    // }

    // // Make values in the associative array easier to access by extracting them
    // if ( is_array( $args ) ){
    //     extract( $args );
    // }

    // // buffer the output (including the file is "output")
    // ob_start();

    // include $file;

    // return ob_get_clean();
}
