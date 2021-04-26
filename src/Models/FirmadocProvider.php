<?php

namespace Ajtarragona\Accede\Models;

use Ajtarragona\Accede\Models\AccedeProvider;
use Ajtarragona\Accede\Models\Beans\Firmadoc\Document as FirmadocDocument;
use Ajtarragona\Accede\Models\Beans\Firmadoc\Expedient as FirmadocExpedient;
use Ajtarragona\Accede\Models\Beans\Firmadoc\TipusDocument;
use Ajtarragona\Accede\Models\Beans\Firmadoc\TipusExpedient;

class FirmadocProvider extends AccedeProvider
{

    public function getAllTipusDocument($combo = false)
    {
        $params = array(
            //"entCod" => 1
        );
        $response = $this->sendRequest("TDO", "LST", $params, ["apl" => "GDOC"]);
        $items    = TipusDocument::parseResponse($response);

        if ($combo) {
            $ret = [];
            foreach ($items as $item) {
                $ret[$item->tdoId] = $item->tdoCod . " - " . $item->tdoDes;
            }
        } else {
            $ret = $items;
        }
        return $ret;
    }

    public function getTipusDocument($tdoCod)
    {
        $params = array(
            "entCod" => 0,
            "tdoCod" => $tdoCod,
        );
        $response = $this->sendRequest("TDO", "LST", $params, ["apl" => "GDOC"]);
        return TipusDocument::parseSingle($response);

    }

    public function searchTipusDocument($tdoDes)
    {
        $params = array(
            "entCod" => 0,
            "tdoDes" => $tdoDes,
        );

        $response = $this->sendRequest("TDO", "LST", $params, ["apl" => "GDOC"]);
        return TipusDocument::parseSingle($response);

    }

    public function getAllTipusExpedient($combo = false)
    {
        $params = array(
            //"entCod" => 1
        );
        $response = $this->sendRequest("TXP", "LST", $params, ["apl" => "GDOC"]);
        $items    = TipusExpedient::parseResponse($response);

        if ($combo) {
            $ret = [];
            foreach ($items as $item) {
                $ret[$item->lngTxpId] = $item->strTxpCod . " - " . $item->strTxpDes;
            }
        } else {
            $ret = $items;
        }
        return $ret;
    }

    public function createDocument($array)
    {
        $document = FirmadocDocument::cast($array);

        //$params=TercerAccede::toArray($tercer);
        if (isset($document->lngExpId)) {
            $params = array(
                "binDocumento"       => $document->binDocumento,
                "strNombreDocumento" => $document->strNombreDocumento,
                "strTipoDocumento"   => $document->strTipoDocumento,
                "lngExpId"           => $document->lngExpId,
                "strPathDocumento"   => $document->strPathDocumento,
            );

        } else {
            $params = array(
                "binDocumento"       => $document->binDocumento,
                "strNombreDocumento" => $document->strNombreDocumento,
                "strTipoDocumento"   => $document->strTipoDocumento,
                "strExpTxp"          => $document->strExpTxp,
                "strExpCod"          => $document->strExpCod,
                "lngExpAnn"          => $document->lngExpAnn,
                "strPathDocumento"   => $document->strPathDocumento,
            );

        }

        try {
            $response = $this->sendRequest("DOC", "CRE", $params, ["apl" => "GDOC"]);

        } catch (Exception $e) {
            dd("ERROR:" . $params["strNombreDocumento"] . "->" . $e);
        }
        return FirmadocDocument::parseCreate($response);
    }

}
