<?php


/** Function that checks subject code, title, item_type form upload. To be split into proper pieces later.
 * @return bool
 */
function pdfUpload() {
	if ( isset( $_POST['subject_code'] ) && isset( $_POST['title'] ) && isset( $_POST['item_type'] ) ) {
		//if the form has been sent

		if ( $_POST['subject_code'] !== "---" && $_POST['title'] !== "---" ) {//if non-default values have been picked
			if ( $_FILES['item_pdf']['error'] !== UPLOAD_ERR_OK ) { //check if pdf file failed to upload
				die( "File upload error: " . $_FILES['item_pdf']['error'] ); //fail to upload
			}

			//check if file is actually a pdf
			$finfo = finfo_open( FILEINFO_MIME_TYPE );  //$finfo = file information
			$mime  = finfo_file( $finfo, $_FILES['item_pdf']['tmp_name'] ); //tmp_name is temporary name on server


			if ( $mime == 'application/pdf' ) {
				$basePath = $_SERVER['DOCUMENT_ROOT'] . '/EducationHub/pdf_doc/';
				//append something unique like e.g. day to path for keeping file in.
				$extPath = date( 'Y-m-d' );

				$fullPath = $basePath . $extPath;

				//make sure folder exists. (file to go in content /
				if ( ! is_dir( $fullPath ) ) {
					mkdir( $fullPath, 0777, true );
				}


				//get file extension
				$ext = pathinfo( $_FILES['item_pdf']['name'], PATHINFO_EXTENSION );

				//move the file to the folder
				move_uploaded_file( $_FILES['item_pdf']["tmp_name"], $fullPath . "/" . $_POST['subject_code'] . "-"
				                                                     . $_POST['title'] . "." . $ext );

				//move file to correct location as it's a valid pdf
				return true;
			} else {
				die( "file type not permitted. (" . $mime . ")" );
			}

			//do all the rest of the post stuff.
		} else {
			echo "fail 2nd if";
		}

	} else {
		echo "Variables empty";
	}
	return false;
}