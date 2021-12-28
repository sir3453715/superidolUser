export const dataTable = function(ele, options = {}){
    return $(ele).dataTable(Object.assign({}, {
        language: app.admin.translations.dataTables
    }, options));
};
