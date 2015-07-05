<?php

namespace Grs\Utils;

use Nette,
	Nette\Application\UI,
	Nette\Http\FileUpload;


class Files
{

	/**
	 * Static class - cannot be instantiated.
	 */
	final public function __construct()
	{
		throw new Nette\StaticClassException;
	}


	/**
	 * @param  string $dir directory name
	 * @return bool
	 */
	public static function createDir($dir)
	{
		if (file_exists($dir) || is_dir($dir)) {
			$return = TRUE;
		} else {
			$return = mkdir($dir, 0777, TRUE) ? TRUE : FALSE;
		}

		return $return;
	}


	/**
	 * Return file upload error message.
	 * @param  FileUpload $file
	 * @param  UI\Presenter $presenter
	 * @return bool
	 */
	public static function hasFileError(FileUpload $file, UI\Presenter &$presenter, $noFileError = TRUE)
	{
		switch ($file->getError())
		{
			case UPLOAD_ERR_INI_SIZE:
				$presenter->flashMessage('The uploaded file exceeds the upload_max_filesize directive in php.ini.', 'error');
				$return = FALSE;
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$presenter->flashMessage('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.', 'error');
				$return = FALSE;
				break;
			case UPLOAD_ERR_PARTIAL:
				$presenter->flashMessage('The uploaded file was only partially uploaded.', 'error');
				$return = FALSE;
				break;
			case UPLOAD_ERR_NO_FILE:
				if ($noFileError === FALSE) {
					$presenter->flashMessage('No file was uploaded.', 'error');
				}
				$return = $noFileError;
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$presenter->flashMessage('Missing a temporary folder.', 'error');
				$return = FALSE;
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$this->flashMessage('Failed to write file to disk.', 'error');
				$return = FALSE;
				break;
			case UPLOAD_ERR_EXTENSION:
				$presenter->flashMessage('File upload stopped by extension.', 'error');
				$return = FALSE;
				break;
			default:
				$presenter->flashMessage('Chyba při zpracování souboru ' . $file->getName(), 'error');
				$return = FALSE;
				break;
		}

		return $return;
	}

}
