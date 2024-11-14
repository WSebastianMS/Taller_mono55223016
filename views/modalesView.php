<?php

namespace App\views;

class ModalesView
{
    function getConfirmacion($idModal, $url, $nameForm)
    {
        $modal = '<div id="' . $idModal . '" class="modal ocultarModal">';
        $modal .= '  <div class="confirmModal">';
        $modal .= '     <form name="' . $nameForm . '" action="' . $url . '" method="post">';
        $modal .= '         <input type="hidden" name="cod" value="">';
        $modal .= '         <button type="button" class="closeBtn">X</button>';
        $modal .= '         <p class="msg">¿Desea eliminar el registro?</p>';
        $modal .= '         <button type="submit" class="okBtn">Si</button>';
        $modal .= '         <button type="button" class="notBtn">No</button>';
        $modal .= '     </form>';
        $modal .= '  </div>';
        $modal .= '</div>';
        return $modal;
    }
}
