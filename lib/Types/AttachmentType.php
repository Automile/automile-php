<?php

namespace Automile\Sdk\Types;

/**
 * Attachment Type
 */
class AttachmentType implements Type
{

    const IMAGE = 0;
    const PDF = 1;
    const DOCX = 2;
    const EXCEL = 3;

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value)
    {
        return in_array($value, rante(0, 3));
    }

    /**
     * determine attachment type by file extension
     * @param string $filename
     * @return int
     */
    public static function getByFilename($filename)
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        switch ($ext)
        {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
            case 'tiff':
            case 'bmp':
                return self::IMAGE;

            case 'pdf':
                return self::PDF;

            case 'xls':
            case 'xlsx':
                return self::EXCEL;

            case 'docx':
                return self::DOCX;
        }
    }

}
