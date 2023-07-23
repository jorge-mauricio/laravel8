<?php

declare(strict_types=1);

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
     */
    public static function filesUploadMultiple(
        float $idRecord,
        Request $postedFile,
        string $directoryUpload,
        string $fileNameFinal = '',
        ?array $formfileFieldsReference = []
    ): array {
        // Variables.
        // ----------------------
        $strReturn = ['returnStatus' => false]; // ['returnStatus' => false, 'returnFileName' => ""]
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
            foreach ($formfileFieldsReference as $formfileFieldsReferenceKey => $formfileFieldsReferenceData) {
                // Variables.
                $fileName = '';

                // Define values.
                $fileName = $formfileFieldsReferenceData['fileNamePrefix'] . $idRecord . '.' . $formfileFieldsReferenceData['fileExtension'];

                // Set return values.
                $strReturn[$formfileFieldsReferenceKey] = $fileName;

                // Check if it´s an image (for resizing and copying an original file size).
                if (strpos(config('app.gSystemConfig.configImageFormats'), $formfileFieldsReferenceData['fileExtension']) !== false) {
                    $fileName = 'o' . $fileName;
                }

                // Copy file (local).
                // ----------------------
                if (config('app.gSystemConfig.configUploadType') === 1) {
                    try {
                        // $postedFile->file('image_main')->storeAs('public/app_files_public/', 'testing.jpg'); // Debug.
                        // $postedFile->file($formfileFieldsReferenceKey)->storeAs(config('app.gSystemConfig.configDirectoryFiles') . '/', $fileName); // working
                        $postedFile->file($formfileFieldsReferenceKey)->storeAs($directoryUpload . '/', $fileName);
                    } catch (\Exception $filesUploadMultipleError) {
                        if (config('app.gSystemConfig.configDebug') === true) {
                            throw new \Error('filesUploadMultipleError: ' . $filesUploadMultipleError->getMessage());
                        }
                    } finally {
                        $strReturn['returnStatus'] = true;
                    }
                }
                // ----------------------

                // Copy file (local).
                // ----------------------
                if (config('app.gSystemConfig.configUploadType') === 2) {
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
    // **************************************************************************************

    // Delete files on server.
    // **************************************************************************************
    /**
     * Delete files on server.
     * @static
     * @param string $fileName
     * @param string $directoryName
     * @param array $arrImageSize
     * @return array ['returnStatus' => false, 'nRecords' => 0]
     */
    public static function fileDelete02(
        $fileName,
        $directoryName = '',
        $arrImageSize = null
    ): array {
        // Variables.
        // ----------------------
        $arrReturn = ['returnStatus' => true, 'nRecords' => 0];
        $nRecords = 0;
        $strDirectoryName = $directoryName;
        // ----------------------

        // Default values.
        if ($strDirectoryName === '') {
            $strDirectoryName = storage_path('app') . '\\' . config('app.gSystemConfig.configDirectoryFilesUpload');
        }

        // Logic.
        // ----------------------
        try {
            if ($fileName) {
                if ($arrImageSize) {
                    // Delete original file.
                    $fileOriginalDeletePath = $strDirectoryName . '\\' . 'o' . $fileName;

                    // Debug.
                    // echo 'fileOriginalDeletePath=<pre>';
                    // var_dump($fileOriginalDeletePath);
                    // echo '</pre><br />';

                    // echo 'file_exists(fileOriginalDeletePath)=<pre>';
                    // var_dump(file_exists($fileOriginalDeletePath));
                    // echo '</pre><br />';

                    // Review - ref: https://stackoverflow.com/questions/15318230/php-unlink-handling-the-exception
                    if (file_exists($fileOriginalDeletePath)) {
                        // File exists.
                        if (unlink($fileOriginalDeletePath) === true) {
                            $nRecords++;

                            if (config('app.gSystemConfig.configDebug') === true) {
                                $arrReturn['debug'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage6');
                            }
                        } else {
                            $arrReturn['returnStatus'] = false;

                            if (config('app.gSystemConfig.configDebug') === true) {
                                $arrReturn['debug'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage6e');
                            }
                        }

                        // AWS S3.
                        // TODO: Check if file_exists works with S3.
                        if (config('app.gSystemConfig.configUploadType') === 2) {
                            // TODO:
                        }
                    } else {
                        if (config('app.gSystemConfig.configDebug') === true) {
                            $arrReturn['debug'] = 'File access error';
                        }
                    }

                    // Delete - multiple files.
                    // Loop through array.
                    for ($arrCountImageSize = 0; $arrCountImageSize < count($arrImageSize); $arrCountImageSize++) {
                        $arrImageSizeParameters = explode(';', $arrImageSize[$arrCountImageSize]);
                        $imagePrefix = $arrImageSizeParameters[0];
                        if ($imagePrefix === 'NULL') {
                            $imagePrefix = '';
                        }
                        $fileDeletePath = $strDirectoryName . '\\' . $imagePrefix . $fileName;
                        // $imageW = $arrImageSizeParameters[1];
                        // $imageH = $arrImageSizeParameters[2];

                        if (file_exists($fileDeletePath)) {
                            // File exists.
                            if (unlink($fileDeletePath) === true) {
                                $nRecords++;

                                if (config('app.gSystemConfig.configDebug') === true) {
                                    $arrReturn['debug'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage6');
                                }
                            } else {
                                $arrReturn['returnStatus'] = false;

                                if (config('app.gSystemConfig.configDebug') === true) {
                                    $arrReturn['debug'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage6e');
                                }
                            }

                            // AWS S3.
                            if (config('app.gSystemConfig.configUploadType') === 2) {
                                // TODO:
                            }
                        } else {
                            if (config('app.gSystemConfig.configDebug') === true) {
                                $arrReturn['debug'] = 'File access error';
                            }
                        }
                    }
                } else {
                    // Delete - single file.
                    $fileDeletePath = $strDirectoryName . '\\' . $fileName;

                    if (file_exists($fileDeletePath)) {
                        // File exists.
                        if (unlink($fileDeletePath) === true) {
                            $nRecords++;

                            if (config('app.gSystemConfig.configDebug') === true) {
                                $arrReturn['debug'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage6');
                            }
                        } else {
                            $arrReturn['returnStatus'] = false;

                            if (config('app.gSystemConfig.configDebug') === true) {
                                $arrReturn['debug'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage6e');
                            }
                        }

                        // AWS S3.
                        if (config('app.gSystemConfig.configUploadType') === 2) {
                            // TODO:
                        }
                    } else {
                        if (config('app.gSystemConfig.configDebug') === true) {
                            $arrReturn['debug'] = 'File access error';
                        }
                    }
                }
            }
        } catch (\Exception $fileDelete02Error) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('fileDelete02Error: ' . $fileDelete02Error->getMessage());
            }
        } finally {
            // Debug.
            if (config('app.gSystemConfig.configDebug') === true) {
                //
            }
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
