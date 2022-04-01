/*
 Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://cksource.com/ckfinder/license
 */

var config = {};
CKFinder.customConfig = function (config) {
    // Define changes to default configuration here. For example:
    config.skin = 'kama';
    config.language = 'vi';
    config.removePlugins = 'help,basket,flashupload,Flash';
    config.language = 'vi';
    config.skin = 'jquery-mobile';
    config.htmlEncodeOutput = false;

};

// Set your configuration options below.

// Examples:
// config.language = 'vi';
// config.skin = 'jquery-mobile';
// CKFinder.widget( 'ckfinder-widget', {
// 	width: '100%',
// 	height: 600,
// 	skin: 'jquery-mobile',
// 	swatch: 'a'
// } );
config.entities = false;
CKFinder.start({
    chooseFiles: true,
    width: 1100,
    height: 550,
    skin: 'jquery-mobile',
    language: 'vi'
});

CKFinder.define(config);
// CKFinder.modal({
//         chooseFiles: true,
//         width: 1100,
//         height: 550,
//         skin: 'jquery-mobile',
//         language: 'vi',
//         onInit: function (finder) {
//             finder.on('files:choose', function (e) {
//                 var path = e.data.files.first().getUrl().replace(new RegExp('^.*' + baivietid + '\/upload\/'), '');
//                 $input.val(path).trigger('change');
//             });
//         }
//     });