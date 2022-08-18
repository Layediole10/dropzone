let total_photos_counter = 0;
Dropzone.options.myDropzone = {
    uploadMultiple: true,
    parallelUploads: 3,
    maxFilesize: 16,
    previewTemplate: document.querySelector('#preview').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'supprimer',
    dictFileTooBig: "la taille de l'image dépasse 16MB",
    timeout: 10000,
 
    init: function () {
        this.on("removedfile", function (file) {
            $.post({
                url: '/images-delete',
                data: {id: file.name, _token: $('[name="_token"]').val()},
                dataType: 'json',
                success: function (data) {
                    total_photos_counter--;
                    $("#counter").text("# " + total_photos_counter);
                }
            });
        });
    },
    success: function (file, done) {
        total_photos_counter++;
        $("#counter").text("# " + total_photos_counter);
    }
};