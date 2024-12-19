/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	config.extraPlugins = 'youtube,justify,colorbutton,tabletools,tableresize,scayt,menubutton,wordcount';
	config.scayt_autoStartup = false;
	config.removePlugins = 'stylescombo'; // Styles menüsünü tamamen kaldırır
	config.wordcount = {
		showWordCount: true,
		showCharCount: false,
		maxWordCount: -1,
		maxCharCount: -1,
		maxParagraphs: -1,
	};

	config.toolbarGroups = [
		{ name: 'insert' },
		{ name: 'links' },
		{ name: 'paragraph',   groups: [ 'list', 'blocks', 'align' ] },
		{ name: 'styles'},
		{ name: 'colors'},
		{ name: 'document',	   groups: [ 'mode' ] },
		{ name: 'tools' },
		{ name: 'alignment' } // Hizalama seçenekleri doğrudan araç çubuğunda
	];

	//config.removeButtons = 'Underline,Subscript,Superscript';

	config.format_tags = 'p;h2;h3;h4';
	// Simplify the dialog windows.

};