<?php

namespace Utils;

class Upload{
    // for jpg 
    private function resize_imagejpg($file, $w, $h) {
        list($width, $height) = getimagesize($file);
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($w, $h);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);

        return $dst;
    }

    // for png
    private function resize_imagepng($file, $w, $h) {
        list($width, $height) = getimagesize($file);
        $src = imagecreatefrompng($file);
        $dst = imagecreatetruecolor($w, $h);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);

        return $dst;
    }

    // for gif
    private function resize_imagegif($file, $w, $h) {
        list($width, $height) = getimagesize($file);
        $src = imagecreatefromgif($file);
        $dst = imagecreatetruecolor($w, $h);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);

        return $dst;
    }

    public function save(){
        // verifica se foi enviado um arquivo
        if ( isset( $_FILES[ 'imagem' ][ 'name' ] ) && $_FILES[ 'imagem' ][ 'error' ] == 0 ) {
            // echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'imagem' ][ 'name' ] . '</strong><br />';
            // echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'imagem' ][ 'type' ] . ' </strong ><br />';
            // echo 'Temporáriamente foi salvo em: <strong>' . $_FILES[ 'imagem' ][ 'tmp_name' ] . '</strong><br />';
            // echo 'Seu tamanho é: <strong>' . $_FILES[ 'imagem' ][ 'size' ] . '</strong> Bytes<br /><br />';
        
            $arquivo_tmp = $_FILES[ 'imagem' ][ 'tmp_name' ];
            $nome = $_FILES[ 'imagem' ][ 'name' ];
        
            // Pega a extensão
            $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
        
            // Converte a extensão para minúsculo
            $extensao = strtolower ( $extensao );
        
            // Somente imagens, .jpg;.jpeg;.gif;.png
            // Aqui eu enfileiro as extensões permitidas e separo por ';'
            // Isso serve apenas para eu poder pesquisar dentro desta String
            if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
                // Cria um nome único para esta imagem
                // Evita que duplique as imagens no servidor.
                // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                $novoNome = uniqid ( time () ) . '.' . $extensao;
        
                // Concatena a pasta com o nome
                $destino = 'images/' . $novoNome;
        
                // tenta mover o arquivo para o destino
                if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
                    // depois do upload redimensiona a imagem...
                    if($extensao == 'jpg' || $extensao == 'jpeg'){
                        $img = $this->resize_imagejpg($destino, 100, 100);
                        imagejpeg($img, $destino); // substitui a imagem
                    }

                    if($extensao == 'gif'){
                        $img = $this->resize_imagegif($destino, 100, 100);
                        imagegif($img, $destino); // substitui a imagem
                    }

                    if($extensao == 'png'){
                        $img = $this->resize_imagepng($destino, 100, 100);
                        imagepng($img, $destino); // substitui a imagem
                    }

                    // echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
                    // echo ' < img src = "' . $destino . '" />';

                    return $destino;
                }
                else
                    return false; // erro ao salvar o arquivo (permissão)
            }
            else
                return false; // arquivo não é uma imagem
        }
        else
            return false; // nenhum arquivo enviado
    }
}