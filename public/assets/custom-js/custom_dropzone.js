Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("#my-dropzone", {// The camelized version of the ID of the form element
    // The configuration we've talked about above
    url: "update-employee",
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 100,
    maxFilesize: 20,
    addRemoveLinks: true,
    paramName: 'attachments',
});