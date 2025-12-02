$(function () {
	//Activo el tinymce
	tinymce.init({
		selector: 'textarea.editor',  // change this value according to your HTML
		plugin: 'a_tinymce_plugin',
		paste_as_text: true,
		paste_data_images: true,
		plugins: 'paste',
		language: 'es_AR',
		menubar: 'edit format table',
		a_plugin_option: true,
		a_configuration_option: 400
	});

// 	//Método para eliminar
// 	$('body').on('click','.delete',function(e){
// 		var u = $(this).data('url');
// 		var t = $(this).attr('title');
// 		if(typeof t === "undefined" || t == ""){
// 			t = $(this).data('original-title');
// 		}

// 		confirm('test');

// 		// bootbox.confirm({
// 		//     title: t+" Registro?",
// 		//     message: "Está seguro que desea <b>"+t+"</b> el Registro?.",
// 		//     buttons: {
// 		//         cancel: {
// 		//             label: '<i class="glyphicon glyphicon-remove"></i> Cancelar'
// 		//         },
// 		//         confirm: {
// 		//             label: '<i class="glyphicon glyphicon-ok"></i> <b>'+t+'</b>'
// 		//         }
// 		//     },
// 		//     callback: function (result) {
// 		//     	if(result){
// 		//     		//Me fijo si hay texto de mensaje
// 		//     		if(typeof m !== "undefined" && $.trim(m) != ""){
// 		//     			waitingDialog.show(m+"...");
// 		//     		}
// 		//     		location.href = u;
// 		//     	}
// 		//     }
// 		// });
// 	});
});