<?php
namespace SyncSystemNS;

use Image;

class FunctionsImage
{
    // Resize images.
    // **************************************************************************************
    /**
     * Resize images.
     * @static
     * @async
     * @param array arrImageSize ["g;667;500","NULL;370;277","r;205;154","t;120;90"]
     * @param string directoryFiles  c:\directory\subdirectory | gSystemConfig.configDirectoryFilesUpload
     * @param string fileName
     * @return boolean true (success) | false (error)
     * @example \SyncSystemNS\FunctionsImage::imageResize01($arrImageSize, 
     *                                                      $directoryFiles, 
     *                                                      $fileName, 
     *                                                      '');
     */
    static function imageResize01($arrImageSize, $directoryFiles, $fileName): bool
    {
        // Variables.
        // ----------------------
        $strReturn = true;
        // ----------------------

        // Logic.
        if (strpos($GLOBALS['configImageFormats'], strtolower(pathinfo($fileName, PATHINFO_EXTENSION))) !== false) {

            for ($arrCountImageSize = 0; $arrCountImageSize < count($arrImageSize); $arrCountImageSize++) {
                // Variables.
                $arrImageSizeParameters = explode(';', $arrImageSize[$arrCountImageSize]);
                $imagePrefix = $arrImageSizeParameters[0];
                if ($imagePrefix === 'NULL') {
                  $imagePrefix = '';
                }
                $imageW = $arrImageSizeParameters[1];
                $imageH = $arrImageSizeParameters[2];

                // Resize.
                // ----------------------
                // Intervention Image.
                if ($GLOBALS['configImageComponent'] === 12) {
                    // Create image object.
                    $objImgIntervention = Image::make(storage_path('app' . DIRECTORY_SEPARATOR . $directoryFiles . DIRECTORY_SEPARATOR . 'o' . $fileName));

                    // Resize.
                    $objImgIntervention->resize($imageW, $imageH, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    
                    // Save file.
                    $objImgIntervention->save(storage_path('app' . DIRECTORY_SEPARATOR . $directoryFiles . DIRECTORY_SEPARATOR . $imagePrefix . $fileName));
                }
                // ----------------------
        
            }
        }

        return $strReturn;
              
    }
    // **************************************************************************************

}
