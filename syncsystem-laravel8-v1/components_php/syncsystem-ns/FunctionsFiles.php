<?php
namespace SyncSystemNS;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FunctionsFiles
{
    // Upload multiple files function.
    // **************************************************************************************
    /**
    * Upload multiple files function.
     * @static
     * @param float $idRecord 
     * @param Request $postedFile 
     * @param string $directoryUpload c:\directory\subdirectory | gSystemConfig.configDirectoryFilesUpload
     * @param string $formFilePost optional
     * @param string $fileNameFinal optional
     * @param array $formfileFieldsReference
     * @return array ['returnStatus' => false, 'file_field_name1' => '', 'file_field_name1' => ''] 
     * @example \SyncSystemNS\FunctionsFiles::filesUpload(tblCategoriesID, 
     *                                              this.openedFiles, 
     *                                              gSystemConfig.configDirectoryFilesUpload, 
     *                                              '');
     * 
     */
    static function filesUploadMultiple(float $idRecord, Request $postedFile, string $directoryUpload, string $fileNameFinal = '', ?array $formfileFieldsReference = []): array
    {
        // Variables.
        // ----------------------
        $strReturn = ['returnStatus' => false ]; // ['returnStatus' => false, 'returnFileName' => ""]
        // ----------------------

        // Loop through postedFile.
        /*
        for ($countArrayPostedFiles = 0; $countArrayPostedFiles < count($formfileFieldsReference); $countArrayPostedFiles++) {
            echo 'formfileFieldsReference=<pre>';
            var_dump($formfileFieldsReference[$countArrayPostedFiles]);
            echo '</pre><br />';
        }
        */
        if ($formfileFieldsReference) {
            foreach($formfileFieldsReference as $formfileFieldsReferenceKey => $formfileFieldsReferenceData) {
                // Variables.
                $fileName = '';

                // Define values.
                $fileName = $formfileFieldsReferenceData['fileNamePrefix'] . $idRecord . '.' . $formfileFieldsReferenceData['fileExtension'];
                
                // Set return values.
                $strReturn[$formfileFieldsReferenceKey] = $fileName;

                // Check if it´s an image (for resizing and copying an original file size).
                if (strpos($GLOBALS['configImageFormats'], $formfileFieldsReferenceData['fileExtension']) !== false) {
                    $fileName = 'o' . $fileName;
                }

                // Copy file (local).
                // ----------------------
                if ($GLOBALS['configUploadType'] === 1) {
                    try {
                        //$postedFile->file('image_main')->storeAs('public/app_files_public/', 'testing.jpg'); // Debug.
                        $postedFile->file($formfileFieldsReferenceKey)->storeAs($GLOBALS['configDirectoryFiles'] . '/', $fileName);
                    } catch (Error $filesUploadMultipleError) {
                        if ($GLOBALS['configDebug'] === true) {
                            throw new Error('filesUploadMultipleError: ' . $filesUploadMultipleError->message());
                        }
                    } finally {
                        $strReturn['returnStatus'] = true;
                    }
                }
                // ----------------------

                // Copy file (local).
                // ----------------------
                if ($GLOBALS['configUploadType'] === 2) {
                    // TODO:
                }
                // ----------------------

                // Delete temporary file.
                //Storage::disk('tmp')->delete($formfileFieldsReferenceData['temporaryFilePath']);
                Storage::delete($formfileFieldsReferenceData['temporaryFilePath']);
            }
        }

        return $strReturn;
    }
}
