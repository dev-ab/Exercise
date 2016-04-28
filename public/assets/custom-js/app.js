var app = angular.module('MyApp', ['xeditable', "ui.bootstrap", "angular-bind-html-compile",
    'homeCtrl']);
app.run(function (editableOptions) {
    editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
});