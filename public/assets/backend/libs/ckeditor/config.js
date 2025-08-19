/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	var APP_URL = 'http://172.19.49.161:7000/';
    config.allowedContent = true;
    config.removeFormatAttributes = '';
	config.contentsCss = [
		'https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic',
        APP_URL + 'assets/frontend/css/reset.css',
        APP_URL + 'assets/frontend/libs//bootstrap/css/bootstrap.min.css',
        APP_URL + 'assets/frontend/libs/font-awesome/css/font-awesome.min.css',

        APP_URL + 'assets/frontend/css/custom.css',
        APP_URL + 'assets/frontend/libs/iconmoon/css/iconmoon.css',
        APP_URL + 'assets/frontend/css/ckeditor.css'
	];
};
