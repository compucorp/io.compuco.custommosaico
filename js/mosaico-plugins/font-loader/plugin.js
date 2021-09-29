export const fontLoaderPlugin = {
    widget: function ($, ko, kojqui) {
        return {
            widget: 'fontLoader',
            parameters: { param: true },
            html: function (propAccessor, onfocusbinding, parameters) {
                let html = '';
                html += '<label class="data-fontLoader">';
                html += '<select type="text" data-bind="value: ' + propAccessor + ', ' + onfocusbinding + '">';
                html += '<optgroup label="Brand Fonts">';
                html += '</optgroup>';
                html += '<optgroup label="Sans-Serif Fonts">';
                html += '<option value="Arial,Helvetica,sans-serif">Arial</option>';
                html += '<option value="\'Comic Sans MS\',cursive,sans-serif">Comic Sans MS</option>';
                html += '<option value="Impact,Charcoal,sans-serif">Impact</option>';
                html += '<option value="\'Trebuchet MS\',Helvetica,sans-serif">Trebuchet MS</option>';
                html += '<option value="Verdana,Geneva,sans-serif">Verdana</option>';
                html += '</optgroup>';
                html += '<optgroup label="Serif Fonts">';
                html += '<option value="Georgia,serif">Georgia</option>';
                html += '<option value="\'Times New Roman\',Times,serif">Times New Roman</option>';
                html += '</optgroup>';
                html += '<optgroup label="Monospace Fonts">';
                html += '<option value="\'Courier New\',Courier,monospace">Courier New</option>';
                html += '</optgroup>';
                html += '</select>';
                html += '</label>';
                return html;
            }
        };
    },
    viewModel: function (vm) {

    }
};

